<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class HeaderSearchComponent extends Component
{
    public $query;


    public function mount(): void
    {
        $this->fill(request()?->only('query'));
    }


    public function render(): View
    {
        return view('livewire.header-search-component');
    }
}
