<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Producator;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $total_products = Products::count();
        $total_producatori = Producator::count();
        $total_categories = Categories::count();
        $total_users = User::count();
        return view('admin.pages.main', [
            'total_products' => $total_products,
            'total_producatori' => $total_producatori,
            'total_categories' => $total_categories,
            'total_users' => $total_users,
        ]);
    }
}
