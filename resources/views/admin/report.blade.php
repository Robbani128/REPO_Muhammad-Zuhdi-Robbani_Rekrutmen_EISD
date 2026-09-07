@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 style="margin: 0;">Laporan Tonase Sampah Kota</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Kembali ke Dashboard</a>
</div>

<div class="card">
    <div class="text-center" style="padding: 3rem 0;">
        <h3 style="color: var(--text-muted); font-weight: 500; font-size: 1.25rem;">Total Sampah Anorganik yang Berhasil Didaur Ulang</h3>
        <div style="margin: 2rem 0;">
            <span style="font-size: 6rem; font-weight: 800; color: var(--accent-tosca); line-height: 1;">
                {{ $totalTonase ?? 0 }}
            </span>
            <span style="font-size: 2rem; color: var(--text-muted); font-weight: 600; margin-left: -10px;">Kg</span>
        </div>
        <p style="max-width: 500px; margin: 0 auto;">Pencapaian luar biasa dalam upaya mengurangi dampak lingkungan perkotaan sesuai dengan <strong>Target SDG 11.6</strong>.</p>
    </div>
</div>
@endsection
