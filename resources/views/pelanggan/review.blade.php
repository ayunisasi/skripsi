<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Terapis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --gd: #1a3a2a;
            --gm: #2d5a3d;
            --green-900: #153428;
            --green-700: #245a42;
            --gold: #c6a24a;
            --gold-soft: #f3ead3;
            --bg: #f7f8f7;
            --border: #e6e6e6;
            --cream: #faf7f0;
        }

        body {
            background: var(--cream);
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
        }

        .navbar-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;

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
            /* diperkecil dikit */
            letter-spacing: 1.5px;
            /* gak terlalu jauh */
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
            /* lebih kecil biar elegan */
            height: 2px;
            background: #c084fc;
            margin: 5px auto 0;
            border-radius: 10px;
            opacity: 0.9;
            /* biar gak terlalu “ngejreng” */
        }

        .brand-sub {
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.62rem;
            letter-spacing: 1.5px
        }

        .nav-btn {
            border: 1.5px solid var(--gold);
            color: var(--gold);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all .2s
        }

        .nav-btn:hover {
            background: var(--gold);
            color: var(--gd)
        }

        .btn-gold {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: #7c3aed;
            color: #fff !important;

            padding: 10px 16px;
            border-radius: 12px;

            font-weight: 600;
            font-size: 0.9rem;

            text-decoration: none;
            border: 1px solid #7c3aed;

            transition: .2s ease;
        }

        .btn-gold:hover {
            background: #6d28d9;
            border-color: #6d28d9;
        }

        .nav-btn {
            border: 1.5px solid var(--gold);
            color: var(--gold);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-decoration: none;
            background: transparent;
            cursor: pointer;
            transition: all .2s
        }

        .nav-btn:hover {
            background: var(--gold);
            color: var(--gd)
        }



        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .card-box {
            width: 100%;
            max-width: 700px;

            background: #fff;

            border-radius: 20px;

            border: 1px solid rgba(201, 168, 76, .15);

            box-shadow: 0 3px 16px rgba(26, 58, 42, .07);

            overflow: hidden;

            padding: 0;
        }

        .status-bar {
            height: 6px;
            background: linear-gradient(90deg,
                    #c9a84c,
                    #b8922e);
        }

        .header {
            padding: 25px 30px 15px;
            border-bottom: 1px solid #eee;
        }

        .review-content {
            padding: 30px;
        }

        .title {
            font-size: 18px;
            font-weight: 700;
            color: var(--green-900);
            margin: 0;
        }

        .subtitle {
            font-size: 13px;
            color: #777;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--green-900);
            margin-bottom: 6px;
        }

        /* ⭐ STAR RATING */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 5px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 28px;
            color: #ddd;
            cursor: pointer;
            transition: 0.2s;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: var(--gold);
        }

        /* TAGS */
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            gap: 6px;
            align-items: center;
            transition: 0.2s;
            user-select: none;
        }

        .tag input {
            accent-color: var(--gold);
        }

        .tag:has(input:checked) {
            background: var(--gold-soft);
            border-color: var(--gold);
        }

        /* FORM */
        .form-control {
            border-radius: 10px;
            border: 1px solid var(--border);
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(198, 162, 74, 0.15);
        }

        /* BUTTON */
        .btn-submit {
            width: 100%;
            margin-top: 10px;
            padding: 11px;
            border-radius: 10px;
            border: 1.5px solid #7c3aed;
            background: transparent;
            color: #7c3aed;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #7c3aed;
            color: #fff;
        }

        .dropdown-menu .dropdown-item {
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {

            .page-wrapper {
                padding: 15px;
                padding-top: 70px;
            }

            .card-box {
                max-width: 100%;
                border-radius: 14px;
            }

            .header {
                padding: 18px;
            }

            .review-content {
                padding: 18px;
            }

            .title {
                font-size: 16px;
            }

            .star-rating label {
                font-size: 24px;
            }

            .tags {
                gap: 8px;
            }

            .tag {
                font-size: 12px;
                padding: 6px 10px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar-top">
        <div style="display:flex;align-items:center;gap:10px">
            <div>
                <img src="{{ asset('images/salon.jpg') }}" alt="Logo" width="40" height="40"
                    style="border-radius:50%; object-fit:cover;">
            </div>
            <div class="brand-name">SalonQu</div>
        </div>
        <div style="display:flex;gap:10px;align-items:center">

            <div class="dropdown">
                <a class="dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown"
                    style="color:#7C4DFF;font-size:0.85rem;font-weight:500">

                    <i class="bi bi-person-circle me-1"></i>
                    {{ Auth::user()->nama_lengkap }}

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="/booking">
                            <i class="bi bi-plus-circle me-2"></i> Booking Baru
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

    <div class="page-wrapper">

        <div class="card-box">

            <div class="status-bar"></div>

            <div class="header">
                <h1 class="title">Ulasan Terapis</h1>
            </div>

            <div class="review-content">

                <form method="POST">
                    @csrf

                    <!-- ⭐ RATING BINTANG (FUNCTION TETAP: name="rating") -->
                    <div class="mb-3">
                        <label class="form-label">Rating</label>

                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5">★</label>

                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4">★</label>

                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3">★</label>

                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2">★</label>

                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1">★</label>
                        </div>
                    </div>

                    <!-- TAG -->
                    <div class="mb-3">
                        <label class="form-label">Kelebihan yang dirasakan</label>

                        <div class="tags">

                            <label class="tag">
                                <input type="checkbox" name="ramah"> Ramah
                            </label>

                            <label class="tag">
                                <input type="checkbox" name="rapi"> Rapi
                            </label>

                            <label class="tag">
                                <input type="checkbox" name="profesional"> Profesional
                            </label>

                            <label class="tag">
                                <input type="checkbox" name="bersih"> Bersih
                            </label>

                            <label class="tag">
                                <input type="checkbox" name="keterampilan"> Keterampilan
                            </label>

                        </div>
                    </div>


                    <!-- BUTTON -->
                    <button type="submit" class="btn-submit">
                        Kirim Ulasan
                    </button>
            </div>

            </form>

        </div>

    </div>

</body>

</html>