<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - SalonQu</title>

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
            background: #faf7ff;
            font-family: 'Poppins', sans-serif;
            font-family: 'Poppins',
                sans-serif;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;

            background: white;

            border-right: 1px solid #e9d5ff;

            box-shadow: 4px 0 20px rgba(124, 58, 237, .05);

            display: flex;
            flex-direction: column;

            z-index: 100;
        }

        .sidebar-brand {
            color: #6d28d9;
            padding: 18px 18px;
            background: white;

            border: none;
            border-left: 4px solid #8b5cf6;
            border-bottom: 1px solid #ede9fe;

            display: flex;
            align-items: center;
            gap: 14px;

            font-weight: 700;
            font-size: 1rem;
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

            color: #6b7280;

            padding: 11px 18px;

            text-decoration: none;

            font-size: 0.84rem;
            font-weight: 500;

            transition: 0.3s;

            border-left: 3px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {

            background: #f5f3ff;

            color: #7c3aed;

            border-left: 4px solid #7c3aed;
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

            color: #6b7280;

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
            background: #f5f3ff;
            color: #7c3aed;
            border-left: 4px solid #7c3aed;
        }

        /* ================= MAIN ================= */

        .main-content {
            margin-left: 250px;
            padding: 28px;
        }

        /* ================= TOPBAR ================= */

        .topbar {
            background: white;
            border: 1px solid #e9d5ff;
            box-shadow: 0 4px 20px rgba(124, 58, 237, .05);
            padding: 18px 26px;

            border-radius: 22px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 28px;

        }

        .topbar-title {
            font-size: 1.08rem;
            font-weight: 700;

            color: #7c3aed;
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

            background: #fff;
            box-shadow: 0 6px 25px rgba(124, 58, 237, .08);

            border:
                1px solid #efe7d2;
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
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table thead th {
            background: #faf7ff;
            color: #7c3aed;

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
        .btn-detail-soft {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            padding: 3px 8px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .btn-detail-soft:hover {
            background: #ede9fe;
            color: #6d28d9;
            border-color: #7c3aed;
        }

        .btn-success-soft {
            background: #ecfdf5;
            color: #16a34a;
            border: 1px solid #bbf7d0;
            padding: 3px 8px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .btn-success-soft:hover {
            background: #dcfce7;
            color: #15803d;
        }

        .btn-danger-soft {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 3px 8px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .btn-danger-soft:hover {
            background: rgba(220, 38, 38, 0.12);
            color: #dc2626;
            border-color: rgba(220, 38, 38, 0.35);
        }

        .btn-danger {
            background: #f5f3ff;
            color: #dc2626;
            /* merah */
            border: 1.5px solid #fecaca;
            font-weight: 600;
        }

        .btn-danger:hover {
            background: #fee2e2;
            color: #b91c1c;
        }

        .table .btn {
            padding: 3px 8px !important;
            font-size: 0.72rem !important;
        }

        .btn-outline-soft {
            background: white;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            font-weight: 600;
        }

        .btn-outline-soft:hover {
            background: #faf7ff;
            color: #6d28d9;
            border: 1px solid #c084fc;
            /* border tetap ada */
        }

        .btn-outline-soft:focus,
        .btn-outline-soft:active {
            background: #faf7ff !important;
            color: #6d28d9 !important;
            border: 1px solid #c084fc !important;
            box-shadow: none !important;
            /* hilangkan efek bootstrap */
        }

        .btn-purple {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            font-weight: 600;
            transition: .2s;
        }

        .btn-purple:hover {
            background: #ede9fe;
            color: #6d28d9;
            border-color: #c084fc;
        }

        .btn-action {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            font-weight: 600;
            transition: .2s;
        }

        .btn-action:hover {
            background: #ede9fe;
            color: #6d28d9;
            border-color: #c084fc;
        }

        .btn-purple {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            font-weight: 600;
        }

        .btn-purple:hover {
            background: #ede9fe;
            color: #6d28d9;
        }

        .btn-gray {
            background: white;
            color: black;
            border: 1.5px solid black;
            font-weight: 300;
        }

        .btn-gray:hover {
            background: gray;
            color: white;
        }

        .btn-warning {
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #fed7aa;
            font-weight: 600;
        }

        .btn-warning:hover {
            background: #ffedd5;
            color: #c2410c;
            border-color: #fdba74;
        }

        .btn-warning-soft {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
            font-weight: 600;
            transition: .2s;
        }

        .btn-warning-soft:hover {
            background: #fef3c7;
            color: #b45309;
            border-color: #fcd34d;
        }

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

        .btn-add-soft {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            font-weight: 600;
        }

        .btn-add-soft:hover {
            background: #ede9fe;
            color: #6d28d9;
            border-color: #c084fc;
        }

        .btn-add-soft:focus,
        .btn-add-soft:active {
            background: #ede9fe !important;
            color: #6d28d9 !important;
            border-color: #c084fc !important;
            box-shadow: none !important;
        }

        .btn-add {
            background: #f5f3ff;
            color: #7c3aed;
            border: 1px solid #d8b4fe;
            font-weight: 600;
        }

        .btn-add:hover {
            background: #ede9fe;
            color: #6d28d9;
            border-color: #c084fc;
        }

        .btn-add:focus,
        .btn-add:active {
            background: #ede9fe !important;
            color: #6d28d9 !important;
            border-color: #c084fc !important;
            box-shadow: none !important;
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
            color: #7c3aed;
            border-radius: 8px;
            margin: 0 3px;
        }

        .pagination .page-item.active .page-link {
            background: #7c3aed;
            border-color: #7c3aed;
        }

        .row-active {
            background: #faf7ff !important;
        }

        .filter-dropdown {
            width: 180px;
            max-height: 180px;
            overflow-y: auto;

            border-radius: 10px;

            padding: 4px;
        }

        .filter-dropdown .dropdown-item {
            border-radius: 6px;

            padding: 6px 10px;

            font-size: 12px;

            line-height: 1.2;
        }

        .filter-dropdown .dropdown-divider {
            margin: 4px 0;
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <div class="sidebar-brand">

            <img src="{{ asset('images/salon.jpg') }}" alt="Logo" width="48" height="48">

            <div>
                <div>SalonQu</div>

                <div style="font-size:0.72rem;color:#a78bfa;font-weight:500;">

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