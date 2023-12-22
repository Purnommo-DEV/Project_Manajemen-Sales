<!DOCTYPE html>
<html lang="en">

@include('Layout._head')

<body class="g-sidenav-show  bg-gray-100">
    <div class="loader">
        <div></div>
    </div>
    @include('sweetalert::alert')
    @include('Layout._sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('Layout._navbar')
        <!-- End Navbar -->
        @yield('konten')
        @include('Layout._footer')
    </main>
    @include('Layout._soft-ui-configurator')
    <!--   Core JS Files   -->
    @include('Layout._script')
</body>

</html>
