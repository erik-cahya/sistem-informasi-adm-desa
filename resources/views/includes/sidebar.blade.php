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
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <a class="nav-link {{ Request::segment(1) == 'keluarga' ? '' : 'collapsed' }}" data-bs-target="#forms-nav"
            data-bs-toggle="collapse" href="#">
            <i class="ri-folder-5-fill"></i><span>Data Keluarga</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse {{ Request::segment(1) == 'keluarga' ? 'show' : '' }}"
            data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('keluargas') }}" class="{{ $route == 'keluargas' ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Daftar Keluarga</span>
                </a>
            </li>
            <li>
                <a href="{{ route('keluarga.add') }}" class="{{ $route == 'keluarga.add' ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Tambah Kelaurga</span>
                </a>
            </li>
        </ul>
    </li><!-- End Forms Nav -->

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
