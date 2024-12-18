<?php
session_start();
include("connect.php");
if (isset($_SESSION['id'])) {
    // Xóa toàn bộ phiên hiện tại
    session_unset();
    session_destroy();
}
$telInput = $_POST['tel'];
$passwordInput = $_POST['password'];

// Thực hiện truy vấn kiểm tra đăng nhập
$sql = "SELECT id, role FROM users WHERE tel = '$telInput' AND password = '$passwordInput'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Đăng nhập thành công
    $row = mysqli_fetch_assoc($result);
    // Lưu thông tin người dùng vào phiên
    $_SESSION['id'] = $row['id'];

    $sql_cart = "SELECT id FROM cart WHERE id_user =" . $_SESSION['id'];
    $result_cart = mysqli_query($conn, $sql_cart);
    if ($result_cart->num_rows > 0) {
        $row_cart = $result_cart->fetch_assoc();
        $_SESSION['id_cart'] = $row_cart['id'];
    }

    //Kiểm tra quyền admin
    $role = $row['role'];
    if ($role == 1) {
        $_SESSION['admin'] = true;
        echo "Đăng nhập thành công admin!";
    } else
        echo "Đăng nhập thành công!";
} else {
    // Đăng nhập không thành công
    echo "Tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại.";
}

// Đóng kết nối CSDL
$conn->close();
