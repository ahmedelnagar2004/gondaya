<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AGIESIGY STORE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">


    <link rel="stylesheet" href="style.css">
    <style>
        /* Navbar Styles */
        .main-navbar {
            border-bottom: 1px solid #ccc;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #ddd; /* Ensure background color */
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
        }
        .top-navbar {
            background-color: #000000;
            padding-top: 10px;
            padding-bottom: 10px;
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
        }
        .brand-name {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            color: #fff;
        }
        .nav-link {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
        }
        .dropdown-menu {
            padding: 0px 0px;
            border-radius: 0px;
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
        }
        .dropdown-item {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            padding: 8px 16px;
            border-bottom: 1px solid #ccc;
            font-size: 14px;
        }
        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: #000000;
            font-size: 14px;
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
        }
        .navbar {
            padding: 0px;
        }
        .nav-item .nav-link {
            padding: 8px 20px;
            color: #000;
            font-size: 15px;
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
        }
        @media only screen and (max-width: 600px) {
            .nav-link {
                font-size: 12px;
                padding: 8px 10px;
            }
        }

        /* Footer Styles */
        .footer {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            background-color: #000000; /* Dark Black */
            color: #ffffff; /* White Text */
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0;
            text-align: center;
            z-index: 1000;
        }
        .footer a {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            color: #ffffff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }

        /* Card and Button Styles */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .btn-custom {
            background-color: #000000;
            color: #ffffff;
            border: none;
            transition: background-color 0.3s, color 0.3s, transform 0.3s ease;
            margin-left: 70px;
        }
        .btn-custom:hover {
            background-color: #ffffff;
            color: #000000;
            border: 1px solid #000000;
            transform: translateX(10px) rotate(5deg); /* حركة بسيطة لليمين مع دوران */
            animation: shake 0.5s ease-in-out; /* تأثير الاهتزاز */
        }
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
        .card {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card:active {
            transform: scale(0.98);
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        }

        /* Content Padding to avoid overlap with Navbar and Footer */
        body {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            padding-top: 80px; /* Adjust this value based on Navbar height */
            padding-bottom: 60px; /* Adjust this value based on Footer height */
        }

        /* New Style for Right-aligned Cart */
        .cart-icon {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            margin-left: auto;
            display: flex;
            align-items: center;
        }
        .splide {
            overflow: visible;
            padding: 0 5rem; /* تعديل المسافات عند الحاجة */
        }

        .splide__slide {
            transition: transform 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .splide__slide img {
            max-width: 100%;
            height: auto;
            display: block;
            width: 100%; /* اجعل الصور تملأ كامل العرض */
            object-fit: cover; /* لملء الإطار مع الحفاظ على نسبة الأبعاد */
        }

        .splide__slide.is-prev,
        .splide__slide.is-next {
            transform: scale(0.8); /* تصغير الصور المجاورة */
        }

        @media (max-width: 768px) {
            .splide {
                padding: 0 1rem; /* تعديل المسافات للأجهزة المحمولة */
            }

            .splide__track {
                display: flex;
                justify-content: center; /* توسيط الصور في الأجهزة المحمولة */
            }

            .splide__slide {
                width: 100%; /* ضبط العرض بحيث تملأ الشاشة بالكامل */
            }
        }
    </style>
</head>
<body>

<div class="main-navbar shadow-sm">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <h5 class="brand-name">AGIESIGY</h5>
                </div>
                <div class="col-md-5 my-auto">
                    <form role="search" method="GET" action="">
                        <div class="input-group">
                            <input type="search" name="query" placeholder="Search your product" class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        <li class="nav-item cart-icon">
                            <a class="nav-link" href="cart.php">
                                <i class="fa fa-shopping-cart"></i> Cart (0)
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                AGIESIGY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="store.php">STORE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="size_shart.php">SIZE CHART</a>
                    </li>
                </ul>
                <!-- Cart Icon is now visible on the right side -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fa fa-shopping-cart"></i> Cart (0)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<br>
<br>
<div class="splide" id="splide">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide"><img src="WhatsApp Image 2024-08-17 at 14.42.27_eed5392e.jpg" alt="Slide 01"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.15.49_baa42f64.jpg" alt="Slide 02"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.15.50_17e4b30d.jpg" alt="Slide 03"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.15.46_4bae41e1.jpg" alt="Slide 04"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.11.36_b36b2bab.jpg" alt="Slide 05"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.11.35_ea4261b8.jpg" alt="Slide 06"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.12.23_a2ce2be6.jpg" alt="Slide 07"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.11.35_c86eae3f.jpg" alt="Slide 08"></li>
            <li class="splide__slide"><img src="WhatsApp Image 2024-07-30 at 00.15.49_9e58c460.jpg" alt="Slide 09"></li>
        </ul>
    </div>
</div>
<br>
<br>
<br>

<div class="container my-4">
    <div class="row">
        <?php
        include 'db_connect.php';

        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        }

        $searchQuery = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

        $sql = "SELECT id, name, price, description, image FROM products";

        if ($searchQuery) {
            $sql .= " WHERE name LIKE '%" . $searchQuery . "%'";
        }

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-6 col-md-3 mb-4 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <img src="' . htmlspecialchars($row["image"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["name"]) . '">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($row["name"]) . '</h5>
                                <p class="card-text">' . htmlspecialchars($row["description"]) . '</p>
                                <p class="card-text">⭐⭐⭐⭐⭐</p>
                                <p class="card-text"><strong>Price: </strong>$' . htmlspecialchars($row["price"]) . '</p>
                                <a href="information.php?id=' . $row["id"] . '" class="btn btn-custom">quick add</a>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo "<p>No products found</p>";
        }

        $conn->close();
        ?>
    </div>
</div>


<!-- Footer -->
<footer class="footer">
    <div class="container">
        <a href="https://www.instagram.com/ageisegy/" target="_blank">
            <i class="fa fa-instagram"></i>
        </a>
        &nbsp; &nbsp;
        <a href="https://www.tiktok.com/@ageisegy" target="_blank">
            <i class="fa fa-tiktok"></i>
        </a>
        <div class="text-center">
            <p>&copy; 2024 AGIESIGY. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#splide', {
            type    : 'loop',
            perPage : 3, /* عرض 3 صور في كل مرة */
            focus   : 'center',
            gap     : '1rem',
            overflow: true,
            padding : {
                left : '5rem',
                right: '5rem',
            },
            autoplay: true, /* تفعيل التشغيل التلقائي */
            interval: 3000, /* المدة الزمنية بين كل انتقال (بالمللي ثانية) */
            breakpoints: {
                768: {
                    perPage: 1, /* عرض صورة واحدة فقط على الأجهزة المحمولة */
                    padding: {
                        left : '1rem',
                        right: '1rem',
                    },
                },
            },
        }).mount();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
</body>
</html>
