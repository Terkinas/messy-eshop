<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function menu()
    {
        try {
            if (auth()->user()->admin) {
                return view('pages.admin.menu');
            } else {
                return redirect()->route('404');
            }
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function toggle()
    {
        try {
            if (auth()->user()->admin) {
                $products = Product::select('id', 'name', 'urltag', 'price', 'color', 'image_path', 'subtitle', 'category')->orderBy('quantity_sold', 'asc')->paginate(14)->onEachSide(2);

                return view('pages.admin.toggle', compact('products'));
            } else {
                return redirect()->route('404');
            }
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }
}
