<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPengaduan;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanAspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LaporanPengaduan::with(['kategori', 'aspirasi'])
            ->latest();

        if ($request->filled('status')) {

            if ($request->status === 'belum') {
                $query->where(function ($q) {
                    $q->whereDoesntHave('aspirasi')
                      ->orWhereHas('aspirasi', function ($sub) {
                          $sub->where('status', 'menunggu');
                      });
                });
            } else {
                $query->whereHas('aspirasi', function ($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }
        }

        $laporan = $query->paginate(10)->withQueryString();

        $kepuasan = [
            1 => 'Tidak Puas',
            2 => 'Kurang Puas',
            3 => 'Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas',
        ];
        $laporan->getCollection()->transform(function ($item) use ($kepuasan) {

            $item->status = $item->aspirasi?->status ?? 'Belum diproses';

            $nilai = $item->aspirasi?->feedback ?? null;

            $item->feedback = $nilai
                ? ($kepuasan[$nilai] ?? '-')
                : 'Belum ada feedback';

            return $item;
        });

        return view('admin.laporan.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanPengaduan $laporan)
    {
        $laporan->load(['kategori', 'aspirasi']);

        $kepuasan = [
            1 => 'Tidak Puas',
            2 => 'Kurang Puas',
            3 => 'Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas',
        ];

        if ($laporan->aspirasi?->feedback) {
            $laporan->feedback =
                $kepuasan[$laporan->aspirasi->feedback] ?? '-';
        } else {
            $laporan->feedback = 'Belum ada feedback';
        }

        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanPengaduan $laporanPengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanPengaduan $laporan)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai',
        ]);

        Aspirasi::updateOrCreate(
            [
                'laporan_id' => $laporan->id,
            ],
            [
                'admin_id' => Auth::guard('admin')->id(),
                'status'   => $request->status,
            ]
        );

        return redirect()
            ->route('admin.laporan.show', $laporan->id)
            ->with('success', 'Status aspirasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPengaduan $laporanPengaduan)
    {
        //
    }
}
