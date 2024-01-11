<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function show($slug){
        $top_category = MainController::top_category();
        $all_category = Categories::all();
        $product = Products::where('slug', $slug)->get();
        if ($product->isEmpty()){
            abort(404);
        }
        $images = json_decode($product[0]->images);
        return view('pages.product',[
            'product' => $product,
            'images' => $images,
            'top_category' => $top_category,
            'all_category' => $all_category,
        ]);
        //dd($product);
    }

    public static function random5(){
        $product = Products::inRandomOrder()->limit(5)->get();
        return view('blocks.random3', [
            'products' => $product,
        ]);
    }
}
