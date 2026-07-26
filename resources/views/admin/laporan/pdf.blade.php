<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            margin: 0;
            text-align: center;
        }

        h4 {
            margin: 5px 0 20px;
            text-align: center;
            font-weight: normal;
        }

        .periode {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        table th {
            background: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <h2>SALONQU</h2>
    <h4>LAPORAN PENDAPATAN</h4>

    <div class="periode">

        <strong>Periode :</strong>

        {{ request('tanggal_awal') ?? '-' }}
        s/d
        {{ request('tanggal_akhir') ?? '-' }}

    </div>

    <table>

        <thead>

            <tr>

                <th width="40">No</th>
                <th width="90">Tanggal</th>
                <th width="110">Kode Booking</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th width="90">Terapis</th>
                <th width="100">Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach($booking as $item)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tgl_booking)->format('d-m-Y') }}
                    </td>

                    <td>{{ $item->kd_booking }}</td>

                    <td>{{ $item->user->username ?? '-' }}</td>

                    <td>
                        {{ $item->layanan->pluck('nama_layanan')->implode(', ') }}
                    </td>

                    <td>
                        {{ $item->terapis->nama_terapis ?? '-' }}
                    </td>

                    <td>
                        Rp{{ number_format($item->jumlah_dibayar, 0, ',', '.') }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="footer">

        <p>
            <strong>Jumlah Transaksi :</strong>
            {{ $totalBooking }}
        </p>

        <p>
            <strong>Total Pendapatan :</strong>
            Rp{{ number_format($totalPendapatan, 0, ',', '.') }}
        </p>

    </div>

    <div style="
    position:fixed;
    bottom:15px;
    left:0;
    right:0;
    text-align:center;
    font-size:10px;
    color:#666;
">

        Laporan Pendapatan • SalonQu

    </div>
</body>

</html>