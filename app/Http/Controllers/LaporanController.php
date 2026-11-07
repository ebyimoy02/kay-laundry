<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\PaketLaundry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Menentukan tanggal berdasarkan pilihan periode.
     */
    private function getPeriode(Request $request)
    {
        $periode = $request->query('periode', 'bulanan');

        $tanggalMulai = null;
        $tanggalSelesai = null;

        switch ($periode) {
            case 'semua':
                break;

            case 'mingguan':
                $tanggalAcuan = $request->query(
                    'tanggal_acuan',
                    now()->toDateString()
                );

                $tanggal = Carbon::createFromFormat(
                    'Y-m-d',
                    $tanggalAcuan
                );

                $tanggalMulai = $tanggal->copy()
                    ->startOfWeek(Carbon::MONDAY)
                    ->toDateString();

                $tanggalSelesai = $tanggal->copy()
                    ->endOfWeek(Carbon::SUNDAY)
                    ->toDateString();

                break;

            case 'bulanan':
                $bulan = $request->query(
                    'bulan',
                    now()->format('Y-m')
                );

                $tanggal = Carbon::createFromFormat('Y-m', $bulan);

                $tanggalMulai = $tanggal->copy()
                    ->startOfMonth()
                    ->toDateString();

                $tanggalSelesai = $tanggal->copy()
                    ->endOfMonth()
                    ->toDateString();

                break;

            case 'tahunan':
                $tahun = $request->query('tahun', now()->year);

                $tanggal = Carbon::createFromFormat(
                    'Y',
                    (string) $tahun
                );

                $tanggalMulai = $tanggal->copy()
                    ->startOfYear()
                    ->toDateString();

                $tanggalSelesai = $tanggal->copy()
                    ->endOfYear()
                    ->toDateString();

                break;

            case 'rentang':
                $tanggalMulai = $request->query('tanggal_mulai');
                $tanggalSelesai = $request->query('tanggal_selesai');

                break;

            default:
                $periode = 'bulanan';

                $tanggal = now();

                $tanggalMulai = $tanggal->copy()
                    ->startOfMonth()
                    ->toDateString();

                $tanggalSelesai = $tanggal->copy()
                    ->endOfMonth()
                    ->toDateString();

                break;
        }

        return [
            'periode' => $periode,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'tanggalAcuan' => $request->query('tanggal_acuan', now()->toDateString()),
            'bulan' => $request->query('bulan', now()->format('Y-m')),
            'tahun' => $request->query('tahun', now()->year),
        ];
    }

    /**
     * Membuat query laporan berdasarkan periode dan pencarian.
     */
    private function queryLaporan(Request $request)
    {
        $filter = $this->getPeriode($request);

        $keyword = trim($request->query('q', ''));

        $query = Transaksi::with([
            'pelanggan',
            'detailTransaksi.paket',
        ])->orderBy('tgl_masuk', 'desc');

        if ($filter['tanggalMulai']) {
            $query->whereDate(
                'tgl_masuk',
                '>=',
                $filter['tanggalMulai']
            );
        }

        if ($filter['tanggalSelesai']) {
            $query->whereDate(
                'tgl_masuk',
                '<=',
                $filter['tanggalSelesai']
            );
        }

        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('pelanggan', function ($pelangganQuery) use ($keyword) {
                    $pelangganQuery->where(
                        'nama',
                        'like',
                        '%' . $keyword . '%'
                    );
                })->orWhereHas('detailTransaksi.paket', function ($paketQuery) use ($keyword) {
                    $paketQuery->where(
                        'nama_paket',
                        'like',
                        '%' . $keyword . '%'
                    );
                });
            });
        }

        return $query;
    }

    public function index(Request $request)
    {
        $filter = $this->getPeriode($request);

        $query = $this->queryLaporan($request);

        $totalTransaksi = (clone $query)->count();
        $totalPendapatan = (clone $query)->sum('total');

        $transaksi = $query->paginate(10)->withQueryString();

        $totalPelanggan = Pelanggan::count();
        $totalPaket = PaketLaundry::count();

        return view('laporan.index', array_merge(
            compact(
                'transaksi',
                'totalTransaksi',
                'totalPendapatan',
                'totalPelanggan',
                'totalPaket'
            ),
            $filter,
            [
                'keyword' => trim($request->query('q', '')),
            ]
        ));
    }

    /**
     * Mengunduh laporan dalam format PDF.
     */
    public function exportPdf(Request $request)
    {
        $filter = $this->getPeriode($request);

        $query = $this->queryLaporan($request);

        // Ambil seluruh data sesuai filter.
        $transaksi = $query->get();

        $totalPendapatan = (clone $query)->sum('total');

        $pdf = Pdf::loadView('laporan.pdf', array_merge(
            compact('transaksi', 'totalPendapatan'),
            $filter
        ))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-kay-laundry.pdf');
    }

    /**
     * Menampilkan laporan untuk dicetak melalui browser.
     */
    public function cetak(Request $request)
    {
        $filter = $this->getPeriode($request);

        $query = $this->queryLaporan($request);

        // Ambil seluruh data sesuai filter dan pencarian.
        $transaksi = $query->get();

        $totalPendapatan = (clone $query)->sum('total');

        return view('laporan.cetak', array_merge(
            compact('transaksi', 'totalPendapatan'),
            $filter,
            [
                'keyword' => trim($request->query('q', '')),
            ]
        ));
    }
}