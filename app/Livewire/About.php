<?php

namespace App\Livewire;

use App\Models\About as AboutUs;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $about = AboutUs::first();

        return view('livewire.about', compact('about'));
    }
}
