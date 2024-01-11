<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class MainController extends Controller
{
    public function index(){
        $top_category = self::top_category();
        $all_category = Categories::all();
        return view('pages.main', [
            'top_category' => $top_category,
            'all_category' => $all_category,
        ]);
    }

    public static function top_category(){
        $top_categories = Categories::where('category_id', 0)->get();
        return $top_categories;
    }
}
