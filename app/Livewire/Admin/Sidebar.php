<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class Sidebar extends Component
{
    public $openMenu = null;

    public $ordersCount = 0;

    public function mount()
    {
        $this->ordersCount = Order::where('status', 'pending')->count();
    }

    public function toggleMenu($menu)
    {
        $this->openMenu = $this->openMenu === $menu ? null : $menu;
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.admin.sidebar');
    }
}
