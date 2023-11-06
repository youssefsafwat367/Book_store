<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $highest_products = DB::select('     SELECT COUNT(*) as highest_products , order_products.product_id , products.*   FROM order_products join products on products.id= order_products.product_id GROUP BY product_id ORDER BY COUNT(*) DESC LIMIT 5') ;
        $sliders =  Slider::where('status' , '=' , 'appear')->get() ;
        $products = Product::where('status' , '=' , 'appear')->get() ;
        $new_products = Product::where('status' , '=' , 'appear')->orderBy('created_at')->take(10)->get() ;
        $categories = Category::all() ;
        $branches =  Branch::all() ;
        if (auth()->user() != NULL) {
            $carts = Cart::where('user_id' , '=' , auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get() ;
            return view('front.home' , ['sliders'=>$sliders , 'products'=> $products , 'categories'=> $categories   , 'new_products'=>$new_products , 'branches'=>$branches  , 'carts'=>$carts , 'highest_products'=>$highest_products]) ;
        }
    else{
            return view('front.home', ['sliders' => $sliders, 'products' => $products, 'categories' => $categories, 'new_products' => $new_products, 'branches' => $branches , 'highest_products' => $highest_products]);

    }
    }

}
