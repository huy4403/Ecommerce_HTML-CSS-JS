<?php
include("connect.php");
include("session-admin.php");
$id = $_GET['id'];

$query = "DELETE FROM sanpham WHERE id = ?";

// Thực thi truy vấn
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id); // Giả sử 'id' là kiểu số nguyên (integer)
$stmt->execute();

// Kiểm tra xem đã xóa thành công hay không
if ($stmt->affected_rows > 0) {
    echo "<script> alert('Xóa thành công San pham ID: $id'); </script>";
} else {
    echo "<script> alert('Không thể xóa San pham ID: $id'); </script>";
}

// Đóng kết nối và statement
$stmt->close();
$conn->close();

// Chuyển hướng sau khi thực hiện xóa
header("Location: javascript://history.go(-1)");
