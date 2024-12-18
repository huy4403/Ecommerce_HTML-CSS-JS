<?php
include("../database/connect.php");
include("../database/session-admin.php");
$idsp = $_GET['idsp'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sản phẩm</title>
</head>
<link rel="stylesheet" href="../css/admin.css">

<body>

    <main>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane">
                    <h1 class="purchase">Thông tin sản phẩm</h1>
                    <?php
                    $Sql = "SELECT * FROM sanpham WHERE id = " . $idsp;
                    $Result = $conn->query($Sql);
                    if ($Result->num_rows > 0) {
                        $row = $Result->fetch_assoc();
                        $timestamp = $row['created_time'];
                        $lastUpdated = $row['last_updated'];
                        $formattedTime = date('H:i:s d-m-Y', $timestamp);
                        $formatUpdated = date('H:i:s d-m-Y', $lastUpdated);
                        $gianhap = intval(preg_replace('/[,.]/', '', $row['gianhap']));
                        $giaban = intval(preg_replace('/[,.]/', '', $row['giaban']));
                        $tienlai = ($giaban - $gianhap) * ($row['best_seller']);
                        $formatTienlai = number_format($tienlai);
                    }
                    ?>

                    <div class="infoSP">
                        <form class="update-sanpham-form" action="">
                            <table>
                                <tr>
                                    <td>
                                        <label for="id">ID:</label>
                                        <input type="text" name="id" placeholder="id" value="<?php echo $row['id'] ?>" readonly>
                                    </td>
                                    <td>
                                        <label for="name">Tên hàng:</label>
                                        <input type="text" name="name" placeholder="Tên hàng hóa" value="<?php echo $row['name'] ?>" readonly>
                                    </td>
                                    <td>
                                        <label for="masp">Mã SP:</label>
                                        <input type="text" name="masp" placeholder="Mã sản phẩm" value="<?php echo $row['masp'] ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="color">Màu sắc:</label>
                                        <input type="text" name="color" placeholder="Màu sắc" value="<?php echo $row['color'] ?>" readonly>
                                    </td>
                                    <td>
                                        <label for="gianhap">Giá nhập:</label>
                                        <input type="text" name="gianhap" placeholder="Giá nhập" value="<?php echo $row['gianhap'] . "đ" ?>" readonly>
                                    </td>
                                    <td>
                                        <label for="giaban">Giá bán:</label>
                                        <input type="text" name="giaban" placeholder="Giá bán" value="<?php echo $row['giaban'] . "đ" ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="soluong">Số lượng:</label>
                                        <input type="text" name="soluong" placeholder="Số lượng" value="<?php echo $row['soluong'] ?>" readonly>
                                    </td>
                                    <td>
                                        <label for="best_seller">Đã bán:</label>
                                        <input type="text" name="best_seller" placeholder="Số lượng" value="<?php echo $row['best_seller'] ?>" readonly>
                                    </td>
                                    <td>
                                        <label for="giaban">Thu nhập:</label>
                                        <input type="text" name="giaban" placeholder="Giá bán" value="<?php echo $formatTienlai . "đ" ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="img1">Ảnh SP 1:</label>
                                        <img src="../img-product/<?php echo $row['img1']; ?>" alt="Không có ảnh" width="50" height="50">
                                    </td>
                                    <td>
                                        <label for="img2">Ảnh SP 2:</label>
                                        <img src="../img-product/<?php echo $row['img2']; ?>" alt="Không có ảnh" width="50" height="50">
                                    </td>
                                    <td>
                                        <label for="img3">Ảnh SP 3:</label>
                                        <img src="../img-product/<?php echo $row['img3']; ?>" alt="Không có ảnh" width="50" height="50">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="img4">Ảnh SP 4:</label>
                                        <img src="../img-product/<?php echo $row['img4']; ?>" alt="Không có ảnh" width="50" height="50">
                                    </td>
                                    <td>
                                        <label for="img5">Ảnh SP 5:</label>
                                        <img src="../img-product/<?php echo $row['img5']; ?>" alt="Không có ảnh" width="50" height="50">
                                    </td>
                                    <td>
                                        <label for="ghichu">Ghi chú:</label>
                                        <textarea name="ghichu" placeholder="Ghi chú" readonly><?php echo $row['ghichu'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="danhmuc">Danh mục:</label>
                                        <select class="choose-danhmuc" name="iddm" readonly>
                                            <option value="1" <?php if ($row['iddm'] == 1) echo 'selected'; ?>>Áo sơ mi
                                            </option>
                                            <option value="2" <?php if ($row['iddm'] == 2) echo 'selected'; ?>>Áo polo
                                            </option>
                                            <option value="3" <?php if ($row['iddm'] == 3) echo 'selected'; ?>>Quần
                                            </option>
                                            <option value="4" <?php if ($row['iddm'] == 4) echo 'selected'; ?>>Suit
                                            </option>
                                            <option value="5" <?php if ($row['iddm'] == 5) echo 'selected'; ?>>Giảm giá
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <label for="best_seller">Ngày tạo:</label>
                                        <input type="text" name="best_seller" placeholder="Số lượng" value="<?php echo $formattedTime ?>" readonly>
                                    </td>
                                    <td>
                                        <label for="best_seller">Cập nhật lần cuối:</label>
                                        <input type="text" name="best_seller" placeholder="Số lượng" value="<?php echo $formatUpdated ?>" readonly>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <!-- <div id="tinhtoan"></div> -->
        </div>
    </main>
</body>

</html>