<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../css/forgot-password.css">
    <link rel="stylesheet" href="../responsive/login-signup-fgpw-responsive.css">
</head>

<body>
    <main>
        <form id="form-login">
            <h1>Quên mật khẩu?</h1>
            <!-- Nhap email -->
            <div class="form-group">
                <label for="ten"></label>
                <input type="tel" id="tel" name="tel" class="form-input" placeholder="Nhập số điện thoại">
                <div id="empty-number"></div>
            </div>

            <!-- Nho tai khoan -->
            <div class="back">
                <a onclick="kiem_tra()">Lấy lại mật khẩu</a>
                <a href="login.php">Quay lại</a>
            </div>
        </form>
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
</body>
<script src="../js/forgot-password.js"></script>
<script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>

</html>