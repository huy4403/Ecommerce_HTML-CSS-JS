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
    <title>Về chúng tôi</title>
</head>
<link rel="stylesheet" href="../css/aboutus-style.css">
<link rel="stylesheet" href="../responsive/aboutus-responsive.css">

<body>
    <!--Header -->
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
        <a href="https://www.facebook.com/messages/t/685146471568038"><img class="inbox"
                src="../assets/messenger.png"></a>
    </div>
    <!-- Main -->
    <main>
        <section class="banner" id="banner"></section>
        <h1>CÂU CHUYỆN THƯƠNG HIỆU</h1>
        <div class="container">
            <div class="noidung">
                <div align="center">
                    <h3>Chủ tịch hội đồng kiêm CEO:</h3>
                    <h4>Đoàn Văn Huy</h4>
                    <h3>Thành viên cốt cán:</h3>
                    <h4>Đỗ Thị Thu Lợi</h4>
                    <h4>Nguyễn Minh Đức</h4>
                    <h4>Lê Hiếu Thảo</h4>
                    <h4>Đoàn Phương Linh</h4>
                    <h4>Hà Minh Hiếu</h4>
                </div>
                <p>
                <h3>TỪ NHỎ ĐẾN LỚN TỪ<br>TỐT ĐẾN VĨ ĐẠI </h3>
                <p>

                <p>Thành công của người đàn ông bắt đầu từ những điều nhỏ bé</p>

                <p>Chặng đường chinh phục làng thời trang của Aristino cũng khởi đầu từ những bước đi nhỏ.</p>

                <h3><span>Từ bàn chải đến chiếc quần sịp nam giới đầu
                        tiên</strong></span></h3>

                <p>Năm 2012, kinh tế toàn cầu suy thoái, màu đen ảm đạm phủ kín bức tranh kinh tế trong nước và thế
                    giới. Giữa khó khăn và biến động, anh Tăng Văn Khanh - CEO Aristino hiện tại vẫn quyết định bắt đầu
                    hành trình khởi nghiệp của mình với thương hiệu bàn chải Bizs+. </p>

                <p>Bizs+ ra đời với khát khao mang đến sản phẩm tiêu dùng chất lượng cao do người Việt, cho người
                    Việt. Trên hành trình đó, anh Khanh nhìn thấy những giá trị tiềm năng của thị trường thời trang,
                    đặc biệt đối với sản phẩm đồ lót cho nam giới. </p>

                <p>Ở thời điểm đó, 82% thị phần đồ lót tại Việt Nam bị chiếm lĩnh bởi các sản phẩm nhập khẩu tiểu ngạch
                    kém chất lượng, trong khi đại bộ phận người Việt khó lòng “chạm” tới những sản phẩm cao cấp hơn. Và
                    thương hiệu Aristino đã ra đời với dòng sản phẩm đầu tiên - quần sịp cho nam giới, bước đầu trên
                    hành trình chinh phục thị trường thời trang Việt. </p>

                <p>Từ những sản phẩm đầu tay được mang đi “chào hàng” tại các shop nhỏ lẻ, cho tới Showroom nội y đầu
                    tiên khai trương ở Times City, Aristino đã có một bước tiến dài bằng sự tâm huyết và kiên định của
                    người sáng lập cùng các cộng sự của anh. </p>

                <h3><span>Từ quần sịp đến sứ mệnh “làm đẹp” cho nam giới
                        Việt</strong></span></h3>

                <p>Từ thành công đầu tiên với dòng sản phẩm đơn giản nhưng cần thiết đối với nam giới, Aristino tiếp tục
                    lắng nghe, thấu hiểu để đồng hành cùng đàn ông Việt trong công cuộc làm đẹp, đáp ứng tới những nhu
                    cầu nhỏ nhất. Các dòng sản phẩm áo thun, áo sơ mi, quần âu, quần kaki, phụ kiện... lần lượt được cho
                    ra đời, mang tới cho nam giới Việt những “giải pháp ăn mặc” ưu việt và toàn diện.</p>

                <p>Với tầm nhìn trở thành công ty thời trang có quy mô lớn nhất Việt Nam, chúng tôi không ngừng nghiên
                    cứu chuyên sâu về công nghệ tạo nên chất lượng sản phẩm, nắm giữ và làm chủ chuỗi giá trị cốt lõi.
                    Phương châm của Aristino là lấy khách hàng làm trung tâm, mang đến dịch vụ từ trái tim.</p>

                <p>Cho tới hiện tại, Aristino đã xây dựng một hệ thống phân phối sản phẩm lớn mạnh với hơn gần 60
                    Showroom và hàng trăm điểm bán trên cả nước, vì vậy chúng tôi tin rằng tầm nhìn đó vẫn đang được
                    hiện thực hóa mỗi ngày.</p>

                <h3><span>Sự chuyển mình mạnh mẽ trong hành trình tạo nên “Dấu ấn Việt
                        Nam” trong thời trang</strong></span></h3>

                <p>Với định vị là thương hiệu thời trang nam cao cấp, sản phẩm Aristino sử dụng chất liệu thiên nhiên và
                    đặc biệt chú trọng thiết kế phom dáng phù hợp cho hình thể người Việt.</p>

                <p>Năm 2020 tiếp tục đánh dấu sự chuyển mình mạnh mẽ của thương hiệu Aristino về tầm nhìn và sứ mệnh.
                    Ngoài việc giúp người Việt Nam trở nên phong cách, tự tin hơn, Aristino còn mong muốn đánh thức niềm
                    tự hào, tình yêu quê hương, đất nước, bằng việc phát triển và nâng tầm phong cách quý ông qua những
                    thiết kế hiện đại, tinh tế, lịch lãm, phong cách châu Âu nhưng được lấy cảm hứng từ chính đất nước
                    con người Việt. </p>

                <p>Giống như hình ảnh người đàn ông không ngừng phấn đấu phát triển sự nghiệp, đại bàng Aristino
                    cũng không ngừng “lột xác” và chuyển mình để sẵn sàng “sải cánh vươn tầm” thế giới.</p>

                <p>“Kẻ thù của tốt là vĩ đại”</strong>, không chỉ dừng lại ở việc xác lập vị thế trong
                    nước, Aristino còn tham vọng dấn thân vào thị trường thời trang thế giới. Trong đó xác định 2 hướng
                    đi quan trọng: Một là, nhạy bén trong tư duy thiết kế và đón đầu các xu hướng mới phù hợp với dòng
                    chảy thời trang. Hai là, bắt tay với các nhà thiết kế và thương hiệu đẳng cấp thế giới để mang đến
                    những bộ sưu tập không chỉ chất lượng cho người tiêu dùng mà còn chinh phục được hoàn toàn giới mộ
                    điệu.</p>
            </div>

        </div>
        </div>
    </main>
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
    <script src="../js/aboutus-script.js"></script>
    <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
</body>

</html>