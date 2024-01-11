<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Producator;
use App\Models\Products;

class ProducatoriController extends Controller
{
    public function index(){
        $producatori = Producator::all();
        $all_category = Categories::all();
        $top_category = MainController::top_category();
        if ($producatori->isEmpty()){
            abort(404);
        }
        return view('pages.producatori', [
            'producatori' => $producatori,
            'top_category' => $top_category,
            'all_category' => $all_category,
        ]);
    }

    public function show($slug){
        $producatori = Producator::all();
        $producator = Producator::where('slug', $slug)->get();
        if ($producator->isEmpty()){
            abort(404);
        }
        $all_category = Categories::all();
        $top_category = MainController::top_category();
        $products = Products::where('producator_id', $producator[0]->id)->paginate(20);
        return view('pages.producatori_show', [
            'producatori' => $producatori,
            'producator' => $producator,
            'top_category' => $top_category,
            'all_category' => $all_category,
            'products' => $products,
        ]);
    }
}
