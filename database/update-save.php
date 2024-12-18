<?php
include("connect.php");
include("session.php");
$last_update = time();
$name = $_POST['name'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$address = $_POST['address'];
$gender = $_POST['option'];
$dob = $_POST['dob'];


// Câu truy vấn
$sql = "update users set name='$name', tel='$tel', email='$email',address='$address', gender='$gender', birthdate='$dob', last_updated='$last_update' where id=" . $_SESSION['id'];

// Thực thi câu truy vấn
$stmt = $conn->prepare($sql);
$stmt->execute();

// Chuyển về trang hiển thị để kiểm tra đã sửa chưa
header("Location: javascript://history.go(-1)");
exit;
