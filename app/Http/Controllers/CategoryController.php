<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MainController;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $all_category = Categories::all();
        $top_category = MainController::top_category();
        $products = Products::paginate(20);
        return view('pages.category', [
            'top_category' => $top_category,
            'all_category' => $all_category,
            'products' => $products,
        ]);
    }

    public function show($slug){
        $all_category = Categories::all();
        $top_category = MainController::top_category();
        $category_info = Categories::where('slug', $slug)->get();
        $products ='';
        if ($category_info[0]->category_id == 0){
            $subcategory = Categories::where('category_id', $category_info[0]->id)->get();
            foreach ($subcategory as $sub){
                $cat_id = $sub->id;
                $data[] = $cat_id;
            }
            $products = Products::whereIn('category_id', $data)->get();
        }else{
            $products = Products::where('category_id', $category_info[0]->id)->paginate(20);
        }
        return view('pages.category', [
            'top_category' => $top_category,
            'all_category' => $all_category,
            'category_info' => $category_info,
            'products' => $products,
        ]);
    }

}
