<?php

namespace App\Livewire;

use App\Models\Slider as AdminSlider;
use Livewire\Component;

class Slider extends Component
{
    public $sliders;

    public function render()
    {
        $this->sliders = AdminSlider::where('is_active', 1)
            ->orderBy('order')
            ->get();

        return view('livewire.slider');
    }

    public function sliderImage($image)
    {
        return asset('storage/'.$image);
    }
}
