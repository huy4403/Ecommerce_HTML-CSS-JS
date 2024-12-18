<?php
include("../database/connect.php");
include("../database/session.php");
$sql_users = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
$result_users = $conn->query($sql_users);
if ($result_users->num_rows > 0) {
    $row_users = $result_users->fetch_assoc(); // Store user data in $row
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../css/trangchu-style.css">
    <link rel="stylesheet" href="../responsive/trangchu-responsive.css">
</head>

<body>
    <!-- Thanh header -->
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
                <?php
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                    echo '<li><a href="admin-panel.php" class="admin-link"><i class="fas fa-user-shield"></i><span>Admin Panel</span></a></li>';
                }
                ?>
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
    <!-- icon mess -->
    <div>
        <a href="https://www.messenger.com/t/685146471568038" target="_blank"><img class="inbox" src="../assets/messenger.png"></a>
    </div>
    <!-- Main -->
    <main>
        <!-- banner -->
        <section class="banner" id="banner">
            <div class="slide-container">
                <div class="slidershow">
                    <div class="slides">
                        <input type="radio" name="bottom" id="bottom_1" checked>
                        <input type="radio" name="bottom" id="bottom_2">
                        <input type="radio" name="bottom" id="bottom_3">
                        <input type="radio" name="bottom" id="bottom_4">
                        <input type="radio" name="bottom" id="bottom_5">
                        <div class="slide s1">
                            <a href="https://aristino.com/BST-Aristino-ban-hoa-ca-di-san-Symphony-of-Heritage.html" target="_blank"><img src="../assets/banner1.jpg"></a>
                        </div>
                        <div class="slide">
                            <a href="https://aristino.com/BST-Horizon-Light-Up.html" target="_blank"><img src="../assets/banner2.jpg"></a>
                        </div>
                        <div class="slide">
                            <a><img src="../assets/banner3.jpg"></a>
                        </div>
                        <div class="slide">
                            <a href="https://aristino.com/BST-Aristino-nhat-thi-nhat-hoa.html" target="_blank"><img src="../assets/banner4.jpg"></a>
                        </div>
                        <div class="slide">
                            <a href="https://aristino.com/BST-Soaring-to-success.html" target="_blank"><img src="../assets/banner5.jpg"></a>
                        </div>
                    </div>
                    <div class="navigation">
                        <label for="bottom_1" class="bar"></label>
                        <label for="bottom_2" class="bar"></label>
                        <label for="bottom_3" class="bar"></label>
                        <label for="bottom_4" class="bar"></label>
                        <label for="bottom_5" class="bar"></label>
                    </div>
                </div>
                <button class="btn-prev" onclick="prevSlide()"><i class="fa-solid fa-angle-right fa-rotate-180" style="color: #ffffff;"></i></i></button>
                <button class="btn-next" onclick="nextSlide()"><i class="fa-solid fa-angle-right" style="color: #ffffff;"></i></button>
            </div>
            <hr>
        </section>
        <h1>SẢN PHẨM MỚI</h1>
        <section class="menu" id="menu">
            <?php
            $itemsPerPage = 9;
            $sqlCount = "SELECT COUNT(*) AS total FROM sanpham";
            $resultCount = $conn->query($sqlCount);
            $rowCount = $resultCount->fetch_assoc();
            $totalProducts = $rowCount['total'];

            // Calculate the total number of pages
            $maxPages = ceil($totalProducts / $itemsPerPage);

            // Get the current page from the URL parameter
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $currentPage = max(1, min($currentPage, $maxPages)); // Ensure the page is within a valid range

            $offset = ($currentPage - 1) * $itemsPerPage;
            $sql = "SELECT *
            FROM sanpham
            ORDER BY created_time DESC
            LIMIT $itemsPerPage OFFSET $offset";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            ?>
                <div class="content">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $productURL = "productdetails.php?idsp=" . $row['id'];
                    ?>
                        <div class="box">
                            <div class="img-box">
                                <img src="../img-product/<?php echo $row['img1'] ?>" alt="">
                                <h3><?php echo $row['name'] . " " . $row['masp'] . " màu " . $row['color'] . ": " . $row['giaban'] . "đ" ?>
                                </h3>
                            </div>
                            <div class="buyitem">
                                <a href="<?php echo $productURL; ?>">
                                    <?php
                                    if ($row['soluong'] > 0) {
                                        echo "<h3>Mua hàng</h3>";
                                    } else
                                        echo "<h3>Hết hàng</h3>";
                                    ?>
                                </a>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "No records found.";
            }
            ?>
            <!-- blabla -->
            <hr>

        </section>
        <div class="pagination">
            <?php
            $numLinks = 3; // Number of pagination links to display

            // Calculate the start and end page numbers to display
            $startPage = max(1, $currentPage - floor($numLinks / 2));
            $endPage = min($maxPages, $startPage + $numLinks - 1);

            // Adjust the start page if needed to display the correct number of links
            $startPage = max(1, $endPage - $numLinks + 1);

            // Add button to go to the first page
            echo "<a href='trangchu.php?page=1'>&laquo;&laquo;</a>";

            // Add pagination links
            for ($page = $startPage; $page <= $endPage; $page++) {
                echo "<a href='trangchu.php?page=$page' " . ($page == $currentPage ? 'class="active"' : '') . ">$page</a>";
            }
            // Add button to go to the last page
            echo "<a href='trangchu.php?page=$maxPages'>&raquo;&raquo;</a>";
            ?>
        </div>
        <hr>
        <div class="lookbook">
            <h1>LOOKBOOK</h1>
            <p>Những định kiến và khuôn mẫu chung luôn muốn kìm hãm chúng ta lại, nhưng chỉ những tâm hồn tự do và
                dũng
                cảm nhất mới dám vươn lên đương đầu,</p>
            <p>cái tôi độc lập là vũ khí và thời trang là tấm khiên nâng đỡ, hãy lắng nghe thanh âm của riêng mình
                và đi
                con đường mà mình muốn. Đó là tiếng nói Aristino </p>
            <p>muốn truyền tải thông qua concept series này, bạn vẫn đang lắng nghe chứ?</p>
        </div>
        <div class="video-ytb">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/f4BlJ1TJsSU?si=H-hQv7QiB6QqFzno" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

        <hr>
        <div class="about-us-container" align="center">
            <div class="about-us">
                <h1>ABOUT US</h1>
                <p>ARISTINO tự hào giới thiệu đến bạn một bộ sưu tập đồ âu lịch thiệp.</p>
                <p>Chúng tôi cung cấp các sản phẩm đa dạng với tông màu nhẹ nhàng làm chủ đạo và thiết kế phương
                    tây.
                </p>
                <p>Chúng tôi tin rằng mỗi người đều có quyền tự do thể hiện cái tôi riêng và không nên bị giới hạn
                    bởi
                    các quy tắc vô lý. Hãy tự tin là chính mình và trở thành những người tiên phong thời đại.</p>
                <p>Chúng tôi hy vọng rằng bạn sẽ tìm thấy những sản phẩm ưng ý trong cửa hàng của chúng tôi. Cảm ơn
                    bạn
                    đã ghé thăm!</p>
            </div>
        </div>
    </main>
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
    <script src="../js/trangchu-script.js"></script>
    <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
</body>

</html>
<?php
$conn->close();
?>
<style>
    .admin-link {
        position: relative;
        display: inline-block;
    }

    .admin-link:hover span {
        display: inline-block;
    }

    .admin-link span {
        display: none;
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        white-space: nowrap;
    }
</style>