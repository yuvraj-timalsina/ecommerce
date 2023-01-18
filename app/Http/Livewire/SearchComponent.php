<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Gloudemans\Shoppingcart\Facades\Cart;

class SearchComponent extends Component
{
    use WithPagination;

    public $pageSize = 12;
    public $orderBy = 'Default Sorting';
    public $query;
    public $searchTerm;


    public function mount(): void
    {
        $this->fill(request()?->only('query'));
        $this->searchTerm = '%' . $this->query . '%';
    }


    public function store($product_id, $product_name, $product_price): void
    {
        $cartItem = Product::find($product_id);
        Cart::instance('cart')
            ->add($product_id, $product_name, 1, $product_price, ['slug' => $cartItem->slug, 'image' => $cartItem->image])
            ->associate('Product');
        $this->emitTo('cart-icon-component', 'refreshComponent');

        flasher('Product Added To Cart Successfully!');

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


    public function addToWishlist($product_id, $product_name, $product_price): void
    {
        $cartItem = Product::findOrFail($product_id);
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price, ['slug' => $cartItem->slug])->associate('Product');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }


    public function removeFromWishlist($product_id): void
    {
        foreach (Cart::instance('wishlist')->content() as $item) {
            if ($item->id === $product_id) {
                Cart::instance('wishlist')->remove($item->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');

                return;
            }
        }
    }


    public function render(): View
    {
        if ($this->orderBy === 'Price: Low to High') {
            $products = Product::where('name', 'LIKE', $this->searchTerm)
                ->orderBy('regular_price')->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Price: High to Low') {
            $products = Product::where('name', 'LIKE', $this->searchTerm)
                ->orderByDesc('regular_price')->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Sort By Newest') {
            $products = Product::where('name', 'LIKE', $this->searchTerm)
                ->orderByDesc('created_at')->paginate($this->pageSize);
        } else {
            $products = Product::where('name', 'LIKE', $this->searchTerm)
                ->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name')->get();

        return view('livewire.search-component', compact('products', 'categories'));
    }
}
