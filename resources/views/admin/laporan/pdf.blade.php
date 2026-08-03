<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Laporan Pendapatan</title>

    <style>
        @page {
            margin: 22px;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 10px;
        }

        * {
            box-sizing: border-box;
        }



        .header-table,
        .table-data,
        .summary-table,
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td,
        .info-table td,
        .ttd-table td {
            border: none;
            vertical-align: top;
        }

        .logo {

            width: 70px;

            margin-left: 20px;

        }

        .company {
            text-align: center;
        }

        .company h1 {

            margin: 0;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 25px;

            font-weight: bold;

            letter-spacing: 2px;

            color: #0F3E2E;

            line-height: 1;

        }

        .company p {
            margin: 3px 0;
            font-size: 10px;
            color: #666;
        }

        .line1 {

            border-top: 3px solid #0F3E2E;

            margin-top: 10px;

        }

        .line2 {

            border-top: 1px solid #AFAFAF;

            margin-top: 2px;

            margin-bottom: 18px;

        }

        .title {

            text-align: center;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 18px;

            font-weight: bold;

            color: #0F3E2E;

            letter-spacing: 1px;

            margin-top: 8px;

            margin-bottom: 15px;

        }

        .info-table td {

            padding: 0px 0;

            font-size: 10px;

        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .table-data th {

            background: #CFCFCF;
            color: #222;
            border: 1px solid #7A7A7A;
            padding: 8px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;

        }

        .table-data td {

            border: 1px solid #8E8E8E;
            padding: 7px;
            font-size: 10px;
            vertical-align: middle;

        }

        .table-data tbody tr:nth-child(even) {
            background: #F8F8F8;
        }


        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .summary-table {

            width: 30%;

            margin-top: 18px;

            float: left;

        }

        .summary-table td {

            border: 1px solid #8E8E8E;
            padding: 8px;

        }

        .summary-title {

            background: #D9D9D9;
            font-weight: bold;

        }

        .ttd {

            width: 35%;

            float: right;

            text-align: center;

            margin-top: 10px;

        }

        .qr {

            margin: 10px auto;

            line-height: 70px;

            font-size: 10px;

            color: #777;

        }

        .footer {

            position: fixed;

            bottom: 0;

            left: 0;

            right: 0;

            text-align: center;

            font-size: 9px;

            color: #777;

        }

        .clearfix {
            clear: both;
        }
    </style>

</head>

<body>

    <table class="header-table">

        <tr>

            <td width="70">

                <img src="{{ public_path('images/salon.jpg') }}" class="logo">

            </td>

            <td class="company">

                <h1>SALONQU</h1>



                <p>Jl. Pangeran Dharma Kusuma No.67, Sindang, Indramayu</p>

                <p>Telp. +62 896-1921-1547</p>

            </td>

            <td width="70"></td>

        </tr>

    </table>

    <div class="line1"></div>
    <div class="line2"></div>

    <div class="title">

        LAPORAN PENDAPATAN

    </div>

    <table class="info-table" style="width:100%; margin-top:10px; margin-bottom:5px;">

        <tr>

            <td style="width:50%; text-align:left; vertical-align:top;">

                <strong>Periode</strong><br>

                {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }}

                s/d

                {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}

            </td>

            <td style="width:50%; text-align:right; vertical-align:top;">

                <strong>Tanggal Cetak</strong><br>

                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

            </td>

        </tr>

    </table>



    <table class="table-data">

        <thead>

            <tr>

                <th width="5%">No</th>

                <th width="12%">Tanggal</th>

                <th width="15%">Kode Booking</th>

                <th width="17%">Pelanggan</th>

                <th width="28%">Layanan</th>

                <th width="13%">Terapis</th>

                <th width="10%">Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach($booking as $item)

                <tr>

                    <td class="center">{{ $loop->iteration }}</td>

                    <td class="center">

                        {{ \Carbon\Carbon::parse($item->tgl_booking)->format('d-m-Y') }}

                    </td>

                    <td>{{ $item->kd_booking }}</td>

                    <td>{{ $item->user->username }}</td>

                    <td>

                        {{ $item->layanan->pluck('nama_layanan')->implode(', ') }}

                    </td>

                    <td>

                        {{ $item->terapis->nama_terapis }}

                    </td>

                    <td class="right">

                        Rp{{ number_format($item->jumlah_dibayar, 0, ',', '.') }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>


    {{-- Ringkasan --}}
    <table class="summary-table">

        <tr>

            <td class="summary-title" width="65%">
                Jumlah Transaksi
            </td>

            <td class="center">
                {{ $totalBooking }}
            </td>

        </tr>

        <tr>

            <td class="summary-title">
                Total Pendapatan
            </td>

            <td class="right">

                <strong>

                    Rp{{ number_format($totalPendapatan, 0, ',', '.') }}

                </strong>

            </td>

        </tr>

    </table>

    {{-- Tanda Tangan --}}
    <div class="ttd">

        Indramayu,

        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

        <br>

        <strong>

            Disusun dan Dicetak Oleh

        </strong>

        <div class="qr">

            <img src="{{ public_path('images/ttd.png') }}" width="80" height="80">

        </div>



    </div>
    </div>

    <div class="clearfix"></div>

    <div class="footer">

        Laporan Pendapatan • SalonQu

    </div>

</body>

</html>
</body>
