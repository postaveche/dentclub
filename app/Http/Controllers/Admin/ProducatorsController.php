<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProducatorsController extends Controller
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
        $producator = Producator::all();
        return view('admin.producator.index', [
            'producatori'=>$producator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.producator.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|mimes:png,jpg,jpeg|max:8096',
            'website' => 'required|string|max:500',
            'country' => 'required|string|max:255',
        ]);
        $producator = new Producator();
        $producator->name = $request->name;
        $producator->slug = Str::slug($request->name);
        if ($request->hasFile('logo')) {
            $name = $producator->slug . '_logo.' . $request->logo->extension();
            $request->logo->storeAs('public/producatori/', $name);
            $data = $name;
        }
        $producator->logo = $data;
        $producator->site = $request->website;
        $producator->country = $request->country;
        $producator->save();
        return redirect()->route('producatori.index')->withSuccess('Producătorul a fost adaugata cu succes!!!');
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
        $producator = Producator::where('id', $id)->get();
        return view('admin.producator.edit',[
            'producator' => $producator,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producator = Producator::find($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'mimes:png,jpg,jpeg|max:8096',
            'website' => 'required|string|max:500',
            'country' => 'required|string|max:255',
        ]);
        $producator->name = $request->name;
        if ($request->hasFile('logo')) {
            if (Storage::exists('public/producatori/' . $producator->logo)) {
                Storage::delete('public/producatori/' . $producator->logo);
            }
            $name = $producator->slug . '_logo.' . $request->logo->extension();
            $request->logo->storeAs('public/producatori/', $name);
            $data = $name;
            $producator->logo = $data;
        }
        $producator->site = $request->website;
        $producator->country = $request->country;
        $producator->update();
        return redirect()->route('producatori.index')->with('success', 'Producatorul a fost modificat cu succes!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producator = Producator::findorfail($id);
        if (Storage::exists('public/producatori/' . $producator->logo)) {
            Storage::delete('public/producatori/' . $producator->logo);
        }
        $producator->delete();
        return redirect()->route('producatori.index')->with('success', 'Producătorul a fost șters cu succes!!!');
    }
}
