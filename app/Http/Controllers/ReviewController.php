<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'heading' => 'required|max:255',
                'description' => 'max:1024',
                'rating' => 'required',
            ]);

            if ($request->rating > 5 || $request->rating < 1) {
                return redirect()->route('404');
            }


            Review::create([
                'heading' => request('heading'),
                'description' => request('description') || '',
                'rating' => request('rating'),

                'user_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'product_id' => $id,
                'accepted' => false,


            ]);

            return redirect()->back()->with('success', 'Thanks for your feedback, it will appear once it is reviewed');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function reviews_all()
    {

        try {
            if (auth()->user()->admin) {
                $reviews = Review::where('accepted', false)->orderBy('created_at', 'desc')->get();
                $products = Product::all();
                $users = User::all();

                return view('pages.admin.reviews', compact('reviews', 'products', 'users'));
            }
            return redirect()->route('404');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function update()
    {
        try {


            return redirect()->back()->with('success', 'Thanks for your feedback, it will appear once it is reviewed');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function accept($id)
    {
        try {
            if (auth()->user()->admin) {
                $review = Review::find($id);
                $review->accepted = true;
                $review->save();
            }

            return redirect()->back()->with('success', 'Review accepted!');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }

    public function reject($id)
    {
        try {
            if (auth()->user()->admin) {
                $review = Review::find($id);
                $review->delete();
            }

            return redirect()->back()->with('success', 'Review accepted!');
        } catch (\Exception $e) {
            return redirect()->route('404')->with('error', $e);
        }
    }
}
