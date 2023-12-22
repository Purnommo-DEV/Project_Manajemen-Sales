<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan BPPBM</title>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center">BON PENGAMBILAN DAN PENGEMBALIAN BARANG ATAU MATERIAL (BPPBM)
                            </h4>
                            <table width="100%" border="1" cellspacing=0 cellpadding=5>
                                <tbody>
                                    <tr>
                                        <td>Kode Sales</td>
                                        <td>:&nbsp;{{ $perjalanan->relasi_sales->kode }}</td>
                                        <td>Kode Teritory</td>
                                        <td>:</td>
                                    </tr>
                                    <tr>
                                        <td>Hari/Tgl</td>
                                        <td>:&nbsp;{{ Carbon\Carbon::parse($perjalanan->created_at)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                        </td>
                                        <td>Week</td>
                                        <td>:</td>
                                    </tr>
                                    <tr>
                                        <td>No. Pol.</td>
                                        <td>:&nbsp;{{ $perjalanan->relasi_kendaraan->plat }}</td>
                                        <td>Kilometer Awal</td>
                                        <td>:&nbsp;{{ $perjalanan->km_awal }}</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>Kilometer Akhir</td>
                                        <td>:&nbsp;{{ $perjalanan->km_akhir }}</td>
                                    </tr>
                                </tbody>
                            </table><br>
                            <table width="100%" border="1" cellspacing=0 cellpadding=5>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Item</th>
                                        <th>Pengambilan</th>
                                        <th>Jual/Pemasangan</th>
                                        <th>Insentif/Program</th>
                                        <th>Penarikan Retur</th>
                                        <th>Pengembalian</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bppbm as $i => $data_bppbm)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $data_bppbm->relasi_produk->nama_produk }}</td>
                                            <td>{{ $data_bppbm->pengambilan }}</td>
                                            <td>{{ $data_bppbm->pemasangan_jual }}</td>
                                            <td>{{ $data_bppbm->insentif_program }}</td>
                                            <td>{{ $data_bppbm->penarikan_retur }}</td>
                                            <td>{{ $data_bppbm->pengembalian }}</td>
                                            <td>{{ $data_bppbm->remark }}</td>
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
</body>

</html>
