<?php
include("connect.php");
include("session-admin.php");
$last_update = time();
$id = $_POST['id'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];
$gender = $_POST['option'];
$dob = $_POST['dob'];


// Câu truy vấn
$sql = "UPDATE users SET name=?, tel=?, password=?, email=?, address=?, gender=?, birthdate=?, last_updated=? WHERE id=?";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sssssssii", $name, $tel, $password, $email, $address, $gender, $dob, $last_update, $id);

// Thực thi câu truy vấn
$result = $stmt->execute();

// Check if the query was successful
if ($result) {
    // Chuyển về trang hiển thị để kiểm tra đã sửa chưa
    header("Location: javascript://history.go(-1)");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
