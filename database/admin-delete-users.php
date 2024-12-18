<?php
include("connect.php");
include("session-admin.php");
$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = ?";

// Thực thi truy vấn
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id); // Giả sử 'id' là kiểu số nguyên (integer)
$stmt->execute();

echo "<script> alert('Xóa thành công KH ID: $id'); </script>";

// Đóng kết nối và statement
$stmt->close();
$conn->close();

// Chuyển hướng sau khi thực hiện xóa
header('location:../view/admin-panel.php?pg=qlkh');
