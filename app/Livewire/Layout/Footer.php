<?php

namespace App\Livewire\Layout;

use App\Models\Setting;
use Livewire\Component;

class Footer extends Component
{
    public $settings;

    public $openingHours;

    public function mount()
    {
        $this->settings = Setting::first();

        // Ensure openingHours is always an array
        $this->openingHours = is_array($this->settings->openingHours)
            ? $this->settings->openingHours
            : json_decode($this->settings->openingHours, true);
    }

    public function render()
    {
        return view('livewire.layout.footer');
    }
}
