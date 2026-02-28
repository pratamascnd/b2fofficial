@extends('layout.landing-page.main')
@section('title', 'News - B2F Official')
@section('content')
<style>
    .img-pinned {
        object-fit: cover;
        height: 100%;
        min-height: 250px;
    }

    .pagination .page-item.active .page-link {
        background-color: #feb801; 
        border-color: #feb801;
        color: #000;
    }

    .pagination .page-link {
        color: #feb801;
    }

    .pagination .page-link:hover {
        background-color: #e5ac00;
        color: #000;
    }
    
</style>

<div class="page-title dark-background" data-aos="fade" style="background-image: url({{asset('bootstrap')}}/bootstrap-b2f-landing/assets/img/page-title-bg.png)">
    <div class="container position-relative">
        <h1>News</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('landing-page.index') }}">Home</a></li>
                <li class="current">News</li>
            </ol>
        </nav>
    </div>
</div>

<section id="news" class="news section light-background">
    <div class="container">
        
        {{-- Loop untuk News yang berstatus PINNED --}}
        @foreach($news as $item)
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 15px;">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid img-pinned w-100" alt="{{ $item->title }}">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 p-lg-5">
                                <div class="d-flex align-items-center mb-3">
                                    @if($item->status == 'pinned')
                                        <span class="badge bg-warning text-dark me-2"><i class="bi bi-pin-angle-fill"></i> PINNED</span>
                                    @endif
                                    <span class="text-muted small">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                <h2 class="card-title fw-bold mb-3">{{ $item->title }}</h2>
                                <p class="card-text text-secondary">
                                    {{ Str::limit($item->description, 200, '...') }}
                                </p>
                                <a href="{{ route('landing-page.news-detail', $item->id) }}" class="btn btn-warning rounded-pill px-4 mt-3">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            {{ $news->links() }}
        </div>
    </div>
</section>

@endsection