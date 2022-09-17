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
        <a class="nav-link {{ $title == 'Data surat' ? '' : 'collapsed' }}" href="{{ route('surats') }}">
            <i class="ri-draft-line"></i>
            <span>Daftar Surat</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link  {{ Request::segment(1) == 'buat-surat' ? '' : 'collapsed' }}"
            data-bs-target="#components-nav" data-bs-toggle="collapse"
            aria-expanded="{{ Request::segment(1) == 'buat-surat' ? 'true' : 'false' }}" href="#">
            <i class="ri-draft-line"></i><span>Buat Surat</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse {{ Request::segment(1) == 'buat-surat' ? 'show' : ' ' }}"
            data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('surat.domisili') }}"
                    class="{{ Request::segment(2) == 'domisili' ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Domisili</span>
                </a>
            </li>
            <li>
                <a href="{{ route('surat.keterangan_pekerjaan_orang_tua') }}"
                    class="{{ Request::segment(2) == 'keterangan-pekerjaan-orang-tua' ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Pekerjaan orang tua</span>
                </a>
            </li>
            <li>
                <a href="{{ route('surat.keterangan_berlakuan_baik') }}"
                    class="{{ Request::segment(2) == 'keterangan-berlakuan-baik' ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Berpelakukan Baik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('surat.keterangan_ekonomi_lemah') }}"
                    class="{{ Request::segment(2) == 'keterangan-ekonomi-lemah' ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Ekonomi Lemah</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-circle"></i><span>Belom Menikah</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-circle"></i><span>Kepemilikan</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-circle"></i><span>Keterangan Usaha</span>
                </a>
            </li>
        </ul>
    </li><!-- End Components Nav -->
</ul>
