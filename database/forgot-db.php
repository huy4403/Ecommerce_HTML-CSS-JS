<?php
include("connect.php");
$tel = $_POST['tel'];

$sql = "SELECT * FROM users WHERE tel = $tel";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Success";
} else {
    echo "Số điện thoại chưa tồn tại trong hệ thống";
}
$result->close();
$conn->close();
