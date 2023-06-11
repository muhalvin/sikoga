@if (Auth::user()->role == 'Pemilik')
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ route('pemilik/dashboard') }}">SIKOGA</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ route('pemilik/dashboard') }}">SG</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="">
                    <a class="nav-link" href="{{ route('pemilik/dashboard') }}"><i class="far fa-square"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-header">Starter</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Layout</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                        <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                        <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link" href="blank.html"><i class="far fa-square"></i>
                        <span>Blank Page</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
@elseif (Auth::user()->role == 'Pengurus')
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ route('pengurus/dashboard') }}">SIKOGA</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ route('pengurus/dashboard') }}">SG</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="">
                    <a class="nav-link" href="{{ route('pengurus/dashboard') }}"><i class="far fa-square"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-header">Starter</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Layout</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                        <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                        <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link" href="blank.html"><i class="far fa-square"></i>
                        <span>Blank Page</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>

    {{-- Anak Kos --}}
@else
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}">SIKOGA</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ route('dashboard') }}">SG</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-fire"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-header">Pendaftaran</li>

                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Pendaftaran</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="">Verifikasi</a></li>
                        <li><a class="nav-link" href="">Pendaftaran</a></li>
                    </ul>
                </li>
            </ul>
        </aside>
    </div>
@endif
