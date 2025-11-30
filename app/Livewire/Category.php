<?php

namespace App\Livewire;

use App\Models\Category as CategoryModel;
use Livewire\Component;

class Category extends Component
{
    public $categories;

    public function render()
    {
        $this->categories = CategoryModel::all();

        return view('livewire.category');
    }
}
