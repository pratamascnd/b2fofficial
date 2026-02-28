<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderByRaw("status = 'pinned' DESC")
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'status'   => 'required',
        ], [
            'image.required'   => 'Foto utama harus diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 2MB.',
            'title.required'       => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'status.required'   => 'Status harus diisi.',
        ]);

        $news = new News();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-news', 'public');
            $news->image = $path;
        }

        $news->title = $request->title;
        $news->description = $request->description;
        $news->link = $request->link;
        $news->status = $request->status;
        $news->save();

        return redirect()
            ->route("news.index")
            ->with("SA-success", "Data berhasil disimpan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);
        return view('news.detail', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = News::find($id);
        return view("news.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::find($id);

        $request->validate([
            'image'   => 'image|mimes:jpeg,png,jpg|max:2048', 
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'status'   => 'required',
        ], [
            'image.required'   => 'Foto utama harus diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 2MB.',
            'title.required'       => 'Judul harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'status.required'   => 'Status harus diisi.',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-news', 'public');
            $news->image = $path;
        }

        $news->title = $request->title;
        $news->description = $request->description;
        $news->link = $request->link;
        $news->status = $request->status;
        $news->save();

        return redirect()
            ->route("news.index")
            ->with("SA-success", "Data berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route("news.index")
            ->with("SA-success", "Data dan file storage berhasil dihapus.");
    }
}