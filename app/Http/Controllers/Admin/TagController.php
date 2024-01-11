<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use Illuminate\Support\Str;

class TagController extends Controller
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
        $tags = Tags::all();
        return view('admin.tags.index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tags::all();
        return view('admin.tags.create', [
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ro' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'desc_ro' => 'max:255',
            'desc_ru' => 'max:255',
            'tag_id' => 'required|integer',
        ]);
        $tag = new Tags();
        $tag->name_ro = $request->name_ro;
        $tag->name_ru = $request->name_ru;
        $tag->desc_ro = $request->desc_ro;
        $tag->desc_ru = $request->desc_ru;
        $tag->tag_id = $request->tag_id;
        $tag->slug = Str::slug($request->name_ro);
        $tag->save();
        return redirect()->route('tags.index')->withSuccess('Tagul a fost adaugat cu succes!');
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
        $taginfo = Tags::where('id', $id)->get();
        $tags = Tags::orderBy('tag_id')->get();
        return view('admin.tags.edit',[
            'taginfo' =>$taginfo,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name_ro' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'desc_ro' => 'max:255',
            'desc_ru' => 'max:255',
            'tag_id' => 'required|integer',
        ]);
        $tag = Tags::find($id);
        $tag->name_ro = $request->name_ro;
        $tag->name_ru = $request->name_ru;
        $tag->desc_ro = $request->desc_ro;
        $tag->desc_ru = $request->desc_ru;
        $tag->tag_id = $request->tag_id;
        $tag->update();
        return redirect()->route('tags.index')->withSuccess('Tagul a fost modificată cu succes!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tags::find($id);
        $tag->delete();
        return redirect()->route('tags.index')->withSuccess('Tagul a fost sters cu succes!');
    }
}
