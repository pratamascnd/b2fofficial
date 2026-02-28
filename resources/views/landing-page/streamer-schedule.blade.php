@extends('layout.landing-page.main')
@section('title', 'Streamer Schedule - B2F Official')
@section('content')

<div class="page-title dark-background" data-aos="fade" style="background-image: url({{asset('bootstrap')}}/bootstrap-b2f-landing/assets/img/page-title-bg.png)">
    <div class="container position-relative">
        <h1>Streamer Schedule</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('landing-page.index') }}">Home</a></li>
                <li class="current">Streamer Schedule</li>
            </ol>
        </nav>
    </div>
</div>

<section id="schedule" class="schedule section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>STREAMER SCHEDULE</h2>
        <p>Jadwal Live Stream Minggu Ini</p>
    </div>

    <div class="container">
        <div class="row gy-4 justify-content-center">
            {{-- Menggunakan forelse untuk mengecek apakah $schedules kosong --}}
            @forelse ($schedules as $groupKey => $items)
                @php 
                    $firstItem = $items->first();
                    $streamer = $firstItem->streamer;
                @endphp
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="schedule-card shadow-sm h-100">
                        <div class="card-img-box">
                            <img src="{{ asset('storage/' . $streamer->image) }}" alt="{{ $streamer->name }}" />
                            <div class="card-badge">SCHEDULE</div>
                        </div>
                        <div class="card-body-custom p-4">
                            <div class="mb-3 text-center">
                                <h4 class="fw-bold mb-0 text-dark">{{ $streamer->name }}</h4>
                                <small class="text-muted">{{ $streamer->full_name }}</small>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-details" data-bs-toggle="modal" data-bs-target="#modal{{ $streamer->id }}{{ $loop->index }}">
                                    Lihat Jadwal Lengkap
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika tidak ada jadwal sama sekali --}}
                <div class="col-12 text-center py-5" data-aos="fade-up">
                    <div class="no-schedule-box">
                        <i class="bi bi-calendar-x text-muted mb-3" style="font-size: 3rem;"></i>
                        <h4 class="fw-bold text-dark">Tidak ada streamer yang menjadwalkan streaming</h4>
                        <p class="text-muted">Pantau terus halaman ini untuk update jadwal terbaru dari komunitas B2F Official.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@foreach ($schedules as $groupKey => $items)
    @php 
        $firstItem = $items->first();
        $streamer = $firstItem->streamer;
    @endphp
    <div class="modal fade" id="modal{{ $streamer->id }}{{ $loop->index }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 10px">
                <div class="modal-header border-0 d-flex align-items-center py-4 px-4 bg-warning">
                    <div class="d-flex align-items-center text-dark">
                        <div class="icon-box-modal bg-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px">
                            <i class="bi bi-calendar3 fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0">Weekly Stream Schedule - {{ $streamer->name }}</h5>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="bg-light text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px">
                                <tr>
                                    <th class="py-3 ps-4">Hari</th>
                                    <th class="py-3 text-center">Tanggal</th>
                                    <th class="py-3 text-center">Waktu (WIB)</th>
                                    <th class="py-3 ps-4">Agenda / Game</th>
                                    <th class="py-3 text-center pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.95rem">
                                @foreach($items as $detail)
                                    <tr class="border-bottom {{ $detail->status == 'off_day' ? 'bg-danger-subtle' : '' }}">
                                        <td class="py-3 ps-4 fw-bold {{ $detail->status == 'off_day' ? 'text-danger' : 'text-dark' }}">
                                            {{ \Carbon\Carbon::parse($detail->date)->locale('id')->translatedFormat('l') }}
                                        </td>
                                        <td class="py-3 text-center text-muted small">
                                            {{ \Carbon\Carbon::parse($detail->date)->locale('id')->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="py-3 text-center fw-semibold">
                                            {{ $detail->start_time ? \Carbon\Carbon::parse($detail->start_time)->format('H:i') : '-' }}
                                        </td>
                                        <td class="py-3 ps-4 {{ $detail->status == 'off_day' ? 'text-danger fw-bold italic' : '' }}">
                                            {{ $detail->agenda }}
                                        </td>
                                        <td class="py-3 text-center pe-4">
                                            @if($detail->status == 'streaming')
                                                <span class="badge rounded-pill bg-success-subtle text-success px-3">Streaming</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger text-white px-3">Off Day</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer border-0 py-4 px-4 bg-light">
                    <div class="d-flex align-items-center gap-2">
                        {{-- Tampilkan Label jika minimal salah satu channel ada --}}
                        @if($streamer->link_youtube1 || $streamer->link_youtube2)
                            <span class="small fw-bold text-muted text-uppercase me-2 d-none d-md-block">Channel:</span>
                        @endif

                        {{-- Channel YouTube 1 --}}
                        @if($streamer->link_youtube1)
                            <a href="{{ $streamer->link_youtube1 }}" target="_blank" 
                            class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                                <i class="bi bi-youtube me-2"></i> YouTube 1
                            </a>
                        @endif

                        {{-- Channel YouTube 2 (Hanya muncul jika diisi di database) --}}
                        @if($streamer->link_youtube2)
                            <a href="{{ $streamer->link_youtube2 }}" target="_blank" 
                            class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                                <i class="bi bi-youtube me-2"></i> YouTube 2
                            </a>
                        @endif
                    </div>
                    
                    <button type="button" class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold ms-auto" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection