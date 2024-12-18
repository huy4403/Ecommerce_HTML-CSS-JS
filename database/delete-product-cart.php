<?php
include("../database/connect.php");
include("../database/session.php");


if (isset($_GET['idsp']) && isset($_POST['size'])) {
    $productID = $_GET['idsp'];
    $size = $_POST['size'];
    $time = time();

    $sql_cart_details = "SELECT * FROM cart_details WHERE idsp = ? AND size = ? AND id_cart = ?";
    $stmt_cart_details = $conn->prepare($sql_cart_details);
    if ($stmt_cart_details) {
        //check car_details
        $stmt_cart_details->bind_param("isi", $productID, $size, $_SESSION['id_cart']);
        $stmt_cart_details->execute();
        $result_cart_details = $stmt_cart_details->get_result();
        if ($result_cart_details->num_rows > 0) {
            //tìm thấy cart_details
            // Assuming there's only one cart per user; adjust the logic if needed
            $row_cart_details = $result_cart_details->fetch_assoc();
            //gán giá trị
            $thanhtien = intval(preg_replace('/[,.]/', '', $row_cart_details['thanhtien']));
        } else {
            echo 'không có giá trị';
        }
    } else {
        echo "stmt_cart_details fail";
    }

    $sql_cart_price = "SELECT * FROM cart WHERE id = ? AND id_user = ?";
    $stmt_cart_price = $conn->prepare($sql_cart_price);
    if ($stmt_cart_price) {
        //check car_details
        $stmt_cart_price->bind_param("ii", $_SESSION['id_cart'], $_SESSION['id']);
        $stmt_cart_price->execute();
        $result_cart_price = $stmt_cart_price->get_result();
        if ($result_cart_price->num_rows > 0) {
            //tìm thấy cart_details
            // Assuming there's only one cart per user; adjust the logic if needed
            $row_cart_price = $result_cart_price->fetch_assoc();
            //gán giá trị
            $tongtien = intval(preg_replace('/[,.]/', '', $row_cart_price['tongtien']));
        } else {
            echo 'không có giá trị';
        }
    } else {
        echo "stmt_cart_price fail";
    }
    $price = $tongtien - $thanhtien;
    $Formatprice = number_format($price);


    //xóa  cart_details
    $deleteQuery = "DELETE FROM cart_details WHERE idsp = ? AND id_cart = ? AND size = ?";
    // Use prepared statement to prevent SQL injection
    //Xóa thành công cart details
    if ($stmt = $conn->prepare($deleteQuery)) {
        $stmt->bind_param("iis", $productID, $_SESSION['id_cart'], $size);
        $stmt->execute();
        //xóa thành công cart details
        //Kiểm tra xem còn cart detailss k
        $sql_cart_details_no_id = "SELECT * FROM cart_details WHERE id_cart =" . $_SESSION['id_cart'];
        $result_cart_details_no_id = $conn->query($sql_cart_details_no_id);
        if (mysqli_num_rows($result_cart_details_no_id) == 0) {
            include("delete-cart.php");
            header("location: ../view/cart.php");
            //k còn cart detail -> xóa cart
        } else {

            $sql_update_tongtien = "UPDATE cart SET tongtien = ?, last_updated=? WHERE id = ? AND id_user=?";
            $stmt_update_tongtien = $conn->prepare($sql_update_tongtien);

            if ($stmt_update_tongtien) {
                $stmt_update_tongtien->bind_param("siii", $Formatprice, $time, $_SESSION['id_cart'], $_SESSION['id']);
                if ($stmt_update_tongtien->execute()) {
                    header("location: ../view/cart.php");
                } else {
                    echo "Update tongtien failed: " . $stmt_update_tongtien->error;
                }
            } else {
                echo 'stmt_update_tongtien fail';
            }
        }
        // Close the statement
        $stmt_cart_details->close();
        $stmt_cart_price->close();
        $stmt_update_tongtien->close();
        $stmt->close();
        $conn->close();
    }
}
