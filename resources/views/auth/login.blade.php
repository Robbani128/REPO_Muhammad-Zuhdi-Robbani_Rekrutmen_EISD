@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="card auth-card">
        <div class="text-center mb-4">
            <h2 class="card-title" style="border: none; margin-bottom: 0.5rem;">Login ke Akun Anda</h2>
            <p>Mulai berkontribusi untuk lingkungan yang lebih baik.</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Login</button>
        </form>
        
        <div class="text-center mt-4" style="font-size: 0.9rem;">
            Belum punya akun? <a href="{{ route('register') }}" style="font-weight: 600;">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection
