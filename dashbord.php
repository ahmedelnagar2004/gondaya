<?php
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="card text-center">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <h5 class="card-title">welcome Abdelrahman gondaya</h5>
        <p class="card-text">this page to control in all website</p>
        <a href="product.php" target="_blank" class="btn btn-primary"> dashbord store </a>
        <a href="orders.php" target="_blank" class="btn btn-primary"> dashbord order </a>
    </div>
    <div class="card-footer text-muted">
        2 days ago
    </div>
</div>
<div class="container mt-5">

    <h2>إضافة منتج جديد</h2>
    <form action="submit_product.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="productName">product name </label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="productname" required>
        </div>
        <div class="form-group">
            <label for="productPrice">productPrice</label>
            <input type="number" class="form-control" id="productPrice" name="productPrice"  placeholder="productPrice"required>
        </div>
        <div class="form-group">
            <label for="productDescription">وصف المنتج</label>
            <textarea class="form-control" id="productDescription" name="productDescription" rows="3" placeholder="productDescription" required></textarea>
        </div>
        <div class="form-group">
            <label for="productImage">productImage</label>
            <input type="file" class="form-control-file" id="productImage" name="productImage"  placeholder="productImage" required>
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
        <br>
        <br>

    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
