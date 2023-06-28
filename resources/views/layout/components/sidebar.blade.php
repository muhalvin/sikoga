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
                <li class="{{ $menu == 'Dashboard' ? 'active' : '' }}">
                    <a href="{{ route('pemilik/dashboard') }}" class="nav-link">
                        <i class="fas fa-fire"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-header">KOS</li>
                <li class="{{ $menu == 'Kos' ? 'active' : '' }}">
                    <a href="{{ route('pemilik/kos') }}" class="nav-link">
                        <i class="fas fa-home"></i><span>Setting Kos</span>
                    </a>
                </li>

                <li class="{{ $menu == 'users' ? 'active' : '' }}">
                    <a href="{{ route('pemilik/users') }}" class="nav-link">
                        <i class="fas fa-users"></i><span>Penghuni Kos</span>
                    </a>
                </li>

                <li class="menu-header">Pendaftaran</li>
                <li class="{{ $submenu == 'Verifikasi' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pemilik/verifikasi') }}">
                        <i class="fas fa-registered"></i>
                        Verifikasi
                    </a>
                </li>
                <li class="{{ $submenu == 'Pembayaran' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pemilik/pembayaran') }}">
                        <i class="fas fa-file-invoice"></i>
                        Pembayaran
                    </a>
                </li>

                <li class="menu-header">Tagihan</li>
                <li class="{{ $menu == 'Tagihan' ? 'active' : '' }}">
                    <a href="{{ route('pemilik/tagihan') }}" class="nav-link">
                        <i class="fas fa-file-invoice-dollar"></i><span>Tagihan</span>
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
                <li class="{{ $menu == 'Dashboard' ? 'active' : '' }}">
                    <a href="{{ route('pengurus/dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-header">Pendaftaran</li>
                <li class="{{ $submenu == 'Verifikasi' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pengurus/verifikasi') }}">
                        <i class="fas fa-registered"></i>
                        Verifikasi
                    </a>
                </li>
                <li class="{{ $submenu == 'Pembayaran' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pengurus/pembayaran') }}">
                        <i class="fas fa-file-invoice"></i>
                        Pembayaran
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
                <li class="{{ $menu == 'Dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-header">Profile</li>
                <li class="{{ $menu == 'Profile' ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <i class="fas fa-user"></i><span>Profile</span>
                    </a>
                </li>

                <li class="menu-header">Pendaftaran</li>
                <li class="{{ $submenu == 'Verifikasi' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('verifikasi') }}">
                        <i class="fas fa-registered"></i>
                        Verifikasi
                    </a>
                </li>
                <li class="{{ $submenu == 'Pembayaran' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pembayaran') }}">
                        <i class="fas fa-file-invoice"></i>
                        Pilih Kos
                    </a>
                </li>

                <li class="menu-header">Tagihan</li>

                <li class="{{ $menu == 'Tagihan' ? 'active' : '' }}">
                    <a href="{{ route('tagihan') }}" class="nav-link">
                        <i class="fas fa-file-invoice-dollar"></i><span>Tagihan</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
@endif
