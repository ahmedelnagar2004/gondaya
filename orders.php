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

// استعلام لاسترجاع جميع الطلبات
$sqlOrders = "SELECT * FROM orders";
$resultOrders = $conn->query($sqlOrders);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 20px;
        }
    </style>
</head>
<body>
<div class="container table-container">
    <h2>Orders</h2>
    <?php if ($resultOrders->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Second Phone</th>
                <th>Address</th>
                <th>Total Price</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($order = $resultOrders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                    <td><?php echo htmlspecialchars($order['phone']); ?></td>
                    <td><?php echo htmlspecialchars($order['second_phone']); ?></td>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                    <td><?php echo number_format($order['total_price'], 2); ?> EGP</td>
                    <td>
                        <a href="order_details.php?order_id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-info btn-sm">View Details</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
