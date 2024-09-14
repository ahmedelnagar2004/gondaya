<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productDescription = $_POST['productDescription'];
    $productImage = $_FILES['productImage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($productImage);

    // نقل الملف إلى مجلد 'uploads'
    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $target_file)) {
        // إعداد الاستعلام
        $sql = "INSERT INTO products (name, price, description, image) VALUES ('$productName', '$productPrice', '$productDescription', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "تم إضافة المنتج بنجاح!";
        } else {
            echo "خطأ: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "عذراً، حدث خطأ أثناء رفع الملف.";
    }
}
header('Location: dashbord.php');
$conn->close();
?>

