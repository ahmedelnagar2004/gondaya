<?php
include 'db_connect.php';

// التحقق من وجود رسالة في URL
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المنتجات</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmDelete(id) {
            $('#deleteModal').modal('show');
            document.getElementById('confirmDeleteBtn').dataset.id = id;
        }

        $(document).ready(function() {
            $('#confirmDeleteBtn').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'delete_product.php',
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        // تحديث المحتوى في الصفحة دون إعادة تحميلها
                        $('#productList').html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <h2>عرض المنتجات</h2>

    <!-- عرض الرسالة إذا كانت موجودة -->
    <?php if ($message): ?>
        <div class="alert alert-info">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div id="productList" class="row">
        <?php
        // جلب البيانات من جدول المنتجات
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
        ?>
    </div>
</div>

<!-- نافذة التأكيد (Modal) -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                هل أنت متأكد أنك تريد حذف هذا المنتج؟
            </div>
            <div class="modal-footer">
                <button id="confirmDeleteBtn" class="btn btn-danger" data-id="">حذف</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
