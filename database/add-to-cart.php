<?php
include("connect.php");
include("session.php");

$sql_users = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
$result_users = $conn->query($sql_users);
if ($result_users->num_rows > 0) {
   $row_users = $result_users->fetch_assoc(); // Store user data in $row
}

if (isset($_GET['idsp'])) {
   $productID = $_GET['idsp'];

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $_SESSION['quantity'] = $_POST['quantity'];
      $_SESSION['size'] = $_POST['size'];
   }

   $sql_product = "SELECT * FROM sanpham WHERE id=?";
   $stmt_product = $conn->prepare($sql_product);

   if ($stmt_product) {
      $stmt_product->bind_param("i", $productID);
      $stmt_product->execute();
      $result_product = $stmt_product->get_result();

      if ($result_product->num_rows > 0) {
         $row_product = $result_product->fetch_assoc();
         $thanhtien = intval(preg_replace('/[,.]/', '', $row_product['giaban'])) * $_SESSION['quantity'];
         $Price = intval(preg_replace('/[,.]/', '', $row_product['giaban'])) * $_SESSION['quantity'];
         $tongtien = $thanhtien;
         $formatTongtien = number_format($tongtien);

         // Retrieve or create user's cart
         $sql_cart = "SELECT * FROM cart WHERE id_user=?";
         $stmt_cart = $conn->prepare($sql_cart);

         if ($stmt_cart) {
            $stmt_cart->bind_param("i", $_SESSION['id']);
            $stmt_cart->execute();
            $result_cart = $stmt_cart->get_result();

            if ($result_cart->num_rows > 0) {
               $row_cart = $result_cart->fetch_assoc();
               $_SESSION['id_cart'] = $row_cart['id'];
               $tongtien_old = intval(preg_replace('/[,.]/', '', $row_cart['tongtien']));
               $tongtien += $tongtien_old;
               $tongtienFormat = number_format($tongtien);
            } else {
               // User's cart not found, create a new one
               if ($_SESSION['quantity'] <= $row_product['soluong']) {
                  $sql_insert_cart = "INSERT INTO cart (id_user, name_user, tel_user, address_user, tongtien, created_time, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?)";
                  $stmt_insert_cart = $conn->prepare($sql_insert_cart);

                  if ($stmt_insert_cart) {
                     $time = time();
                     $formatTongtien = '0';
                     $stmt_insert_cart->bind_param("sssssii", $_SESSION['id'], $row_users['name'], $row_users['tel'], $row_users['address'], $formatTongtien, $time, $time);

                     if ($stmt_insert_cart->execute()) {
                        $_SESSION['id_cart'] = mysqli_insert_id($conn);
                     } else {
                        echo "Insert failed: " . $stmt_insert_cart->error;
                     }

                     $stmt_insert_cart->close();
                  } else {
                     echo "Prepare statement failed: " . $conn->error;
                  }
               }
            }

            // Check if the product is already in the cart
            $sql_check_sp_cart = "SELECT * FROM cart_details WHERE id_cart=? AND idsp=? AND size=?";
            $stmt_check_sp_cart = $conn->prepare($sql_check_sp_cart);

            if ($stmt_check_sp_cart) {
               $stmt_check_sp_cart->bind_param("iis", $_SESSION['id_cart'], $productID, $_SESSION['size']);
               $stmt_check_sp_cart->execute();
               $result_check_sp_cart = $stmt_check_sp_cart->get_result();

               if ($result_check_sp_cart->num_rows > 0) {
                  //đã có cart_details trùng
                  $row_check_sp_cart = $result_check_sp_cart->fetch_assoc();
                  $time = time();
                  $gia_old = intval(preg_replace('/[,.]/', '', $row_check_sp_cart['thanhtien']));
                  $thanhtien += $gia_old;

                  $thanhtienFormat = number_format($thanhtien);
                  if ($row_check_sp_cart['soluong'] + $_SESSION['quantity'] <= $row_product['soluong']) {
                     $sql_update_quantity = "UPDATE cart_details SET soluong= soluong + ?, thanhtien=?, last_updated=? WHERE id_cart=? AND idsp=? AND size=?";
                     $stmt_update_quantity = $conn->prepare($sql_update_quantity);

                     if ($stmt_update_quantity) {
                        $stmt_update_quantity->bind_param("isiiis", $_SESSION['quantity'], $thanhtienFormat, $time, $_SESSION['id_cart'], $productID, $_SESSION['size']);
                        if ($stmt_update_quantity->execute()) {
                           $sql_update_tongtien = "UPDATE cart SET tongtien= ?, last_updated=? WHERE id=?";
                           $stmt_update_tongtien = $conn->prepare($sql_update_tongtien);

                           if ($stmt_update_tongtien) {
                              $stmt_update_tongtien->bind_param("sii", $tongtienFormat, $time, $_SESSION['id_cart']);
                              if ($stmt_update_tongtien->execute()) {
                                 //them gio hang thanh cong
                                 echo "<script>alert('Thêm vào giỏ hàng thành công! 1'); history.go(-1);</script>";

                                 exit;
                              } else {
                                 echo "Update tongtien failed: " . $stmt_update_tongtien->error;
                              }
                           } else {
                              echo "Prepare statement failed: " . $conn->error;
                           }
                        } else {
                           echo "Update quantity failed: " . $stmt_update_quantity->error;
                        }

                        $stmt_update_quantity->close();
                     } else {
                        echo "Prepare statement failed: " . $conn->error;
                     }
                  } else {
                     echo "<script>alert('Bạn chỉ có thể thêm " . $row_product['soluong'] - $row_check_sp_cart['soluong'] . " sản phẩm vào giỏ hàng');</script>";
                     echo "<script>window.location = '../view/productdetails.php?idsp=$productID';</script>";
                  }
               } else {

                  //chưa có cart_details trùng
                  $time = time();
                  $thanhtienFormat = number_format($thanhtien);
                  if ($_SESSION['quantity'] > $row_product['soluong']) {
                     echo "<script>alert('Bạn chỉ có thể thêm " . $row_product['soluong'] . " sản phẩm vào giỏ hàng');</script>";
                     echo "<script>window.location = '../view/productdetails.php?idsp=$productID';</script>";
                  } else {
                     $sql_insert_cart_detail = "INSERT INTO cart_details (id_cart, idsp, name_sp, color, size, masp, img, giatien, soluong, thanhtien, created_time, last_updated) 
                                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                     $stmt_insert_cart_detail = $conn->prepare($sql_insert_cart_detail);

                     if ($stmt_insert_cart_detail) {
                        $stmt_insert_cart_detail->bind_param("isssssssisii", $_SESSION['id_cart'], $row_product['id'], $row_product['name'], $row_product['color'], $_SESSION['size'], $row_product['masp'], $row_product['img1'], $row_product['giaban'], $_SESSION['quantity'], $thanhtienFormat, $time, $time);

                        if ($stmt_insert_cart_detail->execute()) {


                           $sql_select_cart_price = "SELECT * FROM cart WHERE id = ?";
                           $stmt_select_cart_price = $conn->prepare($sql_select_cart_price);

                           if ($stmt_select_cart_price) {
                              $stmt_select_cart_price->bind_param("i", $_SESSION['id_cart']);

                              if ($stmt_select_cart_price->execute()) {
                                 $result = $stmt_select_cart_price->get_result();

                                 // Fetch the result as an associative array
                                 $row_select_cart_price = $result->fetch_assoc();

                                 if ($row_select_cart_price) {
                                    // Assign specific column values to variables$totalPrice = $row_select_cart_price['tongtien'];
                                    $price_old = intval(preg_replace('/[,.]/', '', $row_select_cart_price['tongtien']));
                                    $totalPrice = $Price + $price_old;
                                    $totalPriceFormat = number_format($totalPrice);
                                    // Add more assignments for other columns as needed
                                 } else {
                                    echo "Cart not found with ID {$_SESSION['id_cart']}";
                                 }
                              } else {
                                 echo "Select failed: " . $stmt_select_cart_price->error;
                              }
                           } else {
                              echo "Prepare statement failed: " . $conn->error;
                           }

                           $sql_update_tongtien = "UPDATE cart SET tongtien=?, last_updated=? WHERE id=?";
                           $stmt_update_tongtien = $conn->prepare($sql_update_tongtien);

                           if ($stmt_update_tongtien) {
                              $stmt_update_tongtien->bind_param("sii", $totalPriceFormat, $time, $_SESSION['id_cart']);
                              if ($stmt_update_tongtien->execute()) {
                                 //them vao gio hang thanh cong
                                 echo "<script>alert('Thêm vào giỏ hàng thành công!'); history.go(-1);</script>";
                                 exit;
                              } else {
                                 echo "Update tongtien failed: " . $stmt_update_tongtien->error;
                              }
                           } else {
                              echo "Prepare statement failed: " . $conn->error;
                           }
                        } else {
                           echo "Insert into cart_details failed: " . $stmt_insert_cart_detail->error;
                        }

                        $stmt_insert_cart_detail->close();
                     } else {
                        echo "Prepare statement failed: " . $conn->error;
                     }

                     //
                  }
               }
            } else {
               echo "Prepare statement failed: " . $conn->error;
            }
         } else {
            echo "Prepare statement failed: " . $conn->error;
         }
      } else {
         echo "Product not found.";
      }

      //
   } else {
      echo "Prepare statement failed: " . $conn->error;
   }
} else {
   echo "Product ID not set.";
}

// Close the database connection
$conn->close();
