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
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Kode Sales</label>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="inputtext"
                                        value="{{ $perjalanan->relasi_sales->kode }}" placeholder="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="inputtext"
                                        value="{{ Carbon\Carbon::parse($perjalanan->created_at)->isoFormat('dddd, DD MMMM YYYY') }}"
                                        placeholder="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext" class="col-sm-2 col-form-label">Kilometer Awal</label>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="inputtext" placeholder="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputtext" class="col-sm-2 col-form-label">Kilometer Akhir</label>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="inputtext" placeholder="text">
                                </div>
                            </div>
                            <table class="table table-striped" id="table-data-detail-bppbm">
                                <thead>
                                    <tr>
                                        <th width="30">No.</th>
                                        <th>Item</th>
                                        <th width="30">Pengambilan</th>
                                        <th width="30">Jual/Pemasangan</th>
                                        <th width="30">Insentif</th>
                                        <th width="30">Penarikan Retur</th>
                                        <th width="30">Pengembalian</th>
                                        <th width="30">Remark</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                            {{-- <form action="">
                                <button type="submit" class="btn btn-primary btn-sm">Setujui</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let perjalanan_id = @json($perjalanan);
        let daftar_data_perjalanan = [];
        const table_data_perjalanan = $('#table-data-detail-bppbm').DataTable({
            "destroy": true,
            // "pageLength": 10,
            // "lengthMenu": [
            //     [10, 25, 50, 100, -1],
            //     [10, 25, 50, 100, 'semua']
            // ],
            "bLengthChange": true,
            "bFilter": false,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "responsive": false,
            "sScrollX": '100%',
            "sScrollXInner": "100%",
            ajax: {
                url: "/supervisor/data-detail-pengajuan-bppbm/" + perjalanan_id.id,
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
                        return row.relasi_produk.nama_produk;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        return row.pengambilan
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
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
                        daftar_data_perjalanan[row.id] = row;
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
                        daftar_data_perjalanan[row.id] = row;
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
                        daftar_data_perjalanan[row.id] = row;
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
                        daftar_data_perjalanan[row.id] = row;
                        if (row.remark == null) {
                            return `-`
                        } else {
                            return row.remark;
                        }
                    }
                },
                {
                    "targets": 8,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        if (row.id_status_bppbm_awal == null) {
                            return `-`
                        } else {
                            return row.relasi_status_bppbm.status;
                        }
                    }
                },
                {
                    "targets": 9,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perjalanan[row.id] = row;
                        let tampilan;
                        tampilan = `
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-link text-dark text-gradient px-3 mb-0" href="/supervisor/detail-bppbm-customer/${row.id}">
                                    <i class="fas fa-eye text-dark me-2" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-link text-success text-gradient px-3 mb-0 bppbm-disetujui" id-data-bpppbm = "${row.id}" href="#!">
                                    <i class="fas fa-check text-success me-2" aria-hidden="true"></i></a>
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0 bppbm-tidak-disetujui" id-data-bpppbm = "${row.id}" href="#!">
                                    <i class="fas fa-times text-danger me-2" aria-hidden="true"></i>
                                </a>
                            </a>
                        </div>
                        `
                        if (row.id_status_bppbm_awal == 3) {
                            return tampilan;
                        } else if (row.id_status_bppbm_awal == 1 || row.id_status_bppbm_awal == 2) {
                            return `-`;
                        }
                    }
                },
            ]
        });

        $(document).on('click', '.bppbm-disetujui', function(event) {
            const id = $(event.currentTarget).attr('id-data-bpppbm');
            swal({
                title: "Yakin ?",
                text: "Setujui Pengajuan BPPBM ini ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/supervisor/setujui-pengajuan-bppbm/" + id,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 0) {
                                alert("Pengambilan produk melebihi stok")
                            } else if (response.status == 1) {
                                swal({
                                        title: "Berhasil",
                                        text: `${response.msg}`,
                                        icon: "success",
                                        successMode: true,
                                    }),
                                    table_data_perjalanan.ajax.reload()
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        $(document).on('click', '.bppbm-tidak-disetujui', function(event) {
            const id = $(event.currentTarget).attr('id-data-bpppbm');
            swal({
                title: "Yakin ?",
                text: "Pengajuan BPPBM ini tidak disetujui?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/supervisor/tidak-setujui-pengajuan-bppbm/" + id,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 1) {
                                swal({
                                        title: "Berhasil",
                                        text: `${response.msg}`,
                                        icon: "success",
                                        successMode: true,
                                    }),
                                    table_data_perjalanan.ajax.reload()
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        // $("#head-cb").on('click', function() {
        //     var isChecked = $("#head-cb").prop('checked')
        //     $(".cb-child").prop('checked', isChecked)
        //     $("#tombol-approve").prop('disabled', !isChecked)
        // })
        // $("#table-data-detail-bppbm tbody").on('click', '.cb-child', function() {
        //     if ($(this).prop('checked') != true) {
        //         $("#thead-cb").prop('checked', false)
        //     }

        //     let semua_checkbox = $("#table-data-detail-bppbm tbody .cb-child:checked")
        //     let button_non_aktif_status = (semua_checkbox.length > 0)
        //     $("#tombol-approve").prop('disabled', !button_non_aktif_status)
        // })

        // function nonAktifkanTerpilih() {
        //     let checkbox_terpilih = $("#table-data-detail-bppbm tbody .cb-child:checked")
        //     let semua_id = []
        //     let produk_id = []
        //     $.each(checkbox_terpilih, function(index, elm) {
        //         semua_id.push(elm.value)
        //         produk_id.push($(this).attr("produk"))
        //     })

        //     $.ajax({
        //         url: "",
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             ids: semua_id,
        //             produk_ids: produk_id
        //         },
        //         success: function(res) {
        //             table_data_perjalanan.ajax.reload(null, false)
        //         }
        //     })
        //     // for (let key in checkbox_terpilih) {
        //     //     semua_id.push(checkbox_terpilih[key].value)
        //     // }
        // }
    </script>
@endsection
