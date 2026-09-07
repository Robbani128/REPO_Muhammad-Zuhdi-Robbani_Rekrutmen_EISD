@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="card auth-card">
        <div class="text-center mb-4">
            <h2 class="card-title" style="border: none; margin-bottom: 0.5rem;">Buat Akun Baru</h2>
            <p>Bergabunglah dengan Bank Sampah Digital.</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>

            <div class="form-group">
                <label class="form-label">Daftar Sebagai</label>
                <select name="role" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Peran Anda --</option>
                    <option value="customer">Warga (Customer) - Request Penjemputan</option>
                    <option value="merchant">Pengepul (Merchant) - Terima Tugas</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-tosca" style="width: 100%; margin-top: 1rem;">Daftar Sekarang</button>
        </form>
        
        <div class="text-center mt-4" style="font-size: 0.9rem;">
            Sudah punya akun? <a href="{{ route('login') }}" style="font-weight: 600;">Login di sini</a>
        </div>
    </div>
</div>
@endsection
