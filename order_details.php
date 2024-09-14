<?php
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

// التحقق من وجود order_id في الرابط لعرض تفاصيل الطلب المحدد
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// استعلام لاسترجاع تفاصيل الطلب بناءً على order_id إذا تم تحديده
$orderDetails = [];
$cartDetails = [];
if ($order_id > 0) {
    $sqlOrderDetails = "SELECT * FROM orders WHERE id = ?";
    $stmtOrderDetails = $conn->prepare($sqlOrderDetails);
    $stmtOrderDetails->bind_param("i", $order_id);
    $stmtOrderDetails->execute();
    $orderResult = $stmtOrderDetails->get_result();

    if ($orderResult->num_rows > 0) {
        $orderDetails = $orderResult->fetch_assoc();
    } else {
        echo "No order found with the given ID.";
    }

    $sqlCartDetails = "SELECT * FROM cart WHERE order_id = ?";
    $stmtCartDetails = $conn->prepare($sqlCartDetails);
    $stmtCartDetails->bind_param("i", $order_id);
    $stmtCartDetails->execute();
    $cartResult = $stmtCartDetails->get_result();
    while ($row = $cartResult->fetch_assoc()) {
        $cartDetails[] = $row;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 20px;
        }
        .product-image {
            width: 100px; /* Adjust as needed */
            height: auto;
        }
    </style>
</head>
<body>
<div class="container table-container">
    <?php if (!empty($orderDetails)): ?>
        <h2>Order Details for Order ID: <?php echo htmlspecialchars($orderDetails['id']); ?></h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($orderDetails['name']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($orderDetails['phone']); ?></p>
        <p><strong>Second Phone:</strong> <?php echo htmlspecialchars($orderDetails['second_phone']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($orderDetails['address']); ?></p>
        <p><strong>Total Price:</strong> <?php echo number_format($orderDetails['total_price'], 2); ?> EGP</p>

        <h4>Products in this Order</h4>
        <?php if (!empty($cartDetails)): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Size</th>
                    <th>Image</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cartDetails as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td><?php echo number_format($product['product_price'], 2); ?> EGP</td>
                        <td><?php echo htmlspecialchars($product['product_size']); ?></td>
                        <td>
                            <?php if (!empty($product['product_image'])): ?>
                                <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="product-image">
                            <?php else: ?>
                                No image available
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found for this order.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>No order details found for the given Order ID.</p>
    <?php endif; ?>
</div>

<?php
// إغلاق الاستعلامات
if ($order_id > 0) {
    $stmtOrderDetails->close();
    $stmtCartDetails->close();
}
$conn->close();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
