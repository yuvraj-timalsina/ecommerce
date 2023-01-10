<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    use WithPagination;

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('Product');
        session()->flash('success_message', 'Item Added To Cart!');

        to_route('shop.cart');
    }


    public function render()
    {
        $products = Product::paginate(12);

        return view('livewire.shop-component', compact('products'));
    }
}
