<?php
include 'db_connect.php';

// التحقق من وجود معرف للمنتج
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // حذف المنتج من قاعدة البيانات
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // جلب قائمة المنتجات المحدثة
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // عرض المنتجات ككروت
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="'.$row["image"].'" class="card-img-top" alt="'.$row["name"].'">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row["name"].'</h5>';
                echo '<p class="card-text">'.$row["description"].'</p>';
                echo '<p class="card-text"><strong>السعر: </strong>'.$row["price"].' جنيهاً</p>';
                echo '<button class="btn btn-danger" onclick="confirmDelete('.$row["id"].')">حذف</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>لا توجد منتجات لعرضها.</p>';
        }

        // إغلاق الاتصال
        $result->free();
        $conn->close();
    } else {
        echo "خطأ في حذف المنتج: " . $stmt->error;
    }

    // إغلاق الاستعلام
    $stmt->close();
} else {
    echo "لم يتم تحديد معرف المنتج.";
}
?>
