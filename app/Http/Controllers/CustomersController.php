<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Order;
use App\Models\PostalCode;
use App\Models\User;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::orderBy('id', 'desc')->paginate(45);

        return view('backend.customers.index', compact('customers'));
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        $address = Address::where('user_id', $customer->id)->first();
        $cities = City::all();
        if ($address) {
            $postalCodes = PostalCode::where('city_id', $address->city_id)->get();
        } else {
            $postalCodes = PostalCode::all();
        }

        return view('backend.customers.edit', compact('customer', 'address', 'cities', 'postalCodes'));
    }

    // Update customer info
    public function updateCustomer(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$customer->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];

        if (! empty($validated['password'])) {
            $customer->password = bcrypt($validated['password']);
        }

        $customer->save();

        return back()->with('success', __('Customer updated successfully.'));
    }

    // Update address info
    public function updateAddress(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'street' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'postal_code_id' => 'required|exists:postal_codes,id',
        ]);

        if ($request->has('address_id')) {
            $address = Address::find($request->address_id);
        } else {
            $address = new Address;
            $address->user_id = $customer->id;
        }

        $address->first_name = $validated['first_name'];
        $address->last_name = $validated['last_name'];
        $address->phone = $validated['phone'];
        $address->address = $validated['address'];
        $address->street = $validated['street'];
        $address->city_id = $validated['city_id'];
        $address->postal_code_id = $validated['postal_code_id'];

        $address->save();

        return back()->with('success', __('Address updated successfully.'));
    }

    public function dashboard()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(45);

        return view('frontend.customer.dashboard', compact('orders'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(45);

        return view('frontend.customer.orders', compact('orders'));
    }

    public function profile()
    {
        return view('frontend.customer.profile');
    }

    public function address()
    {
        $cities = City::all();
        $address = Address::where('user_id', auth()->user()->id)->first();
        if ($address) {
            $postalCodes = PostalCode::where('city_id', $address->city_id)->get();
        } else {
            $postalCodes = PostalCode::all();
        }

        return view('frontend.customer.address', compact('cities', 'address', 'postalCodes'));
    }

    public function saveAddress()
    {
        $address = Address::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'first_name' => request('first_name'),
                'last_name' => request('last_name'),
                'phone' => request('phone'),
                'email' => auth()->user()->email,
                'city_id' => request('city_id'),
                'postal_code_id' => request('postal_code_id'),
                'address' => request('address'),
                'street' => request('street'),
            ]
        );

        return redirect()->route('customer.dashboard');
    }

    public function getPostalCodes($city)
    {
        $postalCodes = PostalCode::where('city_id', $city)->get();

        return response()->json($postalCodes);
    }
}
