@extends('Layout.master', ['title' => 'Data Pengguna'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Data Area/</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Area</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.ProsesUbahDataArea', $data_area->kode) }}" id="formUbahArea"
                                method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label class="col col-form-label" for="provinsi">Provinsi</label>
                                        <div class="col-md-9">
                                            @php
                                                $provinces = new App\Http\Controllers\Admin\WilayahIndonesiaController();
                                                $provinces = $provinces->provinsi();
                                            @endphp
                                            <select class="form-control" name="provinsi_id" id="provinsi" required>
                                                <option value="{{ $data_area->relasi_provinsi->id }}" hidden>
                                                    {{ $data_area->relasi_provinsi->name }}</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->id ?? '' }}">
                                                        {{ $item->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col col-form-label" for="kota">Kabupaten /
                                            Kota</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="kota_id" id="kota" required>
                                                <option value="{{ $data_area->relasi_kota->id }}" hidden>
                                                    {{ $data_area->relasi_kota->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col col-form-label" for="kecamatan">Kecamatan</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="kecamatan_id" id="kecamatan" required>

                                                <option value="{{ $data_area->relasi_kecamatan->id }}" hidden>
                                                    {{ $data_area->relasi_kecamatan->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col col-form-label" for="desa">Desa</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="desa_id" id="desa" required>

                                                <option value="{{ $data_area->relasi_desa->id }}" hidden>
                                                    {{ $data_area->relasi_desa->name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin.HalamanArea') }}" class="btn btn-light-secondary">
                                            Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(":submit").attr("disabled", true);

        function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function() {
            $('#provinsi').on('change', function() {
                onChangeSelect('{{ route('admin.Kota') }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function() {
                onChangeSelect('{{ route('admin.Kecamatan') }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function() {
                onChangeSelect('{{ route('admin.Desa') }}', $(this).val(), 'desa');
                $(":submit").removeAttr("disabled");
            })
        });

        $('#formUbahArea').on('submit', function(e) {
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
                            setTimeout(function() {
                                window.location.href = `${data.route}`;
                            }, 1000);
                    }
                }
            });
        });
    </script>
@endsection
