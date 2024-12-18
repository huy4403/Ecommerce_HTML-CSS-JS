<?php
include("connect.php");
    $tel = $_POST["tel"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $time = time();

    $checkExistQuery = "SELECT tel FROM users WHERE tel = '$tel'";
    $stmtCheckExist = mysqli_query($conn, $checkExistQuery);

    if (mysqli_num_rows($stmtCheckExist) > 0) {
        echo "Tài khoản đã tồn tại";
    } else {
            $query = "INSERT INTO users (tel, password, name, email, address, created_time) VALUES (?, ?, ?, ?, ?, ?)";

            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare($query);

            if ($stmt) {
                // Bind parameters with their respective data types
                $stmt->bind_param("sssssi", $tel, $password, $name, $email, $address, $time);

                // Execute the query
                if ($stmt->execute()) {
                    // Insert successful, redirect to the login page
                    echo "Đăng ký thành công!";
                } else {
                    echo "Insert failed: " . $stmt->error;
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                echo "Prepare statement failed: " . $conn->error;
            }
    }
    $stmtCheckExist->close();