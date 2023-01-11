<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;

class ShopComponent extends Component
{
    use WithPagination;

    public $pageSize = 12;
    public $orderBy = 'Default Sorting';


    public function store($product_id, $product_name, $product_price): void
    {
        $cartItem = Product::findOrFail($product_id);
        Cart::add($product_id, $product_name, 1, $product_price, ['slug' => $cartItem->slug])->associate('Product');
        session()->flash('success_message', 'Item Added To Cart!');

        to_route('shop.cart');
    }


    public function changePageSize($size): void
    {
        $this->pageSize = $size;
    }


    public function changeOrderBy($order): void
    {
        $this->orderBy = $order;
    }


    public function render(): Factory|View|Application
    {
        if ($this->orderBy === 'Price: Low to High') {
            $products = Product::orderBy('regular_price')->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Price: High to Low') {
            $products = Product::orderByDesc('regular_price')->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Sort By Newest') {
            $products = Product::orderByDesc('created_at')->paginate($this->pageSize);
        } else {
            $products = Product::paginate($this->pageSize);
        }
        $categories = Category::orderBy('name')->get();

        return view('livewire.shop-component', compact('products', 'categories'));
    }
}
