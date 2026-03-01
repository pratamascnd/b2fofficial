<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard.index') }}" class="logo">
                <img
                    src="{{ asset("bootstrap") }}/bootstrap-b2f-dashboard/assets/img/sidebar_logo.png"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="50"
                />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Manage Menu</h4>
                </li>

                @if(Auth::user()->role == 'Super Admin')
                    <li class="nav-item {{ request()->routeIs('admin-account.*') ? 'active' : '' }}">
                        <a href="{{ route('admin-account.index') }}">
                            <i class="fas fa-user-shield"></i>
                            <p>Admin Account</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item {{ request()->routeIs('about.*') ? 'active' : '' }}">
                    <a href="{{ route('about.index') }}">
                        <i class="fas fa-info-circle"></i>
                        <p>About</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('service.*') ? 'active' : '' }}">
                    <a href="{{ route('service.index') }}">
                        <i class="fas fa-concierge-bell"></i>
                        <p>Service</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('brand-partner.*') ? 'active' : '' }}">
                    <a href="{{ route('brand-partner.index') }}">
                        <i class="fas fa-handshake"></i>
                        <p>Brand Partner</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('gallery.*') ? 'active' : '' }}">
                    <a href="{{ route('gallery.index') }}">
                        <i class="fas fa-images"></i>
                        <p>Gallery</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
                    <a href="{{ route('news.index') }}">
                        <i class="fas fa-newspaper"></i>
                        <p>News</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('streamer-profile.*') ? 'active' : '' }}">
                    <a href="{{ route('streamer-profile.index') }}">
                        <i class="fas fa-users"></i>
                        <p>Streamer Profile</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('streamer-schedule.*') ? 'active' : '' }}">
                    <a href="{{ route('streamer-schedule.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Streamer Schedule</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                    <a href="{{ route('contact.index') }}">
                        <i class="fas fa-envelope"></i>
                        <p>Contact</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('auth.logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

<div class="main-panel">
    <div class="main-header">
        <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img
                        src="../{{ asset("bootstrap") }}/bootstrap-b2f-dashboard/assets/img/sidebar_logo.png"
                        alt="navbar brand"
                        class="navbar-brand"
                        height="20"
                    />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
        >
            <div class="container-fluid">
                <nav
                    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
                ></nav>
                <h3 class="fw-bold">@yield("namepage")</h3>

                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a
                            class="dropdown-toggle profile-pic"
                            data-bs-toggle="dropdown"
                            href="#"
                            aria-expanded="false"
                        >
                            <div class="avatar-sm">
                                <img
                                    src="{{ asset("bootstrap") }}/bootstrap-b2f-dashboard/assets/img/profile.jpg"
                                    alt="..."
                                    class="avatar-img rounded-circle"
                                />
                            </div>
                            <span class="profile-username">
                                <span class="fw-bold">
                                    @if (Auth::check())
                                        {{ Auth::user()->name ?? 'AdminFactory' }}
                                    @endif
                                </span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
