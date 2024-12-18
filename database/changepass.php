<?php
include("session.php");
include("connect.php");
$pass1 = $_POST['pass1'];
$iduser = $_SESSION['id'];

$sql_check = "SELECT * FROM users WHERE id = $iduser AND password = '$pass1'";
$result = $conn->query($sql_check);
if ($result->num_rows > 0) {
    echo "Mật khẩu mới không được trùng với mật khẩu cũ";
} else {
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("si", $pass1, $iduser);

        // Execute the statement
        $stmt->execute();

        // Check for success
        if ($stmt) {
            echo "success";
        } else {
            echo "Không thể thay đổi mật khẩu";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} // Close the database connection
$conn->close();
