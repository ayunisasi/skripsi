
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - SalonQu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
            --gd: #1a3a2a;
            --gm: #2d5a3d;
            --gold: #c9a84c;
            --gold-l: #f5edd0;
            --cream: #faf7f0;
            --gl: #e8f5ee;
        }
       body {
    background: var(--cream);
    font-family: 'Poppins', sans-serif;
    padding-top: 80px;
}

        .navbar-top {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: #faf7ff;
        border-bottom: 1px solid #e9d5ff;
        padding: 8px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .brand-name {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.02rem;
        letter-spacing: 1.5px;
        color: #6d28d9;
        text-transform: uppercase;
        font-style: italic;
        position: relative;
        line-height: 1;
    }

    .brand-name::after {
        content: "";
        display: block;
        width: 28px;
        height: 2px;
        background: #c084fc;
        margin: 5px auto 0;
        border-radius: 10px;
        opacity: 0.9;
    }
        .container {
            max-width: 750px;
        }

        .profile-card {
            background: white;
            border: 1px solid #e9d5ff;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(124, 58, 237, .06);
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #7c3aed;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 18px;
        }

        .profile-photo {
            width: 115px;
            height: 115px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ede9fe;
        }

        .form-control {
            border: 1.5px solid #e9d5ff;
            border-radius: 10px;
            padding: 11px 13px;
            font-size: 13px;
        }

        .form-control:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, .12);
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #444;
        }

        .btn-purple {
            background: #8b5cf6;
            color: white;
            border: none;
            border-radius: 11px;
            padding: 12px 25px;
            font-weight: 600;
        }

        .btn-purple:hover {
            background: #7c3aed;
            color: white;
        }

        .btn-back {
            color: #7c3aed;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }

        .btn-back:hover {
            color: #5b21b6;
        }

        .info-text {
            font-size: 11px;
            color: #888;
        }

        .profile-photo {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ede9fe;
        flex-shrink: 0;
    }

    .profile-photo-placeholder {
        font-size: 85px;
        color: #c4b5fd;
        line-height: 1;
        flex-shrink: 0;
    }

    .photo-upload {
        flex: 1;
        min-width: 0;
    }

    .navbar-top .dropdown-menu {
    font-family: 'Poppins', sans-serif;
    font-size: 12px;
    border: 1px solid #e9d5ff;
    border-radius: 8px;
    padding: 5px 0;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.10);
}

.navbar-top .dropdown-item {
    color: #333;
    font-family: 'Poppins', sans-serif;
    font-size: 12px;
    padding: 6px 14px;
}

    @media(max-width:576px) {
        .profile-card {
            padding: 18px;
        }

        .profile-photo {
            width: 70px;
            height: 70px;
        }

        .profile-photo-placeholder {
            font-size: 70px;
        }
    }

        @media(max-width:576px) {
            .profile-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

   {{-- NAVBAR --}}
<nav class="navbar-top">

    <div style="display:flex;align-items:center;gap:10px">
        <div>
            <img src="{{ asset('images/salon.jpg') }}"
                alt="Logo"
                width="40"
                height="40"
                style="border-radius:50%;object-fit:cover;">
        </div>

        <div class="brand-name">SalonQu</div>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">

            <a class="dropdown-toggle text-decoration-none"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                style="color:#7c3aed;font-size:0.85rem;font-weight:500">

               @if(Auth::user()->foto_profil)
    <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
         width="24"
         height="24"
         style="border-radius:50%; object-fit:cover; vertical-align:middle; margin-right:5px;">
@else
    <i class="bi bi-person-circle me-1"></i>
@endif

{{ Auth::user()->nama_lengkap }}

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2"></i> Profil
                    </a>
                </li>

                 <li>
                        <a class="dropdown-item" href="/booking">
                            <i class="bi bi-plus-circle me-2"></i> Booking Baru
                        </a>
                    </li>

                <li>
                    <a class="dropdown-item" href="/booking/riwayat">
                        <i class="bi bi-clock-history me-2"></i> Riwayat
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>

</nav>

    <div class="container py-4">

        {{-- JUDUL --}}
        <div class="mb-4">
            <h5 class="fw-bold mb-1">Profil Saya</h5>
        </div>

        {{-- PESAN BERHASIL --}}
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- PESAN ERROR --}}
        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3">
                <strong>Periksa kembali data Anda:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- FOTO PROFIL --}}
           <div class="profile-card">
    <div class="section-title">
        <i class="bi bi-camera me-2"></i> Foto Profil
    </div>

    <div class="d-flex align-items-center gap-3">

        @if(Auth::user()->foto_profil)
            <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                 class="profile-photo">
        @else
            <i class="bi bi-person-circle profile-photo-placeholder"></i>
        @endif

        <div class="photo-upload">
            <div class="fw-semibold mb-1">
                {{ Auth::user()->nama_lengkap }}
            </div>

            <div class="info-text mb-2">
                JPG, JPEG, PNG, WEBP (Maksimal 2 MB)
            </div>

            <input type="file"
                   name="foto_profil"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp,image/*">
        </div>

    </div>
</div>

            {{-- INFORMASI PRIBADI --}}
            <div class="profile-card">

                <div class="section-title">
                    <i class="bi bi-person me-2"></i>
                    Informasi Pribadi
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                        name="nama_lengkap"
                        class="form-control"
                        value="{{ old('nama_lengkap', Auth::user()->nama_lengkap) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', Auth::user()->email) }}"
                        required>
                </div>

                <div class="mb-0">
                    <label class="form-label">Nomor HP</label>
                    <input type="text"
                        name="no_telp"
                        class="form-control"
                        value="{{ old('no_telp', Auth::user()->no_telp) }}"
                        maxlength="15"
                        placeholder="Masukkan nomor HP">
                </div>

            </div>

            {{-- UBAH PASSWORD --}}
            <div class="profile-card">

                <div class="section-title">
                    <i class="bi bi-shield-lock me-2"></i>
                    Keamanan Akun
                </div>

                <div class="alert alert-light border"
                    style="font-size:12px;color:#777">
                    Kosongkan bagian password jika tidak ingin mengganti password.
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Lama</label>
                    <input type="password"
                        name="password_lama"
                        class="form-control"
                        placeholder="Masukkan password lama"
                        autocomplete="current-password">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password"
                        name="password"
                        class="form-control"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password">
                </div>

                <div class="mb-0">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password baru"
                        autocomplete="new-password">
                </div>

            </div>

            {{-- TOMBOL SIMPAN --}}
            <button type="submit" class="btn btn-purple w-100 mb-4">
                <i class="bi bi-save me-2"></i>
                Simpan Perubahan
            </button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
