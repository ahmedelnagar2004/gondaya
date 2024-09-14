<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGIESIGY STORE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Tajawal", sans-serif;
            font-weight: 600;
            font-style: normal;
        }
        .navbar {
            background-color:black;
        }
        .navbar-nav {
            flex-direction: row; /* ترتيب العناصر بجانب بعضها */
            margin: auto; /* لتوسيط العناصر */
        }
        .navbar-nav .nav-item {
            margin-left: 20px; /* إضافة مسافة بين العناصر */
            margin-right: 20px; /* إضافة مسافة بين العناصر */
        }
        .slider {
            background-color: #f8f9fa;
            padding: 30px 0;
        }
        .carousel-inner {
            height: 500px;
        }
        .carousel-item img {
            object-fit: cover;
            width: 100%;
            height: 500px;
        }
        .company-info, .products, .contact-info {
            padding: 30px 0;
        }
        .footer {
            margin-bottom:0px;
            background-color: #ffffff;
            color: rgba(0, 0, 0, 0.73);
        }
        .img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .icons-carousel {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .icons-carousel .carousel-item {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .icons-carousel i {
            font-size: 50px;
            color: #000;
        }
    </style>
</head>
<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">
<h1 class="barnd-name"
style="text-align: center;color: #adb5bd"

>Ageisegy</h1>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="store.php" target="_blank"> Ageisegy store</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php" target="_blank">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="size_shart.php" target="_blank">Size-Shart</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Slider Section -->
<section class="slider">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="WhatsApp Image 2024-08-17 at 14.42.27_eed5392e.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="WhatsApp Image 2024-07-30 at 00.15.49_baa42f64.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="WhatsApp Image 2024-07-30 at 00.15.49_9e58c460.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="WhatsApp Image 2024-07-30 at 00.15.46_4bae41e1.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">السابق</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">التالي</span>
            </a>
        </div>
    </div>
</section>

<!-- Company Info Section -->
<section class="company-info text-center">
    <div class="container">
        <h2>Who We Are</h2>
        <p> In AGIESIGY,We seek to provide the best in fashion</p>
        <a href="https://www.instagram.com/ageisegy/" target="_blank">Get to know us</a>
    </div>
</section>




<!-- Products Section -->
<section class="products text-center bg-light">
    <div class="container">
        <h2>New Collection</h2>
        <div class="row">
            <div class="col-md-4">
                <h4>Item 1</h4>
                <p>Slim fit t-shirt</p>
                <img class="img" src="WhatsApp Image 2024-07-30 at 00.11.35_ea4261b8.jpg">
            </div>
            <div class="col-md-4">
                <h4>Item 2</h4>
                <p>Slim fit t-shirt</p>
                <img class="img" src="WhatsApp Image 2024-07-30 at 00.11.35_c86eae3f.jpg">
            </div>
            <div class="col-md-4">
                <h4>Item 3</h4>
                <p>Slim fit t-shirt</p>
                <img class="img" src="WhatsApp Image 2024-07-30 at 00.11.36_b36b2bab.jpg">
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="contact-info text-center">
    <div class="container">
    </div>
</section>

<!-- Footer -->
<footer class="footer text-center">
    <div class="container">

        <p style="color:black "> In AGIESIGY  you will find  the best quality , last fashion ,refund service. </p>

        <br>
        <p> &copy; 2024 AGIESIGY. All Rights Reserved.</p>

    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome -->
</body>
</html>
