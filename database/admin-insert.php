<?php
include("connect.php");

    $name = $_POST["name"];
    $masp = $_POST["masp"];
    $color = $_POST["color"];
    $gianhap = $_POST["gianhap"];
    $giaban = $_POST["giaban"];
    $soluong = $_POST["soluong"];
    $img1 = $_POST["img1"];
    $img2 = $_POST["img2"];
    $img3 = $_POST["img3"];
    $img4 = $_POST["img4"];
    $img5 = $_POST["img5"];
    $ghichu = $_POST["ghichu"];
    $iddm = $_POST["iddm"];
    $time = time();
    // SQL query with placeholders
    $sqlSelect = "SELECT * FROM sanpham WHERE masp = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    // Bind the parameter
    $stmtSelect->bind_param("s", $masp);
    // Execute the query
    $stmtSelect->execute();
    // Store the result
    $result = $stmtSelect->get_result();

    // Check if a record exists
    if ($result->num_rows == 0) {

        $query = "INSERT INTO sanpham (name, masp, color, gianhap, giaban, soluong, img1, img2, img3, img4, img5, ghichu, iddm, created_time, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind parameters with their respective data types
            // Adjust data types accordingly (e.g., s for string, i for integer, d for double, etc.)
            $stmt->bind_param("sssssissssssiii", $name, $masp, $color, $gianhap, $giaban, $soluong, $img1, $img2, $img3, $img4, $img5, $ghichu, $iddm, $time, $time);

            // Execute the query 
            if ($stmt->execute()) {
                echo "Thêm thành công sản phẩm";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error in preparing the statement: " . $conn->error;
        }
    } else {
        echo "Sản phẩm đã tồn tại";
    }
// Close the database connection
$conn->close();
