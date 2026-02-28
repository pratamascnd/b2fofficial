<?php

namespace App\Http\Controllers;

use App\Models\Streamer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StreamerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $streamer_profile = Streamer::get();
        return view('streamer-profile.index', compact('streamer_profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('streamer-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name'       => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'link_instagram1' => 'required|string|max:255',
            'link_tiktok1' => 'required|string|max:255',
            'link_youtube1' => 'required|string|max:255',
        ], [
            'image.required'   => 'Foto utama harus diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 2 MB.',
            'name.required'       => 'Nama harus diisi.',
            'full_name.required' => 'Nama lengkap harus diisi.',
            'link_instagram1.required' => 'Link Instagram 1 harus diisi.',
            'link_tiktok1.required' => 'Link TikTok 1 harus diisi.',
            'link_youtube1.required' => 'Link YouTube 1 harus diisi.',
        ]);

        $streamer_profile = new Streamer();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-streamer', 'public');
            $streamer_profile->image = $path;
        }

        $streamer_profile->name = $request->name;
        $streamer_profile->full_name = $request->full_name;
        $streamer_profile->link_instagram1 = $request->link_instagram1;
        $streamer_profile->link_instagram2 = $request->link_instagram2;
        $streamer_profile->link_tiktok1 = $request->link_tiktok1;
        $streamer_profile->link_tiktok2 = $request->link_tiktok2;
        $streamer_profile->link_youtube1 = $request->link_youtube1;
        $streamer_profile->link_youtube2 = $request->link_youtube2;
        $streamer_profile->save();

        return redirect()
            ->route("streamer-profile.index")
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
        $data = Streamer::find($id);
        return view("streamer-profile.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $streamer_profile = Streamer::find($id);

        $request->validate([
            'image'   => 'image|mimes:jpeg,png,jpg|max:2048',
            'name'       => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'link_instagram1' => 'required|string|max:255',
            'link_tiktok1' => 'required|string|max:255',
            'link_youtube1' => 'required|string|max:255',
        ], [
            'image.required'   => 'Foto utama harus diunggah.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max'        => 'Ukuran gambar maksimal 2 MB.',
            'name.required'       => 'Nama harus diisi.',
            'full_name.required' => 'Nama lengkap harus diisi.',
            'link_instagram1.required' => 'Link Instagram 1 harus diisi.',
            'link_tiktok1.required' => 'Link TikTok 1 harus diisi.',
            'link_youtube1.required' => 'Link YouTube 1 harus diisi.',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('image-streamer', 'public');
            $streamer_profile->image = $path;
        }

        $streamer_profile->name = $request->name;
        $streamer_profile->full_name = $request->full_name;
        $streamer_profile->link_instagram1 = $request->link_instagram1;
        $streamer_profile->link_instagram2 = $request->link_instagram2;
        $streamer_profile->link_tiktok1 = $request->link_tiktok1;
        $streamer_profile->link_tiktok2 = $request->link_tiktok2;
        $streamer_profile->link_youtube1 = $request->link_youtube1;
        $streamer_profile->link_youtube2 = $request->link_youtube2;
        $streamer_profile->save();

        return redirect()
            ->route("streamer-profile.index")
            ->with("SA-success", "Data berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $streamer_profile = Streamer::findOrFail($id);

        if ($streamer_profile->image && Storage::disk('public')->exists($streamer_profile->image)) {
            Storage::disk('public')->delete($streamer_profile->image);
        }

        $streamer_profile->delete();

        return redirect()
            ->route("streamer-profile.index")
            ->with("SA-success", "Data dan file storage berhasil dihapus.");
    }
}
