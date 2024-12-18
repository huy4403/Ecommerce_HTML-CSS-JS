<?php
include("../database/connect.php");
include("../database/session-admin.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$id = $_GET['id'];
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
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- summernote -->
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<body>

    <main>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane">
                    <h1 class="purchase">Cập nhật sản phẩm</h1>
                </div>
                <?php
                $Sql = "SELECT * FROM sanpham WHERE id = $id";
                $Result = $conn->query($Sql);
                if ($Result->num_rows > 0) {
                    $row = $Result->fetch_assoc();
                    $timestamp = $row['created_time'];
                    $lastUpdated = $row['last_updated'];
                    $formattedTime = date('H:i:s d-m-Y', $timestamp);
                    $formatUpdated = date('H:i:s d-m-Y', $lastUpdated);

                ?>
                    <form class="update-sanpham-form" action="../database/admin-update-sanpham.php" method="POST" align="center">
                        <table>
                            <tr class="IDSP-centered">
                                <td colspan="2" style="text-align: center;">
                                    <input style="width: 130px;" type="text" id="id" name="idfake" placeholder="id" value="<?php echo "ID sản phẩm: " . $row['id'] ?>" readonly>
                                    <input name = "id" value="<?= $row['id'] ?>" hidden>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="name">Tên hàng:</label>
                                    <input type="text" name="name" id ="name" placeholder="Tên hàng hóa" value="<?php echo $row['name'] ?>">
                                    <div id="empty-tenhang"></div>
                                </td>
                                <td>
                                    <label for="masp">Mã SP:</label>
                                    <input type="text" name="masp" id="masp" placeholder="Mã sản phẩm" value="<?php echo $row['masp'] ?>">
                                    <div id="empty-masp"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="color">Màu sắc:</label>
                                    <input type="text" name="color" id="color" placeholder="Màu sắc" value="<?php echo $row['color'] ?>">
                                    <div id="empty-mausac"></div>
                                </td>
                                <td>
                                    <label for="gianhap">Giá nhập:</label>
                                    <input type="text" name="gianhap" id="gianhap" placeholder="Giá nhập" value="<?php echo $row['gianhap'] ?>" >
                                    <div id="empty-gianhap"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="giaban">Giá bán:</label>
                                    <input type="text" name="giaban" id="giaban" placeholder="Giá bán" value="<?php echo $row['giaban'] ?>" >
                                    <div id="empty-giaban"></div>
                                </td>
                                <td>
                                    <label for="soluong">Số lượng:</label>
                                    <input type="text" name="soluong" id="soluong" placeholder="Số lượng" value="<?php echo $row['soluong'] ?>">
                                    <div id="empty-soluong"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="img1">Ảnh SP 1:</label>
                                    <img src="../img-product/<?php echo $row['img1']; ?>" alt="Không có ảnh" width="50" height="50">
                                    <input type="file" id="img1" name="img1">
                                    <input type="hidden" id ="old-img1" name="old_img1" value="<?php echo $row['img1']; ?>">
                                </td>
                                <td>
                                    <label for="img2">Ảnh SP 2:</label>
                                    <img src="../img-product/<?php echo $row['img2']; ?>" alt="Không có ảnh" width="50" height="50">
                                    <input type="file" id="img2" name="img2" value="<?php echo $row['img2'] ?>">
                                    <input type="hidden" id = "old_img2" name="old_img2" value="<?php echo $row['img2']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="img3">Ảnh SP 3:</label>
                                    <img src="../img-product/<?php echo $row['img3']; ?>" alt="Không có ảnh" width="50" height="50">
                                    <input type="file" id = "img3" name="img3" value="<?php echo $row['img3'] ?>">
                                    <input type="hidden" id="old_img3" name="old_img3" value="<?php echo $row['img3']; ?>">
                                </td>
                                <td>
                                    <label for="img4">Ảnh SP 4:</label>
                                    <img src="../img-product/<?php echo $row['img4']; ?>" alt="Không có ảnh" width="50" height="50">
                                    <input type="file" id ="img4" name="img4" value="<?php echo $row['img4'] ?>">
                                    <input type="hidden" id = "old_img4" name="old_img4" value="<?php echo $row['img4']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="img5">Ảnh SP 5:</label>
                                    <img src="../img-product/<?php echo $row['img5']; ?>" alt="Không có ảnh" width="50" height="50">
                                    <input type="file" id = "img5" name="img5" value="<?php echo $row['img5'] ?>">
                                    <input type="hidden" id="old_img5" name="old_img5" value="<?php echo $row['img5']; ?>">
                                </td>
                                <td>
                                    <label for="ghichu">Ghi chú:</label>
                                    <textarea id ="ghichu" name="ghichu" placeholder="Ghi chú"><?php echo $row['ghichu'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="danhmuc">
                                    <label for="danhmuc">Danh mục:</label>
                                    <select class="choose-danhmuc" name="iddm" id ="iddm">
                                        <option value="1" <?php if ($row['iddm'] == 1) echo 'selected'; ?>>Áo sơ mi</option>
                                        <option value="2" <?php if ($row['iddm'] == 2) echo 'selected'; ?>>Áo polo</option>
                                        <option value="3" <?php if ($row['iddm'] == 3) echo 'selected'; ?>>Quần</option>
                                        <option value="4" <?php if ($row['iddm'] == 4) echo 'selected'; ?>>Suit</option>
                                        <option value="5" <?php if ($row['iddm'] == 5) echo 'selected'; ?>>Giảm giá</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="empty"></div>
                                    <input class="submit" id = "save" type="submit" name="save" value="Xác nhận">
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } else {
                    echo "Thôi có sản phẩm ID= $id đâu mà update";
                }
                ?>
            </div>
    </main>
</body>
<script src="../js/admin-script.js"></script>
</html>
<script>