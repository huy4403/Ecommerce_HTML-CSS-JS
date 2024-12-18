<?php
include("../database/connect.php");
include("../database/session.php");

$defaultSortOption = 1;

// Check if the sorting option is set in the request, otherwise use the default
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : $defaultSortOption;

// Define the column and order based on the selected option
switch ($sortOption) {
    case 1:
        $sortBy = "created_time DESC"; // Mới nhất
        break;
    case 2:
        $sortBy = "created_time ASC"; // Cũ nhất
        break;
    case 3:
        $sortBy = "best_seller DESC"; // Giảm dần
        break;
    default:
        $sortBy = "created_time DESC"; // Default sorting
}

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

$sql_users = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
$result_users = $conn->query($sql_users);
if ($result_users->num_rows > 0) {
    $row_users = $result_users->fetch_assoc(); // Store user data in $row
}

if (isset($_GET['iddm'])) {
    $danhmucID = $_GET['iddm'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $sql_dm = "SELECT * FROM danhmuc WHERE id = $danhmucID";
        $result_dm = $conn->query($sql_dm);
        if ($result_dm->num_rows > 0) {
            $row_dm = $result_dm->fetch_assoc();
        }
        if ($danhmucID > 0) {
        ?>
            <title><?php echo $row_dm['name']; ?></title>
        <?php
        } else {
            echo "<title>Sản phẩm</title>";
        }
        ?>
    </head>
    <link rel="stylesheet" href="../css/sanpham-style.css">
    <link rel="stylesheet" href="../responsive/sanpham-responsive.css">

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
                    <li><a href="trangchu.php">Trang chủ</a></li>
                    <li>
                        <div class="dropbtn">
                            <a class="hover-border" href="sanpham.php?iddm=0" class="dropbtn">Sản phẩm
                                <div class="hidden-clothes" id="hidden-clothes">
                                    <ul>
                                        <?php
                                        $sql_damhmuc = "SELECT * FROM danhmuc";
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
            <?php

            if ($danhmucID > 0) {
                $sql_img = "SELECT * FROM danhmuc WHERE id=$danhmucID";
                $result_img = $conn->query($sql_img);
                if ($result_img->num_rows > 0) {
                    $row_img = $result_img->fetch_assoc();
            ?>
                    <section class="banner" id="banner"><a href="sanpham.php?iddm=<?php echo $danhmucID ?>"><img src="../assets/<?php echo $row_img["img_dm"] ?>"></a></section>
                <?php
                }
            } else {
                ?>
                <section class="banner" id="banner"></section>
            <?php } ?>

            <section class="menu" id="menu">

                <div class="title">
                    <h2>WELCOME TO OUR WORLD OF ARISTINO</h2>
                </div>
                <div class="sort">
                    <label for="sort">Sắp xếp theo</label>
                    <select class="sort-content" name="sort-content" id="sortSelect" onchange="changeSort(this.value)">
                        <optgroup label="Thời gian">
                            <option value="1" <?php echo ($sortOption == 1) ? 'selected' : ''; ?>>Mới nhất</option>
                            <option value="2" <?php echo ($sortOption == 2) ? 'selected' : ''; ?>>Cũ nhất</option>
                        </optgroup>
                        <option value="3" <?php echo ($sortOption == 3) ? 'selected' : ''; ?>>Best seller</option>
                    </select>
                </div>

                <div class="content">
                    <?php
                    if ($danhmucID > 0) {
                        $sql = "SELECT * FROM sanpham WHERE iddm=$danhmucID ORDER BY $sortBy LIMIT $itemsPerPage OFFSET $offset";
                    } else {
                        $sql = "SELECT * FROM sanpham ORDER BY $sortBy LIMIT $itemsPerPage OFFSET $offset";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
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
            ?>
                <div class="not-item">
                    <p>Không có sản phẩm trong danh mục này.</p>
                </div>
            <?php } ?>

            </section>
            <hr>
            <div class="pagination">
                <?php
                if (isset($_GET['sort'])) {
                    $numLinks = 3; // Number of pagination links to display

                    // Calculate the start and end page numbers to display
                    $startPage = max(1, $currentPage - floor($numLinks / 2));
                    $endPage = min($maxPages, $startPage + $numLinks - 1);

                    // Adjust the start page if needed to display the correct number of links
                    $startPage = max(1, $endPage - $numLinks + 1);

                    // Add button to go to the first page
                    echo "<a href='sanpham.php?iddm=$danhmucID&sort=$sortOption&page=1'>&laquo;&laquo;</a>";

                    // Add pagination links
                    for ($page = $startPage; $page <= $endPage; $page++) {
                        echo "<a href='sanpham.php?iddm=$danhmucID&sort=$sortOption&page=$page' " . ($page == $currentPage ? 'class="active"' : '') . ">$page</a>";
                    }
                    // Add button to go to the last page
                    echo "<a href='sanpham.php?iddm=$danhmucID&sort=$sortOption&page=$maxPages'>&raquo;&raquo;</a>";
                } else {
                    $numLinks = 3; // Number of pagination links to display

                    // Calculate the start and end page numbers to display
                    $startPage = max(1, $currentPage - floor($numLinks / 2));
                    $endPage = min($maxPages, $startPage + $numLinks - 1);

                    // Adjust the start page if needed to display the correct number of links
                    $startPage = max(1, $endPage - $numLinks + 1);

                    // Add button to go to the first page
                    echo "<a href='sanpham.php?iddm=$danhmucID&page=1'>&laquo;&laquo;</a>";

                    // Add pagination links
                    for ($page = $startPage; $page <= $endPage; $page++) {
                        echo "<a href='sanpham.php?iddm=$danhmucID&page=$page' " . ($page == $currentPage ? 'class="active"' : '') . ">$page</a>";
                    }
                    // Add button to go to the last page
                    echo "<a href='sanpham.php?iddm=$danhmucID&page=$maxPages'>&raquo;&raquo;</a>";
                }
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
        <script src="../js/sanpham-script.js"></script>
        <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
    </body>

    </html>
    <script>
        // JavaScript function to handle onchange event of the select element
        function changeSort(optionValue) {
            var danhmucID = <?php echo json_encode($danhmucID); ?>;
            window.location.href = 'sanpham.php?iddm=' + danhmucID + '&sort=' + optionValue;
        }
    </script>
<?php
}

?>