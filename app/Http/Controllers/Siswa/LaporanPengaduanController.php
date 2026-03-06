<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use App\Models\LaporanPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('siswa.laporan.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
       'kategori_id' => 'required|exists:kategoris,id',
       'ket'         => 'required|string',
       'lokasi'      => 'required|string|max:255'
    ]);

    LaporanPengaduan::create([
       'siswa_id'    => Auth::guard('siswa')->user()->id,
       'kategori_id' => $request->kategori_id,
       'ket'         => $request->ket,
       'lokasi'      => $request->lokasi,
    ]);

    return redirect()
       ->route('siswa.dashboard')
       ->with('success', 'Laporan berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanPengaduan $laporan)
    {
       $laporan->load(['siswa', 'aspirasi', 'kategori']);

       return view('siswa.laporan.show', [
        'laporan' => $laporan
       ]);
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
    public function update(Request $request, LaporanPengaduan $laporanPengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPengaduan $laporan)
    {
        $laporan->delete();

        return redirect()
         ->route('siswa.dashboard')
         ->with('success', 'Laporan berhasil dihapus');
    }

    public function feedback(Request $request, Aspirasi $aspirasi)
    {
    $request->validate([
        'feedback' => 'required|integer|min:1|max:5',
    ]);

    $aspirasi->update($request->all());

    return redirect()
        ->route('siswa.dashboard')
        ->with('success', 'Terima kasih atas feedback Anda.');
    }
}
