<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kay Laundry</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 24px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #233750;
        }

        h1 {
            margin: 0 0 6px;
            color: #0b2553;
            font-size: 22px;
        }

        .periode {
            margin-bottom: 18px;
            color: #526581;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th {
            padding: 9px 6px;
            border: 1px solid #dfe4ec;
            background-color: #f0f4f8;
            color: #0b2553;
            text-align: left;
        }

        td {
            padding: 8px 6px;
            border: 1px solid #dfe4ec;
            vertical-align: top;
            overflow-wrap: break-word;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .detail div {
            margin-bottom: 4px;
        }

        .total {
            margin-top: 16px;
            text-align: right;
            color: #0b2553;
            font-size: 14px;
            font-weight: bold;
        }

        .kosong {
            padding: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Kay Laundry</h1>

<div class="periode">
    Periode:

    @if ($periode === 'semua')
        Semua data

    @elseif ($periode === 'mingguan')
        Minggu
        {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }}
        sampai
        {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }}

    @elseif ($periode === 'bulanan')
        {{ \Carbon\Carbon::parse($tanggalMulai)->translatedFormat('F Y') }}

    @elseif ($periode === 'tahunan')
        Tahun {{ $tahun }}

    @elseif ($periode === 'rentang')
        {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }}
        sampai
        {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }}
    @endif
</div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;" class="center">No</th>
                <th style="width: 11%;">Tanggal</th>
                <th style="width: 16%;">Pelanggan</th>
                <th style="width: 20%;">Paket</th>
                <th style="width: 13%;">Jumlah</th>
                <th style="width: 14%;">Harga</th>
                <th style="width: 21%;">Total</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksi as $index => $item)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>

                    <td>
                        {{ $item->tgl_masuk
                            ? \Carbon\Carbon::parse($item->tgl_masuk)->format('d/m/Y')
                            : '-' }}
                    </td>

                    <td>{{ $item->pelanggan->nama ?? '-' }}</td>

                    <td class="detail">
                        @forelse ($item->detailTransaksi as $detail)
                            <div>{{ $detail->paket->nama_paket ?? '-' }}</div>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td class="detail">
                        @forelse ($item->detailTransaksi as $detail)
                            <div>
                                {{ number_format((float) $detail->berat, 2, ',', '.') }}
                                {{ $detail->paket->satuan ?? '' }}
                            </div>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td class="detail">
                        @forelse ($item->detailTransaksi as $detail)
                            <div>
                                Rp {{ number_format((float) $detail->harga, 0, ',', '.') }}
                            </div>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td>
                        <strong>
                            Rp {{ number_format((float) $item->total, 0, ',', '.') }}
                        </strong>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="kosong">
                        Belum ada data transaksi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Pendapatan:
        Rp {{ number_format((float) $totalPendapatan, 0, ',', '.') }}
    </div>
</body>
</html>