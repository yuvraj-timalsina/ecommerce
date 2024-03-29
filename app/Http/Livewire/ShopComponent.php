<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    use WithPagination;

    public $pageSize = 12;
    public $orderBy = 'Default Sorting';
    public $minValue = 0;
    public $maxValue = 1000;


    public function store($product_id, $product_name, $product_price): void
    {
        $cartItem = Product::find($product_id);
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price, ['slug' => $cartItem->slug, 'image'=>$cartItem->image])->associate('Product');
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
            $products = Product::whereBetween('regular_price', [$this->minValue, $this->maxValue])
                ->orderBy('regular_price')
                ->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Price: High to Low') {
            $products = Product::whereBetween('regular_price', [$this->minValue, $this->maxValue])
                ->orderByDesc('regular_price')
                ->paginate($this->pageSize);
        } elseif ($this->orderBy === 'Sort By Newest') {
            $products = Product::whereBetween('regular_price', [$this->minValue, $this->maxValue])
                ->orderByDesc('created_at')
                ->paginate($this->pageSize);
        } else {
            $products = Product::whereBetween('regular_price', [$this->minValue, $this->maxValue])->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name')->get();

        return view('livewire.shop-component', compact('products', 'categories'));
    }
}
