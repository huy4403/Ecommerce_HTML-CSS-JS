<?php
include("../database/connect.php");
include("../database/session.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$sql = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Giỏ hàng</title>
    </head>
    <link rel="stylesheet" href="../css/cart-style.css">
    <link rel="stylesheet" href="../responsive/cart-responsive.css">

    <body>
        <!--Header -->
        <header id="header">
            <input type="checkbox" id="toggler">
            <label for="toggler"><i class="fa-solid fa-bars"></i></label>
            <a href="trangchu.php" class="logo">Aristino</a>
            <form action="search.php" method="GET" class="search-form">
                <input type="text" name="noidung" class="search-content" placeholder="Tìm kiếm sản phẩm">
                <button type="submit" onclick="showProduct()" class="search"><i class="fa-solid fa-magnifying-glass" style="color: black;"></i></button>
            </form>
            <div class="menu-nav">
                <ul class="navigation">
                    <li><a href="trangchu.php">Trang chủ</a></li>
                    <li>
                        <div class="dropbtn">
                            <a class="hover-border" href="sanpham.php?iddm=0" class="dropbtn">Sản phẩm
                                <div class="hidden-clothes" id="hidden-clothes">
                                    <ul>
                                        <?php $sql_damhmuc = "SELECT * FROM danhmuc";
                                        $result_damhmuc = $conn->query($sql_damhmuc);
                                        if ($result_damhmuc->num_rows > 0) {
                                            while ($row_damhmuc = $result_damhmuc->fetch_assoc()) {
                                                $product = "sanpham.php?iddm=" . $row_damhmuc['id'];
                                        ?>
                                                <li><a href="<?php echo $product; ?>"><?php echo $row_damhmuc['name']; ?></a></li>
                                        <?php }
                                        } else {
                                            echo "No records found.";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li><a href="aboutus.php">Về chúng tôi</a></li>
                    <li>
                        <div class="dropbtn">
                            <span class="hover-border" href="sanpham.php" class="dropbtn"><i class="fa-solid fa-user" style="cursor: pointer;"></i>
                                <div class="hidden-account" id="hidden-account">
                                    <ul>
                                        <li><a href="profile.php" style="color: aqua;"><?php echo $row['name'] ?></a></li>
                                        <li><a href="cart.php">Giỏ hàng</a></li>
                                        <li><a href="../database/log-out.php">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <!-- click quay trở lại đầu trang -->
        <div>
            <button id="scrollToTopButton"><i class="fas fa-arrow-up"></i></button>
        </div>
        <!-- Icon inbox -->
        <div>
            <a href="https://www.facebook.com/messages/t/685146471568038"><img class="inbox" src="../assets/messenger.png"></a>
        </div>
        <!-- Main -->
        <main>
            <div class="container">
                <div class="tab-content">
                    <div class="tab-pane">
                        <h1 class="cart">Giỏ hàng</h1>
                        <div class="cart-item">
                            <?php
                            $cartSql = "SELECT * FROM cart WHERE id_user =" . $_SESSION['id'];
                            $cartResult = $conn->query($cartSql);
                            if ($cartResult->num_rows > 0) {
                                $row_cart = $cartResult->fetch_assoc();
                            ?>
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
                                        <th class="product-delete">Thao tác</th>
                                    </tr>
                                    <?php
                                    $stt = 1;
                                    $sql_cart_details = "SELECT * FROM cart_details WHERE id_cart ='$row_cart[id]'";
                                    $cartDetailsResult = $conn->query($sql_cart_details);
                                    while ($row_cart_details = $cartDetailsResult->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td class="sp-num"><?php echo $stt++; ?></td>
                                            <td class="sp-name"><?php echo $row_cart_details['name_sp'] ?></td>
                                            <td class="sp-color"><?php echo $row_cart_details['color'] ?></td>
                                            <td class="size-sp"><?php echo $row_cart_details['size'] ?></td>
                                            <td class="ma-sp"><?php echo $row_cart_details['masp'] ?></td>
                                            <td class="sp-img"><img src="../img-product/<?php echo $row_cart_details['img'] ?>" alt="">
                                            </td>
                                            <td class="sp-gia"><?php echo $row_cart_details['giatien'] ?></td>
                                            <td class="sp-soluong"><?php echo $row_cart_details['soluong'] ?></td>
                                            <td class="total-money">
                                                <?php echo $row_cart_details['thanhtien'] ?>
                                            </td>
                                            <form action="../database/delete-product-cart.php?idsp=<?php echo $row_cart_details['idsp'] ?>" method="POST">
                                                <input type="text" name="size" value="<?php echo $row_cart_details['size']; ?>" style="display: none;">
                                                <td class="product-delete"><button type="submit" name="Xóa" style="font-weight: bolder">XÓA</button></td>
                                            </form>
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


                                        <td class="total-money"><?php echo $row_cart['tongtien'] . "đ"; ?></td>

                                        <td class="product-delete">&nbsp;</td>
                                    </tr>
                                </table>
                                <button class="btn-thanhtoan" onclick="showConfirmation()">Thanh toán</button>
                            <?php
                            } else {
                                echo '<h3 class="non-cart">Bạn chưa thêm sản phẩm vào giỏ hàng</h3>';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- <div id="tinhtoan"></div> -->
                </div>
            </div>
            </div>
        </main>

        <div id="confirmationDiv" class="confirmation">
            <i class="fa-solid fa-square-xmark fa-2xl" style="color: #ff0000;" id="closeButton" onclick="hideConfirmation()"></i>
            <label for="paymentMethod">Phương thức thanh toán:</label>
            <select id="paymentMethod" onchange="togglePaymentDetails()">
                <option value="">Chọn phương thức thanh toán</option>
                <option value="transfer">Chuyển khoản</option>
                <option value="momo">Thanh toán qua Momo</option>
            </select>
            <br /><br />

            <div class="bank-details" id="bankDetails">
                <img src="../assets/qrcode.jpg" alt="Mã QR" />
            </div>

            <div class="momo-details" id="momoDetails">
                <p>Đang cập nhật thêm...</p>
            </div>

            <button id="confirmButton" href="../database/purchase.php" onclick="confirmPurchase()" disabled>
                Xác nhận
            </button>
        </div>
    <?php
    $conn->close();
} else {
    echo "Không tìm thấy người dùng";
}
    ?>

    <!-- Liên hệ các thứ blabla -->
    <footer>
        <div class="logo2">
            <img src="../assets/logobottom.png" alt="">
        </div>
        <div class="address">
            <h3>HỆ THỐNG SHOWROOM</h3>
            <a href="https://maps.app.goo.gl/z1eStFFpQ9koDYmC8" target="_blank"><i class="fa-solid fa-location-dot"></i>
                Showroom
                Aristino
                - Vincom Bắc Từ Liêm 234 Phạm Văn
                Đồng, Bắc Từ Liêm, Hà Nội</a>
            <a href="https://maps.app.goo.gl/2CvFCfu4BFZJ96Es5" target="_blank"><i class="fa-solid fa-location-dot"></i>
                Showroom
                Aristino 379 Quang Trung, Hà Đông, Hà Nội</a>
            <a href="https://maps.app.goo.gl/2NS4BYytWR8Uxd687" target="_blank"><i class="fa-solid fa-location-dot"></i>
                Showroom
                Aristino 84 Nguyễn Trãi - Hồ Chí Minh</a>
            <a href="tel:18006226"><i class="fa-solid fa-phone"></i> 18006226</a>
            <a href="mailto:cs@kgvietnam.com"><i class="fa-solid fa-envelope"></i> cs@kgvietnam.com</a>
        </div>
        <div class="icon">
            <ul>
                <h3>THEO DÕI CHÚNG TÔI</h3>
                <li>
                    <a href="https://shopee.vn/aristino_official_store" target="_blank"><i class="fa-brands fa-shopify fa-2xl"></i></a>
                    <a href="https://www.tiktok.com/discover/aristino" target="_blank"><i class="fa-brands fa-tiktok fa-2xl"></i></a>
                    <a href="https://www.facebook.com/ilovearistino/" target="_blank"><i class="fa-brands fa-square-facebook fa-2xl"></i></a>
                    <a href="https://www.instagram.com/aristino_official/" target="_blank"><i class="fa-brands fa-instagram fa-2xl"></i></a>
                    <a href="https://www.youtube.com/channel/UCxLkYQ3yrgqxGRzWO-I2PZg" target="_blank"><i class="fa-brands fa-youtube fa-2xl"></i></a>
                </li>
            </ul>
        </div>
        <p class="copyright">© 2022 K&G Vietnam. All Rights Reserved</p>
    </footer>
    <script src="../js/cart-script.js"></script>
    <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
    </body>

    </html>