<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Streamer;
use App\Models\StreamerSchedule;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStreamer = Streamer::count();

        $totalGallery = Gallery::with('details')->count();

        $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek()->toDateString();
        
        $streamerOnSchedule = StreamerSchedule::whereBetween('date', [$startOfWeek, $endOfWeek])
            ->distinct('streamer_id')
            ->count('streamer_id');

        $activeStreamers = StreamerSchedule::with('streamer')
            ->select('streamer_id', DB::raw('count(*) as total_streaming'))
            ->whereMonth('date', \Carbon\Carbon::now()->month)
            ->whereYear('date', \Carbon\Carbon::now()->year)
            ->where('status', 'streaming')
            ->groupBy('streamer_id')
            ->orderBy('total_streaming', 'desc')
            ->limit(10)
            ->get();

        $chartLabels = $activeStreamers->map(fn($item) => $item->streamer->name);
        $chartData = $activeStreamers->pluck('total_streaming');

        return view('dashboard', compact(
            'totalStreamer', 
            'totalGallery', 
            'streamerOnSchedule',
            'chartLabels',
            'chartData'
        ));
    }
}
