<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class SearchController extends Controller
{
    public function search(Request $query){
        dd($query);
    }
}
