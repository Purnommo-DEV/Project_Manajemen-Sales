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
                            <div class="buttons">
                                <a id="tombol-tambah-area"
                                    class="btn btn-sm btn-primary rounded-pill text-white fw-semibold tambah_isi_elemen"
                                    href="#" data-bs-toggle="modal" data-bs-target="#modalTambahRutePlan"><i
                                        class="fa fa-plus fa-xs"></i> Tambah Rute
                                </a>
                            </div>
                            <div class="modal fade text-left" id="modalTambahRutePlan" data-bs-backdrop="static"
                                data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Rute</h4>
                                            <button type="button" id="batal" class="close batal"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.TambahRutePlan') }}" id="formTambahRutePlan"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <label class="col col-form-label">Pilih Nama
                                                        Sales</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="id_sales" required>
                                                            <option>Pilih Sales</option>
                                                            @foreach ($sales_retail as $data_sales_retail)
                                                                <option value="{{ $data_sales_retail->id }}">
                                                                    {{ $data_sales_retail->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col col-form-label">Pilih hari</label>
                                                    <div class="col-md-9">
                                                        <select name="hari" class="form-control">
                                                            <option value="" disabled selected>Pilih Hari</option>
                                                            <option value="senin">Senin</option>
                                                            <option value="selasa">Selasa</option>
                                                            <option value="rabu">Rabu</option>
                                                            <option value="kamis">Kamis</option>
                                                            <option value="jumat">Jum'at</option>
                                                            <option value="sabtu">Sabtu</option>
                                                            <option value="minggu">Minggu</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col col-form-label">Minggu Ke-</label>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" name="minggu_ke"
                                                                min="1" oninput="this.value = Math.abs(this.value)">
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
                            <table class="table table-striped" id="table-data-rute">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Sales</th>
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

    <div class="modal fade text-left" id="modalEditRutePlan" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Rute</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditRutePlan" action="{{ route('admin.UbahRutePlan') }}" method="POST">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label class="col col-form-label">Pilih Sales</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="id_sales" id="id_sales" required>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col col-form-label">Pilih Hari</label>
                                <div class="col-md-9">
                                    <select name="hari" class="form-control" id="pilih-hari">
                                        <option value="" disabled>Pilih Hari</option>
                                    </select>
                                    <div class="input-group has-validation">
                                        <label class="text-danger error-text hari_error"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col col-form-label">Minggu Ke-</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="minggu_ke" min="1"
                                        oninput="this.value = Math.abs(this.value)">
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
@endsection
@section('script')
    <script>
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
                url: "{{ route('admin.DataRutePlan') }}",
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
                        return row.relasi_sales.nama;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        return row.hari;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_rute[row.id] = row;
                        return row.minggu_ke;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                            <div class="ms-auto">
                                <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_data_rute_plan" id-rute-plan = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0 hapus_data_rute_plan" id-rute-plan = "${row.id}" href="#!"><i class="fa fa-trash-alt me-2"></i>Hapus</a>
                                <a class="btn btn-link text-success text-gradient px-3 mb-0" href="/admin/rute-plan-customer/${row.kode}"><i class="fa fa-eye me-2"></i>Daftar Customer</a>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_area" id-rute-plan = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahRutePlan').on('submit', function(e) {
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
                        $("#id_sales").empty().append('');
                        swal({
                                title: "Berhasil",
                                text: `${data.msg}`,
                                icon: "success",
                                buttons: true,
                                successMode: true,
                            }),
                            table_data_rute.ajax.reload(null, false)

                        $("#formTambahRutePlan")[0].reset();
                        $("#modalTambahRutePlan").modal('hide')
                    }
                }
            });
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#id_sales").empty().append('');
        })

        let sales_retail = @json($sales_retail);

        $(document).on('click', '.edit_data_rute_plan', function(event) {
            const id = $(event.currentTarget).attr('id-rute-plan');
            const data_rute = daftar_data_rute[id]
            $("#modalEditRutePlan").modal('show');
            $("#formEditRutePlan [name='id']").val(id)
            $("#formEditRutePlan [name='hari']").val(data_rute.hari)
            $("#formEditRutePlan [name='minggu_ke']").val(data_rute.minggu_ke)

            $.each(sales_retail, function(key, value) {
                $('#id_sales')
                    .append(
                        `<option value="${value.id}" ${value.id == data_rute.id_sales ? 'selected' : ''}>${value.nama}</option>`
                    )
            });

            $("#formEditRutePlan [name='hari']").append(
                $(
                    `
                <option value='' disabled selected>-- Pilih Hari -- </option>
                <option value='senin' ${'senin' === data_rute.hari ? 'selected' : ''}>Senin</option>
                <option value='selasa' ${'selasa' === data_rute.hari ? 'selected' : ''}>Selasa</option>
                <option value='rabu' ${'rabu' === data_rute.hari ? 'selected' : ''}>Rabu</option>
                <option value='kamis' ${'kamis' === data_rute.hari ? 'selected' : ''}>Kamis</option>
                <option value='jumat' ${'jumat' === data_rute.hari ? 'selected' : ''}>Jum'at</option>
                <option value='sabtu' ${'sabtu' === data_rute.hari ? 'selected' : ''}>Sabtu</option>
                <option value='minggu' ${'minggu' === data_rute.hari ? 'selected' : ''}>Minggu</option>
                `
                ));

            $('#formEditRutePlan').on('submit', function(e) {
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
                            $("#id_sales").empty().append('');
                            $("#modalEditRutePlan").modal('hide');
                            swal({
                                    title: "Berhasil",
                                    text: `${data.msg}`,
                                    icon: "success",
                                    successMode: true,
                                }),
                                table_data_rute.ajax.reload(null, false);
                        }
                    }
                });
            });
        });


        $(document).on('click', '.hapus_data_rute_plan', function(event) {
            const id = $(event.currentTarget).attr('id-rute-plan');

            swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/admin/hapus-rute-plan/" + id,
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
                                    table_data_rute.ajax.reload()
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
