@extends('Layout.master', ['title' => 'Laporan Transaksi'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Laporan Transaksi/</a>
            </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Laporan Transaksi</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table-data-transaksi">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Customer</th>
                                        <th>Produk</th>
                                        <th>Kuantitas</th>
                                        <th>Harga</th>
                                        <th>Total Pembayaran</th>
                                        <th>Hari/Tanggal</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="modalDetailDataLaporanTransaksi" tabindex="-1"
        aria-labelledby="modalDetailDataLaporanTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="formDetailDataLaporanTransaksi">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kode Perjalanan</label>
                            <div class="col-4">
                                <input type="text" readonly class="form-control" name="perjalanan" id="inputtext"
                                    placeholder="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kode Sales</label>
                            <div class="col-4">
                                <input type="text" readonly class="form-control" name="kode_sales" id="inputtext"
                                    placeholder="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kode Customer</label>
                            <div class="col-4">
                                <input type="text" readonly class="form-control" name="kode_customer" id="inputtext"
                                    placeholder="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputtext" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                            <div class="col-4">
                                <input type="text" readonly class="form-control" id="inputtext" name="created_at"
                                    placeholder="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputtext" class="col-sm-2 col-form-label">Kilometer Awal</label>
                            <div class="col-4">
                                <input type="text" readonly class="form-control" id="inputtext" name="km_awal"
                                    placeholder="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputtext" class="col-sm-2 col-form-label">Kilometer Akhir</label>
                            <div class="col-4">
                                <input type="text" readonly class="form-control" id="inputtext" name="km_akhir"
                                    placeholder="text">
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-detail-transaksi">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Transaksi</th>
                                    <th>Item</th>
                                    <th>Kuantitas</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script>
        let daftar_laporan_data_transaksi = [];
        const table_laporan_data_transaksi = $('#table-data-transaksi').DataTable({
            "destroy": true,
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'semua']
            ],
            "bLengthChange": true,
            "bFilter": false,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "responsive": false,
            "sScrollX": '100%',
            "sScrollXInner": "100%",
            ajax: {
                url: "{{ route('admin.DataLaporanTransaksi') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // data: function(d) {
                //     d.role_pengguna = data_role_pengguna;
                //     d.jurusan_pengguna = data_filter_jurusan;
                //     return d
                // }
            },
            columnDefs: [{
                    targets: '_all',
                    visible: true
                },
                {
                    "targets": 0,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let i = 1;
                        daftar_laporan_data_transaksi[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_transaksi[row.id] = row;
                        return row.relasi_customer.nama;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_transaksi[row.id] = row;
                        return row.relasi_bppbm.relasi_produk.nama_produk;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_transaksi[row.id] = row;
                        return row.kuantitas;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_transaksi[row.id] = row;
                        return $.fn.dataTable.render.number('.', ',', 2, 'Rp ').display(row.harga);
                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_transaksi[row.id] = row;
                        let total_bayar = row.kuantitas * row.harga;
                        return $.fn.dataTable.render.number('.', ',', 2, 'Rp ').display(total_bayar);
                    }
                },
                {
                    "targets": 6,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_transaksi[row.id] = row;
                        return moment(row.created_at).format('dddd, DD-MMMM-YYYY, HH:mm:ss')
                    }
                },
            ]
        });

        $(document).on('click', '.click_transaksi', function(event) {
            const transaksi_id = $(event.currentTarget).attr('transaksi-id');
            $('#modalDetailDataLaporanTransaksi').modal('show');
            const data_transaksi = daftar_laporan_data_transaksi[transaksi_id]

            $("#formDetailDataLaporanTransaksi [name='perjalanan']").val(data_transaksi.relasi_perjalanan.kode);
            $("#formDetailDataLaporanTransaksi [name='kode_sales']").val(data_transaksi.relasi_perjalanan
                .relasi_sales.kode);
            $("#formDetailDataLaporanTransaksi [name='kode_customer']").val(data_transaksi.relasi_customer.kode);
            $("#formDetailDataLaporanTransaksi [name='created_at']").val(moment(data_transaksi.created_at).format(
                'dddd, DD-MMMM-YYYY, HH:mm:ss'));
            $("#formDetailDataLaporanTransaksi [name='km_awal']").val(data_transaksi.relasi_perjalanan.km_awal);
            $("#formDetailDataLaporanTransaksi [name='km_akhir']").val(data_transaksi.relasi_perjalanan.km_akhir);

            let list_detail_data_laporan_transaksi = [];
            const table_data_transaksi = $('#table-data-detail-transaksi').DataTable({
                "destroy": true,
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'semua']
                ],
                "bLengthChange": true,
                "bFilter": false,
                "bInfo": true,
                "processing": true,
                "bServerSide": true,
                "responsive": false,
                "sScrollX": '100%',
                "sScrollXInner": "100%",
                ajax: {
                    url: "/admin/detail-data-laporan-transaksi/" + transaksi_id,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // data: function(d) {
                    //     d.role_pengguna = data_role_pengguna;
                    //     d.jurusan_pengguna = data_filter_jurusan;
                    //     return d
                    // }
                },
                columnDefs: [{
                        targets: '_all',
                        visible: true
                    },
                    {
                        "targets": 0,
                        "class": "text-nowrap text-center",
                        "render": function(data, type, row, meta) {
                            let i = 1;
                            list_detail_data_laporan_transaksi[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_transaksi[row.id] = row;
                            return row.relasi_transaksi.kode;
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_transaksi[row.id] = row;
                            return row.relasi_produk.nama_produk;
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_transaksi[row.id] = row;
                            return row.kuantitas
                        }
                    },
                    {
                        "targets": 4,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_transaksi[row.id] = row;
                            return $.fn.dataTable.render.number('.', ',', 2, 'Rp ').display(row
                                .sub_total);
                        }
                    }
                ]
            });
        });
    </script>
@endsection
