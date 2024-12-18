<?php
include("connect.php");
include("session-admin.php");
// Thực hiện câu truy vấn UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idpurchase']) && isset($_POST['status'])) {
    $idpurchase = $_POST['idpurchase'];
    $newStatus = $_POST['status'];

    // Thực hiện câu truy vấn UPDATE
    $sql_update = "UPDATE purchase SET status = '$newStatus' WHERE id = '$idpurchase'";

    if ($conn->query($sql_update) === TRUE) {
        header("location: ../view/admin-panel.php");
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
} else {
    // Trường hợp không có tham số hoặc không phải là yêu cầu POST
    echo "Không có dữ liệu cập nhật được gửi.";
}