<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches =  Branch::all();
        $favorites =  Favorite::all() ;
        $categories = Category::all();
        if (auth()->user() != NULL) {

            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return view('front.favorites', ['branches' => $branches, 'favorites' => $favorites, 'carts' => $carts , 'categories'=>$categories]);

        } else {
            return view('front.favorites', ['branches' => $branches , 'favorites'=>$favorites  , 'categories'=>$categories]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $product = Product::find($id);
        $branches =  Branch::all();

        Favorite::create(
            [
                'product_id' => $product->id  ,
                'user_id' => auth()->user()->id
            ]
        ) ;
        return redirect()->route('favorites') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $branches =  Branch::all();
        $categories = Category::all();
        return view('front.favorites', ['branches' => $branches, 'product'=>$product , 'categories'=>$categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Favorite::find($id)->delete();
        return back();
    }
}
