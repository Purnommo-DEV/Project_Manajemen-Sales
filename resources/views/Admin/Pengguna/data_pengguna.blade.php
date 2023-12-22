@extends('Layout.master', ['title' => 'Data Pengguna'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Data Pengguna/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Pengguna</h6>
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
                                <a id="tombol-tambah-pengguna"
                                    class="btn btn-sm btn-primary rounded-pill text-white fw-semibold tambah_isi_elemen"
                                    href="#" data-bs-toggle="modal" data-bs-target="#modalTambahPengguna"><i
                                        class="fa fa-plus fa-xs"></i> Tambah Pengguna
                                </a>
                            </div>
                            <div class="modal fade text-left" id="modalTambahPengguna" data-bs-backdrop="static"
                                data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Pengguna</h4>
                                            <button type="button" class="close batal" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.TambahDataPengguna') }}" id="formTambahPengguna"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <label>Nama Lengkap</label>
                                                <div class="form-group">
                                                    <input type="text" name="nama" placeholder="Nama Lengkap"
                                                        class="form-control rounded-5">
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text nama_error"></label>
                                                    </div>
                                                </div>
                                                <label>Email</label>
                                                <div class="form-group">
                                                    <input type="text" name="email" placeholder="Email"
                                                        class="form-control rounded-5">
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text email_error"></label>
                                                    </div>
                                                </div>
                                                <label>Password</label>
                                                <div class="form-group">
                                                    <div class="input-group has-validation">
                                                        <input name="password" type="password" class="form-control"
                                                            id="password" />
                                                        <span class="input-group-text" style="height: 83%;margin-left: 92%;"
                                                            onclick="password_show_hide1();">
                                                            <i class="fas fa-eye" id="show_eye"></i>
                                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                        </span>
                                                        <div class="input-group has-validation">
                                                            <label class="text-danger error-text password_error"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label>Role</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="role_id" id="pilih-role">
                                                        <option value="" selected disabled>Pilih Role</option>
                                                        @foreach ($role as $roles)
                                                            <option value="{{ $roles->id }}">{{ $roles->role }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text role_id_error"></label>
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
                            <table class="table table-striped" id="table-data-pengguna">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
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

    {{-- MODAL EDIT DATA PENGGUNA --}}
    {{-- MODAL EDIT --}}
    <div class="modal fade text-left" id="modalEditPengguna" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Pengguna</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditPengguna" action="{{ route('admin.UbahDataPengguna') }}" method="POST">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <label>Nama Lengkap</label>
                        <div class="form-group">
                            <input type="text" name="nama" placeholder="Nama Lengkap"
                                class="form-control rounded-5">
                            <div class="input-group has-validation">
                                <label class="text-danger error-text nama_error"></label>
                            </div>
                        </div>
                        <label>Email</label>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email" class="form-control rounded-5">
                            <div class="input-group has-validation">
                                <label class="text-danger error-text email_error"></label>
                            </div>
                        </div>
                        <label>Password</label>
                        <div class="form-group">
                            <div class="input-group has-validation">
                                <input name="password" type="password" class="form-control rounded-5" id="password_edit"
                                    placeholder="Kosongkan jika tidak ingin diubah" />
                                <span class="input-group-text" style="height: 83%;margin-left: 92%;"
                                    onclick="password_show_hide2();">
                                    <i class="fas fa-eye" id="e_show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="e_hide_eye"></i>
                                </span>
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text password_error"></label>
                                </div>
                            </div>
                        </div>

                        <label>Role</label>
                        <div class="form-group">
                            <select class="form-control" name="role_id" id="role">
                            </select>
                            <div class="input-group has-validation">
                                <label class="text-danger error-text role_id_error"></label>
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
        let daftar_data_pengguna = [];
        const table_data_pengguna = $('#table-data-pengguna').DataTable({
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
                url: "{{ route('admin.DataPengguna') }}",
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
                        daftar_data_pengguna[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.kode;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.nama;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.email;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.relasi_role.role;
                    }
                },
                {
                    "targets": 5,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_pengguna" id-pengguna = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0 hapus_pengguna" id-pengguna = "${row.id}" href="#!"><i class="far fa-trash-alt me-2"></i>Hapus</a>
                                </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahPengguna').on('submit', function(e) {
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
                            table_data_pengguna.ajax.reload(null, false)

                        $("#formTambahPengguna")[0].reset();
                        $("#modalTambahPengguna").modal('hide')
                    }
                }
            });
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#role").empty().append('');
        })

        let role = @json($role);

        $(document).on('click', '.edit_pengguna', function(event) {
            const id = $(event.currentTarget).attr('id-pengguna');
            const data_pengguna = daftar_data_pengguna[id]
            $("#modalEditPengguna").modal('show');
            $("#formEditPengguna [name='id']").val(id)
            $("#formEditPengguna [name='nama']").val(data_pengguna.nama);
            $("#formEditPengguna [name='email']").val(data_pengguna.email);
            $("#formEditPengguna [name='password']").val(data_pengguna.password);

            $.each(role, function(key, value) {
                $('#role')
                    .append(
                        `<option value="${value.id}" ${value.id == data_pengguna.role_id ? 'selected' : ''}>${value.role}</option>`
                    )
            });

            $('#formEditPengguna').on('submit', function(e) {
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
                            $("#role").empty().append('');
                            $("#modalEditPengguna").modal('hide');
                            swal({
                                    title: "Berhasil",
                                    text: `${data.msg}`,
                                    icon: "success",
                                    successMode: true,
                                }),
                                table_data_pengguna.ajax.reload(null, false);
                        }
                    }
                });
            });
        });

        function password_show_hide1() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_show_hide2() {
            var x = document.getElementById("password_edit");
            var e_show_eye = document.getElementById("e_show_eye");
            var e_hide_eye = document.getElementById("e_hide_eye");
            e_hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                e_show_eye.style.display = "none";
                e_hide_eye.style.display = "block";
            } else {
                x.type = "password";
                e_show_eye.style.display = "block";
                e_hide_eye.style.display = "none";
            }
        }


        $(document).on('click', '.hapus_pengguna', function(event) {
            const id = $(event.currentTarget).attr('id-pengguna');

            swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/admin/hapus-data-pengguna/" + id,
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
                                    table_data_pengguna.ajax.reload()
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
