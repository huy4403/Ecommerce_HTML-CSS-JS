<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $masp = $_POST["masp"];
    $color = $_POST["color"];
    $gianhap = $_POST["gianhap"];
    $giaban = $_POST["giaban"];
    $soluong = $_POST["soluong"];

    echo "<script>
        if($name.length == 0){
            window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Vui lòng nhập tên sản phẩm');
        }else if($masp.length == 0){
            window.location.href='../view/form-update-sanpham.php?id=$id';
            alert('Vui lòng nhập mã sản phẩm');
        }else if($color.length == 0){
            window.location.href='../view/form-update-sanpham.php?id=$id';
            alert('Vui lòng nhập màu sản phẩm');
        }else if($gianhap.length == 0){
            window.location.href='../view/form-update-sanpham.php?id=$id';
            alert('Vui lòng nhập giá nhập');
        }else if($giaban.length == 0){
            window.location.href='../view/form-update-sanpham.php?id=$id';
            alert('Vui lòng nhập giá bán');
        }else if($soluong.length == 0){
            window.location.href='../view/form-update-sanpham.php?id=$id';
            alert('Vui lòng nhập số lượng');
        }
        </script>";

    if(empty($name)){
        echo "<script>window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Vui lòng nhập tên sản phẩm')</script>";
    }else if(empty($masp)){
        echo "<script>window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Vui lòng nhập mã sản phẩm')</script>";
    }else if(empty($color)){
        echo "<script>window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Vui lòng nhập màu sắc sản phẩm')</script>";
    }else if(empty($gianhap)){
        echo "<script>window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Vui lòng nhập giá nhập của sản phẩm')</script>";
    }else if(empty($giaban)){
        echo "<script>window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Vui lòng nhập giá bán của sản phẩm')</script>";
    }else if(empty($soluong)){
        echo "<script>window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Vui lòng nhập số lượng')</script>";
    }

    if (empty($_POST["img1"])) {
        $img1 = $_POST["old_img1"];
    } else {
        $img1 = $_POST["img1"];
    }
    if (empty($_POST["img2"])) {
        $img2 = $_POST["old_img2"];
    } else {
        $img2 = $_POST["img2"];
    }
    if (empty($_POST["img3"])) {
        $img3 = $_POST["old_img3"];
    } else {
        $img3 = $_POST["img3"];
    }
    if (empty($_POST["img4"])) {
        $img4 = $_POST["old_img4"];
    } else {
        $img4 = $_POST["img4"];
    }
    if (empty($_POST["img5"])) {
        $img5 = $_POST["old_img5"];
    } else {
        $img5 = $_POST["img5"];
    }
    $ghichu = $_POST["ghichu"];
    $iddm = $_POST["iddm"];
    $time = time();
    // SQL query with placeholders
    $sqlSelect = "SELECT * FROM sanpham WHERE id = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    // Bind the parameter
    $stmtSelect->bind_param("i", $id);
    // Execute the query
    $stmtSelect->execute();
    // Store the result
    $result = $stmtSelect->get_result();

    // Check if a record exists
    if ($result->num_rows > 0) {

        $query = "UPDATE sanpham set name = ?, masp = ?, color = ?, gianhap = ?, giaban = ?, soluong = ?, img1 = ?, img2 = ?, img3 = ?, img4 = ?, img5 = ?, ghichu = ?, iddm = ?, last_updated = ? WHERE id = ?";

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind parameters with their respective data types
            // Adjust data types accordingly (e.g., s for string, i for integer, d for double, etc.)
            $stmt->bind_param("sssssissssssiii", $name, $masp, $color, $gianhap, $giaban, $soluong, $img1, $img2, $img3, $img4, $img5, $ghichu, $iddm, $time, $id);

            // Execute the query 
            if ($stmt->execute()) {
                echo "<script> window.location.href='../view/form-update-sanpham.php?id=$id'; alert('Cập nhật sản phẩm $masp thành công');</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error in preparing the statement: " . $conn->error;
        }
    } else {
        echo "<script> window.location='../view/admin-panel.php'; alert('Sản phẩm $masp không tồn tại');</script>";
    }
}

// Close the database connection
$conn->close();
