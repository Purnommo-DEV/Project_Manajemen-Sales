@extends('Layout.master', ['title' => 'Data Rute'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Rute Perjalanan/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Rute Perjalanan</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table-data-rute">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Status Kunjungan</th>
                                        <th>Alasan Batal</th>
                                        <th>Bukti Insentif</th>
                                        <th>Bukti Stok & Visibility</th>
                                        <th>Bukti Retur</th>
                                        <th>Bukti Transaksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailInsentif" tabindex="-1" aria-labelledby="modalDetailInsentifLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="formDetailInsentif">
                    <div class="modal-body">
                        <div class="card-header">
                            <h5 class="modal-title" id="modalDetailInsentifLabel">Detail Insentif</h5>
                        </div>
                        <table class="table table-striped" id="table-data-detail-insentif">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Customer</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Unit</th>
                                    <th>Komentar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="modal-body">
                        <div class="card-header">
                            <h5 class="modal-title" id="modalDetailReturLabel">Detail Retur</h5>
                        </div>
                        <table class="table table-striped" id="table-data-detail-retur">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Customer</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Unit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="modal-body">
                        <div class="card-header">
                            <h5 class="modal-title" id="modalDetailPenjualanLabel">Detail Penjualan</h5>
                        </div>
                        <table class="table table-striped" id="table-data-detail-penjualan">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Customer</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="modal-body">
                        <div class="card-header">
                            <h5 class="modal-title" id="modalDetailStokVisibilityLabel">Detail Stok & Visibility</h5>
                        </div>
                        <table class="table table-striped" id="table-data-detail-stok-visibility">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Total Stok</th>
                                    <th>Kondisi</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i>
                        Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const rute_id = @json($id);
        let daftar_data_rute = [];
        const table_data_rute = $('#table-data-rute').DataTable({
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
                url: "/admin/data-kunjungan-rute-id/" + rute_id,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // data: function(d) {
                //     d.role_Rute = data_role_Rute;
                //     d.jurusan_Rute = data_filter_jurusan;
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
                        daftar_data_rute[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        return row.relasi_status_kunjungan.status_kunjungan;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.id_alasan_batal === null) {
                            return '-';
                        } else {
                            return row.relasi_alasan_batal.alasan_batal;
                        }
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.foto_bukti_insentif === null) {
                            return '<img src="/img/no-img.png" width="50">'
                        } else {
                            return '<img src='
                        }
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.foto_bukti_stok_visibility === null) {
                            return '<img src="/img/no-img.png" width="50">'
                        } else {
                            return '<img src='
                        }
                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.foto_bukti_retur === null) {
                            return '<img src="/img/no-img.png" width="50">'
                        } else {
                            return '<img src='
                        }
                    }
                },
                {
                    "targets": 6,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.foto_bukti_transaksi === null) {
                            return '<img src="/img/no-img.png" width="50">'
                        } else {
                            return '<img src='
                        }
                    }
                },
                {
                    "targets": 7,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                            <div class="ms-auto">
                                <a class="btn btn-link text-warning text-gradient px-3 mb-0 click_kunjungan" kunjungan-id="${row.id}" href="#!"><i class="fa fa-eye me-2"></i>Detail</a>
                                </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });

        $(document).on('click', '.click_kunjungan', function(event) {
            const kunjungan_id = $(event.currentTarget).attr('kunjungan-id');
            $('#modalDetailInsentif').modal('show');

            let list_detail_insentif = [];
            let list_detail_retur = [];
            let list_detail_penjualan = [];
            let list_detail_stok_visibility = [];
            const table_detail_insentif = $('#table-data-detail-insentif').DataTable({
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
                    url: "/admin/detail-insentif/" + kunjungan_id,
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
                            list_detail_insentif[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_insentif[row.id] = row;
                            return row.relasi_customer.nama;
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_insentif[row.id] = row;
                            return row.kuantitas
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_insentif[row.id] = row;
                            return row.harga
                        }
                    },
                    {
                        "targets": 4,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_insentif[row.id] = row;
                            return row.unit
                        }
                    },
                    {
                        "targets": 5,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_insentif[row.id] = row;
                            return row.coment
                        }
                    },
                ]
            });

            const table_detail_retur = $('#table-data-detail-retur').DataTable({
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
                    url: "/admin/detail-retur/" + kunjungan_id,
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
                            list_detail_retur[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_retur[row.id] = row;
                            return row.relasi_customer.nama;
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_retur[row.id] = row;
                            return row.kuantitas
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_retur[row.id] = row;
                            return row.harga
                        }
                    },
                    {
                        "targets": 4,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_retur[row.id] = row;
                            return row.unit
                        }
                    },
                ]
            });

            const table_detail_penjualan = $('#table-data-detail-penjualan').DataTable({
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
                    url: "/admin/detail-penjualan/" + kunjungan_id,
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
                            list_detail_penjualan[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_penjualan[row.id] = row;
                            return row.relasi_customer.nama;
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_penjualan[row.id] = row;
                            return row.kuantitas
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_penjualan[row.id] = row;
                            return row.harga
                        }
                    },
                ]
            });

            const table_detail_stok_visibility = $('#table-data-detail-stok-visibility').DataTable({
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
                    url: "/admin/detail-stok-visibility/" + kunjungan_id,
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
                            list_detail_stok_visibility[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_stok_visibility[row.id] = row;
                            return row.total_stok;
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_stok_visibility[row.id] = row;
                            return row.relasi_kondisi_pemajangan.kondisi_pemajangan
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_stok_visibility[row.id] = row;
                            return row.catatan
                        }
                    },
                ]
            });
        });
    </script>
@endsection
