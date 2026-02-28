@extends('layout.landing-page.main')
@section('title', 'Streamer - B2F Official')
@section('content')

<style>
    /* Tombol Connect Modern */
    .btn-connect {
        background-color: #feb801;
        color: #000;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn-connect:hover {
        background-color: #000;
        color: #feb801;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(254, 184, 1, 0.3);
    }

    /* Styling Modal Social Media */
    .social-modal-content {
        border-radius: 25px;
        border: none;
        overflow: hidden;
    }

    .social-modal-header {
        background: #f8f9fa;
        border-bottom: none;
        padding: 25px 25px 10px;
    }

    .streamer-avatar-modal {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #feb801;
        margin-bottom: 15px;
    }

    .social-link-card {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        margin-bottom: 12px;
        border-radius: 15px;
        text-decoration: none;
        color: #fff;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .social-link-card:hover {
        transform: scale(1.02);
        color: #fff;
        opacity: 0.9;
    }

    .social-link-card i {
        font-size: 24px;
        margin-right: 15px;
    }

    /* Warna Brand Sosmed */
    .bg-instagram { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
    .bg-tiktok { background: #000; }
    .bg-youtube { background: #ff0000; }
    
</style>

<div class="page-title dark-background" data-aos="fade" style="background-image: url({{asset('bootstrap')}}/bootstrap-b2f-landing/assets/img/page-title-bg.png)">
    <div class="container position-relative">
        <h1>Streamer</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('landing-page.index') }}">Home</a></li>
                <li class="current">Streamer</li>
            </ol>
        </nav>
    </div>
</div>

<section id="streamer" class="team section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>STREAMER</h2>
        <p>OUR STREAMER</p>
    </div>

    <div class="container">
        <div class="row gy-5">
            {{-- Lakukan Looping data streamer dari database --}}
            @foreach($streamer_profile as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                    <div class="pic">
                        <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid" alt="{{ $item->name }}">
                    </div>
                    <div class="member-info text-start"> 
                        <h4 class="mb-1">{{ $item->name }}</h4>
                        <span class="d-block mb-3 text-muted">{{ $item->full_name }}</span>
                        
                        <button type="button" class="btn-connect" data-bs-toggle="modal" data-bs-target="#socialModal{{ $item->id }}">
                            <i class="bi bi-person-lines-fill me-2"></i>Social Media
                        </button>
                    </div>
                </div>

                <div class="modal fade" id="socialModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content social-modal-content shadow-lg">
                            <div class="social-modal-header text-center position-relative">
                                <button type="button" class="btn-close position-absolute" style="top: 15px; right: 15px;" data-bs-dismiss="modal" aria-label="Close"></button>
                                <img src="{{ asset('storage/' . $item->image) }}" class="streamer-avatar-modal shadow-sm">
                                <h5 class="fw-bold mb-0">Follow {{ $item->name }}</h5>
                                <p class="text-muted small">Stay connected on social media</p>
                            </div>
                            <div class="modal-body p-4 pt-2">
                                
                                {{-- List Instagram --}}
                                @if($item->link_instagram1)
                                    <a href="{{ $item->link_instagram1 }}" target="_blank" class="social-link-card bg-instagram">
                                        <i class="bi bi-instagram"></i> Instagram 1
                                    </a>
                                @endif
                                @if($item->link_instagram2)
                                    <a href="{{ $item->link_instagram2 }}" target="_blank" class="social-link-card bg-instagram">
                                        <i class="bi bi-instagram"></i> Instagram 2
                                    </a>
                                @endif

                                {{-- List Tiktok --}}
                                @if($item->link_tiktok1)
                                    <a href="{{ $item->link_tiktok1 }}" target="_blank" class="social-link-card bg-tiktok">
                                        <i class="bi bi-tiktok"></i> TikTok 1
                                    </a>
                                @endif
                                @if($item->link_tiktok2)
                                    <a href="{{ $item->link_tiktok2 }}" target="_blank" class="social-link-card bg-tiktok">
                                        <i class="bi bi-tiktok"></i> TikTok 2
                                    </a>
                                @endif

                                {{-- List Youtube --}}
                                @if($item->link_youtube1)
                                    <a href="{{ $item->link_youtube1 }}" target="_blank" class="social-link-card bg-youtube">
                                        <i class="bi bi-youtube"></i> YouTube 1
                                    </a>
                                @endif
                                @if($item->link_youtube2)
                                    <a href="{{ $item->link_youtube2 }}" target="_blank" class="social-link-card bg-youtube">
                                        <i class="bi bi-youtube"></i> YouTube 2
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- End Looping --}}
        </div>
    </div>
</section>

@endsection