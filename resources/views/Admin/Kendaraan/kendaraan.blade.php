@extends('Layout.master', ['title' => 'Data Kendaraan'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Data Kendaraan/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Kendaraan</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="buttons">
                                <a id="tombol-tambah-area"
                                    class="btn btn-sm btn-primary rounded-pill text-white fw-semibold tambah_isi_elemen"
                                    href="#" data-bs-toggle="modal" data-bs-target="#modalTambahArea"><i
                                        class="fa fa-plus fa-xs"></i> Tambah Kendaraan
                                </a>
                            </div>
                            <div class="modal fade text-left" id="modalTambahArea" data-bs-backdrop="static"
                                data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Kendaraan</h4>
                                            <button type="button" class="close batal" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.TambahDataKendaraan') }}" id="formTambahKendaraan"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label class="col col-form-label" for="tipe">Tipe</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="tipe" class="form-control"
                                                            id="exampleInputPassword1" placeholder="Tipe">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col col-form-label" for="plat">Nomor Polisi</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="plat" class="form-control"
                                                            id="exampleInputPassword1" placeholder="Nomor Polisi">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col col-form-label" for="keterangan_lainnnya">Keterangan
                                                        Lainnya</label>
                                                    <div class="col-md-9">
                                                        <textarea name="keterangan_lainnya" class="form-control" id="exampleInputPassword1" placeholder="Keterangan Lainnya"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col col-form-label" for="keterangan_lainnnya">Status
                                                        Kendaraan</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="status">
                                                            <option value="" disabled selected> -- Pilih Status --
                                                            </option>
                                                            <option value="0">Tidak Tersedia</option>
                                                            <option value="1">Tersedia</option>
                                                        </select>
                                                        <div class="input-group has-validation">
                                                            <label class="text-danger error-text status_error"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary batal rounded-pill"
                                                    data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1 rounded-pill">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped" id="table-data-kendaraan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tipe</th>
                                        <th>Nomor Polisi</th>
                                        <th>Keterangan Lainnya</th>
                                        <th>Status</th>
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

    <div class="modal fade text-left" id="modalEditKendaraan" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Kendaraan</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditKendaraan" action="{{ route('admin.UbahDataKendaraan') }}" method="POST">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col col-form-label" for="tipe">Tipe</label>
                            <div class="col-md-9">
                                <input type="text" name="tipe" class="form-control" id="exampleInputPassword1"
                                    placeholder="Tipe">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col col-form-label" for="plat">Nomor Polisi</label>
                            <div class="col-md-9">
                                <input type="text" name="plat" class="form-control" id="exampleInputPassword1"
                                    placeholder="Nomor Polisi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col col-form-label" for="keterangan_lainnnya">Keterangan
                                Lainnya</label>
                            <div class="col-md-9">
                                <textarea name="keterangan_lainnya" class="form-control" id="exampleInputPassword1"
                                    placeholder="Keterangan Lainnya"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col col-form-label" for="status_kendaraan">Status Kendaraan</label>
                            <div class="col-md-9">
                                <select name="status_kendaraan" class="form-control" id="status_kendaraan">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal rounded-pill"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1 rounded-pill">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let daftar_data_kendaraan = [];
        const table_data_kendaraan = $('#table-data-kendaraan').DataTable({
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
                url: "{{ route('admin.DataKendaraan') }}",
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
                        daftar_data_kendaraan[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_kendaraan[row.id] = row;
                        return row.tipe;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_kendaraan[row.id] = row;
                        return row.plat;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_kendaraan[row.id] = row;
                        return row.keterangan_lainnya;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_kendaraan[row.id] = row;
                        if (row.status == 1) {
                            return `<label>Tersedia</label>`;
                        } else if (row.status == 0) {
                            return `<label>Tidak Tersedia</label>`;
                        }
                    }
                },
                {
                    "targets": 5,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                            <div class="ms-auto">
                        <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_kendaraan" id-kendaraan = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0 hapus_kendaraan" id-kendaraan = "${row.id}" href="#!"><i class="fa fa-trash-alt me-2"></i>Hapus</a>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_kendaraan" id-kendaraan = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahKendaraan').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                    } else if (data.status == 1) {
                        swal({
                                title: "Berhasil",
                                text: `${data.msg}`,
                                icon: "success",
                                buttons: true,
                                successMode: true,
                            }),
                            table_data_kendaraan.ajax.reload(null, false)

                        $("#formTambahKendaraan")[0].reset();
                        $("#modalTambahArea").modal('hide')
                    }
                }
            });
        });


        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#status_kendaraan").empty().append('');
        })

        $(document).on('click', '.edit_kendaraan', function(event) {
            const id = $(event.currentTarget).attr('id-kendaraan');
            const data_kendaraan = daftar_data_kendaraan[id]
            $("#modalEditKendaraan").modal('show');
            $("#formEditKendaraan [name='id']").val(id)
            $("#formEditKendaraan [name='tipe']").val(data_kendaraan.tipe);
            $("#formEditKendaraan [name='plat']").val(data_kendaraan.plat);
            $("#formEditKendaraan [name='keterangan_lainnya']").val(data_kendaraan.keterangan_lainnya);

            $("#formEditKendaraan [name='status_kendaraan']").append(
                $(
                    `<option value='0' ${0 === data_kendaraan.status ? 'selected' : ''}>Tidak Tersedia</option>
                    <option value='1' ${1 === data_kendaraan.status ? 'selected' : ''}>Tersedia</option>`
                ))

            $('#formEditKendaraan').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('label.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('label.' + prefix + '_error').text(val[0]);
                                // $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else if (data.status == 1) {
                            $("#status_kendaraan").empty().append('');
                            $("#modalEditKendaraan").modal('hide');
                            swal({
                                    title: "Berhasil",
                                    text: `${data.msg}`,
                                    icon: "success",
                                    successMode: true,
                                }),
                                table_data_kendaraan.ajax.reload(null, false);
                        }
                    }
                });
            });
        });
        // $('.batal').on('click', function() {
        //     $(document).find('label.error-text').text('');
        //     $("#role").empty().append('');
        // })


        $(document).on('click', '.hapus_kendaraan', function(event) {
            const id = $(event.currentTarget).attr('id-kendaraan');

            swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/admin/hapus-data-kendaraan/" + id,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 0) {
                                alert("Gagal Hapus")
                            } else if (response.status == 1) {
                                swal({
                                        title: "Berhasil",
                                        text: `${response.msg}`,
                                        icon: "success",
                                        successMode: true,
                                    }),
                                    table_data_kendaraan.ajax.reload()
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });
    </script>
@endsection
