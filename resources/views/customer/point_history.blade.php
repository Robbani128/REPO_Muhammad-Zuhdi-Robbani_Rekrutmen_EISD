@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 style="margin: 0;">Riwayat & Tukar Poin</h2>
    <a href="{{ route('customer.dashboard') }}" class="btn btn-outline">Kembali ke Dashboard</a>
</div>

<div class="widget-grid">
    <div class="card" style="margin-bottom: 0;">
        <h3 class="card-title">Tukar Poin Anda</h3>
        <div style="background-color: #F1F5F9; padding: 1rem; border-radius: var(--radius); margin-bottom: 1.5rem;">
            <span style="color: var(--text-muted); font-size: 0.9rem;">Saldo Saat Ini</span>
            <h3 style="color: var(--accent-tosca); font-size: 2rem; margin: 0;">{{ $user->point_balance }} Poin</h3>
        </div>

        <form action="{{ route('customer.redeemPoints') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Jumlah Poin yang Ditukar</label>
                <input type="number" name="amount" min="1" max="{{ $user->point_balance }}" class="form-control" placeholder="Contoh: 100" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Tukar Poin</button>
        </form>
    </div>

    <div class="card" style="margin-bottom: 0;">
        <h3 class="card-title">Log Penambahan Poin</h3>
        <div class="table-container" style="max-height: 350px; overflow-y: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Transaksi</th>
                        <th>Poin Didapat</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td style="color: var(--text-muted);">#{{ $trx->id }}</td>
                        <td><strong style="color: var(--accent-tosca);">+{{ $trx->total_points }}</strong></td>
                        <td>{{ $trx->updated_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center" style="padding: 2rem; color: var(--text-muted);">Belum ada riwayat poin.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
