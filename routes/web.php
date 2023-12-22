<?php

use App\Http\Controllers\Admin\Admin_AreaController;
use App\Http\Controllers\Admin\Admin_CatatanKeuangan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\Admin_ProdukController;
use App\Http\Controllers\Admin\Admin_LaporanController;
use App\Http\Controllers\Admin\Admin_CustomerController;
use App\Http\Controllers\Admin\Admin_PenggunaController;
use App\Http\Controllers\Admin\Admin_DashboardController;
use App\Http\Controllers\Admin\Admin_FormController;
use App\Http\Controllers\Admin\Admin_KendaraanController;
use App\Http\Controllers\Admin\Admin_ListRoute;
use App\Http\Controllers\Admin\Admin_ManajemenBPPBM;
use App\Http\Controllers\Admin\Admin_Perencanaan;
use App\Http\Controllers\Admin\Admin_Perusahaan;
use App\Http\Controllers\Admin\Admin_PesanProduk;
use App\Http\Controllers\Admin\Admin_RoutePlan;
use App\Http\Controllers\Admin\Admin_RoutePlanTemp;
use App\Http\Controllers\Admin\WilayahIndonesiaController;
use App\Http\Controllers\Supervisor\Supervisor_Dashboard;
use App\Http\Controllers\Supervisor\Supervisor_ManajemenBPPBM;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::middleware('guest')->group(function () {
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login')->name('Login');
    Route::get('register', 'register')->name('Register');
    Route::post('login', 'authenticate')->name('Auth');
    Route::post('register-akun', 'register_akun')->name('RegisterAkun');
});
// });

Route::middleware(['auth'])->group(function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('Logout');

    // Route::prefix('superadmin')->name('superadmin.')->middleware(['isSuperAdmin'])->group(function () {
    //     Route::controller(SuperAdmin_DashboardController::class)->group(function () {
    //         Route::get('dashboard', 'dashboard')->name('Dashboard');
    //     });
    //     Route::controller(SuperAdmin_DataUserController::class)->group(function () {
    //         Route::get('halaman-pengguna', 'halaman_pengguna')->name('HalamanPengguna');
    //         Route::any('data-pengguna', 'data_pengguna')->name('DataPengguna');
    //         Route::post('tambah-data-pengguna', 'tambah_data_pengguna')->name('TambahDataPengguna');
    //         Route::post('ubah-data-pengguna', 'ubah_data_pengguna')->name('UbahDataPengguna');
    //         Route::get('hapus-data-pengguna/{id}', 'hapus_data_pengguna')->name('HapusDataPengguna');
    //     });
    // });

    Route::prefix('admin')->name('admin.')->middleware(['isAdmin'])->group(function () {
        Route::controller(Admin_DashboardController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('Dashboard');
        });

        // PRODUK
        Route::controller(Admin_ProdukController::class)->group(function () {
            Route::get('halaman-produk', 'halaman_produk')->name('Produk');
            Route::any('data-produk', 'data_produk')->name('DataProduk');
            Route::post('tambah-data-produk', 'tambah_data_produk')->name('TambahDataProduk');
            Route::post('ubah-data-produk', 'ubah_data_produk')->name('UbahDataProduk');
            Route::get('hapus-data-produk/{id}', 'hapus_data_produk')->name('HapusDataProduk');
        });

        // PENGGUNA
        Route::controller(Admin_PenggunaController::class)->group(function () {
            Route::get('halaman-pengguna', 'halaman_pengguna')->name('HalamanPengguna');
            Route::any('data-pengguna', 'data_pengguna')->name('DataPengguna');
            Route::post('tambah-data-pengguna', 'tambah_data_pengguna')->name('TambahDataPengguna');
            Route::post('ubah-data-pengguna', 'ubah_data_pengguna')->name('UbahDataPengguna');
            Route::get('hapus-data-pengguna/{id}', 'hapus_data_pengguna')->name('HapusDataPengguna');
        });

        // CUSTOMER
        Route::controller(Admin_CustomerController::class)->group(function () {
            Route::get('halaman-customer', 'halaman_customer')->name('HalamanCustomer');
            Route::any('data-customer', 'data_customer')->name('DataCustomer');
            Route::post('tambah-data-customer', 'tambah_data_customer')->name('TambahDataCustomer');
            Route::post('ubah-data-customer', 'ubah_data_customer')->name('UbahDataCustomer');
            Route::get('hapus-data-customer/{id}', 'hapus_data_customer')->name('HapusDataCustomer');
            Route::get('print-barcode-customer/{kode}', 'print_barcode_customer')->name('PrintBarcodeCustomer');
            Route::get('halaman-daftar-piutang-customer', 'halaman_daftar_piutang_customer')->name('HalamanDaftarPiutangCustomer');
        });

        // AREA
        Route::controller(Admin_AreaController::class)->group(function () {
            Route::get('halaman-area', 'halaman_area')->name('HalamanArea');
            Route::any('data-area', 'data_area')->name('DataArea');
            Route::post('tambah-data-area', 'tambah_data_area')->name('TambahDataArea');
            // Route::post('ubah-data-area', 'ubah_data_area')->name('UbahDataArea');
            Route::get('ubah-data-area/{kode}', 'ubah_data_area')->name('HalamanArea.UbahDataArea');
            Route::post('proses-ubah-data-area/{kode}', 'proses_ubah_data_area')->name('ProsesUbahDataArea');
            Route::get('hapus-data-area/{id}', 'hapus_data_area')->name('HapusDataArea');
        });

        // KENDARAAN
        Route::controller(Admin_KendaraanController::class)->group(function () {
            Route::get('halaman-kendaraan', 'halaman_kendaraan')->name('HalamanKendaraan');
            Route::any('data-kendaraan', 'data_kendaraan')->name('DataKendaraan');
            Route::post('tambah-data-kendaraan', 'tambah_data_kendaraan')->name('TambahDataKendaraan');
            Route::post('ubah-data-kendaraan', 'ubah_data_kendaraan')->name('UbahDataKendaraan');
            Route::get('hapus-data-kendaraan/{id}', 'hapus_data_kendaraan')->name('HapusDataKendaraan');
        });

        Route::controller(WilayahIndonesiaController::class)->group(function () {
            Route::get('provinsi', 'provinces')->name('Provinsi');
            Route::get('kota', 'kota')->name('Kota');
            Route::get('kecamatan', 'kecamatan')->name('Kecamatan');
            Route::get('desa', 'desa')->name('Desa');
        });

        //PERENCANAAN
        Route::controller(Admin_Perencanaan::class)->group(function () {
            // SALES RETAIL
            Route::get('halaman-perjalanan', 'halaman_perjalanan')->name('HalamanPerjalanan');
            Route::any('data-perjalanan', 'data_perjalanan')->name('DataPerjalanan');
            Route::post('tambah-data-perjalanan', 'tambah_data_perjalanan')->name('TambahDataPerjalanan');
            Route::post('ubah-data-perjalanan', 'ubah_data_perjalanan')->name('UbahDataPerjalanan');
            Route::get('hapus-data-perjalanan/{id}', 'hapus_data_perjalanan')->name('HapusDataPerjalanan');

            Route::get('halaman-kunjungi-customer/{kode_perjalanan}', 'halaman_kunjungi_customer')->name('HalamanPerjalanan.HalamanKunjungiCustomer');
            Route::any('data-kunjungi-customer/{perjalanan_id}', 'data_kunjungi_customer')->name('DataKunjungiCustomer');
            Route::post('tambah-data-kunjungi-customer', 'tambah_data_kunjungi_customer')->name('TambahDataKunjungiCustomer');
            Route::post('ubah-data-kunjungi-customer', 'ubah_data_kunjungi_customer')->name('UbahDataKunjungiCustomer');
            Route::get('hapus-data-kunjungi-customer/{id}', 'hapus_data_kunjungi_customer')->name('HapusDataKunjungiCustomer');

            // SALES WHOLESALE
            Route::get('halaman-perjalanan-ws', 'halaman_perjalanan_ws')->name('HalamanDaftarPerjalananWholesale');
            Route::any('data-perjalanan-ws', 'data_perjalanan_ws')->name('DaftarPerjalananWholesale');
            Route::post('tambah-data-perjalanan-ws', 'tambah_data_perjalanan_ws')->name('TambahDaftarPerjalananWholesale');
            Route::post('ubah-data-perjalanan-ws', 'ubah_data_perjalanan_ws')->name('UbahDaftarPerjalananWholesale');
            Route::get('hapus-data-perjalanan-ws/{id}', 'hapus_data_perjalanan_ws')->name('HapusDaftarPerjalananWholesale');

            Route::get('halaman-penagihan-hutang/{kode_perjalanan}', 'halaman_penagihan_hutang_ws')->name('HalamanDaftarPerjalananWholesale.HalamanPenagihanHutangWholesale');
            Route::any('data-penagihan-hutang/{perjalanan_id}', 'data_penagihan_hutang_ws')->name('DataPenagihanHutangWholesale');
            Route::post('tambah-data-penagihan-hutang', 'tambah_data_penagihan_hutang_ws')->name('TambahDataPenagihanHutangWholesale');
            Route::post('ubah-data-penagihan-hutang', 'ubah_data_penagihan_hutang_ws')->name('UbahDataPenagihanHutangWholesale');
            Route::get('hapus-data-penagihan-hutang/{id}', 'hapus_data_penagihan_hutang_ws')->name('HapusDataPenagihanHutangWholesale');

            // TEMPORARY PLAN
            Route::get('halaman-perjalanan-temp', 'halaman_perjalanan_temp')->name('HalamanPerjalananTemp');

            Route::get('halaman-kunjungi-customer-temp/{kode_perjalanan}', 'halaman_kunjungi_customer_temp')->name('HalamanPerjalananTemp.HalamanKunjungiCustomerTemp');
            Route::any('data-kunjungi-customer-temp/{perjalanan_id}', 'data_kunjungi_customer_temp')->name('DataKunjungiCustomerTemp');
            Route::post('tambah-data-kunjungi-customer-temp', 'tambah_data_kunjungi_customer_temp')->name('TambahDataKunjungiCustomerTemp');
            Route::post('ubah-data-kunjungi-customer-temp', 'ubah_data_kunjungi_customer_temp')->name('UbahDataKunjungiCustomerTemp');
            Route::get('hapus-data-kunjungi-customer-temp/{id}', 'hapus_data_kunjungi_customer_temp')->name('HapusDataKunjungiCustomerTemp');
        });

        // RUTE PERJALANAN
        Route::controller(Admin_RoutePlan::class)->group(function () {
            Route::get('halaman-rute-plan', 'halaman_rute_plan')->name('HalamanRutePlans');
            Route::any('data-rute-plan', 'data_rute_plan')->name('DataRutePlan');
            Route::post('ubah-rute-plan', 'ubah_rute_plan')->name('UbahRutePlan');
            Route::post('tambah-rute-plan', 'tambah_rute_plan')->name('TambahRutePlan');
            Route::get('hapus-rute-plan/{id}', 'hapus_rute_plan');

            Route::get('rute-plan-customer/{kode}', 'halaman_rute_plan_customer')->name('HalamanRutePlans.HalamanRutePlanCustomer');
            Route::any('data-rute-plan-customer/{id_rute}', 'data_rute_plan_customer');
            Route::post('tambah-rute-plan-customer', 'tambah_rute_plan_customer')->name('TambahRutePlanCustomer');
            Route::get('hapus-rute-plan-customer/{id}', 'hapus_rute_plan_customer');
        });

        // RUTE PERJALANAN TEMPORARY
        Route::controller(Admin_RoutePlanTemp::class)->group(function () {
            Route::get('halaman-rute-plan-temp', 'halaman_rute_plan_temp')->name('HalamanRutePlanTemp');
            Route::any('data-rute-plan-temp', 'data_rute_plan_temp')->name('DataRutePlanTemp');
            Route::post('ubah-rute-plan-temp', 'ubah_rute_plan_temp')->name('UbahRutePlanTemp');
            Route::post('tambah-rute-plan-temp', 'tambah_rute_plan_temp')->name('TambahRutePlanTemp');
            Route::get('hapus-rute-plan-temp/{id}', 'hapus_rute_plan_temp');

            Route::get('rute-plan-temp-customer/{kode}', 'halaman_rute_plan_temp_customer')->name('HalamanRutePlanTemp.HalamanRutePlanTempCustomer');
            Route::any('data-rute-plan-temp-customer/{id_rute}', 'data_rute_plan_temp_customer');
            Route::post('tambah-rute-plan-temp-customer', 'tambah_rute_plan_temp_customer')->name('TambahRutePlanTempCustomer');
            Route::get('hapus-rute-plan-temp-customer/{id}', 'hapus_rute_plan_temp_customer');
        });

        // LIST RUTE
        Route::controller(Admin_ListRoute::class)->group(function () {
            Route::get('halaman-list-rute', 'halaman_list_rute')->name('HalamanListRute');
            Route::any('data-list-rute', 'data_list_rute')->name('DataListRute');
            Route::get('detail-rute-plan/{id}', 'detail_rute_plan')->name('HalamanListRute.HalamanDetailRutePlan');
            Route::any('data-kunjungan-rute-id/{id}', 'data_kunjungan_rute_id');
            Route::any('detail-insentif/{id}', 'data_detail_insentif');
            Route::any('detail-retur/{id}', 'data_detail_retur');
            Route::any('detail-penjualan/{id}', 'data_detail_penjualan');
            Route::any('detail-stok-visibility/{id}', 'detail_stok_visibility');
        });

         //MANAJEMEN BPPBM
        Route::controller(Admin_ManajemenBPPBM::class)->group(function () {
            Route::get('halaman-pengajuan-bppbm', 'halaman_pengajuan_bppbm')->name('HalamanPengajuanBPPBM');
            Route::any('data-pengajuan-bppbm', 'data_pengajuan_bppbm')->name('DataPengajuanBPPBM');
            Route::get('detail-pengajuan-bppbm/{kode_perjalanan}', 'detail_pengajuan_bppbm')->name('HalamanPengajuanBPPBM.HalamanDetailPengajuanBPPBM');
            Route::any('data-detail-pengajuan-bppbm/{perjalanan_id}', 'data_detail_pengajuan_bppbm')->name('HalamanPengajuanBPPBM.DataDetailPengajuanBPPBM');
            Route::get('detail-bppbm-customer/{id}', 'detail_bppbm_customer')->name('HalamanPengajuanBPPBM.DetailBPPBMCustomer');
        });

        // MANAJEMEN PERUSAHAAN
        Route::controller(Admin_Perusahaan::class)->group(function () {
            Route::get('halaman-perusahaan', 'halaman_perusahaan')->name('HalamanPerusahaan');
            Route::any('data-perusahaan', 'data_perusahaan')->name('DataPerusahaan');
            Route::post('tambah-data-perusahaan', 'tambah_data_perusahaan')->name('TambahDataPerusahaan');
            Route::post('ubah-data-perusahaan', 'ubah_data_perusahaan')->name('UbahDataPerusahaan');
            Route::get('hapus-data-perusahaan/{id}', 'hapus_data_perusahaan')->name('HapusDataPerusahaan');
        });

        //PESAN PRODUK
        Route::controller(Admin_PesanProduk::class)->group(function () {

            Route::get('halaman-tambah-pesan-produk/{kode_perusahaan}', 'halaman_tambah_pesan_produk')->name('HalamanDataTambahPesanProduk');
            Route::get('detail-tambah-pesan-produk/{kode_tambah_pesan_produk}', 'detail_tambah_pesan_produk')->name('HalamanDataTambahPesanProduk.HalamanDetailDataTambahPesanProduk');
            Route::any('data-tambah-pesan-produk/{perusahaan_id}', 'data_tambah_pesan_produk')->name('DataTambahPesanProduk');
            Route::post('tambah-data-tambah-pesan-produk', 'tambah_data_tambah_pesan_produk')->name('TambahDataTambahPesanProduk');
            Route::post('ubah-data-tambah-pesan-produk', 'ubah_data_tambah_pesan_produk')->name('UbahDataTambahPesanProduk');
            Route::get('hapus-data-tambah-pesan-produk/{id}', 'hapus_data_tambah_pesan_produk')->name('HapusDataTambahPesanProduk');


            Route::get('halaman-pesan-produk', 'halaman_pesan_produk')->name('HalamanDataPerusahaanPesanProduk');
            Route::get('detail-pesan-produk/{kode_pesan_produk}', 'detail_pesan_produk')->name('HalamanDataPerusahaanPesanProduk.HalamanDetailDataPerusahaanPesanProduk');
            Route::any('data-pesan-produk', 'data_pesan_produk')->name('DataPerusahaanPesanProduk');
            Route::post('tambah-data-pesan-produk', 'tambah_data_pesan_produk')->name('TambahDataPerusahaanPesanProduk');
            Route::post('ubah-data-pesan-produk', 'ubah_data_pesan_produk')->name('UbahDataPerusahaanPesanProduk');
            Route::get('hapus-data-pesan-produk/{id}', 'hapus_data_pesan_produk')->name('HapusDataPerusahaanPesanProduk');

            Route::any('data-detail-pesan-produk/{pesan_produk_id}', 'data_detail_pesan_produk')->name('DataDetailPerusahaanPesanProduk');
            Route::post('tambah-data-detail-pesan-produk', 'tambah_data_detail_pesan_produk')->name('TambahDataDetailPerusahaanPesanProduk');
            Route::post('ubah-data-detail-pesan-produk', 'ubah_data_detail_pesan_produk')->name('UbahDataDetailPerusahaanPesanProduk');
            Route::get('hapus-data-detail-pesan-produk/{id}', 'hapus_data_detail_pesan_produk')->name('HapusDataDetailPerusahaanPesanProduk');
            Route::post('lampiran-pesanan', 'tambah_lampiran_pesanan')->name('TambahLampiranPesanan');
        });

        Route::controller(Admin_FormController::class)->group(function () {
            // FORM SURVEY
            Route::get('form-survey', 'halaman_form_survey')->name('HalamanFormSurvey');
            Route::post('tambah-form-survey', 'tambah_nama_form')->name('TambahFormSurvey');
            Route::get('hapus-form-survey/{id}', 'hapus_nama_form')->name('HapusFormSurvey');
            Route::post('tambah-form-survey-parameter', 'tambah_nama_form_parameter')->name('TambahFormSurveyParameter');
        });

        Route::controller(Admin_LaporanController::class)->group(function () {
            // STOK PRODUK
            Route::get('stok-produk', 'halaman_laporan_stok_produk')->name('HalamanLaporanStokProduk');
            Route::any('data-stok-produk', 'data_laporan_stok_produk')->name('DataLaporanStokProduk');

            // BPPBM
            Route::get('bppbm', 'halaman_laporan_bppbm')->name('HalamanLaporanBPPBM');
            Route::any('data-bppbm', 'data_laporan_bppbm')->name('DataLaporanBPPBM');
            Route::any('detail-data-laporan-bppbm/{perjalanan_id}', 'detail_data_laporan_bppbm')->name('DetailDataLaporanBPPBM');
            Route::get('print-detail-data-laporan-bppbm/{perjalanan_id}', 'print_detail_data_laporan_bppbm')->name('PrintDetailDataLaporanBPPBM');

            // PERJALANAN
            Route::get('halaman-laporan-perjalanan', 'halaman_laporan_perjalanan')->name('HalamanLaporanPerjalanan');
            Route::any('data-laporan-perjalanan', 'data_laporan_perjalanan')->name('DataLaporanPerjalanan');
            Route::any('detail-data-laporan-perjalanan/{perjalanan_id}', 'detail_data_laporan_perjalanan')->name('DetailDataLaporanPerjalanan');

            //TRANSAKSI
            Route::get('halaman-laporan-transaksi', 'halaman_laporan_transaksi')->name('HalamanLaporanTransaksi');
            Route::any('data-laporan-transaksi', 'data_laporan_transaksi')->name('DataLaporanTransaksi');
            Route::any('detail-data-laporan-transaksi/{transaksi_id}', 'detail_data_laporan_transaksi')->name('DetailDataLaporanTransaksi');

             // CUSTOMER
             Route::get('customer', 'halaman_laporan_customer')->name('HalamanLaporanCustomer');
             Route::any('laporan-data-customer', 'data_laporan_customer')->name('DataLaporanCustomer');
        });

        // TRANSAKSI PENGELUARAN/PEMASUKKAN
        Route::controller(Admin_CatatanKeuangan::class)->group(function () {
            Route::get('halaman-ctt-keuangan', 'halaman_ctt_keuangan')->name('HalamanCttKeuangan');
            Route::any('data-ctt-keuangan', 'data_ctt_keuangan')->name('DataCttKeuangan');
            Route::post('tambah-data-ctt-keuangan', 'tambah_data_ctt_keuangan')->name('TambahDataCttKeuangan');
            Route::post('ubah-data-ctt-keuangan', 'ubah_data_ctt_keuangan')->name('UbahDataCttKeuangan');
            Route::get('hapus-data-ctt-keuangan/{id}', 'hapus_data_ctt_keuangan')->name('HapusDataCttKeuangan');
        });
    });

    Route::prefix('supervisor')->name('supervisor.')->middleware(['isSupervisor'])->group(function () {
        Route::controller(Supervisor_Dashboard::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('Dashboard');
        });

        Route::controller(Supervisor_ManajemenBPPBM::class)->group(function () {
            Route::get('setujui-pengajuan-bppbm/{id}', 'setujui_pengajuan_bppbm');
            Route::get('tidak-setujui-pengajuan-bppbm/{id}', 'tidak_setujui_pengajuan_bppbm');

            Route::get('halaman-pengajuan-bppbm', 'halaman_pengajuan_bppbm')->name('HalamanPengajuanBPPBM');
            Route::any('data-perjalanan', 'data_perjalanan')->name('DataPerjalanan');
            Route::any('data-pengajuan-bppbm', 'data_pengajuan_bppbm')->name('DataPengajuanBPPBM');
            Route::get('detail-pengajuan-bppbm/{kode_perjalanan}', 'detail_pengajuan_bppbm')->name('HalamanPengajuanBPPBM.HalamanDetailPengajuanBPPBM');
            Route::any('data-detail-pengajuan-bppbm/{perjalanan_id}', 'data_detail_pengajuan_bppbm')->name('HalamanPengajuanBPPBM.DataDetailPengajuanBPPBM');
            Route::get('detail-bppbm-customer/{id}', 'detail_bppbm_customer')->name('HalamanPengajuanBPPBM.DetailBPPBMCustomer');
        });
    });




    // Route::prefix('produksi')->name('produksi.')->middleware(['isProduksi'])->group(function () {
    //     Route::controller(ProdukController::class)->group(function () {
    //         Route::get('dashboard', 'dashboard')->name('Dashboard');
    //         Route::get('halaman-produksi', 'halaman_produksi')->name('Produksi');
    //         Route::any('data-produk', 'data_produk')->name('DataProduk');
    //         Route::post('tambah-data-produk', 'tambah_data_produk')->name('TambahDataProduk');
    //         Route::post('ubah-data-produk', 'ubah_data_produk')->name('UbahDataProduk');
    //         Route::get('hapus-data-produk/{id}', 'hapus_data_produk')->name('HapusDataProduk');
    //     });
    //     Route::controller(BarangKeluarController::class)->group(function () {
    //         Route::get('halaman-barang-keluar', 'halaman_barang_keluar')->name('BarangKeluar');
    //         Route::any('data-produk-keluar', 'data_produk_keluar')->name('DataProdukKeluar');
    //     });
    // });

    // Route::prefix('marketing')->name('marketing.')->middleware(['isMarketing'])->group(function () {
    //     Route::controller(Marketing_DashboardController::class)->group(function () {
    //         Route::get('dashboard', 'dashboard')->name('Dashboard');
    //     });
    //     Route::controller(ProdukController::class)->group(function () {
    //         Route::get('halaman-produk', 'halaman_produksi_marketing')->name('Produk');
    //         Route::any('data-produk', 'data_produk')->name('DataProduk');
    //     });
    //     Route::controller(Marketing_DistributorController::class)->group(function () {
    //         Route::get('halaman-distributor', 'halaman_distributor')->name('HalamanDistributor');
    //         Route::any('data-distributor', 'data_distributor')->name('DataDistributor');
    //         Route::post('tambah-data-distributor', 'tambah_data_distributor')->name('TambahDataDistributor');
    //         Route::post('ubah-data-distributor', 'ubah_data_distributor')->name('UbahDataDistributor');
    //         Route::get('hapus-data-distributor/{id}', 'hapus_data_distributor')->name('HapusDataDistributor');
    //     });
    //     Route::controller(Marketing_PesananController::class)->group(function () {
    //         Route::get('halaman-pesanan', 'halaman_pesanan')->name('Pesanan');
    //         Route::get('produk-detail/{id}', 'produk_detail')->name('ProdukDetail');
    //         Route::post('tambah-distribusi-barang', 'tambah_distribusi_barang')->name('TambahDistribusiBarang');
    //         Route::any('data-pesanan', 'data_pesanan')->name('DataPesanan');
    //         Route::post('tambah-data-pesanan', 'tambah_data_pesanan')->name('TambahDataPesanan');
    //         Route::post('ubah-data-pesanan', 'ubah_data_pesanan')->name('UbahDataPesanan');
    //         Route::get('hapus-data-pesanan/{id}', 'hapus_data_pesanan')->name('HapusDataPesanan');
    //         // Route::get('cari-distributor', 'pilih_cari_distributor')->name('CariDistributor');

    //         Route::get('produk-pesanan/{id}', 'produk_pesanan')->name('Pesanan.ProdukPesanan');
    //         Route::any('data-produk-pesanan/{id}', 'data_produk_pesanan')->name('DataProdukPesanan');
    //         Route::get('hapus-data-produk-pesanan/{id}', 'hapus_data_produk_pesanan')->name('HapusDataProdukPesanan');

    //         Route::post('status-pesanan', 'status_pesanan')->name('StatusPesanan');
    //         Route::any('data-status-pesanan/{id}', 'data_status_pesanan')->name('DataStatusPesanan');
    //     });
    //     Route::controller(Marketing_PengembalianController::class)->group(function () {
    //         Route::get('halaman-pengembalian', 'halaman_pengembalian')->name('Pengembalian');
    //         Route::any('data-pesanan-diterima', 'data_pesanan_diterima')->name('DataPesananDiterima');
    //         Route::get('produk-pengembalian/{id}', 'pengembalian_produk_pesanan')->name('PengembalianProdukDetail');
    //         Route::any('produk-dipesan/{pesanan_id}/{id}', 'data_produk_dipesan');
    //         Route::any('data-produk-dikembalikan/{id}', 'data_produk_pengembalian');
    //         Route::post('pengembalian-barang', 'pengembalian_barang')->name('PengembalianBarang');
    //         Route::get('hapus-data-pengembalian/{id}', 'hapus_data_pengembalian')->name('HapusDataPengembalian');
    //         // Route::any('data-pengembalian', 'data_pengembalian')->name('DataPengembalian');
    //     });
    // });

});
