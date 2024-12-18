<?php
include("connect.php");
include("session.php");
$sql = "select * from users where id = " . $_SESSION['id'];
$stmt = $conn->query($sql);
if ($stmt->num_rows > 0) {
    // Lấy dữ liệu từ kết quả truy vấn và gán vào biến $result
    $row = $stmt->fetch_assoc();
} else {
    echo "Không có dữ liệu cho ID " . $_SESSION['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form
    $time = time();
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $idsp = $_POST['idsp'];  // Nếu có dữ liệu bổ sung
    // Thực hiện truy vấn để thêm dữ liệu vào cơ sở dữ liệu

    $sql_product = "SELECT * FROM sanpham WHERE id=?";
    $stmt_product = $conn->prepare($sql_product);

    if ($stmt_product) {
        $stmt_product->bind_param("i", $idsp);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();

        if ($result_product->num_rows > 0) {
            $row_product = $result_product->fetch_assoc();
            $gianhapint = intval(preg_replace('/[,.]/', '', $row_product['gianhap'])) * $quantity;
            $thanhtien = intval(preg_replace('/[,.]/', '', $row_product['giaban'])) * $quantity;
            $thanhtienint = $thanhtien - $gianhapint;
            $formatTongtien = number_format($thanhtien);
        } else {
            echo 'Không có sản phẩm trùng với idsp: ' . $idsp;
        }
    }

    if ($row_product['soluong'] < $quantity) {
        echo "Kho chỉ còn " . $row_product['soluong'] . " sản phẩm";
    } else {

        $sql_purchase = "INSERT INTO purchase (id_user, name_user, tel_user, address_user, dongia, thanhtienint, created_time, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_purchase = $conn->prepare($sql_purchase);

        if ($stmt_purchase) {
            $stmt_purchase->bind_param("sssssiii", $_SESSION['id'], $row['name'], $row['tel'], $row['address'], $formatTongtien, $thanhtien, $time, $time);

            if ($stmt_purchase->execute()) {
                $last_inserted_id = $conn->insert_id;
                // Store the ID in the session
                $_SESSION['id_purchase'] = $last_inserted_id;;

                $sql_purchase_detail = "INSERT INTO purchase_details (id_purchase, name_sp, color, size, masp, img, giatien, soluong, thanhtien, created_time, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_purchase_detail = $conn->prepare($sql_purchase_detail);

                if ($stmt_purchase_detail) {
                    $stmt_purchase_detail->bind_param("issssssisii", $_SESSION['id_purchase'], $row_product['name'], $row_product['color'], $size, $row_product['masp'], $row_product['img1'], $row_product['giaban'], $quantity, $formatTongtien, $time, $time);

                    if ($stmt_purchase_detail->execute()) {
                        $sql_update_quantity = "UPDATE sanpham SET soluong = soluong - ?, best_seller = best_seller + ? WHERE id = ?";
                        $stmt_update_quantity = $conn->prepare($sql_update_quantity);

                        if ($stmt_update_quantity) {
                            $stmt_update_quantity->bind_param("iii", $quantity, $quantity, $idsp);

                            if ($stmt_update_quantity->execute()) {
                                // Update successful
                                $sql_thongke = "INSERT INTO thongke (masp, iddm, daban, doanhthu, created_time) VALUES (?, ?, ?, ?, ?)";
                                $stmt_thongke = $conn->prepare($sql_thongke);
                                if ($stmt_thongke) {
                                    $stmt_thongke->bind_param("siiii", $row_product['masp'], $row_product['iddm'], $quantity, $thanhtienint, $time);
                                    if ($stmt_thongke->execute()) {
                                        echo "succes";
                                    } else {
                                        echo "Không thể gán giá trị " . $stmt_thongke->error;
                                    }
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
            } else {
                echo "Insert failed: " . $stmt_purchase->error;
            }

            $stmt_purchase->close();
        } else {
            echo "Prepare statement failed: " . $conn->error;
        }
    }
} else {
    echo "Khong nhan duọc request";
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
