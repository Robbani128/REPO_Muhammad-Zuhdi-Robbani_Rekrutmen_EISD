@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 style="margin: 0;">Dashboard Pengepul (Merchant)</h2>
</div>

<div class="widget-grid">
    <div class="card" style="margin-bottom: 0;">
        <h3 class="card-title">Tugas Saya (Diterima)</h3>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Warga</th>
                        <th>Waktu Diterima</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myTasks as $task)
                    <tr>
                        <td style="color: var(--text-muted);">#{{ $task->id }}</td>
                        <td><strong>{{ $task->customer->name }}</strong></td>
                        <td>{{ $task->updated_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('merchant.weighing', $task->id) }}" class="btn btn-tosca" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Input Timbangan & Selesaikan</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center" style="padding: 2rem; color: var(--text-muted);">Tidak ada tugas penjemputan yang sedang dikerjakan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card" style="margin-bottom: 0;">
        <h3 class="card-title">Request Masuk</h3>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Warga</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingRequests as $req)
                    <tr>
                        <td style="color: var(--text-muted);">#{{ $req->id }}</td>
                        <td><strong>{{ $req->customer->name }}</strong></td>
                        <td>{{ $req->created_at->diffForHumans() }}</td>
                        <td>
                            <form action="{{ route('merchant.acceptPickup', $req->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Terima Tugas</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center" style="padding: 2rem; color: var(--text-muted);">Tidak ada request penjemputan saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
