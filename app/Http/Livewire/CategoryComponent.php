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

class CategoryComponent extends Component
{
    use WithPagination;

    public $pageSize = 12;
    public $orderBy = 'Default Sorting';
    public $slug;


    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('Product');
        flasher('Item Added To Cart Successfully!');

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


    public function mount($slug): void
    {
        $this->slug = $slug;
    }


    public function render(): Factory|View|Application
    {
        $category = Category::where('slug', $this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        if ($this->orderBy === 'Price: Low to High') {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price')->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Price: High to Low') {
            $products = Product::where('category_id', $category_id)->orderByDesc('regular_price')->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Sort By Newest') {
            $products = Product::where('category_id', $category_id)->orderByDesc('created_at')->paginate($this->pageSize);
        } else {
            $products = Product::where('category_id', $category_id)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name')->get();

        return view('livewire.category-component', compact('products', 'categories', 'category_name'));
    }
}
