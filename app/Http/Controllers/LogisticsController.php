<?php

namespace App\Http\Controllers;

use App\Mail\OrderDispatched;
use App\Models\Omniva;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LogisticsController extends Controller
{

    public function omniva(Request $request)
    {
        dd($request->terminalId);
        return redirect()->back();
    }

    public function orders()
    {
        try {
            if (auth()->user()->admin) {
                $orders = Order::orderBy('id', 'ASC')->where('dispatched', 0)->paginate(50);
                foreach ($orders as $order) {
                    $omnivas[] = Omniva::where('order_id', $order->id)->get();
                }
                $orderedproducts = OrderProduct::get();

                $products = Product::get();
                return view('pages.logistics.orders', compact('orders', 'orderedproducts', 'products', 'omnivas'));
            }
        } catch (\Exception $e) {
            dd($e);
            return back()->withErrors('Error, try again' . $e);
        }
    }

    public function allorders()
    {
        try {
            if (auth()->user()->admin) {
                $orders = Order::orderBy('id', 'ASC')->where('id', '>', 0)->paginate(50);
                foreach ($orders as $order) {
                    $omnivas[] = Omniva::where('order_id', $order->id)->get();
                }

                $orderedproducts = OrderProduct::get();

                $products = Product::get();
                return view('pages.logistics.allorders', compact('orders', 'orderedproducts', 'products', 'omnivas'));
            }
        } catch (\Exception $e) {
            return back()->withErrors('Error, try again' . $e);
        }
    }

    public function dispatched(Request $request, $id)
    {
        try {
            if (auth()->user()->admin) {
                $order = Order::find($id);
                $order->dispatched = !$order->dispatched;
                $order->save();

                $terminal = Omniva::where('order_id', $order->id)->first();
                if (!isset($terminal)) {
                    $terminal = null;
                }

                Mail::to($request['email'])->send(new OrderDispatched($order, $request['tracklink'], $terminal));
            }
            return redirect()->route('logistics.orders');
        } catch (\Exception $e) {
            return back()->withErrors('Error, try again' . $e);
        }
    }
}
