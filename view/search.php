<?php
include("../database/connect.php");
session_start();
if (isset($_GET['noidung'])) {
    // Get the search query from the form
    $noidung = $_GET['noidung'];

    // Prepare and execute a SQL query to search for products in your database
}
if (!isset($_GET['noidung']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
</head>
<link rel="stylesheet" href="../css/search-style.css">
<link rel="stylesheet" href="../responsive/search-responsive.css">

<body>
    <!-- Thanh header -->
    <header id="header">
        <input type="checkbox" id="toggler">
        <label for="toggler"><i class="fa-solid fa-bars"></i></label>
        <a href="trangchu.php" class="logo">Aristino</a>
        <form action="search.php" method="GET" class="search-form">
            <input type="text" name="noidung" class="search-content" placeholder="Tìm kiếm sản phẩm">
            <button type="submit" onclick="showProduct()" class="search"><i class="fa-solid fa-magnifying-glass"
                    style="color: black;"></i></button>
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
                    </div>
                </li>
                <li><a href="aboutus.php">Về chúng tôi</a></li>
                <li>
                    <div class="dropbtn">
                        <span class="hover-border" href="sanpham.php" class="dropbtn"><i class="fa-solid fa-user"
                                style="cursor: pointer;"></i>
                            <div class="hidden-account" id="hidden-account">
                                <ul>
                                    <?php
                                    if (isset($_SESSION['id'])) {
                                        $sql_users = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
                                        $result_users = $conn->query($sql_users);
                                        if ($result_users->num_rows > 0) {
                                            $row_users = $result_users->fetch_assoc(); // Store user data in $row
                                        }
                                    ?>
                                    <li><a href="profile.php" style="color: aqua;"><?php echo $row_users['name'] ?></a>
                                    </li>
                                    <li><a href="cart.php">Giỏ hàng</a></li>
                                    <li><a href="../database/log-out.php">Đăng xuất</a></li>
                                    <?php
                                    } else {
                                    ?>
                                    <li><a href="login.php">Đăng nhập</a></li>
                                    <li><a href="sign-up.php">Đăng ký</a></li>
                                    <?php
                                    }
                                    ?>
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
        <a href="https://www.facebook.com/messages/t/685146471568038"><img class="inbox"
                src="../assets/messenger.png"></a>
    </div>
    <!-- Main -->
    <main>
        <section class="menu" id="menu">
            <div class="title">
                <h2>Kết quả tìm kiếm từ khóa: <span style="color: red;"><?php echo "$noidung"; ?></span></h2>
            </div>
            <?php
            $itemsPerPage = 9;
            $offset = isset($_GET['page']) ? ($_GET['page'] - 1) * $itemsPerPage : 0; // Calculate offset

            $sqlCount = "SELECT COUNT(*) AS total FROM sanpham WHERE name LIKE '%$noidung%' OR masp LIKE '%$noidung%' OR color LIKE '%$noidung%'";
            $resultCount = $conn->query($sqlCount);
            $rowCount = $resultCount->fetch_assoc();
            $totalProducts = $rowCount['total'];

            // Calculate the total number of pages
            $maxPages = ceil($totalProducts / $itemsPerPage);

            // Get the current page from the URL parameter
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $currentPage = max(1, min($currentPage, $maxPages)); // Ensure the page is within a valid range

            $sql = "SELECT * FROM sanpham WHERE name LIKE '%$noidung%' OR masp LIKE '%$noidung%' OR color LIKE '%$noidung%' LIMIT $itemsPerPage OFFSET $offset";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            ?>
            <div class="content">
                <?php
                    while ($row = $result->fetch_assoc()) {
                        $productURL = "productdetails.php?idsp=" . $row['id'];
                    ?>
                <div class="box">
                    <div class="imgBx1">
                        <img src="../img-product/<?php echo $row['img1'] ?>" alt="">
                        <h3><?php echo $row['name'] . " " . $row['masp'] . " màu " . $row['color'] . ": " . $row['giaban'] . "đ" ?>
                        </h3>
                    </div>
                    <div class="buyitem">
                        <a href="<?php echo $productURL; ?>">
                            <?php
                                    if ($row['soluong'] > 0) {
                                        echo "<h3>Mua hàng</h3>";
                                    } else {
                                        echo "<h3>Hết hàng</h3>";
                                    }
                                    ?>
                        </a>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="not-item">
                    <p>Không sản phẩm nào được tìm thấy!</p>
                </div>';
                }
                ?>
            </div>
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
            echo "<a href='search.php?noidung=$noidung&page=1'>&laquo;&laquo;</a>";

            // Add pagination links
            for ($page = $startPage; $page <= $endPage; $page++) {
                echo "<a href='search.php?noidung=$noidung&page=$page' " . ($page == $currentPage ? 'class="active"' : '') . ">$page</a>";
            }

            // Add button to go to the last page
            echo "<a href='search.php?noidung=$noidung&page=$maxPages'>&raquo;&raquo;</a>";
            ?>
        </div>
        <hr>
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
                    <a href="https://shopee.vn/aristino_official_store" target="_blank"><i
                            class="fa-brands fa-shopify fa-2xl"></i></a>
                    <a href="https://www.tiktok.com/discover/aristino" target="_blank"><i
                            class="fa-brands fa-tiktok fa-2xl"></i></a>
                    <a href="https://www.facebook.com/ilovearistino/" target="_blank"><i
                            class="fa-brands fa-square-facebook fa-2xl"></i></a>
                    <a href="https://www.instagram.com/aristino_official/" target="_blank"><i
                            class="fa-brands fa-instagram fa-2xl"></i></a>
                    <a href="https://www.youtube.com/channel/UCxLkYQ3yrgqxGRzWO-I2PZg" target="_blank"><i
                            class="fa-brands fa-youtube fa-2xl"></i></a>
                </li>
            </ul>
        </div>
        <p class="copyright">© 2022 K&G Vietnam. All Rights Reserved</p>
    </footer>
    <script src="../js/search-script.js"></script>
    <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
</body>

</html>