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
        <a class="nav-link collapsed" href="users-profile.html">
            <i class="ri-draft-line"></i>
            <span>Buat Surat</span>
        </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
            <i class="ri-user-add-line"></i>
            <span>Lahir/Masuk</span>
        </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
            <i class="ri-user-received-line"></i>
            <span>Wafat/Keluar</span>
        </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
            <i class="bx bxs-log-out"></i>
            <span>Mutasi</span>
        </a>
    </li><!-- End Register Page Nav -->

</ul>
