<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId): void
    {
        $product = Cart::instance('cart')->get($rowId);
        $quantity = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $quantity);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }


    public function decreaseQuantity($rowId): void
    {
        $product = Cart::instance('cart')->get($rowId);
        $quantity = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $quantity);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function destroy($id): void
    {
        Cart::instance('cart')->remove($id);
        session()->flash('success_message', 'Item Removed From Cart!');
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }
  public function clearCart(): void
  {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function render(): View
    {
        return view('livewire.cart-component');
    }
}
