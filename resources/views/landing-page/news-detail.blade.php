@extends('layout.landing-page.main')
@section('title', $news_detail->title . ' - B2F Official')
@section('content')

<style>
    /* Desain Container Gambar agar tetap rapi tapi gambar tidak terpotong */
    .detail-img-container {
        background-color: #f8f9fa; /* Warna dasar abu muda */
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        overflow: hidden;
        border-bottom: 1px solid #eee;
    }

    .detail-img-container img {
        max-width: 100%;
        height: auto; /* Gambar akan mengikuti tinggi aslinya */
        max-height: 600px; /* Batas maksimal agar tidak terlalu panjang ke bawah */
        object-fit: contain; /* INI KUNCINYA: Gambar akan tampil penuh tanpa terpotong */
    }
</style>

<div class="page-title dark-background" data-aos="fade" style="background-image: url({{asset('bootstrap')}}/bootstrap-b2f-landing/assets/img/page-title-bg.png)">
    <div class="container position-relative">
        <h1>News Detail</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('landing-page.index') }}">Home</a></li>
                <li><a href="{{ route('landing-page.news') }}">News</a></li>
                <li class="current">Detail</li>
            </ol>
        </nav>
    </div>
</div>

<section id="news-detail" class="news-detail section light-background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                    
                    {{-- Bagian Gambar yang sudah diperbaiki --}}
                    <div class="detail-img-container">
                        <img src="{{ asset('storage/' . $news_detail->image) }}" alt="{{ $news_detail->title }}">
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4 text-muted small">
                            @if($news_detail->status == 'pinned')
                                <span class="badge bg-warning text-dark me-3 px-3 rounded-pill">
                                    <i class="bi bi-pin-angle-fill"></i> PINNED
                                </span>
                            @endif
                            <span class="me-3"><i class="bi bi-calendar-event me-1"></i> {{ $news_detail->created_at->format('d M Y') }}</span>
                        </div>

                        <h1 class="fw-bold mb-4 text-dark">{{ $news_detail->title }}</h1>

                        <div class="detail-description text-secondary mb-5" style="line-height: 1.8; font-size: 1.1rem; white-space: pre-line;">
                            {!! $news_detail->description !!}
                        </div>

                        @if($news_detail->link)
                            <a href="{{ $news_detail->link }}" target="_blank" class="btn btn-warning rounded-pill fw-bold px-5 shadow-sm text-dark">
                                <i class="bi bi-box-arrow-up-right me-2"></i> Go to Link
                            </a>
                        @endif

                        <hr class="my-5 opacity-25">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('landing-page.news') }}" class="btn btn-outline-dark rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i> Back to News List
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection