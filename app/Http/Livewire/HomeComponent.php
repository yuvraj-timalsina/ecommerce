<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomeSlider;
use Illuminate\Contracts\View\View;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeComponent extends Component
{
    public function store($product_id, $product_name, $product_price): void
    {
        $cartItem = Product::findOrFail($product_id);
        Cart::instance('cart')
            ->add($product_id, $product_name, 1, $product_price, ['slug' => $cartItem->slug, 'image' => $cartItem->image])
            ->associate
            ('Product');
        $this->emitTo('cart-icon-component', 'refreshComponent');

        session()->flash('success_message', 'Item Added To Cart!');
        to_route('shop.cart');
    }


    public function render(): View
    {
        $slides = HomeSlider::whereStatus(1)->get();
        $new_arrivals = Product::orderByDesc('created_at')->get()->take(8);
        $featured_products = Product::whereFeatured(1)->inRandomOrder()->get()->take(8);
        $popular_categories = Category::whereIsPopular(1)->inRandomOrder()->get()->take(8);

        return view('livewire.home-component', compact('slides', 'new_arrivals', 'featured_products', 'popular_categories'));
    }
}
