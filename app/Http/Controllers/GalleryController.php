<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Gallery::get();
        return view('gallery.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'project_date' => 'required|date',
            'year'         => 'required|numeric',
            'images'       => 'required|array|min:1|max:10', 
            'images.*'     => 'image|mimes:jpeg,png,jpg|max:1024', 
        ], [
            'title.required'        => 'Judul harus diisi.',
            'project_date.required' => 'Tanggal harus diisi.',
            'year.required'         => 'Tahun harus diisi.',
            'images.required'       => 'Setidaknya satu foto harus diunggah.',
            'images.array'          => 'Format input gambar tidak valid.',
            'images.max'            => 'Maksimal unggah adalah 10 gambar.',
            'images.*.image'        => 'File harus berupa gambar.',
            'images.*.mimes'        => 'Format gambar harus jpeg, png, atau jpg.',
            'images.*.max'          => 'Ukuran masing-masing gambar maksimal 1MB.',
        ]);

        try {
            DB::beginTransaction();

            $gallery = Gallery::create([
                'title'        => $request->title,
                'project_date' => $request->project_date,
                'year'         => $request->year,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $imagePath = $file->store('image-gallery', 'public');

                    GalleryDetail::create([
                        'gallery_id' => $gallery->id,
                        'image'      => $imagePath
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route("gallery.index")
                ->with("SA-success", "Gallery dan foto berhasil ditambahkan!");

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with("SA-error", "Terjadi kesalahan: " . $e->getMessage());
        }
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
        $gallery = Gallery::with('details')->findOrFail($id);
        return view('gallery.edit', compact('gallery'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);
        $currentImageCount = $gallery->details()->count();
        $availableSlot = 10 - $currentImageCount;

        $request->validate([
            'title'        => 'required|string|max:255',
            'project_date' => 'required|date',
            'year'         => 'required|numeric',
            'images'       => 'nullable|array|max:' . $availableSlot, 
            'images.*'     => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'title.required' => 'Judul harus diisi.',
            'project_date.required' => 'Tanggal harus diisi.',
            'year.required' => 'Tahun harus diisi.',
            'images.array' => 'Format input gambar tidak valid.',
            'images.max' => 'Total gambar tidak boleh lebih dari 10. Sisa slot: ' . $availableSlot,
        ]);

        try {
            DB::beginTransaction();

            $gallery->update([
                'title'        => $request->title,
                'project_date' => $request->project_date,
                'year'         => $request->year,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $imagePath = $file->store('image-gallery', 'public');
                    GalleryDetail::create([
                        'gallery_id' => $gallery->id,
                        'image'      => $imagePath
                    ]);
                }
            }

            DB::commit();
            return redirect()->route("gallery.index")->with("SA-success", "Data berhasil diperbarui!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with("SA-error", "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    public function destroyImage($id)
    {
        $detail = DB::table('tgallery_detail')->where('id', $id)->first();

        if ($detail) {
            try {
                if ($detail->image && Storage::disk('public')->exists($detail->image)) {
                    Storage::disk('public')->delete($detail->image);
                }

                DB::table('tgallery_detail')->where('id', $id)->delete();

                return redirect()->back()->with("SA-success", "Foto berhasil dihapus!");
            } catch (\Exception $e) {
                return redirect()->back()->with("SA-error", "Gagal sistem: " . $e->getMessage());
            }
        }

        return redirect()->back()->with("SA-error", "Data tidak ditemukan!");
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $gallery = Gallery::with('details')->findOrFail($id);

            foreach ($gallery->details as $detail) {
                if ($detail->image && Storage::disk('public')->exists($detail->image)) {
                    Storage::disk('public')->delete($detail->image);
                }
            }

            $gallery->delete();

            DB::commit();

            return redirect()->route("gallery.index")
                ->with("SA-success", "Satu album galeri berhasil dihapus beserta seluruh fotonya!");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("gallery.index")
                ->with("SA-error", "Gagal menghapus galeri: " . $e->getMessage());
        }
    }
}
