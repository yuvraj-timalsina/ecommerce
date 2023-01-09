<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductDetailsComponent extends Component
{
    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
    }


    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $new_arrivals = Product::latest()->limit(3)->get();

        return view('livewire.product-details-component', compact('product', 'related_products', 'new_arrivals'));
    }
}
