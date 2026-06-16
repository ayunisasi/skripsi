<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ulasan Terapis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

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
        }

        body {
            background: var(--bg);
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
        }

        .navbar-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;

            background: var(--gd);
            padding: 14px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow: 0 2px 15px rgba(0, 0, 0, .2);
        }

        .brand-name {
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.1rem
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
            border: none;
            background: var(--green-900);
            color: #fff;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: var(--green-700);
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

            <div class="brand-name">
                E-Booking Salon
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">

            <a href="/booking/riwayat" class="btn btn-outline-danger btn-sm rounded-pill">
                <i class="bi bi-clock-history"></i>
                Riwayat
            </a>

            <span class="small" style="color:var(--gold)">
                {{ Auth::user()->nama_lengkap }}
            </span>

            <form action="/logout" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-outline-secondary btn-sm rounded-pill">
                    Logout
                </button>
            </form>

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
                                <input type="checkbox" name="tepat_waktu"> Tepat Waktu
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