<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لمسة حرير</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #fff0f5;
        }

        .navbar {
            background: linear-gradient(90deg, #ff69b4, #ff1493);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
            color: white !important;
        }

        .hero {
            background: linear-gradient(rgba(255,105,180,0.3), rgba(255,20,147,0.3));
            padding: 40px 0;
            text-align: center;
            color: #c2185b;
        }

        .product-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
            background-color: #ffffff;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(255, 20, 147, 0.2);
        }

        .product-img {
            height: 300px;
            object-fit: contain;
            background-color: #fff;
            padding: 10px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        @media (min-width: 768px) {
            .product-img {
                height: 400px;
            }
        }

        .price {
            color: #ff1493;
            font-weight: bold;
            font-size: 18px;
        }

        /* زر أضف للسلة (أصغر) */
        .btn-pink {
            background-color: #ff1493;
            color: white;
            border-radius: 25px;
            padding: 6px 18px;
            font-size: 14px;
        }

        .btn-pink:hover {
            background-color: #c2185b;
            color: white;
        }

        /* رسالة النجاح وردي */
        .custom-alert {
            background-color: #ffc0cb;
            color: #c2185b;
            border-radius: 10px;
            border: 1px solid #ff69b4;
            font-weight: bold;
        }

        footer {
            background-color: #ff69b4;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 50px;
        }

        /* قسم الموقع */
        .map-wrapper {
            border: 2px solid #ffc0cb;
            border-radius: 20px;
            padding: 30px 20px;
            display: inline-block;
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(255, 105, 180, 0.15);
        }

        .map-title {
            color: #c2185b;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .map-button {
            padding: 10px 22px;
            background: linear-gradient(90deg, #4285F4, #5a95f5);
            color: white;
            font-size: 14px;
            border: none;
            border-radius: 25px;
        }

        .map-button:hover {
            background: #357AE8;
        }
    </style>
</head>

<body>

@php
    $firstProduct = $products->first();
@endphp

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container d-flex align-items-center justify-content-between">

        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            @if($firstProduct)
                <img src="{{ asset('images/' . $firstProduct->image) }}"
                     width="50"
                     height="50"
                     style="object-fit: cover; border-radius: 50%; border:2px solid white;">
            @endif
            <span>لمسة حرير 🌸</span>
        </a>

        <a href="{{ route('cart.index') }}" class="btn btn-outline-pink" style="color: #d63384; border-color: #ffc0cb;">
            السلة 🛒
            <span class="badge rounded-pill" style="background-color: #ffc0cb; color: #d63384;">
                {{ count(session('cart', [])) }}
            </span>
        </a>

    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">

        @if(session('success'))
            <div class="alert text-end custom-alert">
                {{session('success')}}
            </div>
        @endif 

        <h1 class="fw-bold fs-4">أهلاً بكِ في متجر لمسة حرير</h1>
        <p class="mt-2">اكتشفي أجمل المنتجات 💖</p>
    </div>
</section>

<!-- Products -->
<div class="container my-4">
    <div class="row g-3">

        @foreach($products->slice(1) as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card product-card h-100">

                    <img src="{{ asset('images/' . $product->image) }}"
                         class="card-img-top product-img"
                         alt="{{ $product->name }}">

                    <div class="card-body text-center d-flex flex-column">

                        <h6 class="fw-bold text-dark">
                            {{ $product->name }}
                        </h6>

                        <p class="text-muted small">
                            {{ $product->description }}
                        </p>

                        <p class="price mt-auto">
                            {{ (int) $product->price }} ريال
                        </p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-pink">
                                أضف للسلة
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        @endforeach

    </div>
</div>

<!-- Map Section -->
<div class="container text-center my-5">
    <div class="map-wrapper">
        <div class="map-title">📍 اليمن - إب</div>

        <a href="https://www.google.com/maps/search/?api=1&query=13.976639,44.176806" target="_blank">
            <button class="map-button">تحديد موقع لمسة حرير</button>
        </a>
    </div>
</div>

<!-- Footer -->
<footer>
    جميع الحقوق محفوظة © {{ date('Y') }} لمسة حرير
</footer>

</body>
</html>