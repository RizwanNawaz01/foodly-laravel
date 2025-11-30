<?php

namespace App\Livewire\Layout;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public $siteName;

    public $navLinks = [];

    public $currentLanguage = 'EN';

    public $isMenuOpen = false;

    public $isLanguageOpen = false;

    public $isUserDropdown = false;

    public $cartCount = 0;

    public $user;

    public $isAdmin = false;

    public $ordersCount = 0;

    // Delivery
    public $deliveryMode;

    public $deliveryAddress;

    // Modals
    public $isCartOpen = false;

    public $isLoginOpen = false;

    public $isSignupOpen = false;

    public $isForgetOpen = false;

    public $isPostalCodeOpen = false;

    protected $listeners = [
        'cartUpdated' => 'updateCartCount',
        'deliverySelected' => 'updateDeliveryInfo',
        'deliveryUpdated' => 'updateDeliveryInfo',
    ];

    public function mount()
    {
        // Load settings
        $settings = Setting::first();
        $this->siteName = $settings->siteName ?? 'Foodly';

        $this->navLinks = $settings->services
            ? collect($settings->services)->map(fn ($s) => [
                'href' => $s['description'] ?? '#',
                'label' => $s['name'] ?? '',
            ])->toArray()
            : [];

        // Load cart count from session
        $this->updateCartCount();

        // Load user
        if (Auth::check()) {
            $this->user = Auth::user();
            $this->isAdmin = $this->user->role === 'admin';
            $this->ordersCount = $this->user->orders()->count();
        }

        // Load delivery mode
        $this->updateDeliveryInfo();

        if (! $this->deliveryMode) {
            $this->isPostalCodeOpen = true;
        }

        // Load language - Just set the display, middleware handles the actual locale
        $this->currentLanguage = strtoupper(Session::get('language', 'en'));
    }

    public function updateCartCount()
    {
        $items = Session::get('cart_items', []);
        $this->cartCount = array_sum(array_column($items, 'quantity'));
    }

    public function updateDeliveryInfo()
    {
        $this->deliveryMode = Session::get('delivery.mode');
        $this->deliveryAddress = Session::get('delivery.address');
    }

    public function toggleMenu()
    {
        $this->isMenuOpen = ! $this->isMenuOpen;
    }

    public function toggleLanguage()
    {
        $this->isLanguageOpen = ! $this->isLanguageOpen;
    }

    public function selectLanguage($lang)
    {
        $this->currentLanguage = strtoupper($lang);
        Session::put('language', strtolower($lang));
        $this->isLanguageOpen = false;

        return redirect(request()->header('Referer'));
    }

    public function toggleUserDropdown()
    {
        $this->isUserDropdown = ! $this->isUserDropdown;
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('front.home');
    }

    public function openModal($modal)
    {
        $this->{$modal} = true;

        // Dispatch event to open cart component
        if ($modal === 'isCartOpen') {
            $this->dispatch('openCart');
        }
    }

    public function closeModal($modal)
    {
        $this->{$modal} = false;

        // Dispatch event to close cart component
        if ($modal === 'isCartOpen') {
            $this->dispatch('closeCart');
        }
    }

    public function openSearchModal()
    {
        $this->dispatch('openSearchModal');
    }

    public function savePostal($mode, $city = null, $postalCode = null)
    {
        if ($mode === 'pickup') {
            Session::put('delivery.mode', 'pickup');
            Session::forget('delivery.address');
        } else {
            Session::put('delivery.mode', 'delivery');
            Session::put('delivery.address', "$city, $postalCode");
        }

        $this->updateDeliveryInfo();
        $this->isPostalCodeOpen = false;

        $this->dispatch('deliveryUpdated');
    }

    public function openPostalModal()
    {
        $this->dispatch('openDeliveryModal');
    }

    public function render()
    {
        return view('livewire.layout.header');
    }
}
