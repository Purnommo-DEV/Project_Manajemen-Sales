<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $data_customer->nama }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container mt-4">

        <div class="card">
            <div class="card-header">
                {{-- <h2>Simple QR Code</h2> --}}
            </div>
            <div class="d-flex justify-content-center card-body">
                <button class="btn btn-link" onclick="window.print()">{!! QrCode::size(300)->generate($data_customer->barcode) !!}</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td scope="row"><b>Kode Customer</b></td>
                                    <td scope="row">:</td>
                                    <td scope="row">{{ $data_customer->kode }}</td>
                                </tr>
                                <tr>
                                    <td scope="row"><b>Nama Customer</b></td>
                                    <td scope="row">:</td>
                                    <td scope="row">{{ $data_customer->nama }}</td>
                                </tr>
                                <tr>
                                    <td scope="row"><b>Alamat</b></td>
                                    <td scope="row">:</td>
                                    <td scope="row">{{ $data_customer->alamat }}</td>
                                </tr>
                                <tr>
                                    <td scope="row"><b>Nomor HP</b></td>
                                    <td scope="row">:</td>
                                    <td scope="row">{{ $data_customer->nomor_hp }}</td>
                                </tr>
                                <tr>
                                    <td scope="row"><b>Jenis Customer</b></td>
                                    <td scope="row">:</td>
                                    <td scope="row">
                                        @if ($data_customer->jenis_customer == 'r')
                                            Retail
                                        @elseif($data_customer->jenis_customer == 'w')
                                            Wholesale
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>

    </div>
</body>

</html>
