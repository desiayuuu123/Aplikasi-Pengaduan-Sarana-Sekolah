@extends('layouts.admin')

@section('content')

<style>
.stat-card {
    border: none;
    border-radius: 12px;
    padding: 20px;
    color: white;
    position: relative;
    overflow: hidden;
    transition: 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
}

/* Soft Gradient Pastel */
.bg-soft-blue {
    background: linear-gradient(to right, #5dade2, #48c9b0);
}

.bg-soft-orange {
    background: linear-gradient(to right, #f5b041, #f8c471);
}

.bg-soft-purple {
    background: linear-gradient(to right, #a569bd, #5dade2);
}

.bg-soft-green {
    background: linear-gradient(to right, #58d68d, #82e0aa);
}

.stat-icon {
    position: absolute;
    right: 20px;
    bottom: 15px;
    font-size: 40px;
    opacity: 0.3;
}
</style>

<div class="row g-3 mb-4 mt-3">

    <div class="col-md-3">
        <div class="stat-card bg-soft-blue shadow-sm">
            <div>Total Siswa</div>
            <h3 class="fw-bold">{{ $totalSiswa ?? 0 }}</h3>
            <div class="stat-icon">🎓</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card bg-soft-orange shadow-sm">
            <div>Total Laporan</div>
            <h3 class="fw-bold">{{ $totalLaporan ?? 0 }}</h3>
            <div class="stat-icon">📋</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card bg-soft-purple shadow-sm">
            <div>Laporan Diproses</div>
            <h3 class="fw-bold">{{ $laporanProses ?? 0 }}</h3>
            <div class="stat-icon">🔄</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card bg-soft-green shadow-sm">
            <div>Laporan Selesai</div>
            <h3 class="fw-bold">{{ $laporanSelesai ?? 0 }}</h3>
            <div class="stat-icon">✅</div>
        </div>
    </div>

</div>

@include('admin.list-laporan')

@endsection