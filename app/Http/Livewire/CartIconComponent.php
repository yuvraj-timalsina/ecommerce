<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class CartIconComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render(): View
    {
        return view('livewire.cart-icon-component');
    }
}
