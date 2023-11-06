<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all() ;
        $branches =  Branch::all() ;
        $categories = Category::all() ;
        $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();

        return view('front.books' , ['branches'=>$branches , 'products'=>$products , 'categories'=>$categories ,  'carts' => $carts]) ;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id) ;
        $branches =  Branch::all();
        $categories = Category::all();
        $products = Product::where('category_id' , '=' , $category->id)->get() ;
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return view('front.books' , ['branches'=>$branches , 'products'=>$products , 'categories' =>$categories, 'carts' => $carts]) ;
        } else {
            return view('front.books', ['branches' => $branches, 'products' => $products, 'categories' => $categories]);

        }
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
        //
    }
}
