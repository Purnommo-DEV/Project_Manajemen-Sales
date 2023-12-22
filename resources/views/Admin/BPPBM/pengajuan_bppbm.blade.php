@extends('Layout.master', ['title' => 'Data Pengajuan BPPBM'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Data Pengajuan BPPBM/</a>
            </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Pengajuan BPPBM</h6>
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
                                        <th>Kode Sales</th>
                                        <th>Hari/Tanggal</th>
                                        <th>Kilometer Awal</th>
                                        <th>Alamat Awal</th>
                                        <th>Kilometer Akhir</th>
                                        <th>Alamat Akhir</th>
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
@endsection
@section('script')
    <script>
        let daftar_data_perjalanan = [];
        const table_data_perjalanan = $('#table-data-perjalanan').DataTable({
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
                url: "{{ route('admin.DataPerjalanan') }}",
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
                        return row.relasi_sales.kode;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        return moment(row.created_at).format('dddd, DD-MMMM-YYYY, h:mm:ss')
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        if (row.km_awal == null) {
                            return `<p>belum ditentukan`
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
                        if (row.alamat_awal == null) {
                            return `<p>belum ditentukan`
                        } else {
                            return row.alamat_awal;
                        }
                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        if (row.km_akhir == null) {
                            return `<p>belum ditentukan`
                        } else {
                            return row.km_akhir;
                        }
                    }
                },
                {
                    "targets": 6,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        if (row.alamat_akhir == null) {
                            return `<p>belum ditentukan`
                        } else {
                            return row.alamat_akhir;
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
                                <a class="btn btn-link text-warning text-gradient px-3 mb-0" href="/admin/detail-pengajuan-bppbm/${row.kode}"><i class="fa fa-eye me-2"></i>Detail</a>
                            </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });
    </script>
@endsection
