@php
$route = Route::current()->getName();
@endphp

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item ">
        <a class="nav-link {{ Request::segment(1) == 'home' ? '' : 'collapsed' }}" href="{{ route('home') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Master</li>

    <li class="nav-item">
        <a class="nav-link {{ Request::segment(1) == 'warga' ? '' : 'collapsed' }}" href="{{ route('wargas') }}">
            <i class="ri-folder-5-fill"></i>
            <span>Data Penduduk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::segment(1) == 'keluarga' ? '' : 'collapsed' }}" href="{{ route('keluargas') }}">
            <i class="ri-folder-5-fill"></i>
            <span>Data Keluarga</span>
        </a>
    </li>

    <li class="nav-heading">Menu</li>

    <li class="nav-item">
        <a class="nav-link {{ $title == 'Data Mutasi' ? '' : 'collapsed' }}" href="{{ route('mutasi') }}">
            <i class="ri ri-arrow-left-right-fill"></i>
            <span>Data Mutasi</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::segment(2) == 'masuk' ? '' : 'collapsed' }}" href="{{ route('mutasi.masuk') }}">
            <i class="ri-user-add-line"></i>
            <span>Lahir/Masuk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::segment(2) == 'keluar' ? '' : 'collapsed' }}"
            href="{{ route('mutasi.keluar') }}">
            <i class="ri-user-received-line"></i>
            <span>Wafat/Keluar</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
            <i class="ri-draft-line"></i>
            <span>Buat Surat</span>
        </a>
    </li>
</ul>
