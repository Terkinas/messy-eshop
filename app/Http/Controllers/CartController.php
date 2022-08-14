<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{

    public function store(Request $request, $id)
    {
        try {
            $product = Product::select('id', 'name', 'price', 'color', 'image_path')->where('id', $id)->where('quantity', '>', 0)->firstOrFail();
            $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

            $cart = new Cart($oldCart);

            $cart->add($product, $product->id, $request->choosedQty);
            $request->session()->put('cart', $cart);
            // session()->forget('cart');
            // return redirect()->route('products.index')->with('success', 'Product has been added successfully');
            return redirect()->back()->with('success', 'Product has been added successfully');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $product = Product::select('id', 'name', 'price', 'color', 'image_path')->where('id', $id)->firstOrFail();
            $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

            $cart = new Cart($oldCart);

            $cart->update($product, $product->id, $request->choosedQty);
            $request->session()->put('cart', $cart);
            // session()->forget('cart');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function remove(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

            $cart = new Cart($oldCart);
            $cart->remove($product, $product->id);

            $request->session()->put('cart', $cart);

            return back()->with('success', 'Item has been removed successfully');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function checkout(Request $request)
    {

        try {

            if (session()->has('cart')) {
                $cart = session()->get('cart');

                foreach ($cart->items as $key => $item) {
                    //dd($item['qty']);

                }

                return view('pages.commerce.checkout', ['cart' => $cart->items, 'totalPrice' => $cart->totalPrice]);
            }


            return view('pages.commerce.checkout', ['cart' => null, 'totalPrice' => 0]);
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }
}
