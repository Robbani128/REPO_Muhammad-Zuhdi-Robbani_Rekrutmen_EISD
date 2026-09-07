@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 style="margin: 0;">Dashboard Admin (Dinas)</h2>
    <div>
        <a href="{{ route('admin.categories') }}" class="btn btn-outline" style="margin-right: 10px;">Kelola Kategori Sampah</a>
        <a href="{{ route('admin.report') }}" class="btn btn-primary">Pantau Laporan</a>
    </div>
</div>

<div class="card">
    <h3 class="card-title">Validasi Akun Pengepul Baru</h3>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Pengepul</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingMerchants as $merchant)
                <tr>
                    <td><strong>{{ $merchant->name }}</strong></td>
                    <td>{{ $merchant->email }}</td>
                    <td><span class="badge badge-pending">Menunggu Validasi</span></td>
                    <td>
                        <form action="{{ route('admin.validateMerchant', $merchant->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-tosca" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Validasi Akun</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 2rem; color: var(--text-muted);">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px; opacity: 0.5;">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <br>
                        Semua pengepul sudah tervalidasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
