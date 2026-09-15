<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - SalonQu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            padding: 30px 15px;
            line-height: 1.2;

        }

        .card {
            width: 400px;
            padding: 32px 28px;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        }

        .brand {
            letter-spacing: 0.5px;
            font-family: 'Playfair Display', serif;
            color: black;
            font-size: 1.4rem;
            margin-top: 6px;
        }

        .form-label {
            font-size: 0.85rem;
            margin-bottom: 6px;
            color: #374151;
        }

        .form-control {
            padding: 10px 12px;
            font-size: 0.9rem;
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 2px rgba(124, 58, 237, .12);
        }

        .mb-3 {
            margin-bottom: 14px !important;
        }

        .mb-4 {
            margin-bottom: 18px !important;
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
            margin: 30px -35px 20px;
        }

        .login-link {
            color: #7c3aed;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link:hover {
            color: #6d28d9;
        }


        @media (max-width: 576px) {
            .card {
                width: 100%;
                padding: 35px 25px;
                border-radius: 24px;
            }

            .divider {
                margin: 25px -25px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="text-center mb-4">
            <img src="/images/salon.jpg" alt="Logo"
                style="width:55px; height:55px; object-fit:cover; margin-bottom:8px; border-radius:50%;">
            <div class="brand">Daftar Akun</div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger rounded-3 py-2 small">{{ session('error') }}</div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                    value="{{ old('nama_lengkap') }}" placeholder="Nama lengkap kamu" required>
                @error('nama_lengkap')
                <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="email@example.com" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                    value="{{ old('no_telp') }}" placeholder="08xxxxxxxxxx" required>
                @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Minimal 6 karakter" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password"
                    required>
            </div>
            <button type="submit" class="btn-pink">Daftar Sekarang</button>
        </form>

        <div class="divider"></div>
        <div class="text-center">
            <small class="text-muted">Sudah punya akun?
                <a href="/login" class="login-link">Masuk</a>
            </small>
        </div>
    </div>
</body>

</html>
