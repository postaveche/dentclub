<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::orderBy('category_id')->get();
        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('category_id')->get();
        return view('admin.categories.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|unique:categories|max:255',
            'name_ro' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'desc_ro' => 'max:255',
            'desc_ru' => 'max:255',
            'category_id' => 'required|integer',
        ]);
        $category = new Categories();
        $category->slug = $request->slug;
        $category->name_ro = $request->name_ro;
        $category->name_ru = $request->name_ru;
        $category->desc_ro = $request->desc_ro;
        $category->desc_ru = $request->desc_ru;
        $category->category_id = $request->category_id;
        $category->save();
        return redirect()->route('categories.index')->withSuccess('Categoria a fost adaugata cu succes!!!');
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
        $categoryinfo = Categories::where('id', $id)->get();
        $categories = Categories::orderBy('category_id')->get();
        return view('admin.categories.edit',[
            'categoryinfo' =>$categoryinfo,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255',
            'name_ro' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'desc_ro' => 'max:255',
            'desc_ru' => 'max:255',
            'key_ro' => 'max:255',
            'key_ru' => 'max:255',
            'category_id' => 'required|integer',
        ]);
        $category = Categories::find($id);
        $category->slug = trim($request->slug);
        $category->name_ro = $request->name_ro;
        $category->name_ru = $request->name_ru;
        $category->desc_ro = $request->desc_ro;
        $category->desc_ru = $request->desc_ru;
        $category->category_id = $request->category_id;
        $category->update();
        return redirect()->route('categories.index')->withSuccess('Categoria a fost modificată cu succes!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::findorfail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoria a fost ștersă cu succes!!!');
    }
}
