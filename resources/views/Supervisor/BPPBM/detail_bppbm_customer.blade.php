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
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="jual-pemasangan-head">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#jual-pemasangan-collabs" aria-expanded="true"
                                            aria-controls="jual-pemasangan-collabs">
                                            Jual/Pemasangan
                                        </button>
                                    </h2>
                                    <div id="jual-pemasangan-collabs" class="accordion-collapse collapse"
                                        aria-labelledby="jual-pemasangan-head">
                                        <div class="accordion-body">
                                            <table id="jual-pemasangan" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Customer</th>
                                                        <th>Kuantitas</th>
                                                        <th>Harga</th>
                                                        <th>Unit</th>
                                                        <th>Foto Bukti</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pemasangan_jual as $data_pemasangan_jual)
                                                        <tr>
                                                            <td>{{ $data_pemasangan_jual->relasi_customer->nama }}</td>
                                                            <td>{{ $data_pemasangan_jual->kuantitas }}</td>
                                                            <td>{{ $data_pemasangan_jual->harga }}</td>
                                                            <td>{{ $data_pemasangan_jual->unit }}</td>
                                                            <td>{{ $data_pemasangan_jual->foto_bukti }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="insentif-program-head">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#insentif-program-collabs" aria-expanded="true"
                                            aria-controls="insentif-program-collabs">
                                            Insentif/Program
                                        </button>
                                    </h2>
                                    <div id="insentif-program-collabs" class="accordion-collapse collapse"
                                        aria-labelledby="insentif-program-head">
                                        <div class="accordion-body">
                                            <table id="insentif-program" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Customer</th>
                                                        <th>Kuantitas</th>
                                                        <th>Harga</th>
                                                        <th>Unit</th>
                                                        <th>Foto Bukti</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($insentif as $data_insentif)
                                                        <tr>
                                                            <td>{{ $data_insentif->relasi_customer->nama }}</td>
                                                            <td>{{ $data_insentif->kuantitas }}</td>
                                                            <td>{{ $data_insentif->harga }}</td>
                                                            <td>{{ $data_insentif->unit }}</td>
                                                            <td>{{ $data_insentif->foto_bukti }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="penarikan-retur-head">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#penarikan-retur-collabs" aria-expanded="true"
                                            aria-controls="penarikan-retur-collabs">
                                            Penarikan Retur
                                        </button>
                                    </h2>
                                    <div id="penarikan-retur-collabs" class="accordion-collapse collapse"
                                        aria-labelledby="penarikan-retur-head">
                                        <div class="accordion-body">
                                            <table id="penarikan-retur" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Customer</th>
                                                        <th>Kuantitas</th>
                                                        <th>Harga</th>
                                                        <th>Unit</th>
                                                        <th>Foto Bukti</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($retur as $data_retur)
                                                        <tr>
                                                            <td>{{ $data_retur->relasi_customer->nama }}</td>
                                                            <td>{{ $data_retur->kuantitas }}</td>
                                                            <td>{{ $data_retur->harga }}</td>
                                                            <td>{{ $data_retur->unit }}</td>
                                                            <td>{{ $data_retur->foto_bukti }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#jual-pemasangan').DataTable();
        $('#insentif-program').DataTable();
        $('#penarikan-retur').DataTable();
    </script>
@endsection
