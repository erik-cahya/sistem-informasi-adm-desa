<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body class="{{ Request::segment(1) != 'warga' ? '' : 'toggle-sidebar' }}">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('includes.header')
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        @include('includes.sidebar')
    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('includes.footer')
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    @include('includes.plugins')
</body>

</html>
