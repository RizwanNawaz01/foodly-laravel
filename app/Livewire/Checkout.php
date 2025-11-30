<?php

namespace App\Livewire;

use App\Http\Helpers\CartHelper;
use App\Models\Address;
use App\Models\City;
use App\Models\Order;
use App\Models\PostalCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Checkout extends Component
{
    // Customer Information
    public $firstName = '';

    public $lastName = '';

    public $email = '';

    public $phoneNumber = '';

    public $address = '';

    public $street = '';

    public $city = '';

    public $postalCode = '';

    public $disabledEmail = false;

    // Order Details
    public $deliveryType = 'pickup';

    public $items = [];

    public $subtotal = 0;

    public $shipping = 0;

    public $tax = 0;

    public $totalPrice = 0;

    // UI Data
    public $cities = [];

    public $postalCodes = [];

    public $isRestaurantClosed = '';

    public $closedMessage = '';

    // Add this method to your Checkout component class

    public function updatedPhoneNumber($value)
    {
        // This will log whenever phoneNumber is updated
        \Log::info('Phone number updated in Livewire: '.$value);
        $this->phoneNumber = $value;
    }

    protected function rules()
    {
        // Make address fields optional for pickup orders
        return [
            'firstName' => 'required|string|min:2|max:50',
            'lastName' => 'required|string|min:2|max:50',
            'email' => 'required|email',
            'phoneNumber' => 'required',
            'address' => $this->deliveryType === 'delivery' ? 'required|string|max:255' : 'nullable|string|max:255',
            'street' => $this->deliveryType === 'delivery' ? 'required|string|max:255' : 'nullable|string|max:255',
            'city' => $this->deliveryType === 'delivery' ? 'required|string|max:100' : 'nullable|string|max:100',
            'postalCode' => $this->deliveryType === 'delivery' ? 'required|string|max:10' : 'nullable|string|max:10',
        ];
    }

    protected $messages = [
        'firstName.required' => 'First name is required',
        'lastName.required' => 'Last name is required',
        'email.required' => 'Email is required',
        'email.email' => 'Please enter a valid email',
        'phoneNumber.required' => 'Phone number is required',
        'address.required' => 'Address is required',
        'street.required' => 'Street is required',
        'city.required' => 'City is required',
        'postalCode.required' => 'Postal code is required',
    ];

    public function mount()
    {
        $this->isRestaurantClosed = restaurant_closed_time();
        $this->closedMessage = site_settings('order_outside_time');

        if ($this->isRestaurantClosed) {

            return redirect()->with('message', $this->closedMessage)
                ->with('type', 'warning')
                ->route('front.home');

        }
        // Load cart items from session
        $this->items = Session::get('cart_items', []);

        if (empty($this->items)) {
            return redirect()->route('front.home')->with('error', 'Your cart is empty');
        }

        // Load delivery type
        $this->deliveryType = Session::get('cart_delivery_type', 'pickup');

        // Load user data if authenticated
        $this->loadUser();

        // Load cities
        $this->cities = City::orderBy('name')->get();

        // Calculate totals
        $this->calculateTotals();
    }

    public function loadUser()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $address = Address::where('user_id', $user->id)->first();

            $this->firstName = $address->first_name ?? '';
            $this->lastName = $address->last_name ?? '';
            $this->email = $user->email ?? '';
            $this->phoneNumber = $address->phone_number ?? '';
            $this->address = $address->address ?? '';
            $this->street = $address->street ?? '';
            $this->city = $address->city_id ?? '';
            $this->postalCode = $address->postal_code_id ?? '';

            $this->disabledEmail = true;

            // Load postal codes if city is set
            if ($this->city) {
                $this->handleCityChange();
            }
        } else {
            // Guest user - allow empty fields
            $this->disabledEmail = false;
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = 0;

        foreach ($this->items as $item) {
            $basePrice = $item['price'] ?? 0;

            // Add extras
            $extrasPrice = 0;
            if (! empty($item['extras'])) {
                foreach ($item['extras'] as $extra) {
                    $extrasPrice += $extra['price'] ?? 0;
                }
            }

            $this->subtotal += ($basePrice + $extrasPrice) * $item['quantity'];
        }

        // Calculate shipping (6 for delivery if subtotal > 0)
        $this->shipping = ($this->deliveryType === 'delivery' && $this->subtotal > 0) ? 0 : 0;

        // Calculate tax (5%)
        $this->tax = $this->subtotal * 0.05;

        // Calculate total
        $this->totalPrice = $this->subtotal + $this->shipping + $this->tax;
    }

    public function setDeliveryType($type)
    {
        $this->deliveryType = $type;
        Session::put('cart_delivery_type', $type);
        CartHelper::updatePricesByDeliveryType($type);
        $this->items = Session::get('cart_items', []);
        $this->calculateTotals();
    }

    public function handleCityChange()
    {
        $this->postalCode = '';
        $this->postalCodes = [];

        if ($this->city) {
            $this->postalCodes = PostalCode::where('city_id', $this->city)
                ->orderBy('code')
                ->get();
        }
    }

    public function increaseQuantity($itemKey)
    {
        $items = Session::get('cart_items', []);

        if (isset($items[$itemKey])) {
            $items[$itemKey]['quantity']++;
            Session::put('cart_items', $items);
            $this->items = $items;
            $this->calculateTotals();
            $this->dispatch('cartUpdated');
        }
    }

    public function decreaseQuantity($itemKey)
    {
        $items = Session::get('cart_items', []);

        if (isset($items[$itemKey])) {
            if ($items[$itemKey]['quantity'] > 1) {
                $items[$itemKey]['quantity']--;
            } else {
                unset($items[$itemKey]);
            }
            Session::put('cart_items', $items);
            $this->items = $items;
            $this->calculateTotals();
            $this->dispatch('cartUpdated');
        }
    }

    public function removeItem($itemKey)
    {
        $items = Session::get('cart_items', []);
        unset($items[$itemKey]);
        Session::put('cart_items', $items);
        $this->items = $items;
        $this->calculateTotals();
        $this->dispatch('cartUpdated');

        // Redirect if cart is empty
        if (empty($this->items)) {
            return redirect()->route('front.home')->with('error', 'Your cart is empty');
        }
    }

    public function submitOrder()
    {
        // Debug before validation
        \Log::info('Phone number before validation: '.$this->phoneNumber);
        \Log::info('All form data: ', [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
        ]);
        $validated = $this->validate($this->rules(), $this->messages);

        // Check if cart is empty
        if (empty($this->items)) {

            return redirect()->with('message', 'Your cart is empty')
                ->with('type', 'error')
                ->route('front.home');
        }

        // Check minimum order amount

        if ($this->deliveryType == 'delivery') {
            $city = City::where('id', $this->city)->first();
            if ($this->totalPrice < $city->min_order_amount) {
                return redirect()->with('message', 'Your order total must be at least '.format_currency($city->min_order_amount))
                    ->with('type', 'error')
                    ->route('front.checkout');
            }
        } else {
            if ($this->totalPrice < site_settings('minOrder', 0)) {
                return redirect()->with('message', 'Your order total must be at least '.format_currency(site_settings('minOrder', 0)))
                    ->with('type', 'error')
                    ->route('front.checkout');
            }
        }

        try {
            // Prepare customer info (allow empty fields for guest pickup orders)
            $customerInfo = [
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'email' => $this->email,
                'phoneNumber' => $this->phoneNumber,
                'address' => $this->address ?? '',
                'street' => $this->street ?? '',
                'city' => $this->city ?? '',
                'postalCode' => $this->postalCode ?? '',
                'password' => '',
            ];

            // Format items for order
            $orderItems = [];
            foreach ($this->items as $item) {
                $orderItems[] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'extras' => $item['extras'] ?? [],
                ];
            }

            // Create order (user_id will be null for guest users)
            $order = Order::create([
                'user_id' => Auth::id(), // Will be null for guests
                'orderCode' => $this->generateOrderCode(),
                'customerInfo' => $customerInfo,
                'items' => $orderItems,
                'totalPrice' => $this->totalPrice,
                'status' => 'pending',
                'eta' => '',
                'deliveryType' => $this->deliveryType,
            ]);

            // Clear cart
            Session::forget('cart_items');
            Session::forget('cart_delivery_type');
            $this->dispatch('cartUpdated');

            // Redirect to confirmation page
            return redirect()->route('front.order_confirmed', $order->orderCode)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            \Log::error('Order submission failed: '.$e->getMessage());
            dd($e);
            session()->flash('error', 'Failed to place order. Please try again.');
        }
    }

    private function generateOrderCode()
    {
        return 'ORD-'.time().rand(1000, 9999).'-'.rand(1000, 9999);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
