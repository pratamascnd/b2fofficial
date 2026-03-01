@extends('layout.landing-page.main')
@section('title', 'B2F Official')
@section('content')

<style>
    .client-container {
        position: relative;
        padding: 15px;
        transition: all 0.3s ease;
    }

    .client-logo {
        max-height: 60px;
        width: auto;
        filter: grayscale(100%);
        opacity: 0.6;
        transition: all 0.4s ease;
    }

    .client-action {
        margin-top: 10px;
        opacity: 0; /* Sembunyi secara default */
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    .btn-visit {
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 700;
        color: #ffc107; /* Warna B2F */
        text-decoration: none;
        letter-spacing: 1px;
        border-bottom: 2px solid transparent;
        padding-bottom: 2px;
    }

    /* Hover State */
    .client-container:hover .client-logo {
        filter: grayscale(0%);
        opacity: 1;
        transform: translateY(-5px); /* Logo sedikit naik saat tombol muncul */
    }

    .client-container:hover .client-action {
        opacity: 1;
        transform: translateY(0);
    }

    .btn-visit:hover {
        color: #000;
        border-bottom: 2px solid #ffc107;
    }

    /* Mobile Friendly */
    @media (max-width: 768px) {
        .client-action {
            opacity: 1;
            transform: translateY(0);
        }
        .client-logo {
            filter: grayscale(0%);
            opacity: 1;
            max-height: 45px;
        }
    }
</style>
<!-- Hero Section -->
<section id="hero" class="hero section dark-background">
    @if($about && $about->front_pic)
    <img src="{{ asset('storage/' . $about->front_pic) }}" alt="B2F Talent Image" data-aos="fade-in" class="img-fluid"/>
    @else
        {{-- Tampilkan gambar placeholder jika data null --}}
        <img alt="Default Image" class="img-fluid" />
    @endif

    <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">BALA-BALA FAMILY</h2>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="#about" class="btn-get-started">Get Started</a>

            @if($about && $about->video_link)
                <a href="{{ $about->video_link }}"
                    class="glightbox btn-watch-video d-flex align-items-center"
                    ><i class="bi bi-play-circle"></i><span>Watch Video</span>
                </a>
            @else
                {{-- Tampilkan tombol placeholder jika data null --}}
                <a href="#"
                    class="glightbox btn-watch-video d-flex align-items-center"
                    ><i class="bi bi-play-circle"></i><span>Watch Video</span>
                </a>
            @endif
        </div>
    </div>
</section>
<!-- /Hero Section -->

<!-- About Section -->
<section id="about" class="about section py-5">
    <div class="container section-title" data-aos="fade-up">
        <h2>About</h2>
        <p>About Us</p>
    </div>
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="image-wrapper position-relative">
                    @if($about && $about->about_pic)
                        <img src="{{ asset('storage/' . $about->about_pic) }}" class="img-fluid rounded-4 shadow-sm" alt="Bala Bala Family Community"/>
                    @else
                        {{-- Tampilkan gambar placeholder jika data null --}}
                        <img src="assets/img/about.jpg" class="img-fluid rounded-4 shadow-sm"/>
                    @endif
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="content ps-lg-4">
                    @if($about && $about->title)
                        <h3 class="fw-bold display-6 mb-3">{{ $about->title }}</h3>
                    @else
                        {{-- Tampilkan judul placeholder jika data null --}}
                        <h3 class="fw-bold display-6 mb-3"></h3>
                    @endif

                    @if($about && $about->description)
                        <p class="text-muted mb-4">{{ $about->description }}</p>
                    @else
                        {{-- Tampilkan deskripsi placeholder jika data null --}}
                        <p class="text-muted mb-4"></p>
                    @endif

                    <div class="row g-3 mb-4">
                        @foreach ($service as $data)
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i
                                        class="bi bi-check2-circle text-primary fs-4 me-2"
                                    ></i>
                                    <span class="text-secondary fw-semibold"
                                        >{{ $data->category }}</span
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /About Section -->

<!-- Stats Section -->
<section id="stats" class="stats section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center">
            
            {{-- Projects Count --}}
            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center justify-content-center w-100 h-100">
                    <i class="bi bi-journal-richtext color-orange shrink-0 me-3"></i>
                    <div>
                        <span data-purecounter-start="0" 
                              data-purecounter-end="{{ $countProject }}" 
                              data-purecounter-duration="1" 
                              class="purecounter d-block"></span>
                        <p class="mb-0">Projects</p>
                    </div>
                </div>
            </div>

            {{-- Image Count --}}
            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center justify-content-center w-100 h-100">
                    <i class="bi bi-image color-orange shrink-0 me-3"></i>
                    <div>
                        <span data-purecounter-start="0" 
                              data-purecounter-end="{{ $countImage }}" 
                              data-purecounter-duration="1" 
                              class="purecounter d-block"></span>
                        <p class="mb-0">Images</p>
                    </div>
                </div>
            </div>

            {{-- Streamer Count --}}
            <div class="col-lg-3 col-md-6">
                <div class="stats-item d-flex align-items-center justify-content-center w-100 h-100">
                    <i class="bi bi-people color-pink shrink-0 me-3"></i>
                    <div>
                        <span data-purecounter-start="0" 
                              data-purecounter-end="{{ $countStreamer }}" 
                              data-purecounter-duration="1" 
                              class="purecounter d-block"></span>
                        <p class="mb-0">Streamers</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /Stats Section -->

<!-- Service Section -->
<section id="service" class="features section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Service</h2>
        <p>OUR SERVICE</p>
    </div>

    <div class="container">
        <ul class="nav nav-tabs row d-flex" data-aos="fade-up" data-aos-delay="100">
            @foreach ($service as $data)
                <li class="nav-item col-3">
                    <a
                        class="nav-link {{ $loop->first ? 'active' : '' }}" 
                        data-bs-toggle="tab"
                        data-bs-target="#service-tab-{{ $loop->iteration }}"
                        style="cursor: pointer;"
                    >
                        <i class="bi bi-{{ $loop->iteration }}-square"></i>
                        <h4 class="d-none d-lg-block">{{ $data->category }}</h4>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content mt-4" data-aos="fade-up" data-aos-delay="200">
            @foreach ($service as $data)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="service-tab-{{ $loop->iteration }}">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                            <h3>{{ $data->title }}</h3>
                            <p>
                                {{ $data->description }}
                            </p>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            {{-- Pastikan menggunakan properti yang benar, di sini saya pakai $data->image atau $about->front_pic sesuai percakapan sebelumnya --}}
                            <img
                                src="{{ asset('storage/' . ($data->image ?? $about->front_pic)) }}"
                                alt="{{ $data->title }}"
                                class="img-fluid rounded-4 shadow"
                            />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Service Section -->

<!-- Clients Section -->
<section id="clients" class="clients section light-background">
    <div class="container" data-aos="fade-up">
        <div class="row gy-5 justify-content-center align-items-center">
            @foreach ($brand_partner as $data)
                <div class="col-xl-2 col-md-3 col-6 d-flex justify-content-center">
                    <div class="client-container text-center">
                        <div class="client-wrapper">
                            <img
                                src="{{ asset('storage/' . $data->image) }}"
                                class="img-fluid client-logo"
                                alt="Brand Partner"
                            />
                        </div>
                        <div class="client-action">
                            <a href="{{ $data->link ?? '#' }}" target="_blank" class="btn-visit">
                                Visit <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Clients Section -->

<!-- Gallery Section -->
<section id="gallery" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Project Gallery</h2>
        <p>OUR PROJECT GALLERY</p>
    </div>

    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            
            {{-- Filter Tahun Dinamis --}}
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                @foreach($years as $y)
                    <li data-filter=".filter-{{ $y->year }}">{{ $y->year }}</li>
                @endforeach
            </ul>

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                @foreach($galleries as $gallery)
                    {{-- Pastikan ada minimal 1 gambar untuk ditampilkan --}}
                    @if($gallery->details->count() > 0)
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $gallery->year }}">
                            <div class="portfolio-content h-100">
                                {{-- Gambar Utama (Ambil gambar pertama dari koleksi details) --}}
                                <img src="{{ asset('storage/' . $gallery->details->first()->image) }}" class="img-fluid img-potrait" alt="{{ $gallery->title }}" />

                                <div class="portfolio-info">
                                    <h4>{{ $gallery->year }}</h4>
                                    <p class="me-2">{{ $gallery->title }}</p>

                                    {{-- Link Glightbox untuk Gambar Pertama --}}
                                    <a href="{{ asset('storage/' . $gallery->details->first()->image) }}" 
                                       title="{{ \Carbon\Carbon::parse($gallery->project_date)->format('d-m-Y') }} - {{ $gallery->title }}" 
                                       data-gallery="portfolio-gallery-{{ $gallery->id }}" 
                                       class="glightbox preview-link">
                                        <i class="bi bi-zoom-in"></i>
                                    </a>

                                    {{-- Loop Gambar Sisanya (Disembunyikan, hanya muncul saat popup dibuka) --}}
                                    @foreach($gallery->details->skip(1) as $extraImage)
                                        <a href="{{ asset('storage/' . $extraImage->image) }}" 
                                           title="{{ \Carbon\Carbon::parse($gallery->project_date)->format('d-m-Y') }} - {{ $gallery->title }}" 
                                           data-gallery="portfolio-gallery-{{ $gallery->id }}" 
                                           class="glightbox preview-link d-none">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- /Gallery Section --> 

<!-- Contact Section -->
<section id="contact" class="contact section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>OUR CONTACT</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center text-center g-5">
            @if($contact && $contact->no_whatsapp)
                <div class="col-md-4">
                    <div class="contact-minimal">
                        <i class="bi bi-whatsapp fs-2 text-dark mb-3"></i>
                        <h5 class="fw-bold">Whatsapp</h5>
                        <p class="text-muted">{{ $contact->no_whatsapp }}</p>
                        <a
                            href="https://wa.me/{{ $contact->no_whatsapp }}"
                            class="link-primary text-decoration-none small fw-bold"
                            >CHAT NOW &rarr;</a
                        >
                    </div>
                </div>
            @else
                <div class="col-md-4">
                    <div class="contact-minimal">
                        <i class="bi bi-whatsapp fs-2 text-dark mb-3"></i>
                        <h5 class="fw-bold">Whatsapp</h5>
                        <p class="text-muted">Data Whatsapp masih kosong!</p>
                    </div>
                </div>
            @endif

            @if($contact && $contact->email)
                <div class="col-md-4">
                    <div class="contact-minimal">
                        <i class="bi bi-envelope fs-2 text-dark mb-3"></i>
                        <h5 class="fw-bold">Email</h5>
                        <p class="text-muted">{{ $contact->email }}</p>
                        <a
                            href="mailto:{{ $contact->email }}"
                            class="link-primary text-decoration-none small fw-bold"
                        >
                            SEND EMAIL &rarr;
                        </a>
                    </div>
                </div>
            @else
                <div class="col-md-4">
                    <div class="contact-minimal">
                        <i class="bi bi-envelope fs-2 text-dark mb-3"></i>
                        <h5 class="fw-bold">Email</h5>
                        <p class="text-muted">Data Email masih kosong!</p>
                    </div>
                </div>
            @endif

            <div class="col-md-4">
                <div class="contact-minimal h-100 text-center">
                    <i class="bi bi-share fs-2 text-dark mb-3"></i>
                    <h5 class="fw-bold text-uppercase small tracking-widest">
                        Social Media
                    </h5>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        @if($contact && $contact->link_instagram)
                            <a href="{{ $contact->link_instagram }}" target="_blank" class="contact-social-link" title="Instagram" >
                                <i class="bi bi-instagram"></i>
                            </a>
                        @else
                            
                        @endif

                        @if($contact && $contact->link_tiktok)
                            <a href="{{ $contact->link_tiktok }}" target="_blank" class="contact-social-link" title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        @else
                            
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Contact Section -->

@endsection