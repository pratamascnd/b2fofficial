<?php

namespace App\Http\Controllers;

use App\Models\Streamer;
use App\Models\StreamerSchedule;
use Illuminate\Http\Request;

class StreamerScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $schedules = StreamerSchedule::with('streamer')
        ->select('*')
        ->get()
        ->groupBy(function($item) {
            return $item->streamer_id . '-' . \Carbon\Carbon::parse($item->date)->startOfWeek()->format('Y-m-d');
        });
        return view('streamer-schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $streamers = Streamer::orderBy('name', 'asc')->get();
        return view('streamer-schedule.create', compact('streamers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'streamer_id' => 'required|exists:tstreamer,id',
            'schedules'   => 'required|array|size:7',
            'schedules.*.date'    => 'required|date',
            'schedules.*.agenda'  => 'required|string|max:255',
            'schedules.*.status'  => 'required|in:streaming,off_day',
        ], [
            'streamer_id.required' => 'Pilih streamer terlebih dahulu.',
            'schedules.*.date.required' => 'Semua tanggal harus diisi.',
            'schedules.*.agenda.required' => 'Agenda tidak boleh kosong.',
        ]);

        // 2. Proses Simpan dengan Looping
        foreach ($request->schedules as $data) {
            StreamerSchedule::create([
                'streamer_id' => $request->streamer_id,
                'date'        => $data['date'],
                'start_time'  => $data['start_time'],
                'agenda'      => $data['agenda'],
                'status'      => $data['status'],
            ]);
        }

        return redirect()
            ->route("streamer-schedule.index")
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
        $schedule = StreamerSchedule::findOrFail($id);
        $schedules = StreamerSchedule::where('streamer_id', $schedule->streamer_id)
            ->whereBetween('date', [
                \Carbon\Carbon::parse($schedule->date)->startOfWeek(), 
                \Carbon\Carbon::parse($schedule->date)->endOfWeek()
            ])
            ->orderBy('date', 'asc')
            ->get();

        $streamers = Streamer::orderBy('name', 'asc')->get();

        return view('streamer-schedule.edit', compact('schedules', 'streamers', 'schedule'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
            'streamer_id' => 'required|exists:tstreamer,id',
            'schedules'   => 'required|array',
            'schedules.*.id'      => 'required|exists:tstreamer_schedule,id',
            'schedules.*.date'    => 'required|date',
            'schedules.*.agenda'  => 'required|string|max:255',
            'schedules.*.status'  => 'required|in:streaming,off_day',
        ],
        [
            'streamer_id.required' => 'Pilih streamer terlebih dahulu.',
            'schedules.*.date.required' => 'Semua tanggal harus diisi.',
            'schedules.*.agenda.required' => 'Agenda tidak boleh kosong.',
        ]);

        foreach ($request->schedules as $data) {
            $item = StreamerSchedule::findOrFail($data['id']);
            $item->update([
                'streamer_id' => $request->streamer_id,
                'date'        => $data['date'],
                'start_time'  => $data['status'] == 'off_day' ? null : $data['start_time'],
                'agenda'      => $data['agenda'],
                'status'      => $data['status'],
            ]);
        }

        return redirect()
            ->route("streamer-schedule.index")
            ->with("SA-success", "Data berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = StreamerSchedule::findOrFail($id);
        StreamerSchedule::where('streamer_id', $schedule->streamer_id)
        ->whereBetween('date', [
            \Carbon\Carbon::parse($schedule->date)->startOfWeek(), 
            \Carbon\Carbon::parse($schedule->date)->endOfWeek()
        ])
        ->delete();

        return redirect()
            ->route("streamer-schedule.index")
            ->with("SA-success", "Data berhasil dihapus!");
    }
}
