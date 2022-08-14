<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class CartPreview extends Component
{
    public function render()
    {
        if (session()->has('cart')) {
            $cart = session()->get('cart');


            return view('livewire.cart-preview', ['cart' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        } else {
            return view('livewire.cart-preview', ['totalPrice' => '0']);
        }
    }
}
