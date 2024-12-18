<?php
include("../database/connect.php");
include("../database/session.php");
$sql_users = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
$result_users = $conn->query($sql_users);
if ($result_users->num_rows > 0) {
    $row_users = $result_users->fetch_assoc(); // Store user data in $row
}
if (isset($_GET['idsp'])) {
    $productID = $_GET['idsp'];
    $sql = "SELECT * FROM sanpham WHERE id=$productID";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo $row['name'] . " màu " . $row['color'] ?></title>
            </head>
            <link rel="stylesheet" href="../css/allitem-style.css">
            <link rel="stylesheet" href="../responsive/allitem-responsive.css">

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
                                                    ?>
                                                <?php
                                                } else {
                                                    echo "No records found.";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </a>
                                    </a>
                                </div>
                            </li>
                            <li><a href="aboutus.php">Về chúng tôi</a></li>
                            <li>
                                <div class="dropbtn">
                                    <span class="hover-border" href="sanpham.php" class="dropbtn"><i class="fa-solid fa-user" style="cursor: pointer;"></i>
                                        <div class="hidden-account" id="hidden-account">
                                            <ul>
                                                <li><a href="profile.php" style="color: aqua;"><?php echo $row_users['name'] ?></a>
                                                </li>
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
                <!-- Menu sản phẩm -->
                <section>
                    <div class="container">
                        <div class="image">
                            <div class="img-main">
                                <img src="../img-product/<?php echo $row['img1'] ?>" alt="">
                            </div>
                            <div class="img-extra">
                                <img src="../img-product/<?php echo $row['img2'] ?>" alt="">
                                <img src="../img-product/<?php echo $row['img3'] ?>" alt="">
                                <img src="../img-product/<?php echo $row['img4'] ?>" alt="">
                                <img src="../img-product/<?php echo $row['img5'] ?>" alt="">
                                <img src="../img-product/<?php echo $row['img1'] ?>" alt="">
                            </div>
                        </div>
                        <div class="info">
                            <div class="ul-li">
                                <h1><?php echo $row['name'] . " " . $row['masp'] . " màu " . $row['color'] ?>
                                </h1>
                            </div>
                            <div class="ul-li">
                                <p>Mã sản phẩm: <a><?php echo $row['masp'] ?></a></p>
                            </div>
                            <div class="ul-li">
                                <p>Tình trạng:
                                    <?php
                                    if ($row['soluong'] > 0) {
                                        echo '<a style="font-weight: bold">CÒN HÀNG</a>';
                                    } else
                                        echo '<a style="font-weight: bold">HẾT HÀNG</a>';
                                    ?>
                                </p>
                            </div>
                            <?php
                            if ($row['soluong'] > 0) { ?>
                                <div class="ul-li">
                                    <?php
                                    echo "<br><a>Tồn kho: " . $row['soluong'] . "</a>";
                                    ?>
                                </div>
                            <?php } ?>
                            <div class="ul-li" style="display: flex;">
                                <p>Giá: </p>
                                <p id="giatien"><?php echo $row['giaban'] ?></p>
                            </div>
                            <div class="ul-li">
                                <?php
                                if ($row['soluong'] > 0) {
                                ?>

                                    <form id="purchaseForm" action="../database/add-to-cart.php?idsp=<?php echo $productID ?>" method="POST">
                                        <input type="hidden" name="idsp" value="<?php echo $productID ?>">
                                        <div class="size">
                                            <label for="size">Kích thước:</label>
                                            <select class="choose-size" name="size">
                                                <div class="optiona">
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                    <option value="L">L</option>
                                                    <option value="XL">XL</option>
                                                </div>
                                            </select>
                                        </div>
                                        <div class="quantity">
                                            <label for="quantity">Số Lượng:</label>
                                            <input class="choose-quantity" type="number" id="quantity" name="quantity" min="1" max="100" value="1">
                                        </div>
                                        <div class="cart">
                                            <button id="click-me" type="submit"><i class="fa-solid fa-cart-shopping"></i> Thêm vào
                                                giỏ
                                                hàng</button>
                                        </div>
                                    </form>
                                    <div class="buy">
                                        <button onclick="showConfirmation()">Mua hàng</button>
                                    </div>
                                    <div class="size-chart">
                                        <button onclick="openSizeChart()">Size quần áo</button>
                                    </div>
                                <?php
                                } else {
                                    echo '<div class="sold">';
                                    echo '<button>Hết hàng</button>';
                                    echo '<button class="size-chart" onclick="openSizeChart()">Size quần áo</button>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </section>
                <!--  -->
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

                    <button id="confirmButton" onclick="confirmPurchase()" type="submit" disabled>
                        Xác nhận
                    </button>
                </div>
                <!-- Show SizeChart -->
                <div class="show-size-chart" id="show-size-chart">
                    <div class="img-size-chart">
                        <div><img src="../assets/size-chart.png" alt=""></div>
                        <a class="closeSizeChart"><i class="fa-solid fa-square-xmark fa-2xl" onclick="closeSizeChart()"></i></a>
                    </div>
                </div>
                <div class="info2">
                    <h1>THÔNG TIN SẢN PHẨM</h1>
                    <div class="section">
                        <?php echo $row['ghichu']; ?>
                    </div>
                </div>
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
                <script src="../js/allitem-script.js"></script>
                <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
            </body>

            </html>
<?php
        }
    }
}
?>