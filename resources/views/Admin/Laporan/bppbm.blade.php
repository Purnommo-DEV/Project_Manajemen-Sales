@extends('Layout.master', ['title' => 'Laporan BPPBM'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Laporan BPPBM/</a>
            </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Laporan BPPBM</h6>
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

    <div class="modal fade" id="modalDetailDataLaporanBPPBM" tabindex="-1"
        aria-labelledby="modalDetailDataLaporanBPPBMLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailDataLaporanBPPBMLabel">Detail Laporan BPPBM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formDetailDataLaporanBPPBM">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kode Sales</label>
                            <div class="col-4">
                                <input type="text" readonly class="form-control" name="kode" id="inputtext"
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
                        <table class="table table-striped" id="table-data-detail-bppbm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Item</th>
                                    <th>Pengambilan</th>
                                    <th>Jual/Pemasangan</th>
                                    <th>Insentif/Program</th>
                                    <th>Penarikan Retur</th>
                                    <th>Pengembalian</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
                <div class="modal-footer">
                    <a id="print-bppbm" class="btn btn-secondary" target="_blank"><i class="fa fa-print"></i>
                        Print</a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i>
                        Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let daftar_laporan_data_bppbm = [];
        const table_laporan_data_bppbm = $('#table-data-perjalanan').DataTable({
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
                url: "{{ route('admin.DataLaporanBPPBM') }}",
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
                        daftar_laporan_data_bppbm[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_bppbm[row.id] = row;
                        return row.relasi_sales.kode;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_laporan_data_bppbm[row.id] = row;
                        return moment(row.created_at).format('dddd, DD-MMMM-YYYY, HH:mm:ss')
                    }
                },
                {
                    "targets": 3,
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

        $(document).on('click', '.click_perjalanan', function(event) {
            const perjalanan_id = $(event.currentTarget).attr('perjalanan-id');
            $('#modalDetailDataLaporanBPPBM').modal('show');
            const data_perjalanan = daftar_laporan_data_bppbm[perjalanan_id]

            $("#print-bppbm").attr("href", "/admin/print-detail-data-laporan-bppbm/" + perjalanan_id);

            $("#formDetailDataLaporanBPPBM [name='kode']").val(data_perjalanan.kode);
            $("#formDetailDataLaporanBPPBM [name='created_at']").val(moment(data_perjalanan.created_at).format(
                'dddd, DD-MMMM-YYYY, HH:mm:ss'));
            $("#formDetailDataLaporanBPPBM [name='km_awal']").val(data_perjalanan.km_awal);
            $("#formDetailDataLaporanBPPBM [name='km_akhir']").val(data_perjalanan.km_akhir);

            let list_detail_data_laporan_bppbm = [];
            const table_data_perjalanan = $('#table-data-detail-bppbm').DataTable({
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
                    url: "/admin/detail-data-laporan-bppbm/" + perjalanan_id,
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
                            list_detail_data_laporan_bppbm[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_bppbm[row.id] = row;
                            return row.relasi_produk.nama_produk;
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_bppbm[row.id] = row;
                            return row.pengambilan
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_bppbm[row.id] = row;
                            if (row.pemasangan_jual == null) {
                                return `-`
                            } else {
                                return row.pemasangan_jual;
                            }
                        }
                    },
                    {
                        "targets": 4,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_bppbm[row.id] = row;
                            if (row.intensif_program == null) {
                                return `-`
                            } else {
                                return row.intensif_program;
                            }
                        }
                    },
                    {
                        "targets": 5,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_bppbm[row.id] = row;
                            if (row.penarikkan_retur == null) {
                                return `-`
                            } else {
                                return row.penarikkan_retur;
                            }
                        }
                    },
                    {
                        "targets": 6,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_bppbm[row.id] = row;
                            if (row.pengembalian == null) {
                                return `-`
                            } else {
                                return row.pengembalian;
                            }
                        }
                    },
                    {
                        "targets": 7,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            list_detail_data_laporan_bppbm[row.id] = row;
                            if (row.remark == null) {
                                return `-`
                            } else {
                                return row.remark;
                            }
                        }
                    },

                ]
            });
        });
    </script>
@endsection
