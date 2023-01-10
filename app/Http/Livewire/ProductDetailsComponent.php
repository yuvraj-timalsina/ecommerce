<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductDetailsComponent extends Component
{
    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
    }

     public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('Product');
        session()->flash('success_message', 'Product Added To Cart!');

        to_route('shop.cart');
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $new_arrivals = Product::latest()->limit(3)->get();

        return view('livewire.product-details-component', compact('product', 'related_products', 'new_arrivals'));
    }
}
