<?php

namespace App\Http\Controllers;

use App\Mail\MadePurchase;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        try {
            $products = Product::select('id', 'name', 'urltag', 'price', 'color', 'image_path', 'subtitle', 'quantity', 'category')->orderBy('created_at', 'desc')->where('active', 1)->paginate(7)->onEachSide(1);
            $topSellers = Product::select('id', 'name', 'urltag', 'price', 'color', 'image_path', 'subtitle', 'quantity', 'category')->orderBy('size', 'asc')->where('active', 1)->where('quantity', '>', 0)->paginate(2)->onEachSide(1);
            return view('pages.commerce.welcome', compact('products', 'topSellers'));
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function index()
    {
        try {
            $products = Product::select('id', 'name', 'urltag', 'price', 'color', 'quantity', 'image_path', 'subtitle', 'category')->orderBy('quantity_sold', 'desc')->where('active', 1)->paginate(6)->onEachSide(1);

            $productsPopular = Product::select('id', 'name', 'urltag', 'price', 'color', 'quantity', 'image_path', 'subtitle', 'category')->orderBy('quantity_sold', 'desc')->where('active', 1)->paginate(4)->onEachSide(1);
            return view('pages.commerce.catalog', compact('products', 'productsPopular'));
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (auth()->user()->admin) {
                return view('pages.admin.create');
            } else {
                return redirect()->route('404');
            }
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (isset(auth()->user()->admin)) {
                if (auth()->user()->admin) {

                    $validated = $request->validate([
                        'name' => 'required|max:255',
                        'urltag' => 'required|max:255',

                        'subtitle' => 'required|max:255',
                        'description' => 'required|max:1024',

                        'category' => 'max:30',

                        'color' => 'max:30',
                        'size' => 'max:30',

                        'stock_price',
                        'price' => 'required',
                        'price_onsale',

                        'quantity' => 'required',

                        'subtag1' => 'max:30',
                        'subtag2' => 'max:30',

                        'active',

                        'added_by',

                        'image' => 'required|mimes:jpg,png,jpeg',
                    ]);

                    $naming = str_replace(' ', '-', $request->name);

                    $newImageName = time() . '-' . $naming . '-' .
                        $request->image->extension();

                    Product::create([
                        'name' => request('name'),
                        'urltag' => str_replace(' ', '-', strtolower(request('urltag'))),

                        'subtitle' => request('subtitle'),
                        'description' => request('description'),

                        'category' => strtolower(request('category')),

                        'color' =>  strtolower(request('color')),
                        'size' => request('size'),

                        'stock_price' => request('stock_price'),
                        'price' => request('price'),
                        'price_onsale' => 0,

                        'quantity' => request('quantity'),
                        'quantity_sold' => 0,

                        'subtag1' => request('subtag1'),
                        'subtag2' => request('subtag2'),

                        'active' => request('active') ? true : false,

                        'added_by' => User::select('id')->where('id', auth()->user()->id)->first()->id,

                        'onsale' => 0,

                        'image_path' => $newImageName,


                    ]);

                    $request->image->move(public_path('images/products'), $newImageName);
                } else {
                    return redirect()->route('products.index')->with('status', 'Error: You do not have permission');
                }
            }

            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        try {
            $reviews = Review::select('id', 'name', 'heading', 'description', 'rating', 'created_at')->where('product_id', $id)->where('accepted', true)->orderBy('created_at', 'desc')->paginate(6)->onEachSide(1);
            $product = Product::select('id', 'name', 'price', 'urltag', 'color', 'category', 'description', 'size', 'quantity', 'quantity_sold', 'image_path')->where('id', $id)->get();
            $reviewsRatings = Review::select('rating')->where('product_id', $id)->where('accepted', true)->get();

            $avarageRate = 0;
            if ($reviews->total() > 0) {
                foreach ($reviewsRatings as $review) {
                    $avarageRate += (($review->rating * 100) / $reviews->total());
                }
            }


            return view('pages.commerce.preview', compact('product', 'reviews', 'avarageRate'));
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    // public function show($id, $da)
    // {
    //     try {
    //         $product = Product::select('id', 'name', 'price', 'color', 'category', 'description', 'size', 'quantity_sold', 'image_path')->where('id', $id)->get();
    //         return view('pages.commerce.preview', compact('product'));
    //     } catch (\Exception $e) {
    //         return redirect()->route('404')->with('error', $e);
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            if (isset(auth()->user()->admin)) {
                $product = Product::find($id)->get();
                return view('pages.admin.edit', compact('product'));
            }
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            if (auth()->user()->admin) {
                $product = Product::find($id);
                $product->name = $input['name'];
                $product->subtitle = $input['subtitle'];
                $product->description = $input['description'];
                $product->category = $input['category'];
                $product->color = $input['color'];
                $product->size = $input['size'];
                $product->stock_price = $input['stock_price'];
                $product->price = $input['price'];
                // $product->price_onsale = $input['price_onsale'];
                $product->quantity = $input['quantity'];
                $product->subtag1 = $input['subtag1'];
                $product->subtag2 = $input['subtag2'];

                if (isset($input['active'])) {
                    $product->active = true;
                } else {
                    $product->active = false;
                }


                if (isset($input['image'])) {
                    $naming = str_replace(' ', '-', $input['name']);
                    $newImageName = time() . '-' . $naming . '-' .
                        $request->image->extension();

                    $product->image_path = $newImageName;
                }
                $product->save();

                return redirect()->route('products.index');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('404')->with('error', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function search(Request $request)
    {
        try {

            $keyword = ucwords($request->keyword);

            // $products = Product::select('id', 'name', 'urltag', 'price', 'color', 'image_path', 'subtitle', 'category', 'quantity')->where('name', 'LIKE', '%' . strtoupper($keyword) . '%')->orWhere('subtitle', 'LIKE', '%' . $keyword . '%')->orderBy('quantity_sold', 'asc')->paginate(6);

            // postgres not support this
            //$products = Product::select('id', 'name', 'urltag', 'price', 'color', 'image_path', 'subtitle', 'category', 'quantity')->whereRaw('UPPER(`name`) LIKE ?', ['%' . strtoupper($keyword) . '%'])->orWhere('subtitle', 'LIKE', '%' . $keyword . '%')->orderBy('quantity_sold', 'asc')->paginate(6);

            $products = Product::select('id', 'name', 'urltag', 'price', 'color', 'image_path', 'subtitle', 'category', 'quantity')->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('subtitle', 'LIKE', '%' . $keyword . '%')->orderBy('quantity_sold', 'asc')->paginate(6)->onEachSide(1);

            $productsPopular = Product::select('id', 'name', 'urltag', 'price', 'color', 'quantity', 'image_path', 'subtitle', 'category')->orderBy('quantity_sold', 'desc')->where('active', 1)->paginate(4)->onEachSide(1);


            $results = 'These are results we were able to found:';
            return view('pages.commerce.catalog', compact('products', 'results', 'productsPopular'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('404')->with('error', $e);
        }
    }
}
