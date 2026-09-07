@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 style="margin: 0;">Dashboard Warga</h2>
    <div>
        <a href="{{ route('customer.pointHistory') }}" class="btn btn-outline">Lihat Riwayat & Tukar Poin</a>
    </div>
</div>

<div class="widget-grid">
    <div class="widget widget-tosca text-center">
        <h3>Saldo Poin Anda</h3>
        <div class="value">{{ auth()->user()->point_balance }}</div>
        <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 0.9rem;">Poin aktif yang bisa ditukarkan</p>
    </div>

    <div class="card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h3 class="card-title" style="border: none; margin-bottom: 1rem;">Ada Sampah Anorganik?</h3>
        <form action="{{ route('customer.requestPickup') }}" method="POST" style="width: 100%;">
            @csrf
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem;">
                Buat Request Penjemputan
            </button>
        </form>
    </div>
</div>

<div class="card">
    <h3 class="card-title">Riwayat Penjemputan Saya</h3>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Poin Didapat</th>
                    <th>Tanggal Request</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td style="color: var(--text-muted);">#{{ $trx->id }}</td>
                    <td>
                        @if($trx->status == 'pending')
                            <span class="badge badge-pending">Menunggu Pengepul</span>
                        @elseif($trx->status == 'accepted')
                            <span class="badge badge-accepted">Diproses</span>
                        @else
                            <span class="badge badge-completed">Selesai</span>
                        @endif
                    </td>
                    <td><strong style="color: var(--accent-tosca);">+{{ $trx->total_points }}</strong></td>
                    <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 2rem; color: var(--text-muted);">Anda belum pernah melakukan request penjemputan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
