<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Booking Salon</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --gold: #c6a86b;
            --gold-dark: #a8874d;
            --green: #23443d;
            --green-soft: #315a50;
            --cream: #f8f5ef;
            --text-dark: #1f2a28;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
        }

        /* NAVBAR */
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


        .btn-login {
            border: 1.5px solid var(--gold);
            color: white;
            padding: 8px 24px;
            border-radius: 25px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-login:hover {
            background: var(--gold);
            color: white;
        }


        /* HERO */
        .hero {
            min-height: 100vh;
            margin-top: 0;
            background:
                url('{{ asset("images/banner.png") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 50px 80px;
            position: relative;
        }

        .hero-content {
            max-width: 750px;
            text-align: center;
            color: white;
        }

        .hero-badge {
            display: inline-block;
            transform: translateX(-65px);

            border: 1px solid rgba(198, 168, 107, 0.4);
            color: goldenrod;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        .hero-title {
            color: black;
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            transform: translateX(-80px);
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-title span {
            color: var(--gold);
            font-style: italic;
        }

        .hero-desc {
            color: black;
            font-size: 1 rem;
            transform: translateX(-80px);
            line-height: 1.9;
            margin-bottom: 40px;
        }

        .hero-btns {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            transform: translateX(-80px);
        }

        .btn-booking {
            background: linear-gradient(135deg, var(--gold), #e1c48c);
            color: var(--green);
            padding: 14px 36px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(198, 168, 107, 0.3);
        }

        .btn-booking:hover {
            transform: translateY(-3px);
            color: var(--green);
        }

        .btn-outline-pink {
            background: transparent;
            color: var(--green);
            padding: 14px 36px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            border: 1.5px solid var(--gold);
            transition: all 0.3s;
        }

        .btn-outline-pink:hover {
            background: white;
            color: var(--green);
        }

        /* BANNER */
        .banner-section {
            margin-top: -70px;
            position: relative;
            z-index: 5;
            padding: 0 40px;
        }

        .banner-card {
            max-width: 1200px;
            margin: auto;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border: 5px solid rgba(255, 255, 255, 0.7);
        }

        .banner-card img {
            width: 100%;
            display: block;
        }

        /* SERVICES */
        .services {
            padding: 60px 0;
            background: var(--cream);
            margin-top: -20px;
            margin-bottom: 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-label {
            text-align: center;
            color: var(--gold-dark);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .section-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--green);
            margin-bottom: 20px;
        }

        .service-card {
            position: relative;
            padding: 12px;
            /* dari 16px → lebih kecil */
            border-radius: 14px;
            background: #fff;

            /* border gradient ungu soft */
            border: 2px solid transparent;
            background-image:
                linear-gradient(#fff, #fff),
                linear-gradient(135deg, #cdb4ff, #a78bfa, #e9d5ff);

            background-origin: border-box;
            background-clip: padding-box, border-box;

            /* efek glow halus */
            box-shadow: 0 6px 20px rgba(167, 139, 250, 0.15);

            transition: all 0.3s ease;
        }

        /* efek berkilau saat hover */
        .service-card:hover {
            box-shadow:
                0 10px 30px rgba(167, 139, 250, 0.25),
                0 0 18px rgba(199, 210, 254, 0.4);
            transform: translateY(-5px);
        }


        .service-image {
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .service-card:hover .service-image img {
            transform: scale(1.08);
        }

        .service-content {
            padding: 25px;
        }

        .service-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .service-price {
            color: var(--gold-dark);
            font-weight: 700;
            font-size: 0.95rem;
        }

        .service-name {
            font-size: 1.05rem;
            margin-bottom: 14px;
            color: var(--green);
            font-weight: 600;
        }

        .service-desc {
            color: #6d746f;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .service-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #7a7f7b;

        }

        .service-footer i {
            color: var(--gold-dark);
            margin-right: 5px;
        }

        /* STEPS */
        .steps {
            padding: 80px 30px;
            background: linear-gradient(135deg, #f8f7ff, #ffffff);
            position: relative;
            overflow: hidden;
        }

        .step-card {
            text-align: center;
            padding: 25px;

            background: rgba(124, 58, 237, 0.06);
            /* ungu transparan */
            border: 1px solid rgba(124, 58, 237, 0.15);
            backdrop-filter: blur(10px);

            border-radius: 20px;
            transition: 0.3s;
        }

        .step-card:hover {
            transform: translateY(-8px);
            background: rgba(124, 58, 237, 0.1);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.12);
        }

        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;

            background: linear-gradient(135deg, #7c3aed, #a78bfa);
            color: white;

            font-size: 1.3rem;
            font-weight: 700;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 18px;

            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.25);
        }

        .step-title {
            font-weight: 600;
            color: #3b2a66;
            margin-bottom: 8px;
        }

        .step-desc {
            color: #6b7280;
            font-size: 0.85rem;
            line-height: 1.7;
        }



        .cta-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            margin-bottom: 15px;
        }

        .cta-section p {
            opacity: 0.9;
            margin-bottom: 35px;
            font-size: 1rem;
        }

        .btn-white {
            background: #a78bfa;
            color: #fff;

            padding: 12px 30px;
            border-radius: 999px;

            text-decoration: none;
            font-weight: 600;

            display: inline-block;

            transition: 0.25s ease;
        }

        .btn-white:hover {
            background: #7c3aed;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
        }

        footer {
            background: #ffffff;
            /* ungu gelap elegan */
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            padding: 10px 20px;
            font-size: 0.82rem;
            border-top: 1px solid #eee;
        }

        footer p {
            max-width: 500px;
            /* ini bikin tidak panjang ke samping */
            margin: 0 auto;

            text-align: center;

            color: #6b7280;
            font-size: 0.85rem;
            line-height: 1.6;
        }

        footer span {
            color: #a78bfa;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--green);
        }

        /* bullet default */
        .swiper-pagination-bullet {
            background: #d8c7ff !important;
            /* ungu soft */
            opacity: 1;
        }

        /* bullet aktif */
        .swiper-pagination-bullet-active {
            background: #a78bfa !important;
            /* ungu lebih tegas */
            box-shadow: 0 0 10px rgba(167, 139, 250, 0.6);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

            .hero-badge,
            .hero-title,
            .hero-desc,
            .hero-btns {
                transform: none;
            }

            .navbar {
                padding: 14px 20px;
            }

            .hero {
                padding: 120px 20px 80px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-btns {
                justify-content: center;
            }

            .services,
            .steps,
            .cta-section {
                padding-left: 20px;
                padding-right: 20px;
            }

            .banner-section {
                padding: 0 15px;
                margin-top: -40px;
            }

            .layananSwiper {
                padding-bottom: 60px;
            }

            .swiper-slide {
                height: auto;
            }
        }



        .navbar {
            padding: 12px 18px;
        }

        .navbar-brand {
            font-size: 1rem;
        }

        .navbar-brand img {
            width: 35px;
        }

        .btn-login {
            padding: 7px 16px;
            font-size: 0.8rem;
        }

        .hero {
            padding: 110px 20px 70px;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            line-height: 1.3;
        }

        .hero-desc {
            font-size: 0.95rem;
            line-height: 1.8;
        }

        .hero-btns {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: nowrap;
            /* penting biar tidak turun */
        }

        .btn-booking,
        .btn-outline-pink {
            padding: 18px 42px;
            font-size: 14px !important;
            font-weight: 700 !important;
            font-size: 0.8rem;
            border-radius: 30px;
        }

        .banner-section {
            padding: 0 15px;
            margin-top: -35px;
        }

        .banner-card {
            border-radius: 20px;
        }

        .services {
            padding: 70px 15px;
        }

        .section-title {
            font-size: 1.9rem;
        }

        .service-card {
            margin-bottom: 10px;
        }

        .service-image {
            height: 210px;
        }

        .steps {
            padding: 60px 20px;
        }

        .step-card {
            padding: 15px;
        }

        .cta-section {
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2rem;

        }

        footer {
            font-size: 0.75rem;
            padding: 22px;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar-top">
        <div style="display:flex;align-items:center;gap:10px">
            <div>
                <img src="{{ asset('images/salon.jpg') }}" alt="Logo" width="40" height="40"
                    style="border-radius:50%; object-fit:cover;">
            </div>
            <div class="brand-name">SalonQu</div>
        </div>
        <div style="display:flex;gap:10px;align-items:center">
        </div>
    </nav>


    {{-- HERO --}}
    <section class="hero">

        <div class="hero-content">

            <div class="hero-badge">
                ✨ SalonQu
            </div>

            <h1 class="hero-title">
                Elegan, Relax,<br>
                dan <span>Lebih Percaya Diri</span>
            </h1>

            <p class="hero-desc">
                Nikmati layanan salon modern dengan
                nyaman di SalonQu.
            </p>

            <div class="hero-btns">
                <a href="/booking" class="btn-booking">
                    Booking Sekarang
                </a>

                <a href="/register" class="btn-outline-pink">
                    Daftar
                </a>
            </div>

        </div>

    </section>


    {{-- LAYANAN --}}
    <section class="services" id="layanan">

        <div class="section-header">
            <p class="section-label">Layanan Kami</p>
            <h2 class="section-title">Apa yang Kami Tawarkan?</h2>
        </div>

        <div class="container">

            <div class="swiper layananSwiper">

                <div class="swiper-wrapper">

                    {{-- CARD 1 --}}
                    <div class="swiper-slide">
                        <div class="service-card">

                            <div class="service-image">
                                <img src="{{ asset('images/creambath.jpg') }}" alt="">
                            </div>

                            <div class="service-content">

                                <div class="service-top">
                                    <span class="service-price">Rp35K</span>
                                </div>

                                <h5 class="service-name">
                                    Creambath
                                </h5>

                                <p class="service-desc">
                                    Perawatan rambut agar tetap sehat,
                                    lembut, dan berkilau.
                                </p>

                                <div class="service-footer">
                                    <span>
                                        <i class="bi bi-clock"></i>
                                        60 Menit
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- CARD 2 --}}
                    <div class="swiper-slide">
                        <div class="service-card">

                            <div class="service-image">
                                <img src="{{ asset('images/facial.png') }}" alt="">
                            </div>

                            <div class="service-content">

                                <div class="service-top">
                                    <span class="service-price">50K</span>
                                </div>

                                <h5 class="service-name">
                                    Facial
                                </h5>

                                <p class="service-desc">
                                    Facial treatment untuk wajah lebih
                                    glowing dan segar.
                                </p>

                                <div class="service-footer">
                                    <span>
                                        <i class="bi bi-clock"></i>
                                        30 Menit
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- CARD 3 --}}
                    <div class="swiper-slide">
                        <div class="service-card">

                            <div class="service-image">
                                <img src="{{ asset('images/masker.png') }}" alt="">
                            </div>

                            <div class="service-content">

                                <div class="service-top">
                                    <span class="service-price">Rp35K</span>
                                </div>

                                <h5 class="service-name">
                                    Masker Rambut
                                </h5>

                                <p class="service-desc">
                                    Perawatan rambut untuk menjaga kesehatan
                                    rambut.
                                </p>

                                <div class="service-footer">
                                    <span>
                                        <i class="bi bi-clock"></i>
                                        30 Menit
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- CARD 4 --}}
                    <div class="swiper-slide">
                        <div class="service-card">

                            <div class="service-image">
                                <img src="{{ asset('images/potong.png') }}" alt="">
                            </div>

                            <div class="service-content">

                                <div class="service-top">
                                    <span class="service-price">25k</span>
                                </div>

                                <h5 class="service-name">
                                    Potong Rambut
                                </h5>

                                <p class="service-desc">
                                    Potong rambut sesuai gaya yang
                                    diinginkan.
                                </p>

                                <div class="service-footer">
                                    <span>
                                        <i class="bi bi-clock"></i>
                                        20 Menit
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- CARD 5 --}}
                    <div class="swiper-slide">
                        <div class="service-card">

                            <div class="service-image">
                                <img src="{{ asset('images/lulur.png') }}" alt="">
                            </div>

                            <div class="service-content">

                                <div class="service-top">
                                    <span class="service-price">110K</span>
                                </div>

                                <h5 class="service-name">
                                    Lulur Massage
                                </h5>

                                <p class="service-desc">
                                    Lulur dan pijat relaksasi
                                    untuk membantu mengangkat sel kulit
                                    mati
                                </p>

                                <div class="service-footer">
                                    <span>
                                        <i class="bi bi-clock"></i>
                                        90 Menit
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                {{-- tombol --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                {{-- pagination --}}
                <div class="swiper-pagination mt-4"></div>

            </div>

        </div>

    </section>

    {{-- CARA BOOKING --}}
    <section class="steps">

        <p class="section-label">
            Cara Booking
        </p>

        <h2 class="section-title">
            Mudah dalam 4 Langkah
        </h2>

        <div class="container">

            <div class="row g-4">

                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-title">Daftar Akun</div>
                        <p class="step-desc">
                            Buat akun dengan data dirimu
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-title">Pilih Layanan</div>
                        <p class="step-desc">
                            Pilih layanan, terapis, dan tanggal yang diinginkan
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-title">Bayar DP / Full</div>
                        <p class="step-desc">
                            Bayar dengan pilih DP 30% atau full payment
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <div class="step-title">Dapat Nomor Antrian</div>
                        <p class="step-desc">
                            Dapat nomor antrian dan estimasi waktu pelayanan
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </section>

    {{-- CTA --}}
    <section class="cta-section">

        <h2>
            Siap Tampil Lebih Elegan?
        </h2>



        <a href="/register" class="btn-white">
            Daftar Sekarang →
        </a>

    </section>

    <footer>
        <p>
            © {{ date('Y') }}
            <span>SalonQu</span>.
            All rights reserved.
        </p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".layananSwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },

                768: {
                    slidesPerView: 2,
                },

                1024: {
                    slidesPerView: 3,
                }
            }
        });
    </script>

</body>

</html>