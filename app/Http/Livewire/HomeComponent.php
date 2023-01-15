<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\HomeSlider;

class HomeComponent extends Component
{
    public function render()
    {
        $slides = HomeSlider::whereStatus(1)->get();
        $new_arrivals = Product::orderByDesc('created_at')->get()->take(8);
        return view('livewire.home-component', compact('slides', 'new_arrivals'));
    }
}
