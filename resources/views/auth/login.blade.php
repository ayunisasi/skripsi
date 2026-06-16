<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sri Salon Sindang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: #f4f1eb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            padding: 30px 15px;
        }

        .card {
            width: 420px;
            padding: 45px 35px;
            border-radius: 28px;

            background: #ffffff;

            border: 2px solid #d8c39a;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.08),
                0 0 0 4px rgba(198, 168, 107, 0.08);

            overflow: hidden;
        }

        .brand {
            letter-spacing: 0.5px;
            font-family: 'Playfair Display', serif;
            color: #23443d;
            font-size: 1.5rem;
        }

        .sub {
            color: #23443d;
            font-size: 0.82rem;
        }

        .form-control {
            border-radius: 14px;
            border: 2px solid #dcc8a1;
            padding: 14px 18px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #c6a86b;
            box-shadow: 0 0 0 4px rgba(198, 168, 107, 0.18);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.88rem;
            color: #23443d;
        }

        .btn-pink {
            background: linear-gradient(135deg, #c6a86b, #e0c48d);
            color: #23443d;
            border: none;
            border-radius: 16px;
            padding: 15px;
            font-weight: 700;
            width: 100%;
            transition: all 0.3s;
            font-size: 1.05rem;
        }

        .btn-pink:hover {
            background: linear-gradient(135deg, #b89555, #d4b57a);
            transform: translateY(-2px);
            color: #23443d;
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
            <div class="brand">Sri Salon Sindang</div>
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
                <a href="/register" style="color:#b89555; font-weight:600;">Daftar Gratis</a>
            </small>
        </div>
        <div class="text-center mt-2">
            <a href="/" style="color:#8c7a5b;>
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>