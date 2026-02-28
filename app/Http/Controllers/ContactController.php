<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contact = Contact::get();
        return view('contact.index', compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $isMax = Contact::count() >= 1;
        return view('contact.create', compact('isMax'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = Contact::count(); 
        if ($count >= 1) {
            return redirect()
                ->route("contact.index")
                ->with("SA-error", "Data sudah maksimal! Hanya bisa mengedit data yang sudah ada. Jika ingin menambah baru, hapus data lama terlebih dahulu.");
        }

        $request->validate([
            'no_whatsapp' => 'required|string|max:255',
            'email'       => 'required|string|max:255',
            'link_instagram' => 'string|max:255|nullable',
            'link_tiktok'  => 'string|max:255|nullable',
        ], [
            'no_whatsapp.required' => 'Nomor WhatsApp harus diisi.',
            'email.required'       => 'Email harus diisi.',
        ]);

        $contact = new Contact();
        $contact->no_whatsapp = $request->no_whatsapp;
        $contact->email = $request->email;
        $contact->link_instagram = $request->link_instagram;
        $contact->link_tiktok = $request->link_tiktok;
        $contact->save();

        return redirect()
            ->route("contact.index")
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
        $data = Contact::find($id);
        return view("contact.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);

        $request->validate([
            'no_whatsapp' => 'required|string|max:255',
            'email'       => 'required|string|max:255',
            'link_instagram' => 'required|string|max:255',
            'link_tiktok'  => 'required|string|max:255',
        ], [
            'no_whatsapp.required' => 'Nomor WhatsApp harus diisi.',
            'email.required'       => 'Email harus diisi.',
            'link_instagram.required' => 'Link Instagram harus diisi.',
            'link_tiktok.required'  => 'Link TikTok harus diisi.',
        ]);


        $contact->no_whatsapp = $request->no_whatsapp;
        $contact->email = $request->email;
        $contact->link_instagram = $request->link_instagram;
        $contact->link_tiktok = $request->link_tiktok;
        $contact->save();

        return redirect()
            ->route("contact.index")
            ->with("SA-success", "Data berhasil diubah!");    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()
            ->route("contact.index")
            ->with("SA-success", "Data berhasil dihapus.");
    }
}
