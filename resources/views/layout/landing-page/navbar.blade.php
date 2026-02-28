<header
            id="header"
            class="header d-flex align-items-center fixed-top mb-5"
        >
            <div
                class="container-fluid container-xl position-relative d-flex align-items-center"
            >
                <a
                    href="index.html"
                    class="logo d-flex align-items-center me-auto"
                >
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <img
                        src="{{asset('bootstrap')}}/bootstrap-b2f-landing/assets/img/logo_b2f.png"
                        class="logo-about"
                        alt="Bala Bala Family Logo"
                    />
                    <!-- <h1 class="sitename">BALA-BALA FAMILY</h1> -->
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li>
                            <a href="{{ route('landing-page.index') }}#hero" class="{{ request()->routeIs('landing-page.index') ? 'active' : '' }}">Home</a>
                        </li>
                        <li><a href="{{ route('landing-page.index') }}#about">About</a></li>
                        <li><a href="{{ route('landing-page.index') }}#service">Service</a></li>
                        <li><a href="{{ route('landing-page.index') }}#gallery">Gallery</a></li>
                        <li><a href="{{ route('landing-page.news') }}" class="{{ request()->routeIs('landing-page.news') ? 'active' : '' }}">News</a></li>
                        <li><a href="{{ route('landing-page.streamer') }}" class="{{ request()->routeIs('landing-page.streamer') ? 'active' : '' }}">Streamer</a></li>
                        <li><a href="{{ route('landing-page.streamer-schedule') }}" class="{{ request()->routeIs('landing-page.streamer-schedule') ? 'active' : '' }}">Streamer Schedule</a></li>
                        <li><a href="{{ route('landing-page.index') }}#contact">Contact</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </header>