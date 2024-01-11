<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Tags;
use App\Models\Producator;
use App\Models\ProductTags;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class ProductController extends Controller
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
        $categories = Categories::all();
        $products = Products::orderBy('id', 'desc')->get();
        $tags = Tags::all();
        return view('admin.products.index', [
            'categories' => $categories,
            'products' => $products,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('category_id')->get();
        $producatori = Producator::all();
        $tags = Tags::all();
        return view('admin.products.create', [
            'categories' => $categories,
            'tags' => $tags,
            'producatori' => $producatori,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = Products::count();
        if ($count == 0){
            $last_id = 0;
        }
        else {
            $last_id = Products::latest()->first()->id;
        }
        $next_id = $last_id + 1;
        $validated = $request->validate([
            'name_ro' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'desc_ro' => 'max:255',
            'desc_ru' => 'max:255',
            'category_id' => 'required|integer',
            'cod' => 'required|unique:products|max:255',
            'producator_id' =>'required|integer',
            'image_thumb' => 'required|mimes:png,jpg,jpeg,webp|max:8096',
            'images' => 'required|max:8096',
            'catalog_pdf' => 'mimes:pdf|max:25000',
            'catalog_img' => 'mimes:png,jpg,jpeg,webp|max:8096',
            'full_desc_ro' => 'max:20000',
            'full_desc_ru' => 'max:20000',
            'tags' => 'nullable|array'
        ]);
        //dd($request);
        $product = new Products();
        $product->slug = $next_id . '-' . Str::slug($request->name_ro);
        $product->name_ro = $request->name_ro;
        $product->name_ru = $request->name_ru;
        $product->desc_ro = $request->desc_ro;
        $product->desc_ru = $request->desc_ru;
        $product->producator_id = $request->producator_id;
        $product->cod = $request->cod;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image_thumb')) {
            $name = $product->slug . '_' . $next_id . '.' . $request->image_thumb->extension();

            $request->image_thumb->storeAs('public/products_thumb/', $name);
            $data = $name;
        }
        $product->image_thumb = $data;
        if ($request->hasFile('images')) {
            $i = 1;
            foreach ($request->file('images') as $product_file) {
                $name = $product->slug . '_' . $i . '_' . $next_id . '.' . $product_file->extension();
                $product_file->storeAs('public/products/', $name);
                $i = $i + 1;
                $data_img[] = $name;
            }
        }
        $product->images = json_encode($data_img);
        $product->images_qty = $i - 1;
        if ($request->hasFile('catalog_pdf')) {
            $name = $product->slug . '_' . $next_id . '.' . $request->catalog_pdf->extension();
            $request->catalog_pdf->storeAs('public/catalog/', $name);
            $data = $name;
            $product->catalog = $name;
        }
        if ($request->hasFile('catalog_img')) {
            $name = $product->slug . '_' . $next_id . '.' . $request->catalog_img->extension();
            $request->catalog_img->storeAs('public/catalog_img/', $name);
            $data = $name;
            $product->catalog_img = $name;
        }
        $product->full_desc_ro = $request->full_desc_ro;
        $product->full_desc_ru = $request->full_desc_ru;
        $product->active = $request->active;
        $tagsIds = $request->tags;
        unset($request->tags);
        if (!empty($tagsIds)){
            foreach ($tagsIds as $tagsId) {
                ProductTags::firstOrCreate([
                    'product_id' => $next_id,
                    'tag_id' => $tagsId
                ]);
            }
        }
        $product->save();
        return redirect()->route('products.index')->with('success', 'Produsul a fost adaugat cu succes!!!');
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
        $product = Products::where('id', $id)->get();
        $product_image = json_decode($product[0]->images);
        $categories = Categories::orderBy('category_id')->get();
        $producatori = Producator::all();
        $tags = Tags::all();
        $product_tags = ProductTags::where('product_id', $id)->get();
        $tagsIds = [];
        foreach ($product_tags as $etags) {
            $tagsIds[] = $etags->tag_id;
        }
        return view('admin.products.edit', [
            'categories' => $categories,
            'tags' => $tags,
            'tagsIds' => $tagsIds,
            'producatori' => $producatori,
            'product' => $product,
            'product_images' => $product_image,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Products::find($id);
        $product->name_ro = $request->name_ro;
        $product->name_ru = $request->name_ru;
        $product->desc_ro = $request->desc_ro;
        $product->desc_ru = $request->desc_ru;
        $product->producator_id = $request->producator_id;
        $product->cod = $request->cod;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image_thumb')) {
            if (Storage::exists('public/products_thumb/' . $product->image_thumb)) {
                Storage::delete('public/products_thumb/' . $product->image_thumb);
            }
            $name = $product->slug . '_' . $id . '.' . $request->image_thumb->extension();
            $request->image_thumb->storeAs('public/products_thumb/', $name);
            $data = $name;
            $product->image_thumb = $data;
        }
        if ($request->hasFile('images')) {
            $i = 1;
            $old_file = json_decode($product->images);
            foreach ($old_file as $file) {
                if (Storage::exists('public/products/' . $file)) {
                    Storage::delete('public/products/' . $file);
                }
            }
            foreach ($request->file('images') as $product_file) {
                $name = $product->slug . '_' . $i . '_' . $id . '.' . $product_file->extension();
                $product_file->storeAs('public/products/', $name);
                $i = $i + 1;
                $data_img[] = $name;
            }
            $product->images = json_encode($data_img);
            $product->images_qty = $i - 1;
        }
        if (isset($request->delete_catalog) and $request->delete_catalog == 1){
            if (Storage::exists('public/catalog/' . $product->catalog)) {
                Storage::delete('public/catalog/' . $product->catalog);
            }
            $product->catalog = null;
        }
        if ($request->hasFile('catalog_pdf')) {
            if (Storage::exists('public/catalog/' . $product->catalog)) {
                Storage::delete('public/catalog/' . $product->catalog);
            }
            $name = $product->slug . '_' . $id . '.' . $request->catalog_pdf->extension();
            $request->catalog_pdf->storeAs('public/catalog/', $name);
            $data = $name;
            $product->catalog = $name;
        }
        if (isset($request->delete_catalog_img) and $request->delete_catalog_img == 1){
            if (Storage::exists('public/catalog_img/' . $product->catalog_img)) {
                Storage::delete('public/catalog_img/' . $product->catalog_img);
            }
            $product->catalog_img = null;
        }
        if ($request->hasFile('catalog_img')) {
            if (Storage::exists('public/catalog_img/' . $product->catalog_img)) {
                Storage::delete('public/catalog_img/' . $product->catalog_img);
            }
            $name = $product->slug . '_' . $id . '.' . $request->catalog_img->extension();
            $request->catalog_img->storeAs('public/catalog_img/', $name);
            $data = $name;
            $product->catalog_img = $name;
        }
        $product->full_desc_ro = $request->full_desc_ro;
        $product->full_desc_ru = $request->full_desc_ru;
        $product->active = $request->active;
        $tagsIds = $request->tags;
        unset($request->tags);
        if ($tagsIds == null){
            ProductTags::where('product_id', $id)->delete();
        }
        else {
            ProductTags::where('product_id', $id)->delete();
            foreach ($tagsIds as $tagsId) {
                ProductTags::firstOrCreate([
                    'product_id' => $id,
                    'tag_id' => $tagsId
                ]);
            }
        }
        $product->save();
        return redirect()->route('products.index')->with('success', 'Produsul a fost modificat cu succes cu succes!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findorfail($id);
        if (Storage::exists('public/products_thumb/' . $product->image_thumb)) {
            Storage::delete('public/products_thumb/' . $product->image_thumb);
        }
        $images = json_decode($product->images);
        if (isset($images)) {
            foreach ($images as $image) {
                if (Storage::exists('public/products/' . $image)) {
                    Storage::delete('public/products/' . $image);
                }
            }
        }
        if (Storage::exists('public/catalog/' . $product->catalog)) {
            Storage::delete('public/catalog/' . $product->catalog);
        }
        if (Storage::exists('public/catalog_img/' . $product->catalog_img)) {
            Storage::delete('public/catalog_img/' . $product->catalog_img);
        }

        ProductTags::where('product_id', $id)->delete();
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produsul a fost șters cu succes!!!');
    }
}
