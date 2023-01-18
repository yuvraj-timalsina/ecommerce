<?php

namespace App\Http\Livewire\Admin;

use File;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class AdminProductsComponent extends Component
{
    use WithPagination;

    public $product_id;


    public function deleteProduct(): void
    {
        $product = Product::findOrFail($this->product_id);
        if (File::exists($product->image)) {
            unlink(public_path('/storage/' . $product->image));
        }
        $product->delete();

        flasher('Product Deleted Successfully!');
    }


    public function render(): View
    {
        $products = Product::orderByDesc('created_at')->paginate(10);

        return view('livewire.admin.admin-products-component', compact('products'));
    }
}
