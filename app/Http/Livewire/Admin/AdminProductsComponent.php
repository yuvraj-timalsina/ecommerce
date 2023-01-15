<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class AdminProductsComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::orderByDesc('created_at')->paginate(10);

        return view('livewire.admin.admin-products-component', compact('products'));
    }
}
