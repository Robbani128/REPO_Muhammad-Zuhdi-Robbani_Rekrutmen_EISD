@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 style="margin: 0;">Input Timbangan</h2>
    <a href="{{ route('merchant.dashboard') }}" class="btn btn-outline">Kembali ke Dashboard</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div style="background-color: #F1F5F9; padding: 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; text-align: center;">
        <span style="color: var(--text-muted); font-size: 0.9rem;">Transaksi ID</span>
        <h3 style="color: var(--primary-dark); font-size: 1.5rem; margin: 0;">#{{ $transaction->id }}</h3>
        <div style="margin-top: 5px; font-weight: 500;">Penjemputan dari: {{ $transaction->customer->name }}</div>
    </div>

    <form action="{{ route('merchant.storeWeighing', $transaction->id) }}" method="POST">
        @csrf
        <div id="wastes-container">
            <div class="form-group" style="background: white; border: 1px solid #E2E8F0; padding: 1.5rem; border-radius: var(--radius);">
                <label class="form-label">Kategori Sampah</label>
                <select name="wastes[0][waste_category_id]" class="form-control" style="margin-bottom: 1rem;" required>
                    <option value="" disabled selected>Pilih Kategori...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} &mdash; {{ $category->point_per_kg }} Poin/kg</option>
                    @endforeach
                </select>
                
                <label class="form-label">Berat (Kg)</label>
                <input type="number" step="0.1" min="0.1" name="wastes[0][weight_kg]" class="form-control" placeholder="Contoh: 1.5" required>
            </div>
        </div>
        
        <button type="submit" class="btn btn-tosca" style="width: 100%; margin-top: 1rem; padding: 1rem; font-size: 1.1rem;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: text-bottom; margin-right: 5px;">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            Selesaikan Transaksi & Hitung Poin
        </button>
    </form>
</div>
@endsection
