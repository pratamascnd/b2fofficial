<?php

namespace App\Http\Controllers;

use App\Models\BrandPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand_partner = BrandPartner::get();
        return view('brand-partner.index', compact('brand_partner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brand-partner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'link'       => 'required|string|max:255',
            'image'   => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required'     => 'Nama harus diisi.',
            'link.required'     => 'Link harus diisi.',
            'image.required'   => 'Foto harus diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 1MB.',
        ]);

        $brand_partner = new BrandPartner();
        $brand_partner->name = $request->name;
        $brand_partner->link = $request->link;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-brand-partner', 'public');
            $brand_partner->image = $path;
        }

        $brand_partner->save();

        return redirect()
            ->route("brand-partner.index")
            ->with("SA-success", "Data berhasil disimpan!");
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
        $data = BrandPartner::find($id);
        return view("brand-partner.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand_partner = BrandPartner::find($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'link'       => 'required|string|max:255',
            'image'   => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required'     => 'Nama harus diisi.',
            'link.required'     => 'Link harus diisi.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 1MB.',
        ]);

        $brand_partner->category = $request->category;
        $brand_partner->title = $request->title;
        $brand_partner->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-brand-partner', 'public');
            $brand_partner->image = $path;
        }

        $brand_partner->save();

        return redirect()
            ->route('brand-partner.index')
            ->with("SA-success", "Data berhasil disimpan!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand_partner = BrandPartner::findOrFail($id);

        if ($brand_partner->image && Storage::disk('public')->exists($brand_partner->image)) {
            Storage::disk('public')->delete($brand_partner->image);
        }

        $brand_partner->delete();

        return redirect()
            ->route("brand-partner.index")
            ->with("SA-success", "Data partner dan logonya berhasil dihapus.");
    }
}
