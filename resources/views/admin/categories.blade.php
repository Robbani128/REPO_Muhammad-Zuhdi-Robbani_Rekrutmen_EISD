@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 style="margin: 0;">Kelola Kategori Sampah</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Kembali ke Dashboard</a>
</div>

<div class="widget-grid">
    <div class="card" style="margin-bottom: 0;">
        <h3 class="card-title">Tambah Kategori Baru</h3>
        <form action="{{ route('admin.storeCategory') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Kardus, Botol Plastik" required>
            </div>
            <div class="form-group">
                <label class="form-label">Poin per Kg</label>
                <input type="number" step="0.1" name="point_per_kg" class="form-control" placeholder="Contoh: 50" required>
            </div>
            <button type="submit" class="btn btn-tosca" style="width: 100%;">Simpan Kategori</button>
        </form>
    </div>

    <div class="card" style="margin-bottom: 0;">
        <h3 class="card-title">Daftar Kategori</h3>
        <div class="table-container" style="max-height: 300px; overflow-y: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Poin/Kg</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td style="color: var(--text-muted);">#{{ $category->id }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td style="color: var(--accent-tosca); font-weight: 600;">{{ $category->point_per_kg }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
