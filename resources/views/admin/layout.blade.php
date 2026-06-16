<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - E-Booking Salon</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background:
                linear-gradient(to bottom right,
                    #f8f6f1,
                    #f3efe3);
            font-family: 'Poppins', sans-serif;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 250px;
            min-height: 100vh;

            background:
                linear-gradient(180deg,
                    #0f3d2e 0%,
                    #14513b 55%,
                    #1f5c45 100%);

            position: fixed;
            top: 0;
            left: 0;

            display: flex;
            flex-direction: column;

            z-index: 100;

            box-shadow:
                6px 0 25px rgba(0, 0, 0, 0.08);
        }

        .sidebar-brand {
            padding: 18px 18px;

            color: #f8f3e7;

            font-weight: 700;
            font-size: 1rem;

            border-bottom:
                1px solid rgba(212, 175, 55, 0.22);

            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sidebar-brand img {
            border-radius: 50%;
            object-fit: cover;

            border: 2px solid #d4af37;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;

            color: rgba(255, 255, 255, 0.78);

            padding: 11px 18px;

            text-decoration: none;

            font-size: 0.84rem;
            font-weight: 500;

            transition: 0.3s;

            border-left: 3px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {

            background:
                rgba(212, 175, 55, 0.12);

            color: #fff;

            border-left:
                4px solid #d4af37;
        }

        .sidebar a i {
            font-size: 0.92rem;
            width: 18px;
        }

        .sidebar-footer {
            margin-top: auto;

            border-top:
                1px solid rgba(212, 175, 55, 0.18);

            padding: 10px 0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;

            color: rgba(255, 255, 255, 0.82);

            padding: 15px 22px;

            font-size: 0.92rem;

            background: none;
            border: none;

            width: 100%;

            cursor: pointer;

            transition: 0.3s;

            border-left: 4px solid transparent;
        }

        .logout-btn:hover {
            background:
                rgba(212, 175, 55, 0.12);

            color: white;

            border-left:
                4px solid #d4af37;
        }

        /* ================= MAIN ================= */

        .main-content {
            margin-left: 250px;
            padding: 28px;
        }

        /* ================= TOPBAR ================= */

        .topbar {
            background: white;

            padding: 18px 26px;

            border-radius: 22px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 28px;

            border:
                1px solid #efe7d2;

            box-shadow:
                0 8px 30px rgba(0, 0, 0, 0.05);
        }

        .topbar-title {
            font-size: 1.08rem;
            font-weight: 700;

            color: #0f3d2e;
        }

        .topbar-user {
            color: #6e6e6e;
            font-size: 0.9rem;
        }

        /* ================= CARD ================= */

        .card {
            border: none;

            border-radius: 22px;

            overflow: hidden;

            background: white;

            border:
                1px solid #efe7d2;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.05);

            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 18px 40px rgba(0, 0, 0, 0.08);
        }

        .card-body {
            padding: 18px;

        }

        /* ================= TABLE ================= */

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background:
                linear-gradient(to right,
                    #f8f3e7,
                    #f4edd9);

            color: #0f3d2e;

            font-weight: 600;

            font-size: 0.76rem;

            border: none;

            padding: 12px 14px;
        }

        .table td {
            vertical-align: middle;

            padding: 10px 14px;

            font-size: 0.80rem;

            border-color: #f1ece2;
        }

        /* ================= BUTTON ================= */

        .btn-pink {
            background:
                linear-gradient(135deg,
                    #0f3d2e,
                    #1f5c45);

            color: white;

            border: none;

            border-radius: 12px;

            padding: 10px 18px;

            font-size: 0.9rem;

            transition: 0.3s;
        }

        .btn-pink:hover {

            background:
                linear-gradient(135deg,
                    #14513b,
                    #246b50);

            color: white;

            transform: translateY(-2px);
        }

        /* ================= BADGE ================= */

        .badge-menunggu {
            background: #fff3cd;
            color: #8a6d1d;

            padding: 8px 12px;

            border-radius: 30px;

            font-size: 0.76rem;
        }

        .badge-aktif {
            background: #e7f5eb;
            color: #1f5c45;

            padding: 8px 12px;

            border-radius: 30px;

            font-size: 0.76rem;
        }

        .badge-selesai {
            background: #e8f7ee;
            color: #0f5132;

            padding: 8px 12px;

            border-radius: 30px;

            font-size: 0.76rem;
        }

        .badge-batal {
            background: #fdecec;
            color: #c0392b;

            padding: 8px 12px;

            border-radius: 30px;

            font-size: 0.76rem;
        }

        /* ================= ALERT ================= */

        .alert {
            border: none;
            border-radius: 16px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:992px) {

            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* ================= TABLE COMPACT ================= */

        .table td,
        .table th {
            vertical-align: middle;
        }

        .table thead th {
            font-size: 0.72rem;
            padding: 10px 12px;
            white-space: nowrap;
        }

        .table td {
            font-size: 0.77rem;
            padding: 9px 12px;
        }

        /* ================= BUTTON TABLE ================= */

        .table .btn,
        .table button,
        .table a.btn {

            padding: 5px 10px !important;

            font-size: 0.72rem !important;

            border-radius: 8px;

            font-weight: 500;
        }

        /* ICON DI BUTTON */
        .table .btn i {
            font-size: 0.7rem;
        }

        /* BADGE */
        .table .badge {
            font-size: 0.68rem;
            padding: 6px 9px;
            border-radius: 20px;
        }

        /* AKSI BIAR RAPIH */
        .table td:last-child {
            white-space: nowrap;
        }

        /* CARD */
        .card-body {
            padding: 16px;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-link {
            color: #14532d;
            border-radius: 8px;
            margin: 0 3px;
        }

        .pagination .page-item.active .page-link {
            background: #14532d;
            border-color: #14532d;
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <div class="sidebar-brand">

            <img src="{{ asset('images/salon.jpg') }}" alt="Logo" width="48" height="48">

            <div>
                <div>E-Booking Salon</div>

                <div style="
                    font-size:0.72rem;
                    opacity:.75;
                    font-weight:400;
                ">
                    Admin Panel
                </div>
            </div>

        </div>

        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="/admin/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">

            <i class="bi bi-people"></i>
            Data Users
        </a>

        <a href="/admin/booking" class="{{ request()->is('admin/booking*') ? 'active' : '' }}">

            <i class="bi bi-calendar-check"></i>
            Data Booking
        </a>

        <a href="/admin/antrian" class="{{ request()->is('admin/antrian*') ? 'active' : '' }}">

            <i class="bi bi-list-ol"></i>
            Data Antrean
        </a>

        <a href="/admin/layanan" class="{{ request()->is('admin/layanan*') ? 'active' : '' }}">

            <i class="bi bi-scissors"></i>
            Data Layanan
        </a>

        <a href="/admin/terapis" class="{{ request()->is('admin/terapis*') ? 'active' : '' }}">

            <i class="bi bi-person-badge"></i>
            Data Terapis
        </a>

        <a href="/admin/pembayaran" class="{{ request()->is('admin/pembayaran*') ? 'active' : '' }}">

            <i class="bi bi-cash-coin"></i>
            Data Pembayaran
        </a>

        <div class="sidebar-footer">

            <form action="/logout" method="POST">
                @csrf

                <button type="submit" class="logout-btn">

                    <i class="bi bi-box-arrow-left"></i>

                    Logout

                </button>
            </form>

        </div>

    </div>

    {{-- MAIN --}}
    <div class="main-content">

        {{-- TOPBAR --}}
        <div class="topbar">

            <span class="topbar-title">
                @yield('title', 'Dashboard')
            </span>

            <span class="topbar-user">

                <i class="bi bi-person-circle"></i>

                {{ Auth::user()->nama_lengkap }}

            </span>

        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success shadow-sm alert-dismissible fade show">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger shadow-sm alert-dismissible fade show">

                <i class="bi bi-exclamation-circle-fill me-2"></i>

                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        {{-- CONTENT --}}
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>