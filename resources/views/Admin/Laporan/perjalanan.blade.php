@extends('Layout.master', ['title' => 'Laporan Perjalanan'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Laporan Perjalanan/</a>
            </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Laporan Perjalanan</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table-data-perjalanan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Perjalanan</th>
                                        <th>Kode Sales</th>
                                        <th>KM Awal</th>
                                        <th>KM Akhir</th>
                                        <th>Hari/Tanggal</th>
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

    <div class="modal fade" id="modalDetailDataLaporanPerjalanan" tabindex="-1"
        aria-labelledby="modalDetailDataLaporanPerjalananLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailDataLaporanPerjalananLabel">Detail Laporan Perjalanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formDetailDataLaporanPerjalanan">
                    <div class="modal-body">
                        <table class="table table-striped" id="table-data-kunjungi-customer">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Customer</th>
                                    <th>Hari</th>
                                    <th>Minggu Ke-</th>
                                    <th>Tanggal</th>
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
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '.click_perjalanan', function(event) {
            const perjalanan_id = $(event.currentTarget).attr('perjalanan-id');
            $('#modalDetailDataLaporanPerjalanan').modal('show');

            let daftar_data_kunjungi_customer = [];
            const table_data_kunjungi_customer = $('#table-data-kunjungi-customer').DataTable({
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
                    url: "/admin/detail-data-laporan-perjalanan/" + perjalanan_id,
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
                            daftar_data_kunjungi_customer[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_kunjungi_customer[row.id] = row;
                            return row.relasi_customer.nama;
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_kunjungi_customer[row.id] = row;
                            return row.hari;
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_kunjungi_customer[row.id] = row;
                            return row.minggu_ke;
                        }
                    },
                    {
                        "targets": 4,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_kunjungi_customer[row.id] = row;
                            return moment(row.created_at).format('dddd, DD-MMMM-YYYY, HH:mm:ss')
                        }
                    },
                ]
            });

        });

        let daftar_data_perjalanan = [];
        const table_laporan_data_perjalanan = $('#table-data-perjalanan').DataTable({
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
                url: "{{ route('admin.DataLaporanPerjalanan') }}",
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
                        daftar_data_perjalanan[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        return row.kode;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        return row.relasi_sales.nama;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        if (row.km_awal == null) {
                            return `<p>belum ditentukan</p>`
                        } else {
                            return row.km_awal;
                        }
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        if (row.km_akhir == null) {
                            return `<p>belum ditentukan</p>`
                        } else {
                            return row.km_akhir;
                        }
                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        if (row.relasi_kendaraan == null) {
                            return `<p>belum ditentukan</p>`
                        } else {
                            return row.relasi_kendaraan.plat;
                        }
                    }
                },
                {
                    "targets": 6,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                            <div class="ms-auto">
                                <a class="btn btn-link text-warning text-gradient px-3 mb-0 click_perjalanan" perjalanan-id="${row.id}" href="#!"><i class="fa fa-eye me-2"></i>Detail</a>
                            </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });
    </script>
@endsection
