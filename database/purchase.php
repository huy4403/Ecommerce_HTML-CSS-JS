<?php
include("connect.php");
include("session.php");

$sql = "SELECT * FROM cart WHERE id = ? AND id_user= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $_SESSION['id_cart'], $_SESSION['id']);
// Execute the query
$stmt->execute();
// Get the result set
$result = $stmt->get_result();
// Process the results as needed
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Access individual columns using $row['column_name']
    // Example: $row['name_user'], $row['tel_user'], etc.
} else {
    echo "Không có cart ID: " . $_SESSION['id_cart'] . " của user ID: " . $_SESSION['id'];
}

$time = time();
$tienInt = intval(preg_replace('/[,.]/', '', $row['tongtien']));
$sql_purchase = "INSERT INTO purchase (id_user, name_user, tel_user, address_user, dongia, thanhtienint, created_time, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_purchase = $conn->prepare($sql_purchase);

if ($stmt_purchase) {
    $stmt_purchase->bind_param("sssssiii", $_SESSION['id'], $row['name_user'], $row['tel_user'], $row['address_user'], $row['tongtien'], $tienInt, $time, $time);

    if ($stmt_purchase->execute()) {
        $last_inserted_id = $conn->insert_id;

        // Store the ID in the session
        $_SESSION['id_purchase'] = $last_inserted_id;
        // Fetch cart details inside the loop
        $sql_cart_details = "SELECT * FROM cart_details WHERE id_cart = ? ORDER BY created_time DESC";
        $stmt_cart_details = $conn->prepare($sql_cart_details);
        $stmt_cart_details->bind_param("i", $_SESSION['id_cart']);
        // Execute the query
        $stmt_cart_details->execute();
        // Get the result set
        $result_cart_details = $stmt_cart_details->get_result();
        // Process the results as needed
        if ($result_cart_details->num_rows > 0) {
            while ($row_cart_details = $result_cart_details->fetch_assoc()) {
                $sql_purchase_detail = "INSERT INTO purchase_details (id_purchase, name_sp, color, size, masp, img, giatien, soluong, thanhtien, created_time, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_purchase_detail = $conn->prepare($sql_purchase_detail);

                if ($stmt_purchase_detail) {
                    $stmt_purchase_detail->bind_param("issssssisii", $_SESSION['id_purchase'], $row_cart_details['name_sp'], $row_cart_details['color'], $row_cart_details['size'], $row_cart_details['masp'], $row_cart_details['img'], $row_cart_details['giatien'], $row_cart_details['soluong'], $row_cart_details['thanhtien'], $time, $time);

                    if ($stmt_purchase_detail->execute()) {
                        $sql_update_quantity = "UPDATE sanpham SET soluong = soluong - ?, best_seller = best_seller + ? WHERE masp = ?";
                        $stmt_update_quantity = $conn->prepare($sql_update_quantity);

                        if ($stmt_update_quantity) {
                            $stmt_update_quantity->bind_param("iis", $row_cart_details['soluong'], $row_cart_details['soluong'], $row_cart_details['masp']);

                            if ($stmt_update_quantity->execute()) {

                                $sql_gianhap = "SELECT * FROM sanpham WHERE masp = ?";
                                $stmt_gianhap = $conn->prepare($sql_gianhap);

                                if ($stmt_gianhap) {
                                    $stmt_gianhap->bind_param("s", $row_cart_details['masp']);

                                    if ($stmt_gianhap->execute()) {
                                        $result_gianhap = $stmt_gianhap->get_result();  // Fetch the result
                                        $row_gianhap = $result_gianhap->fetch_assoc();  // Fetch a single row
                                        $gianhapint = intval(preg_replace('/[,.]/', '', $row_gianhap['gianhap']));
                                        $giabanint = intval(preg_replace('/[,.]/', '', $row_gianhap['giaban']));
                                        $thanhtienint = ($giabanint - $gianhapint) * $row_cart_details['soluong'];
                                        $sql_thongke = "INSERT INTO thongke (masp, iddm, daban, doanhthu, created_time) VALUES (?, ?, ?, ?, ?)";
                                        $stmt_thongke = $conn->prepare($sql_thongke);
                                        if ($stmt_thongke) {
                                            $stmt_thongke->bind_param("siiii", $row_cart_details['masp'], $row_gianhap['iddm'], $row_cart_details['soluong'], $thanhtienint, $time);
                                            if ($stmt_thongke->execute()) {
                                            } else {
                                                echo "Không thể gán giá trị " . $stmt_thongke->error;
                                            }
                                        }

                                        // Now you can use $row_gianhap as needed
                                    } else {
                                        // Handle the execution error
                                        echo "Error executing the statement: " . $stmt_gianhap->error;
                                    }

                                    $stmt_gianhap->close();  // Close the statement
                                } else {
                                    // Handle the preparation error
                                    echo "Error preparing the statement: " . $conn->error;
                                }
                            } else {
                                echo "Update quantity failed: " . $stmt_update_quantity->error;
                            }

                            $stmt_update_quantity->close();
                        } else {
                            echo "Prepare statement failed for quantity update: " . $conn->error;
                        }
                        // Thêm thành công purchase_details
                    } else {
                        echo "Insert failed: " . $stmt_purchase_detail->error;
                    }

                    $stmt_purchase_detail->close();
                } else {
                    echo "Prepare statement failed: " . $conn->error;
                }
            }

            // Thành công
            include("delete-cart.php");
            header("location: ../view/profile.php?purchase");
        } else {
            echo "Không có cart ID: " . $_SESSION['id_cart'] . " của user ID: " . $_SESSION['id'];
        }
    } else {
        echo "Insert failed: " . $stmt_purchase->error;
    }

    $stmt_purchase->close();
} else {
    echo "Prepare statement failed: " . $conn->error;
}
