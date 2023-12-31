<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Http\Request;

class RefundPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches =  Branch::all() ;
        $categories = Category::all() ;

        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
            return view('front.refund-policy' , ['branches'=>$branches , 'carts'=> $carts , 'categories'=>$categories]) ;
        } else {
            return view('front.refund-policy', ['branches' => $branches , 'categories'=>$categories]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
