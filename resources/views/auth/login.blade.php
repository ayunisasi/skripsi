<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - SalonQu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: #f9fafb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            padding: 30px 15px;
        }

        .card {
            width: 360px;
            padding: 28px 24px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .brand {
            letter-spacing: 0.5px;
            font-family: 'Playfair Display', serif;
            color: #6d28d9;
            font-size: 1.5rem;
        }

        .sub {
            color: #7c3aed;
            font-size: 0.82rem;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 2px rgba(124, 58, 237, .12);
        }

        .form-label {
            font-size: 0.82rem;
            margin-bottom: 5px;
            color: #374151;
        }

        .btn-pink {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1.5px solid #d8b4fe;
            padding: 10px;
            font-size: 0.9rem;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            transition: .3s;
        }

        .btn-pink:hover {
            background: #ede9fe;
            color: #6d28d9;
            border-color: #c084fc;
            transform: translateY(-2px);
        }

        .divider {
            border-top: 1px solid #eadfcf;
            margin: 30px -35px 25px;
        }

        @media (max-width: 576px) {
            .card {
                width: 100%;
                padding: 35px 25px;
                border-radius: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="text-center mb-4">
            <img src="/images/salon.jpg" alt="Logo Salon"
                style="width:55px; height:55px; object-fit:cover; margin-bottom:8px;">
            <div class="brand">SalonQu</div>
            <div class="sub">E-Booking Salon</div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger rounded-3 py-2 small">
                <i class="bi bi-exclamation-circle me-1"></i>{{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success rounded-3 py-2 small">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}" placeholder="Masukkan username" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn-pink">Masuk</button>
        </form>

        <div class="divider"></div>
        <div class="text-center">
            <small class="text-muted">Belum punya akun?
                <a href="/register" style="color:#7c3aed; font-weight:600;">Daftar</a>
            </small>
        </div>
        <div class="text-center mt-2">
            <a href="/" style="color:#7c3aed;>
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>