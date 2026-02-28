<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::get();
        return view('about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $isMax = About::count() >= 1;
        return view('about.create', compact('isMax'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = About::count(); 
        if ($count >= 1) {
            return redirect()
                ->route("about.index")
                ->with("SA-error", "Data sudah maksimal! Hanya bisa mengedit data yang sudah ada. Jika ingin menambah baru, hapus data lama terlebih dahulu.");
        }

        $request->validate([
            'front_pic'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'video_link'  => 'required|url',
            'about_pic'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'front_pic.required'   => 'Foto utama harus diunggah.',
            'front_pic.image'      => 'File harus berupa gambar.',
            'front_pic.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'front_pic.max'        => 'Ukuran gambar maksimal 2MB.',
            'video_link.required'  => 'Link video harus diisi.',
            'video_link.url'       => 'Format link video tidak valid.',
            'about_pic.required'   => 'Foto about harus diunggah.',
            'about_pic.image'      => 'File harus berupa gambar.',
            'about_pic.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'about_pic.max'        => 'Ukuran gambar maksimal 2MB.',
            'title.required'       => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
        ]);

        $about = new About();
        if ($request->hasFile('front_pic')) {
            $file = $request->file('front_pic');
            $path = $file->store('front_pic', 'public');
            $about->front_pic = $path;
        }

        $about->video_link = $request->video_link;

        if ($request->hasFile('about_pic')) {
            $file = $request->file('about_pic');
            $path = $file->store('about_pic', 'public');
            $about->about_pic = $path;
        }
        $about->title = $request->title;
        $about->description = $request->description;
        $about->save();

        return redirect()
            ->route("about.index")
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
        $data = About::find($id);
        return view("about.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = About::find($id);

        $request->validate([
            'front_pic'   => 'image|mimes:jpeg,png,jpg|max:2048',
            'video_link'  => 'required|url',
            'about_pic'   => 'image|mimes:jpeg,png,jpg|max:2048',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'front_pic.required'   => 'Foto utama harus diunggah.',
            'front_pic.image'      => 'File harus berupa gambar.',
            'front_pic.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'front_pic.max'        => 'Ukuran gambar maksimal 2MB.',
            'video_link.required'  => 'Link video harus diisi.',
            'video_link.url'       => 'Format link video tidak valid.',
            'about_pic.required'   => 'Foto about harus diunggah.',
            'about_pic.image'      => 'File harus berupa gambar.',
            'about_pic.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'about_pic.max'        => 'Ukuran gambar maksimal 2MB.',
            'title.required'       => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
        ]);

        if ($request->hasFile('front_pic')) {
            $file = $request->file('front_pic');
            $path = $file->store('front_pic', 'public');
            $about->front_pic = $path;
        }

        $about->video_link = $request->video_link;

        if ($request->hasFile('about_pic')) {
            $file = $request->file('about_pic');
            $path = $file->store('about_pic', 'public');
            $about->about_pic = $path;
        }
        $about->title = $request->title;
        $about->description = $request->description;
        $about->save();

        return redirect()
            ->route("about.index")
            ->with("SA-success", "Data berhasil diubah!");    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::findOrFail($id);

        if ($about->front_pic && Storage::disk('public')->exists($about->front_pic)) {
            Storage::disk('public')->delete($about->front_pic);
        }

        if ($about->about_pic && Storage::disk('public')->exists($about->about_pic)) {
            Storage::disk('public')->delete($about->about_pic);
        }

        $about->delete();

        return redirect()
            ->route("about.index")
            ->with("SA-success", "Data dan file storage berhasil dihapus.");
    }
}
