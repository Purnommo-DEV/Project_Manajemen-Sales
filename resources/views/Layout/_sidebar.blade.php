<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="{{ asset('Assets/logo/PT_SWS_V1.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold">PT. Sumber Wijaya Sakti</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            {{-- SUPERADMIN --}}
            {{-- @if (Auth::user()->relasi_role->role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('superadmin.Dashboard*') ? 'active' : '' }} "
                        href="{{ route('superadmin.Dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-home {{ request()->routeIs('superadmin.Dashboard*') ? 'warna-white' : 'warna-black' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('superadmin.HalamanPengguna*') ? 'active' : '' }} "
                        href="{{ route('superadmin.HalamanPengguna') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-users {{ request()->routeIs('superadmin.HalamanPengguna*') ? 'warna-white' : 'warna-black' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Pengguna</span>
                    </a>
                </li> --}}


            {{-- ADMIN --}}
            @if (Auth::user()->relasi_role->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.Dashboard*') ? 'active' : '' }} "
                        href="{{ route('admin.Dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-home {{ request()->routeIs('admin.Dashboard*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.Produk*') ? 'active' : '' }} "
                        href="{{ route('admin.Produk') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-boxes {{ request()->routeIs('admin.Produk*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Produk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanCustomer*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanCustomer') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-store {{ request()->routeIs('admin.HalamanCustomer*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Customer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanPengguna*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanPengguna') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-users {{ request()->routeIs('admin.HalamanPengguna*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Pengguna</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanArea*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanArea') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-map-marker {{ request()->routeIs('admin.HalamanArea*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Area</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanKendaraan*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanKendaraan') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-truck-pickup {{ request()->routeIs('admin.HalamanKendaraan*') ? 'warna-white' : 'warna-black' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kendaraan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Perjalanan"
                        class="nav-link
                        @if (request()->routeIs('admin.HalamanPerjalanan*')) {{ request()->routeIs('admin.HalamanPerjalanan*') ? 'active' : '' }}
                        @elseif(request()->routeIs('admin.HalamanPerjalananTemp*'))
                            {{ request()->routeIs('admin.HalamanPerjalananTemp*') ? 'active' : '' }}
                        " @endif

                        aria-controls="Perjalanan"
                        role="button" aria-expanded="true">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-route
                                @if (request()->routeIs('admin.HalamanPerjalanan*')) {{ request()->routeIs('admin.HalamanPerjalanan*') ? 'warna-white' : 'warna-black' }}
                                @elseif (request()->routeIs('admin.HalamanPerjalananTemp*')) {{ request()->routeIs('admin.HalamanPerjalananTemp*') ? 'warna-white' : 'warna-black' }}
                                @else
                                    warna-black @endif
                                ">
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">Perjalanan</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.HalamanPerjalanan*') }} show" id="Perjalanan">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item {{ request()->routeIs('admin.HalamanPerjalanan*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanPerjalanan') }}">Daftar Perjalanan
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="collapse {{ request()->routeIs('admin.HalamanPerjalananTemp*') }} show"
                        id="Perjalanan">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanPerjalananTemp*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanPerjalananTemp') }}">Temporary Plan
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <!-- <div class="collapse" id="basicExamples">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanPenagihanHutang*') ? 'active' : '' }}">
                                <a class="nav-link" href="#foundationExample">Daftar Hutang Customer
                                </a>
                            </li>
                        </ul>
                    </div>  -->
                </li>



                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanPengajuanBPPBM*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanPengajuanBPPBM') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-list-alt {{ request()->routeIs('admin.HalamanPengajuanBPPBM*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Manajemen BPPBM</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanPerusahaan*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanPerusahaan') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-building {{ request()->routeIs('admin.HalamanPerusahaan*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Perusahaan</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Laporan"
                        class="nav-link
                        @if (request()->routeIs('admin.HalamanLaporanStokProduk*')) {{ request()->routeIs('admin.HalamanLaporanStokProduk*') ? 'active' : '' }}
                        @elseif(request()->routeIs('admin.HalamanLaporanBPPBM*')) {{ request()->routeIs('admin.HalamanLaporanBPPBM*') ? 'active' : '' }}
                        @elseif(request()->routeIs('admin.HalamanLaporanPerjalanan*')) {{ request()->routeIs('admin.HalamanLaporanPerjalanan*') ? 'active' : '' }}
                        @elseif(request()->routeIs('admin.HalamanLaporanTransaksi*')) {{ request()->routeIs('admin.HalamanLaporanTransaksi*') ? 'active' : '' }}
                        " @endif

                        aria-controls="Laporan"
                        role="button" aria-expanded="true">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-clipboard-list
                                @if (request()->routeIs('admin.HalamanLaporanStokProduk*')) {{ request()->routeIs('admin.HalamanLaporanStokProduk*') ? 'warna-white' : 'warna-black' }}
                                @elseif (request()->routeIs('admin.HalamanLaporanBPPBM*')) {{ request()->routeIs('admin.HalamanLaporanBPPBM*') ? 'warna-white' : 'warna-black' }}
                                @elseif(request()->routeIs('admin.HalamanLaporanPerjalanan*')) {{ request()->routeIs('admin.HalamanLaporanPerjalanan*') ? 'warna-white' : 'warna-black' }}
                                @elseif(request()->routeIs('admin.HalamanLaporanTransaksi*')) {{ request()->routeIs('admin.HalamanLaporanTransaksi*') ? 'warna-white' : 'warna-black' }}
                                @else
                                    warna-black @endif
                                ">
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">Laporan</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.HalamanLaporanStokProduk*') }} show"
                        id="Laporan">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanLaporanStokProduk*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanLaporanStokProduk') }}">Stok Produk
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.HalamanLaporanBPPBM*') }} show" id="Laporan">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanLaporanBPPBM*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanLaporanBPPBM') }}">BPPBM
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.HalamanLaporanPerjalanan*') }} show"
                        id="Laporan">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanLaporanPerjalanan*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanLaporanPerjalanan') }}">Perjalanan
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.HalamanLaporanTransaksi*') }} show"
                        id="Laporan">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanLaporanTransaksi*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanLaporanTransaksi') }}">Transaksi
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.HalamanLaporanCustomer*') }} show"
                        id="Laporan">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanLaporanCustomer*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanLaporanCustomer') }}">Customer
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#DataRute"
                        class="nav-link
                        @if (request()->routeIs('admin.HalamanListRute*')) {{ request()->routeIs('admin.HalamanListRute*') ? 'active' : '' }}
                        @elseif(request()->routeIs('admin.HalamanRutePlans*')) {{ request()->routeIs('admin.HalamanRutePlans*') ? 'active' : '' }}
                        @elseif(request()->routeIs('admin.HalamanRutePlanTemp*')) {{ request()->routeIs('admin.HalamanRutePlanTemp*') ? 'active' : '' }}" @endif

                        aria-controls="DataRute"
                        role="button" aria-expanded="true">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-code-branch
                                @if (request()->routeIs('admin.HalamanListRute*')) {{ request()->routeIs('admin.HalamanListRute*') ? 'warna-white' : 'warna-black' }}
                                @elseif (request()->routeIs('admin.HalamanRutePlans*')) {{ request()->routeIs('admin.HalamanRutePlans*') ? 'warna-white' : 'warna-black' }}
                                @elseif(request()->routeIs('admin.HalamanRutePlanTemp*')) {{ request()->routeIs('admin.HalamanRutePlanTemp*') ? 'warna-white' : 'warna-black' }}
                                @else
                                    warna-black @endif
                                ">
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">Rute</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.HalamanRutePlans*') }} show" id="DataRute">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item {{ request()->routeIs('admin.HalamanRutePlans*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanRutePlans') }}">Rute Perjalanan
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.HalamanListRute*') }} show" id="DataRute">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item {{ request()->routeIs('admin.HalamanListRute*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanListRute') }}">List Rute
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="collapse {{ request()->routeIs('admin.HalamanRutePlanTemp*') }} show" id="DataRute">
                        <ul class="nav ms-4 ps-3">
                            <li
                                class="nav-item {{ request()->routeIs('admin.HalamanRutePlanTemp*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanRutePlanTemp') }}">Rute Perjalanan
                                    Temporary
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanDaftarPerjalananWholesale*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanDaftarPerjalananWholesale') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-money-bill {{ request()->routeIs('admin.HalamanDaftarPerjalananWholesale*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Penagihan Hutang</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanCttKeuangan*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanCttKeuangan') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fa fa-money-check {{ request()->routeIs('admin.HalamanCttKeuangan*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Keuangan</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Form"
                        class="nav-link
                        @if (request()->routeIs('admin.HalamanFormSurvey*')) {{ request()->routeIs('admin.HalamanFormSurvey*') ? 'active' : '' }}
                        " @endif

                        aria-controls="Form"
                        role="button" aria-expanded="true">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-clipboard
                                @if (request()->routeIs('admin.HalamanFormSurvey*')) {{ request()->routeIs('admin.HalamanFormSurvey*') ? 'warna-white' : 'warna-black' }}
                                @else
                                    warna-black @endif
                                ">
                            </i>
                        </div>
                        <span class="nav-link-text ms-1">Form</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.HalamanFormSurvey*') }} show" id="Form">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item {{ request()->routeIs('admin.HalamanFormSurvey*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.HalamanFormSurvey') }}">Form Survery
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.HalamanDataPerusahaanPesanProduk*') ? 'active' : '' }} "
                        href="{{ route('admin.HalamanDataPerusahaanPesanProduk') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-box {{ request()->routeIs('admin.HalamanDataPerusahaanPesanProduk*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Pembelian Produk</span>
                    </a>
                </li> --}}

                {{-- SUPERVISOR --}}
            @elseif (Auth::user()->relasi_role->role == 'spv')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('supervisor.HalamanPengajuanBPPBM*') ? 'active' : '' }} "
                        href="{{ route('supervisor.HalamanPengajuanBPPBM') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-list-alt {{ request()->routeIs('supervisor.HalamanPengajuanBPPBM*') ? 'warna-white' : 'warna-black' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen BPPBM</span>
                    </a>
                </li>

                {{-- MARKETING --}}
                {{-- @elseif (Auth::user()->relasi_role->role == 'marketing')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('marketing.Dashboard*') ? 'active' : '' }} "
                        href="{{ route('marketing.Dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-home {{ request()->routeIs('marketing.Dashboard*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('marketing.Produk*') ? 'active' : '' }} "
                        href="{{ route('marketing.Produk') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-boxes {{ request()->routeIs('marketing.Produk*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Produk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('marketing.HalamanDistributor*') ? 'active' : '' }} "
                        href="{{ route('marketing.HalamanDistributor') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                            <i
                                class="fas fa-building {{ request()->routeIs('marketing.HalamanDistributor*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Distributor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('marketing.Pesanan*') ? 'active' : '' }} "
                        href="{{ route('marketing.Pesanan') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-list {{ request()->routeIs('marketing.Pesanan*') ? 'warna-white' : 'warna-black' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('marketing.Pengembalian*') ? 'active' : '' }} "
                        href="{{ route('marketing.Pengembalian') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-share {{ request()->routeIs('marketing.Pengembalian*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Pengembalian</span>
                    </a>
                </li> --}}


                {{-- PRODUKSI --}}
                {{-- @elseif (Auth::user()->relasi_role->role == 'produksi')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('produksi.Dashboard*') ? 'active' : '' }} "
                        href="{{ route('produksi.Dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-home {{ request()->routeIs('produksi.Dashboard*') ? 'warna-white' : 'warna-black' }}"></i>

                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('produksi.Produksi*') ? 'active' : '' }} "
                        href="{{ route('produksi.Produksi') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-boxes {{ request()->routeIs('produksi.Produk*') ? 'warna-white' : 'warna-black' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Produksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('produksi.BarangKeluar*') ? 'active' : '' }} "
                        href="{{ route('produksi.BarangKeluar') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-truck {{ request()->routeIs('produksi.BarangKeluar*') ? 'warna-white' : 'warna-black' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Barang Keluar</span>
                    </a>
                </li> --}}
            @endif
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('Logout*') ? 'active' : '' }} "
                    href="{{ route('Logout') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i
                            class="fas fa-outdent {{ request()->routeIs('Logout*') ? 'warna-white' : 'warna-black' }}"></i>

                    </div>
                    <span class="nav-link-text ms-1">Keluar</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
