@extends('Layout.master', ['title' => 'Pemesanan Produk'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pemesanan Produk/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Pemesanan Produk</h6>
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
                                    href="#" data-bs-toggle="modal" data-bs-target="#modalTambahPesanProduk"><i
                                        class="fa fa-plus fa-xs"></i>
                                    Tambah Pemesanan Produk
                                </a>
                            </div>
                            <div class="modal fade text-left" id="modalTambahPesanProduk" data-bs-backdrop="static"
                                data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Pemesanan Produk</h4>
                                            <button type="button" id="batal" class="close batal"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.TambahDataTambahPesanProduk') }}"
                                            id="formTambahPesanProduk" method="POST">
                                            @csrf
                                            <input type="hidden" name="perusahaan_id" value="{{ $perusahaan->id }}" hidden>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <input type="datetime-local" name="tanggal" class="form-control">
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
                            <table class="table table-striped" id="table-data-permohonan-tambah-pesan-produk">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Total Pembayaran</th>
                                        <th>Kode Pesanan</th>
                                        <th>Lampiran</th>
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

    <div class="modal fade text-left" id="modalEditTambahPesanProduk" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Pilihan Perusahaan</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditTambahPesanProduk" action="{{ route('admin.UbahDataTambahPesanProduk') }}" method="POST">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <label class="col col-form-label" for="provinsi">Pilih Perusahaan</label>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <input type="datetime-local" name="tanggal" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal rounded-pill" data-bs-dismiss="modal">
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
        let perusahaan_id = @json($perusahaan);
        let daftar_data_tambah_pesan_produk = [];
        const table_data_tambah_pesan_produk = $('#table-data-permohonan-tambah-pesan-produk').DataTable({
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
                url: "/admin/data-tambah-pesan-produk/" + perusahaan_id.id,
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
                        daftar_data_tambah_pesan_produk[row.id] = row;;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_tambah_pesan_produk[row.id] = row;
                        return moment(row.tanggal).format('dddd, DD-MMMM-YYYY, h:mm:ss');
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_tambah_pesan_produk[row.id] = row;
                        if (row.total_pembayaran == 0 || row.total_pembayaran == null) {
                            return `-`;
                        } else {
                            return row.total_pembayaran;
                        }
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_tambah_pesan_produk[row.id] = row;
                        return row.kode_po;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_tambah_pesan_produk[row.id] = row;
                        if (row.lampiran == 0 || row.lampiran == null) {
                            return `-`;
                        } else {
                            return row.lampiran;
                        }
                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_tambah_pesan_produk[row.id] = row;
                        if (row.status == 0 || row.status == null) {
                            return `-`;
                        } else {
                            return row.status;
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
                                <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_data_tambah_pesan_produk" id-perusahaan-pesan-produk = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0 hapus_data_tambah_pesan_produk" id-perusahaan-pesan-produk = "${row.id}" href="#!"><i class="fa fa-trash-alt me-2"></i>Hapus</a>
                                <a class="btn btn-link text-success text-gradient px-3 mb-0" href="/admin/detail-pesan-produk/${row.kode}"><i class="fa fa-eye me-2"></i>Detail</a>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_area" id-perusahaan-pesan-produk = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahPesanProduk').on('submit', function(e) {
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
                            table_data_tambah_pesan_produk.ajax.reload(null, false)

                        $("#formTambahPesanProduk")[0].reset();
                        $("#modalTambahPesanProduk").modal('hide')
                    }
                }
            });
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#tanggal").empty().append('');
        })

        let perusahaan = @json($perusahaan);

        $(document).on('click', '.edit_data_tambah_pesan_produk', function(event) {
            const id = $(event.currentTarget).attr('id-perusahaan-pesan-produk');
            const data_tambah_pesan_produk = daftar_data_tambah_pesan_produk[id]
            $("#modalEditTambahPesanProduk").modal('show');
            $("#formEditTambahPesanProduk [name='id']").val(id)
            $("#formEditTambahPesanProduk [name='tanggal']").val(data_tambah_pesan_produk.tanggal)

            $('#formEditTambahPesanProduk').on('submit', function(e) {
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
                            $("#perusahaan_id").empty().append('');
                            $("#modalEditTambahPesanProduk").modal('hide');
                            swal({
                                    title: "Berhasil",
                                    text: `${data.msg}`,
                                    icon: "success",
                                    successMode: true,
                                }),
                                table_data_tambah_pesan_produk.ajax.reload(null, false);
                        }
                    }
                });
            });
        });


        $(document).on('click', '.hapus_data_tambah_pesan_produk', function(event) {
            const id = $(event.currentTarget).attr('id-perusahaan-pesan-produk');

            swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/admin/hapus-data-pesan-produk/" + id,
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
                                    table_data_tambah_pesan_produk.ajax.reload()
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
