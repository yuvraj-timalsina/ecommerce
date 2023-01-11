<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class SearchComponent extends Component
{
    use WithPagination;

    public $pageSize = 12;
    public $orderBy = 'Default Sorting';
    public $query;
    public $searchTerm;


    public function mount()
    {
        $this->fill(request()->only('query'));
        $this->searchTerm = '%' . $this->query . '%';
    }


    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('Product');
        session()->flash('success_message', 'Item Added To Cart!');

        to_route('shop.cart');
    }


    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }


    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }


    public function render()
    {
        if ($this->orderBy == 'Price: Low to High') {
            $products = Product::where('name', 'LIKE', $this->searchTerm)->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } elseif ($this->orderBy == 'Price: High to Low') {
            $products = Product::where('name', 'LIKE', $this->searchTerm)->orderByDesc('regular_price')->paginate($this->pageSize);
        } elseif ($this->orderBy == 'Sort By Newest') {
            $products = Product::where('name', 'LIKE', $this->searchTerm)->orderByDesc('created_at')->paginate($this->pageSize);
        } else {
            $products = Product::where('name', 'LIKE', $this->searchTerm)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('livewire.search-component', compact('products', 'categories'));
    }
}
