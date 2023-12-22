@extends('Layout.master', ['title' => 'List Rute'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">List Rute/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">List Rute</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table-data-list-rute">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Perjalanan</th>
                                        <th>Nama Customer</th>
                                        <th>Hari</th>
                                        <th>Minggu Ke-</th>
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
        let daftar_data_rute = [];
        const table_data_rute = $('#table-data-list-rute').DataTable({
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
                url: "{{ route('admin.DataListRute') }}",
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
                        return row.relasi_perjalanan.kode;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.relasi_customer == null || row.relasi_customer.nama == null) {
                            return 'Belum ada customer';
                        } else {
                            return row.relasi_customer.nama;
                        }
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.hari == null) {
                            return 'Belum ditentukan';
                        } else {
                            return row.hari;
                        }
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        if (row.minggu_ke == null) {
                            return 'Belum ditentukan';
                        } else {
                            return row.minggu_ke;
                        }
                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        let tampilan;
                        tampilan = `
                            <div class="ms-auto">
                                <a class="btn btn-link text-success text-gradient px-3 mb-0" href="/admin/detail-rute-plan/${row.id}"><i class="fa fa-eye me-2"></i>Detail</a>
                                </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });
    </script>
@endsection
