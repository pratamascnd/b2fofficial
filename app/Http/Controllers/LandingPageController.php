<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\BrandPartner;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Service;
use App\Models\Streamer;
use App\Models\StreamerSchedule;

class LandingPageController extends Controller
{
    public function index()
    {
        $about = About::first();
        $service = Service::get();
        $brand_partner = BrandPartner::get();
        $contact = Contact::first();
        
        // Ambil data gallery beserta foto-fotonya, urutkan dari yang terbaru
        $galleries = Gallery::with('details')->orderBy('project_date', 'DESC')->get();
        
        // Ambil daftar tahun unik untuk filter Isotope
        $years = Gallery::select('year')->distinct()->orderBy('year', 'DESC')->get();

        return view("landing-page.index", compact('about', 'service', 'brand_partner', 'galleries', 'years', 'contact'));
    }

    public function news()
    {
        $news = News::orderByRaw("status = 'pinned' DESC")
                ->orderBy('created_at', 'desc')
                ->simplePaginate(5);

        return view("landing-page.news", compact('news'));
    }

    public function news_detail(string $id)
    {

        $news_detail = News::find($id);
        return view("landing-page.news-detail", compact('news_detail'));
    }

    public function streamer()
    {
        $streamer_profile = Streamer::all();
        return view('landing-page.streamer', compact('streamer_profile'));
    }

    public function streamer_schedule()
    {
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek()->toDateString();

        $schedules = StreamerSchedule::with('streamer')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy(function($item) {
                return $item->streamer_id . '-' . \Carbon\Carbon::parse($item->date)->startOfWeek()->format('Y-m-d');
            });
        return view('landing-page.streamer-schedule', compact('schedules'));
    }
}
