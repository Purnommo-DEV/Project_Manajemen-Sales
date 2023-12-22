@extends('Layout.master', ['title' => 'Keuangan'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Data Transaksi/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Transaksi Pengeluaran dan Pemasukkan</h6>
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
                                    href="#" data-bs-toggle="modal" data-bs-target="#modalTambahCttKeuangan"><i
                                        class="fa fa-plus fa-xs"></i> Tambah Catatan Transaksi
                                </a>
                            </div>
                            <div class="modal fade text-left" id="modalTambahCttKeuangan" data-bs-backdrop="static"
                                data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Catatan Transaksi</h4>
                                            <button type="button" class="close batal" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.TambahDataCttKeuangan') }}" id="formTambahCttKeuangan"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <label>Tanggal</label>
                                                <div class="form-group">
                                                    <input type="datetime-local" name="tanggal" placeholder="Tanggal"
                                                        class="form-control rounded-5">
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text tanggal_error"></label>
                                                    </div>
                                                </div>
                                                <label>Jenis</label>
                                                <div class="form-group">
                                                    <select name="jenis_id" class="form-control rounded-5">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        @php
                                                            $jenis_transaksi = \App\Models\JenisTransaksi::get();
                                                        @endphp
                                                        @foreach ($jenis_transaksi as $data_jenis_transaksi)
                                                            <option value="{{ $data_jenis_transaksi->id }}">
                                                                {{ $data_jenis_transaksi->jenis }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text jenis_id_error"></label>
                                                    </div>
                                                </div>
                                                <label>Kategori</label>
                                                <div class="form-group">
                                                    <select name="kategori_id" class="form-control rounded-5">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        @php
                                                            $kategori_transaksi = \App\Models\KategoriCatatanKeuangan::get();
                                                        @endphp
                                                        @foreach ($kategori_transaksi as $data_kategori_transaksi)
                                                            <option value="{{ $data_kategori_transaksi->id }}">
                                                                {{ $data_kategori_transaksi->kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text kategori_id_error"></label>
                                                    </div>
                                                </div>
                                                <label>Nominal</label>
                                                <div class="form-group">
                                                    <input type="text" id="nominal_id" class="form-control rounded-5"
                                                        name="nominal">
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text nominal_error"></label>
                                                    </div>
                                                </div>
                                                <label>Keterangan</label>
                                                <div class="form-group">
                                                    <textarea name="keterangan" class="form-control rounded-5"></textarea>
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text keterangan_error"></label>
                                                    </div>
                                                </div>
                                                <label>Foto Bukti</label>
                                                <div class="form-group">
                                                    <input type="file" class="form-control rounded-5" name="foto_bukti">
                                                    <div class="input-group has-validation">
                                                        <label class="text-danger error-text foto_bukti_error"></label>
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
                            <div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-md-2 mb-4">
                                        <fieldset class="form-group">
                                            <input type="text" id="tgl" name="daterange"
                                                class="form-control rounded-5">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <button class="btn btn-sm btn-primary filter">Filter</button>
                                    </div>
                                </div>
                                <table class="table table-striped" id="table-data-catatan-keuangan">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Pemasukkan</th>
                                            <th>Pengeluaran</th>
                                            <th>Foto Bukti</th>
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
        <div class="modal fade text-left" id="modalEditCttKeuangan" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="myModalLabel33" aria-hidden="true">>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Ubah Data Customer</h4>
                        <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="formEditCttKeuangan" action="{{ route('admin.UbahDataCttKeuangan') }}" method="POST">
                        <input type="hidden" name="id" hidden>
                        @csrf
                        <div class="modal-body">
                            <label>Tanggal</label>
                            <div class="form-group">
                                <input type="datetime-local" name="tanggal" placeholder="Tanggal"
                                    class="form-control rounded-5">
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text tanggal_error"></label>
                                </div>
                            </div>
                            <label>Jenis</label>
                            <div class="form-group">
                                <select name="jenis_id" class="form-control rounded-5" id="jenis_edit_id">
                                </select>
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text jenis_id_error"></label>
                                </div>
                            </div>
                            <label>Kategori</label>
                            <div class="form-group">
                                <select name="kategori_id" class="form-control rounded-5" id="kategori_edit_id">
                                </select>
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text kategori_id_error"></label>
                                </div>
                            </div>
                            <label>Nominal</label>
                            <div class="form-group">
                                <input type="text" id="nominal_edit_id" class="form-control rounded-5"
                                    name="nominal">
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text nominal_error"></label>
                                </div>
                            </div>
                            <label>Keterangan</label>
                            <div class="form-group">
                                <textarea name="keterangan" class="form-control rounded-5"></textarea>
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text keterangan_error"></label>
                                </div>
                            </div>
                            <label>Foto Bukti</label>
                            <div class="form-group">
                                <input type="file" class="form-control rounded-5" name="foto_bukti">
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text foto_bukti_error"></label>
                                </div>
                            </div>
                            <label>Foto Bukti Sebelumnya</label>
                            <div class="form-group">
                                <img src="" id="foto_bukti_edit" width="300">
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

        {{-- MODAL BARCODE --}}
        <div class="modal fade text-left" id="modalTampilBarcode" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Barcode Customer</h4>
                        <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="formTampilBarcode" action="#">
                        <input type="hidden" name="id" hidden>
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                {{-- <img src="" alt=""> --}}
                                <div id="barcode"></div>
                                {{-- <input type="text" id="barcode" name="barcode" placeholder="Nama"
                                class="form-control rounded-5"> --}}
                                <div class="input-group has-validation">
                                    <label class="text-danger error-text nama_error"></label>
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
            let daftar_data_catatan_keuangan = [];
            $('input[name="daterange"]').daterangepicker({
                startDate: moment().subtract(1, 'M'),
                endDate: moment()
            });

            const table_data_catatan_keuangan = $('#table-data-catatan-keuangan').DataTable({
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
                "searching": false,
                "responsive": false,
                "sScrollX": '100%',
                "sScrollXInner": "100%",
                ajax: {
                    url: "{{ route('admin.DataCttKeuangan') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.tgl_awal = $('input[name="daterange"]').data('daterangepicker').startDate.format(
                            'DD-MM-YYYY');
                        d.tgl_akhir = $('input[name="daterange"]').data('daterangepicker').endDate.format(
                            'DD-MM-YYYY');
                        return d
                    }
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
                            daftar_data_catatan_keuangan[row.id] = row;
                            return meta.row + 1;
                        }
                    },
                    {
                        "targets": 1,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_catatan_keuangan[row.id] = row;
                            return moment(row.tanggal).format('DD-MM-YYYY');
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_catatan_keuangan[row.id] = row;
                            return row.relasi_kategori_transaksi.kategori;
                        }
                    },
                    {
                        "targets": 3,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_catatan_keuangan[row.id] = row;
                            return row.keterangan;
                        }
                    },
                    {
                        "targets": 4,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_catatan_keuangan[row.id] = row;
                            //Pemasukkan
                            if (row.jenis_id === 1) {
                                return $.fn.dataTable.render.number('.', ',', 2, 'Rp ').display(row.nominal);
                            } else {
                                return '-'
                            }
                        }
                    },
                    {
                        "targets": 5,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_catatan_keuangan[row.id] = row;
                            //Pengeluaran
                            if (row.jenis_id === 2) {
                                return $.fn.dataTable.render.number('.', ',', 2, 'Rp ').display(row.nominal);
                            } else {
                                return '-'
                            }
                        }
                    },
                    {
                        "targets": 6,
                        "class": "text-wrap text-center",
                        "render": function(data, type, row, meta) {
                            daftar_data_catatan_keuangan[row.id] = row;
                            return `<img src="/storage/foto_bukti/${row.foto_bukti}" width="100">`
                        }
                    },
                    {
                        "targets": 7,
                        "class": "text-nowrap text-center",
                        "render": function(data, type, row, meta) {
                            let tampilan;
                            tampilan = `
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark px-3 mb-0 edit_data_ctt_keuangan" id-data-customer = "${row.id}" href="#!"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0 hapus_data_ctt_keuangan" id-data-customer = "${row.id}" href="#!"><i class="far fa-trash-alt me-2"></i>Hapus</a>
                                </div>
                                `
                            return tampilan;
                        }
                    },
                ],
            });

            $(".filter").click(function() {
                table_data_catatan_keuangan.ajax.reload();
            });

            $('#formTambahCttKeuangan').on('submit', function(e) {
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
                                table_data_catatan_keuangan.ajax.reload(null, false)

                            $("#formTambahCttKeuangan")[0].reset();
                            $("#modalTambahCttKeuangan").modal('hide')
                        }
                    }
                });
            });

            var nominalId = document.getElementById('nominal_id');
            nominalId.addEventListener('keyup', function(e) {
                nominalId.value = formatRupiah(this.value, 'Rp. ');
            });

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            $('.batal').on('click', function() {
                $(document).find('label.error-text').text('');
                $("#jenis_edit_id").empty().append('');
                $("#kategori_edit_id").empty().append('');
            })

            var nominal_edit = document.getElementById('nominal_edit_id');
            nominal_edit.addEventListener('keyup', function(e) {
                nominal_edit.value = formatRupiah(this.value, 'Rp. ');
            });

            let jenis = @json($jenis);
            let kategori = @json($kategori);

            $(document).on('click', '.edit_data_ctt_keuangan', function(event) {
                const id = $(event.currentTarget).attr('id-data-customer');
                const data_ctt_keuangan = daftar_data_catatan_keuangan[id]
                const img = '/storage/foto_bukti/' + data_ctt_keuangan.foto_bukti

                $("#modalEditCttKeuangan").modal('show');
                $("#formEditCttKeuangan [name='id']").val(id)
                $("#formEditCttKeuangan [name='tanggal']").val(data_ctt_keuangan.tanggal)
                $("#formEditCttKeuangan [name='keterangan']").val(data_ctt_keuangan.keterangan)
                $("#foto_bukti_edit").attr('src', img)
                $("#formEditCttKeuangan [name='nominal']").val(data_ctt_keuangan.nominal).toString()
                    .replace(
                        /(\d)(?=(\d{3})+(?!\d))/g,
                        "Rp.");

                $.each(jenis, function(key, value) {
                    $('#jenis_edit_id')
                        .append(
                            `<option value="${value.id}" ${value.id == data_ctt_keuangan.jenis_id ? 'selected' : ''}>${value.jenis}</option>`
                        )
                });

                $.each(kategori, function(key, value) {
                    $('#kategori_edit_id')
                        .append(
                            `<option value="${value.id}" ${value.id == data_ctt_keuangan.kategori_id ? 'selected' : ''}>${value.kategori}</option>`
                        )
                });

                $('#formEditCttKeuangan').on('submit', function(e) {
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
                                $("#modalEditCttKeuangan").modal('hide');
                                swal({
                                        title: "Berhasil",
                                        text: `${data.msg}`,
                                        icon: "success",
                                        successMode: true,
                                    }),
                                    table_data_catatan_keuangan.ajax.reload(null, false);
                            }
                        }
                    });
                });
            });

            $(document).on('click', '.hapus_data_ctt_keuangan', function(event) {
                const id = $(event.currentTarget).attr('id-data-customer');

                swal({
                    title: "Yakin ?",
                    text: "Menghapus Data ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {

                    if (willDelete) {
                        $.ajax({
                            url: "/admin/hapus-data-customer/" + id,
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
                                        table_data_catatan_keuangan.ajax.reload()
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
