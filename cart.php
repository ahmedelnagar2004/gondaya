<?php
session_start(); // تأكد من بدء الجلسة

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

// تحقق من إذا كانت هناك بيانات مرسلة بواسطة النموذج وأضفها إلى العربة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['name'], $_POST['price'], $_POST['size'], $_POST['image'])) {
    $product = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'size' => $_POST['size'],
        'image' => $_POST['image'],
        'quantity' => 1 // الكمية الافتراضية هي 1
    ];

    // إذا لم تكن هناك عربة مخزنة في الجلسة، أنشئ عربة جديدة
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // تحقق مما إذا كان المنتج موجودًا بالفعل في العربة وقم بزيادة الكمية إذا كان موجودًا
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product['id'] && $item['size'] == $product['size']) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // إذا لم يكن المنتج موجودًا في العربة، أضفه
    if (!$found) {
        $_SESSION['cart'][] = $product;
    }
}

// حذف عنصر من العربة إذا تم الضغط على زر الحذف
if (isset($_GET['confirm_remove'])) {
    $index = $_GET['confirm_remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // إعادة ترتيب العربة بعد الحذف
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// تحديث الكمية في العربة
if (isset($_GET['update_quantity'])) {
    $index = $_GET['update_quantity'];
    $action = $_GET['action'];
    if (isset($_SESSION['cart'][$index])) {
        if ($action == 'increase') {
            $_SESSION['cart'][$index]['quantity'] += 1;
        } elseif ($action == 'decrease') {
            $_SESSION['cart'][$index]['quantity'] -= 1;
            // إذا أصبحت الكمية أقل من 1، قم بإزالة المنتج من العربة
            if ($_SESSION['cart'][$index]['quantity'] < 1) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }
    }
}

// حساب مجموع الأسعار
$totalPrice = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $product) {
        if (isset($product['quantity'])) {
            $totalPrice += $product['price'] * $product['quantity'];
        }
    }
}

// إذا تم إرسال نموذج الدفع، قم بتخزين البيانات في قاعدة البيانات وإعادة التوجيه إلى صفحة المتجر
$showSuccessModal = false; // متغير لتحديد ما إذا كان يجب عرض Modal النجاح
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $second_phone = isset($_POST['second_phone']) ? $_POST['second_phone'] : null;
    $address = $_POST['address'];

    // إدراج البيانات في جدول الطلبات
    $stmt = $conn->prepare("INSERT INTO orders (name, phone, second_phone, address, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $name, $phone, $second_phone, $address, $totalPrice);

    if ($stmt->execute()) {
        $orderId = $stmt->insert_id; // الحصول على ID الطلب الجديد

        // إدراج بيانات العربة في جدول cart
        foreach ($_SESSION['cart'] as $product) {

            $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name, product_price, product_size, product_image, quantity, order_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isdssii", $product['id'], $product['name'], $product['price'], $product['size'],  $product['image'], $product['quantity'], $orderId);
            $stmt->execute();
        }

        // إزالة العربة بعد نجاح الإرسال
        unset($_SESSION['cart']);
        $showSuccessModal = true; // تعيين المتغير لعرض Modal النجاح
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Baskervville SC", serif;
            font-weight: 400;
            font-style: normal;

        }
        .btn-black-white {
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
            position: relative;
            z-index: 2;
        }
        .btn-black-white:active {
            color: black;
        }
        .btn-black-white-red {
            background-color: black;
            color: white;
            border: none;
        }
        .btn-black-white-red:hover {
            background-color: #ffffff;
        }
        .btn-black-white-red:active {
            background-color: #ffffff;
        }
        .navbar {
            background-color: #000000;
        }
        .navbar .nav-link {
            color: white;
        }
        .navbar .nav-link:hover {
            color: #f8f9fa;
        }
        .modal-content {
            border-radius: 0.5rem;
        }
        .cart-item {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .cart-footer {
            border-top: 1px solid #ddd;
            padding-top: 1rem;
            margin-top: 1rem;
        }
        .footer {
            background-color: #000000;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
        .modal-body {
            padding: 1.5rem;
        }
        .brand-name {
            font-size: 1.5rem;
            color: #fff;
            font-weight: bold;
        }
        .btn-quantity {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            background-color: #000;
            color: #fff;
            cursor: pointer;
        }
        .btn-quantity:not(:last-child) {
            margin-right: 5px;
        }
        .quantity-container {
            display: flex;
            align-items: center;
        }
        .quantity-value {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<div class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">AGIESIGY</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="store.php">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php.php">Home</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2>Shopping Cart</h2>

    <!-- Cart Items -->
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <div class="cart-items">
            <?php foreach ($_SESSION['cart'] as $index => $product): ?>
                <div class="cart-item row mb-3 p-3">
                    <div class="col-md-3">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h5><?= htmlspecialchars($product['name']) ?></h5>
                        <p>Size: <?= htmlspecialchars($product['size']) ?></p>
                        <p>Price: $<?= number_format($product['price'], 2) ?></p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-between align-items-center">
                        <div class="quantity-container">
                            <button class="btn btn-black-white-red" onclick="updateQuantity(<?= $index ?>, 'decrease')">-</button>
                            <input type="text" class="quantity-value" value="<?= $product['quantity'] ?>" readonly>
                            <button class="btn btn-black-white-red" onclick="updateQuantity(<?= $index ?>, 'increase')">+</button>
                        </div>
                        <a href="cart.php?confirm_remove=<?= $index ?>" class="btn btn-black-white btn-remove" data-index="<?= $index ?>">Remove</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Cart Footer -->
        <div class="cart-footer">
            <h4>Total Price: $<?= number_format($totalPrice, 2) ?></h4>
            <button class="btn btn-black-white" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="cart.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="second_phone" class="form-label">Second Phone Number (optional)</label>
                        <input type="text" class="form-control" id="second_phone" name="second_phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="checkout" value="true">
                    <button type="submit" class="btn btn-black-white">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Confirmation Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Order Successful</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-check-circle fa-3x text-success" aria-hidden="true"></i>
                <p class="mt-2">Your order has been placed successfully!</p>
            </div>
            <div class="modal-footer">
                <a href="store.php" class="btn btn-black-white">Okay</a>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 AGEISEGY. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // عرض Modal النجاح إذا تم تعيين المتغير showSuccessModal
        <?php if (isset($showSuccessModal) && $showSuccessModal): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        <?php endif; ?>
    });

    function updateQuantity(index, action) {
        var url = 'cart.php?update_quantity=' + index + '&action=' + action;
        window.location.href = url;
    }
</script>
</body>
</html>
