@extends('Layout.master', ['title' => 'Pembelian Produk'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pembelian Produk/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Pembelian Produk</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.TambahLampiranPesanan') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Kode Pemesanan</label>
                                    <div class="col-4">
                                        <input type="hidden" name="pesan_produk_transaksi_id"
                                            value="{{ $pesanan_produk->kode }}" hidden>
                                        <input type="text" class="form-control" id="inputtext" name="kode_po">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputtext" class="col-sm-2 col-form-label">Lampiran</label>
                                    <div class="col-4">
                                        <input type="file" class="form-control" name="lampiran">
                                    </div>
                                    <div class="col-4">
                                        <button type="submit"
                                            class="btn btn-sm btn-default rounded-pill text-black fw-semibold tambah_isi_elemen">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="buttons">
                                <a id="tombol-tambah-area"
                                    class="btn btn-sm btn-primary rounded-pill text-white fw-semibold tambah_isi_elemen"
                                    href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahDetailPerusahaanPesanProduk"><i
                                        class="fa fa-plus fa-xs"></i>
                                    Tambah Produk
                                </a>
                            </div>
                            <div class="modal fade text-left" id="modalTambahDetailPerusahaanPesanProduk"
                                data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33"
                                aria-hidden="true">>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Produk</h4>
                                            <button type="button" id="batal" class="close batal"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.TambahDataDetailPerusahaanPesanProduk') }}"
                                            id="formTambahDetailPerusahaanPesanProduk" method="POST">
                                            @csrf
                                            <input type="hidden" name="pesan_produk_transaksi_id"
                                                value="{{ $pesanan_produk->id }}" hidden>
                                            <div class="modal-body">
                                                <div class="col-md-12 table-responsive">
                                                    <table class="table" id="table-tambah-produk">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama Produk</th>
                                                                <th scope="col">Jumlah</th>
                                                                <th scope="col" width="50">Catatan</th>
                                                                <th scope="col">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td><input class="form-control" type="text"
                                                                        name="nama_produk[]"
                                                                        placeholder="Masukkan Nama Produk"></td>
                                                                <td><input class="form-control" type="n umber"
                                                                        name="jumlah[]" placeholder="Masukkan Jumlah"></td>
                                                                <td>
                                                                    <textarea name="catatan[]" class="form-control" cols="10" rows="5"
                                                                        placeholder="Masukkan Catatan Tambahan (Jika Ada)"></textarea>
                                                                </td>
                                                                <td><button class="btn btn-sm btn-danger"
                                                                        id="hapus">-</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button"
                                                        class="btn btn-light-secondary batal rounded-pill" id="tambah">
                                                        +
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary batal rounded-pill"
                                                    data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" id="simpan"
                                                    class="btn btn-primary ml-1 rounded-pill">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped" id="table-data-detail-permohonan-pesan-produk">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Catatan</th>
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

    <div class="modal fade text-left" id="modalEditDetailPerusahaanPesanProduk" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Produk Pesanan</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDetailPerusahaanPesanProduk"
                    action="{{ route('admin.UbahDataDetailPerusahaanPesanProduk') }}" method="POST">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <label class="col col-form-label" for="provinsi">Nama Produk</label>
                        <div class="form-group">
                            <input type="text" name="nama_produk" class="form-control" id="exampleInputPassword1"
                                placeholder="Nama produk">
                            <div class="input-group has-validation">
                                <label class="text-danger error-text nama_produk_error"></label>
                            </div>
                        </div>
                        <label class="col col-form-label" for="tipe">Jumlah</label>
                        <div class="form-group">
                            <input type="number" name="jumlah" class="form-control" id="exampleInputPassword1"
                                placeholder="jumlah">
                            <div class="input-group has-validation">
                                <label class="text-danger error-text jumlah_error"></label>
                            </div>
                        </div>
                        <label class="col col-form-label" for="tipe">Catatan</label>
                        <div class="form-group">
                            <textarea name="catatan" class="form-control" cols="10" rows="5" placeholder="Catatan Tambahan"></textarea>
                            <div class="input-group has-validation">
                                <label class="text-danger error-text catatan_error"></label>
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
        $(document).ready(function() {
            let baris = 1
            $(document).on('click', '#tambah', function() {
                baris = baris + 1
                var html = "<tr id='baris'" + baris + ">"
                html += "<td>" + baris + "</td>"
                html +=
                    "<td><input class='form-control' type='text' name='nama_produk[]' placeholder='Masukkan Nama Produk'></td>"
                html +=
                    "<td><input  class='form-control' type='number' name='jumlah[]' placeholder='Masukkan Jumlah'></td>"
                html +=
                    " <td> <textarea name = 'catatan[]' class = 'form-control' cols = '10' rows = '5' placeholder = 'Masukkan Catatan Tambahan (Jika Ada' ></textarea> </td > "
                html += "<td><button class='btn btn-sm btn-danger' data-row='baris'" + baris +
                    " id='hapus'>-</button></td>"
                html += "</tr>"

                $('#table-tambah-produk').append(html)
            })
        })

        $(document).on('click', '#hapus', function() {
            let hapus = $(this).data('row')
            $('#' + hapus).remove()
        })

        let pesanan_produk = @json($pesanan_produk);
        let daftar_data_perusahaan_pesanan_produk = [];
        const table_data_perusahaan_pesanan_produk = $('#table-data-detail-permohonan-pesan-produk').DataTable({
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
                url: "/admin/data-detail-pesan-produk/" + pesanan_produk.id,
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
                        daftar_data_perusahaan_pesanan_produk[row.id] = row;;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perusahaan_pesanan_produk[row.id] = row;;
                        return row.nama_produk;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perusahaan_pesanan_produk[row.id] = row;;
                        return row.jumlah;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_perusahaan_pesanan_produk[row.id] = row;;
                        return row.catatan;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                            <div class="ms-auto">
                                <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_detail_data_perusahaan_pesanan_produk" id-detail-produk-perusahaan-pesan-produk = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0 hapus_detail_data_perusahaan_pesanan_produk" id-detail-produk-perusahaan-pesan-produk = "${row.id}" href="#!"><i class="fa fa-trash-alt me-2"></i>Hapus</a>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_area" id-detail-produk-perusahaan-pesan-produk = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahDetailPerusahaanPesanProduk').on('submit', function(e) {
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
                            table_data_perusahaan_pesanan_produk.ajax.reload(null, false)

                        $("#formTambahDetailPerusahaanPesanProduk")[0].reset();
                        $("#modalTambahDetailPerusahaanPesanProduk").modal('hide')
                    }
                }
            });
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#ubah_perusahaan_id").empty().append('');
        })

        $(document).on('click', '.edit_detail_data_perusahaan_pesanan_produk', function(event) {
            const id = $(event.currentTarget).attr('id-detail-produk-perusahaan-pesan-produk');
            const data_perusahaan_pesanan_produk = daftar_data_perusahaan_pesanan_produk[id]
            $("#modalEditDetailPerusahaanPesanProduk").modal('show');
            $("#formEditDetailPerusahaanPesanProduk [name='id']").val(id)
            $("#formEditDetailPerusahaanPesanProduk [name='nama_produk']").val(data_perusahaan_pesanan_produk
                .nama_produk)
            $("#formEditDetailPerusahaanPesanProduk [name='jumlah']").val(data_perusahaan_pesanan_produk.jumlah)
            $("#formEditDetailPerusahaanPesanProduk [name='catatan']").val(data_perusahaan_pesanan_produk.catatan)

            $.each(perusahaan, function(key, value) {
                $('#ubah_perusahaan_id')
                    .append(
                        `<option value="${value.id}" ${value.id == data_perusahaan_pesanan_produk.perusahaan_id ? 'selected' : ''}>${value.perusahaan}</option>`
                    )
            });

            $('#formEditDetailPerusahaanPesanProduk').on('submit', function(e) {
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
                            $("#modalEditDetailPerusahaanPesanProduk").modal('hide');
                            swal({
                                    title: "Berhasil",
                                    text: `${data.msg}`,
                                    icon: "success",
                                    successMode: true,
                                }),
                                table_data_perusahaan_pesanan_produk.ajax.reload(null, false);
                        }
                    }
                });
            });
        });


        $(document).on('click', '.hapus_detail_data_perusahaan_pesanan_produk', function(event) {
            const id = $(event.currentTarget).attr('id-detail-produk-perusahaan-pesan-produk');
            swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/admin/hapus-data-detail-pesan-produk/" + id,
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
                                    table_data_perusahaan_pesanan_produk.ajax.reload()
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
