<?php
include("../database/connect.php");
include("../database/session-admin.php");
$idp = $_GET['idp'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn mua</title>
</head>
<link rel="stylesheet" href="../css/admin.css">

<body>

    <main>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane">
                    <h1 class="purchase">Thông tin đơn hàng</h1>
                    <?php
                    $purchaseSql = "SELECT * FROM purchase WHERE id = " . $idp;
                    $purchaseResult = $conn->query($purchaseSql);
                    if ($purchaseResult->num_rows > 0) {
                        $row_purchase = $purchaseResult->fetch_assoc();
                        $timestamp = $row_purchase['created_time'];
                        $formattedTime = date('H:i:s d-m-Y', $timestamp);
                    ?>
                        <div class="infoKH">
                            <h4>THÔNG TIN NHẬN HÀNG</h4>
                            <div>Tên khách hàng: <?php echo $row_purchase['name_user'] ?></div>
                            <div>Số điện thoại: <?php echo $row_purchase['tel_user'] ?></div>
                            <div>Địa chỉ: <?php echo $row_purchase['address_user'] ?></div>
                            <div>Thời gian: <?php echo $formattedTime ?></div>
                        </div>
                        <?php
                        echo "<div class='idp'>Mã đơn hàng: " . $row_purchase['id'] . "</div>";
                        ?>
                        <div class="purchase-item">
                            <table border="2">
                                <tr>
                                    <th class="sp-num">STT</th>
                                    <th class="sp-name">Tên sản phẩm</th>
                                    <th class="sp-color">Màu</th>
                                    <th class="size-sp">Size</th>
                                    <th class="ma-sp">Mã SP</th>
                                    <th class="sp-img">Ảnh</th>
                                    <th class="sp-gia">Đơn giá</th>
                                    <th class="sp-soluong">SL</th>
                                    <th class="total-money">Thành tiền</th>
                                </tr>
                                <?php
                                $stt = 1;
                                $sql_purchase_details = "SELECT * FROM purchase_details WHERE id_purchase =$idp";
                                $purchaseDetailsResult = $conn->query($sql_purchase_details);
                                while ($row_purchase_details = $purchaseDetailsResult->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td class="sp-num"><?php echo $stt++; ?></td>
                                        <td class="sp-name"><?php echo $row_purchase_details['name_sp'] ?></td>
                                        <td class="sp-color"><?php echo $row_purchase_details['color'] ?></td>
                                        <td class="size-sp"><?php echo $row_purchase_details['size'] ?></td>
                                        <td class="ma-sp"><?php echo $row_purchase_details['masp'] ?></td>
                                        <td class="sp-img"><img src="../img-product/<?php echo $row_purchase_details['img'] ?>" alt="">
                                        </td>
                                        <td class="sp-gia"><?php echo $row_purchase_details['giatien'] ?></td>
                                        <td class="sp-soluong"><?php echo $row_purchase_details['soluong'] ?></td>
                                        <td class="total-money">
                                            <?php echo $row_purchase_details['thanhtien'] ?>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                                <tr id="row-total">
                                    <td class="sp-num">&nbsp;</td>
                                    <td class="sp-name">Tổng tiền</td>
                                    <td class="sp-color">&nbsp;</td>
                                    <td class="size-sp">&nbsp;</td>
                                    <td class="ma-sp">&nbsp;</td>
                                    <td class="sp-img">&nbsp;</td>
                                    <td class="sp-gia">&nbsp;</td>
                                    <td class="sp-soluong">&nbsp;</td>


                                    <td class="total-money"><?php echo $row_purchase['dongia'] . "đ"; ?></td>
                                </tr>
                            </table>
                        <?php
                    }
                        ?>
                        </div>
                </div>
                <!-- <div id="tinhtoan"></div> -->
            </div>
        </div>
        </div>
    </main>
</body>

</html>