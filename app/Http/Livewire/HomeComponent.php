<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HomeSlider;

class HomeComponent extends Component
{
    public function render()
    {
        $slides = HomeSlider::whereStatus(1)->get();
        return view('livewire.home-component', compact('slides'));
    }
}
