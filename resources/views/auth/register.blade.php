<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Sri Salon Sindang</title>
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
            width: 460px;
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
            font-family: 'Playfair Display', serif;
            color: #23443d;
            font-size: 1.8rem;
            letter-spacing: 0.5px;
        }

        .sub-text {
            color: #8c7a5b;
            font-size: 0.9rem;
            margin-top: 4px;
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
            font-weight: 600;
            font-size: 0.92rem;
            color: #23443d;
            margin-bottom: 8px;
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
            margin: 30px -35px 20px;
        }

        .login-link {
            color: #b89555;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link:hover {
            color: #9f7d42;
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
            <div class="brand">Daftar Akun</div>
            <div class="sub-text">Sri Salon Sindang</div>
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
                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}" placeholder="Username unik" required>
                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="email@example.com" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                    value="{{ old('no_telp') }}" placeholder="08xxxxxxxxxx" required>
                @error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Minimal 6 karakter" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
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