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
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(20, 35, 31, 0.75);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            padding: 14px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 999;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            border-radius: 50%;
            object-fit: cover;
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
                linear-gradient(rgba(15, 30, 27, 0.72),
                    rgba(15, 30, 27, 0.72)),
                url('{{ asset("images/banner.jpg") }}');
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
            background: rgba(198, 168, 107, 0.18);
            border: 1px solid rgba(198, 168, 107, 0.4);
            color: #f7dfb0;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 25px;
            backdrop-filter: blur(4px);
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-title span {
            color: var(--gold);
            font-style: italic;
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.86);
            font-size: 1.05rem;
            line-height: 1.9;
            margin-bottom: 40px;
        }

        .hero-btns {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
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
            color: white;
            padding: 14px 36px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            border: 1.5px solid rgba(255, 255, 255, 0.6);
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
            padding: 100px 0;
            background: var(--cream);
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
            background: white;
            border-radius: 24px;
            overflow: hidden;
            transition: 0.35s;
            border: 1px solid #ece4d7;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 45px rgba(35, 68, 61, 0.18);
        }

        .service-image {
            width: 100%;
            height: 240px;
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
            font-size: 1.25rem;
            margin-bottom: 14px;
            color: var(--green);
            font-weight: 600;
        }

        .service-desc {
            color: #6d746f;
            line-height: 1.8;
            font-size: 0.92rem;
            margin-bottom: 22px;
        }

        .service-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #7a7f7b;
            font-size: 0.88rem;
        }

        .service-footer i {
            color: var(--gold-dark);
            margin-right: 5px;
        }

        /* STEPS */
        .steps {
            padding: 20px 30px 80px;
            background: white;
        }

        .step-card {
            text-align: center;
            padding: 20px;
        }

        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green), var(--green-soft));
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            box-shadow: 0 8px 20px rgba(35, 68, 61, 0.3);
            border: 3px solid var(--gold);
        }

        .step-title {
            font-weight: 600;
            color: var(--green);
            margin-bottom: 8px;
        }

        .step-desc {
            color: #78817c;
            font-size: 0.85rem;
            line-height: 1.7;
        }

        /* CTA */
        .cta-section {
            padding: 90px 50px;
            text-align: center;
            background:
                linear-gradient(rgba(20, 35, 31, 0.9),
                    rgba(20, 35, 31, 0.9)),
                url('{{ asset("images/banner.jpg") }}');
            background-size: cover;
            background-position: center;
            color: white;
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
            background: linear-gradient(135deg, var(--gold), #edd39d);
            color: var(--green);
            padding: 14px 45px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-white:hover {
            transform: translateY(-2px);
            color: var(--green);
        }

        footer {
            background: #132622;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            padding: 28px;
            font-size: 0.82rem;
        }

        footer span {
            color: var(--gold);
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--green);
        }

        .swiper-pagination-bullet-active {
            background: var(--gold-dark);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

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

        @media (max-width: 768px) {

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
                font-size: 2.2rem;
                line-height: 1.3;
            }

            .hero-desc {
                font-size: 0.95rem;
                line-height: 1.8;
            }

            .hero-btns {
                flex-direction: column;
                align-items: center;
            }

            .btn-booking,
            .btn-outline-pink {
                width: 100%;
                max-width: 280px;
                text-align: center;
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
                padding: 70px 20px;
            }

            .cta-section h2 {
                font-size: 2rem;
            }

            footer {
                font-size: 0.75rem;
                padding: 22px;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <span class="navbar-brand">
            <img src="{{ asset('images/salon.jpg') }}" alt="Logo" width="42">
            E-Booking Salon
        </span>

        <a href="/login" class="btn-login">
            Masuk
        </a>
    </nav>

    {{-- HERO --}}
    <section class="hero">

        <div class="hero-content">

            <div class="hero-badge">
                ✨ E-booking Sri salon
            </div>

            <h1 class="hero-title">
                Elegan, Relax,<br>
                dan <span>Lebih Percaya Diri</span>
            </h1>

            <p class="hero-desc">
                Nikmati layanan salon modern dengan
                nyaman di Sri Salon Sindang.
                Booking lebih mudah, cepat, dan tanpa antre panjang.
            </p>

            <div class="hero-btns">
                <a href="/booking" class="btn-booking">
                    Booking Now
                </a>

                <a href="/register" class="btn-outline-pink">
                    Daftar Gratis
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
                                    <span class="service-price">Mulai dari Rp35K</span>
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
                                    <span class="service-price">Mulai Rp35K</span>
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
                            Buat akun gratis dengan data dirimu
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
            <span>E-Booking Salon</span>.
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