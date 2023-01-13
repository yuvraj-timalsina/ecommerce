<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $quantity = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $quantity);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }


    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $quantity = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $quantity);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);
        session()->flash('success_message', 'Item Removed From Cart!');
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }
  public function clearCart()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
