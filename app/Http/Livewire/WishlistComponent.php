<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistComponent extends Component
{
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
        return view('livewire.wishlist-component');
    }
}
