<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SalonQu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

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
            font-family: 'Playfair Display', serif;
            color: #6d28d9;
            font-size: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.9rem;
        }

        .btn-reset {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            padding: 10px;
            border-radius: 10px;
            font-weight: 500;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="text-center mb-4">
            <img src="/images/salon.jpg" alt="Logo Salon"
                style="width:55px;height:55px;object-fit:cover;margin-bottom:8px;">
            <div class="brand">Reset Password</div>
            <small class="text-muted">SalonQu</small>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger small">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control"
                    placeholder="Minimal 8 karakter" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Ulangi password baru" required>
            </div>

            <button type="submit" class="btn-reset"
            style="font-family: 'Poppins', sans-serif !important;">
                Simpan Password Baru
            </button>
        </form>
    </div>
</body>
</html>
