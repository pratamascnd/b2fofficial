<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::get();
        return view('service.index', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = Service::count();
        if ($count >= 4) {
            return redirect()
                ->route("service.index")
                ->with("SA-error", "Data service sudah maksimal! Hanya bisa mengedit data yang sudah ada. Jika ingin menambah baru, hapus data lama terlebih dahulu.");
        }

        $request->validate([
            'category'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'category.required'  => 'Kategori harus diisi.',
            'title.required'       => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'image.required'   => 'Foto utama harus diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 2MB.',
        ]);

        $service = new Service();
        $service->category = $request->category;
        $service->title = $request->title;
        $service->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-service', 'public');
            $service->image = $path;
        }

        $service->save();

        return redirect()
            ->route("service.index")
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
        $data = Service::find($id);
        return view("service.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::find($id);

        $request->validate([
            'category'  => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'   => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'category.required'  => 'Kategori harus diisi.',
            'title.required'       => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'image.required'   => 'Foto utama harus diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 2MB.',
        ]);

        $service->category = $request->category;
        $service->title = $request->title;
        $service->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-service', 'public');
            $service->image = $path;
        }

        $service->save();

        return redirect()
            ->route("service.index")
            ->with("SA-success", "Data berhasil disimpan!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()
            ->route("service.index")
            ->with("SA-success", "Data service dan file gambar berhasil dihapus.");
    }
}
