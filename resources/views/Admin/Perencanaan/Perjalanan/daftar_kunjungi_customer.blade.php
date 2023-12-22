@extends('Layout.master', ['title' => 'Jadwal Perjalanan'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Jadwal Perjalanan/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Jadwal Perjalanan</h6>
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
                                <a id="tombol-tambah-customer"
                                    class="btn btn-sm btn-primary rounded-pill text-white fw-semibold tambah_isi_elemen"
                                    href="#" data-bs-toggle="modal" data-bs-target="#modalTambahCustomer"><i
                                        class="fa fa-plus fa-xs"></i> Tambah Jadwal Perjalanan
                                </a>
                            </div>
                            <div class="modal fade text-left" id="modalTambahCustomer" data-bs-backdrop="static"
                                data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Jadwal Perjalanan</h4>
                                        </div>
                                        <form action="{{ route('admin.TambahDataKunjungiCustomer') }}"
                                            id="formTambahKunjungiCustomer" method="POST">
                                            @csrf
                                            <input type="hidden" name="perjalanan_id" value="{{ $perjalanan->id }}" hidden>
                                            <div class="modal-body">
                                                <label>Customer</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="customer_id" id="pilih-customer">
                                                        <option value="" selected disabled>-- Pilih Customer --
                                                        </option>
                                                        @foreach ($customer_retail as $data_customer_retail)
                                                            <option value="{{ $data_customer_retail->id }}">
                                                                {{ $data_customer_retail->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text customer_id_error"></label>
                                                    </div>
                                                </div>
                                                <label>Hari</label>
                                                <div class="form-group">
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
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text hari_error"></label>
                                                    </div>
                                                </div>
                                                <label>Minggu Ke-</label>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" name="minggu_ke"
                                                        min="1" oninput="this.value = Math.abs(this.value)">
                                                </div>
                                                <label>Ganjil/Genap</label>
                                                <div class="form-group">
                                                    <select name="ganjil_genap" class="form-control">
                                                        <option value="" disabled selected>Pilih Ganjil / Genap
                                                        </option>
                                                        <option value="ganjil">Ganjil</option>
                                                        <option value="genap">Genap</option>
                                                    </select>
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text ganjil_genap_error"></label>
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
                            <table class="table table-striped" id="table-data-kunjungi-customer">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Customer</th>
                                        <th>Hari</th>
                                        <th>Minggu Ke-</th>
                                        <th>Ganjil/Genap</th>
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
    <div class="modal fade text-left" id="modalEditKunjungiCustomer" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Jadwal Perjalanan</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditKunjungiCustomer" action="{{ route('admin.UbahDataKunjungiCustomer') }}" method="POST">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <label>Customer</label>
                        <div class="form-group">
                            <select class="form-control" name="customer_id" id="customer">
                                <option value="" disabled>-- Pilih Customer --
                                </option>
                            </select>
                            <div class="input-group has-validation">
                                <label class="text-danger error-text customer_id_error"></label>
                            </div>
                        </div>
                        <label>Hari</label>
                        <div class="form-group">
                            <select name="hari" class="form-control" id="pilih-hari">
                                <option value="" disabled>Pilih Hari</option>
                            </select>
                            <div class="input-group has-validation">
                                <label class="text-danger error-text hari_error"></label>
                            </div>
                        </div>
                        <label>Minggu Ke-</label>
                        <div class="form-group">
                            <input type="number" class="form-control" name="minggu_ke" min="1"
                                oninput="this.value = Math.abs(this.value)">
                        </div>
                        <label>Ganjil/Genap</label>
                        <div class="form-group">
                            <select name="ganjil_genap" class="form-control" id="pilih-ganjil-genap">

                            </select>
                            <div class="input-group has-validation">
                                <label class="text-danger error-text ganjil_genap_error"></label>
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
        let perjalanan_id = @json($perjalanan);
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
                url: "/admin/data-kunjungi-customer/" + perjalanan_id.id,
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
                        return row.ganjil_genap;
                    }
                },
                {
                    "targets": 5,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_kunjungi_customer" id-kunjungi-customer = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0 hapus_kunjungi_customer" id-kunjungi-customer = "${row.id}" href="#!"><i class="far fa-trash-alt me-2"></i>Hapus</a>
                                </div>
                                `
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahKunjungiCustomer').on('submit', function(e) {
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
                            table_data_kunjungi_customer.ajax.reload(null, false)

                        $("#formTambahKunjungiCustomer")[0].reset();
                        $("#modalTambahCustomer").modal('hide')
                    }
                }
            });
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#pilih-hari").empty().append('');
            $("#pilih-ganjil-genap").empty().append('');
            $("#customer").empty().append('');
        })

        let customer_retail = @json($customer_retail);

        $(document).on('click', '.edit_kunjungi_customer', function(event) {
            const id = $(event.currentTarget).attr('id-kunjungi-customer');
            const data_kunjungi_customer = daftar_data_kunjungi_customer[id]
            $("#modalEditKunjungiCustomer").modal('show');
            $("#formEditKunjungiCustomer [name='id']").val(id)
            $("#formEditKunjungiCustomer [name='customer_id']").val(data_kunjungi_customer.customer_id);
            $("#formEditKunjungiCustomer [name='minggu_ke']").val(data_kunjungi_customer.minggu_ke);
            $("#formEditKunjungiCustomer [name='ganjil_genap']").val(data_kunjungi_customer.ganjil_genap);

            $.each(customer_retail, function(key, value) {
                $('#customer')
                    .append(
                        `<option value="${value.id}" ${value.id == data_kunjungi_customer.customer_id ? 'selected' : ''}>${value.nama}</option>`
                    )
            });

            $("#formEditKunjungiCustomer [name='hari']").append(
                $(
                    `
                <option value='' disabled selected>-- Pilih Hari -- </option>
                <option value='senin' ${'senin' === data_kunjungi_customer.hari ? 'selected' : ''}>Senin</option>
                <option value='selasa' ${'selasa' === data_kunjungi_customer.hari ? 'selected' : ''}>Selasa</option>
                <option value='rabu' ${'rabu' === data_kunjungi_customer.hari ? 'selected' : ''}>Rabu</option>
                <option value='kamis' ${'kamis' === data_kunjungi_customer.hari ? 'selected' : ''}>Kamis</option>
                <option value='jumat' ${'jumat' === data_kunjungi_customer.hari ? 'selected' : ''}>Jum'at</option>
                <option value='sabtu' ${'sabtu' === data_kunjungi_customer.hari ? 'selected' : ''}>Sabtu</option>
                <option value='minggu' ${'minggu' === data_kunjungi_customer.hari ? 'selected' : ''}>Minggu</option>
                `
                ))

            $("#formEditKunjungiCustomer [name='ganjil_genap']").append(
                $(
                    `
                <option value='' disabled selected>-- Pilih Ganjil / Genap --</option>
                <option value='ganjil' ${'ganjil' === data_kunjungi_customer.ganjil_genap ? 'selected' : ''}>Ganjil</option>
                <option value='genap' ${'genap' === data_kunjungi_customer.ganjil_genap ? 'selected' : ''}>Genap</option>
                `
                ))

            $('#formEditKunjungiCustomer').on('submit', function(e) {
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
                            $("#customer").empty().append('');
                            $("#pilih-hari").empty().append('');
                            $("#pilih-ganjil-genap").empty().append('');
                            $("#modalEditKunjungiCustomer").modal('hide');
                            swal({
                                    title: "Berhasil",
                                    text: `${data.msg}`,
                                    icon: "/icon/sukses.png",
                                    successMode: true,
                                }),
                                table_data_kunjungi_customer.ajax.reload(null, false);
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


        $(document).on('click', '.hapus_kunjungi_customer', function(event) {
            const id = $(event.currentTarget).attr('id-kunjungi-customer');

            swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/admin/hapus-data-kunjungi-customer/" + id,
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
                                    table_data_kunjungi_customer.ajax.reload()
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
