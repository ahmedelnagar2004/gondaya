<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> AGEISEGY | SIZE SHART </title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-navbar {
            border-bottom: 1px solid #ccc;
        }
        .main-navbar .top-navbar {
            background-color: #000000;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .main-navbar .top-navbar .brand-name {
            color: #fff;
        }
        .main-navbar .top-navbar .nav-link {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
        }
        .main-navbar .top-navbar .dropdown-menu {
            padding: 0px 0px;
            border-radius: 0px;
        }
        .main-navbar .top-navbar .dropdown-menu .dropdown-item {
            padding: 8px 16px;
            border-bottom: 1px solid #ccc;
            font-size: 14px;
        }
        .main-navbar .top-navbar .dropdown-menu .dropdown-item i {
            width: 20px;
            text-align: center;
            color: #000000;
            font-size: 14px;
        }
        .main-navbar .navbar {
            padding: 0px;
            background-color: #ddd;
        }
        .main-navbar .navbar .nav-item .nav-link {
            padding: 8px 20px;
            color: #000;
            font-size: 15px;
        }
        @media only screen and (max-width: 600px) {
            .main-navbar .top-navbar .nav-link {
                font-size: 12px;
                padding: 8px 10px;
            }
        }
        .footer {
            background-color: #000000; /* Dark Black */
            color: #ffffff; /* White Text */
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0;
            text-align: center;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .image-container {
            width: 300px;
            height: 300px;
            overflow: hidden;
            margin: 20px auto;
            /* Center the images horizontally */
        }
        .image-container img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 1s ease-in-out;
        }
        .image-container:hover img {
            transform: scale(1.1);
        }
        .centered-images {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 60px); /* Adjust the height to fit your design */
            /* Center vertically */
        }
        body {
            /* Background Animation */
            background: linear-gradient(45deg, #ffffff, #000000);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }
    </style>
</head>
<body>
<div class="main-navbar shadow-sm sticky-top">
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
                        <li class="nav-item">
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
                EGIESIGY
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
            </div>
        </div>
    </nav>
</div>

<div class="centered-images">
    <div class="image-container">
        <img src="WhatsApp%20Image%202024-07-25%20at%2021.16.47_a99195f9.jpg" alt="photo">
    </div>
    <div class="image-container">
        <img src="WhatsApp%20Image%202024-07-25%20at%2021.16.47_d097faf9.jpg" alt="photo">
    </div>
</div>
<BR>
<BR>

<BR>
<BR>

<footer class="footer">
    <div class="container">
        <a href="https://www.instagram.com/yourprofile" target="_blank">
            <i class="fa fa-instagram fa-2x"></i>
        </a>
        <div class="mt-2">
            <p class="mb-0">Discover the latest fashion trends and styles at EGIESIGY. Your go-to destination for all things stylish!</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

