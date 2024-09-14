<?php
session_start();

// تكوين الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استعلام للحصول على تفاصيل المنتج بناءً على معرف المنتج
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;

if ($product_id > 0) {
    $stmt = $conn->prepare("SELECT name, description, price, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Information</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-black-white {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            position: relative;
            overflow: hidden;
            background-color: black;
            color: white;
            border: none;
            transition: color 0.4s;
        }
        .btn-black-white::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: white;
            transition: all 0.75s;
            z-index: 1;
            opacity: 0;
            transform: translate(-50%, -50%) rotate(45deg);
        }
        .btn-black-white:active::before {
            opacity: 1;
            width: 110%;
            height: 110%;
        }
        .btn-black-white span {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            position: relative;
            z-index: 2;
        }
        .btn-black-white:active {
            color: black;
        }

        .size-buttons { color: font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;;
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .size-buttons button {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 5px 10px; /* تم تصغير حجم padding */
            font-size: 12px; /* تم تصغير حجم الخط */
            cursor: pointer;
        }
        .size-buttons button.active {
            background-color: black;
            color: white;
        }

        .product-container {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }
        .product-container img {
            width: 200px;
            height: auto;
        }
        .product-details {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            max-width: 350px;
        }
        .main-navbar {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            border-bottom: 1px solid #ccc;
        }
        .main-navbar .top-navbar {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            background-color: #000000;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .main-navbar .top-navbar .brand-name {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            color: #fff;
        }
        .main-navbar .top-navbar .nav-link {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;
            color: #fff;
            font-size: 16px;

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
            .size-buttons {
                gap: 5px; /* تصغير المسافة بين الأزرار عند العرض على الشاشات الصغيرة */
            }
            .size-buttons button {
                padding: 5px 8px; /* تصغير الـ padding أكثر عند العرض على الشاشات الصغيرة */
                font-size: 10px; /* تصغير الخط أكثر للشاشات الصغيرة */
            }
        }
    </style>
</head>
<body>
<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <h5 class="brand-name">EGIESIGY</h5>
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
            <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="store.php">
                EGIESIGY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php.php">Home</a>
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

<div class="container mt-5">
    <?php if ($product): ?>
        <div class="product-container">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <div class="product-details">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p calss="card-text">⭐⭐⭐⭐⭐</p>
                <p>Price: <?php echo number_format($product['price'], 2); ?> EGP</p>

                <!-- Form to add the product to the cart -->
                <form id="addToCartForm" method="POST" action="cart.php">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product_id); ?>">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                    <input type="hidden" name="image" value="<?php echo htmlspecialchars($product['image']); ?>">

                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <div class="size-buttons">
                            <button type="button" class="btn" data-size="M">M</button>
                            <button type="button" class="btn" data-size="L">L</button>
                            <button type="button" class="btn" data-size="XL">XL</button>
                            <button type="button" class="btn" data-size="2XL">2XL</button>
                        </div>
                        <input type="hidden" name="size" id="sizeInput" required>
                    </div>

                    <button type="submit" class="btn btn-black-white">
                        <span>Add to Cart</span>
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.size-buttons button').on('click', function() {
            $('.size-buttons button').removeClass('active');
            $(this).addClass('active');
            $('#sizeInput').val($(this).data('size'));
        });

        $('#addToCartForm').on('submit', function(e) {
            if ($('#sizeInput').val() === '') {
                e.preventDefault();
                alert('Please select a size.');
            }
        });
    });
</script>
</body>
</html>
