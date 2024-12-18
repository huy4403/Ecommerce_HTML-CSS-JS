<?php
include("session.php");

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['id']) && !isset($_SESSION['admin'])) {
    // Ngắt kết nối với cơ sở dữ liệu MySQL (điều này có thể thay đổi tùy theo cách bạn đã thiết lập kết nối
    session_unset(); // Loại bỏ tất cả các biến phiên
    session_destroy();

    // Điều hướng người dùng đến trang đăng nhập hoặc trang chính sau khi đăng xuất (tùy thuộc vào yêu cầu của bạn)
    header("Location: ../index.php");
    exit();
}
if (isset($_SESSION['admin'])) {
    session_unset(); // Loại bỏ tất cả các biến phiên
    session_destroy();

    // Điều hướng người dùng đến trang đăng nhập hoặc trang chính sau khi đăng xuất (tùy thuộc vào yêu cầu của bạn)
    header("Location: ../view/login.php");
    exit();
}
