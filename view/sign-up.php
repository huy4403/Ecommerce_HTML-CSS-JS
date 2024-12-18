<?php
include('../database/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../css/signup-style.css">
    <link rel="stylesheet" href="../responsive/login-signup-fgpw-responsive.css">
</head>

<body>
    <main>
        <form id="form-login" onsubmit="return kiem_tra()" method="POST">
            <h1>ĐĂNG KÝ TÀI KHOẢN</h1>

            <div class="form-group">
                <input type="tel" id="tel" name="tel" class="form-input" placeholder="Nhập tên đăng nhập">
                <div id="empty-number"></div>
            </div>
            <input type="text" id="ten" name="ten" class="form-input" placeholder="Họ và tên" value="Đoàn Huy" hidden>
            <div class="form-group">
                <input type="text" id="email" name="email" class="form-input" placeholder="Email(@gmail.com)">
                <div id="empty-email"></div>
            </div>
            <input type="text" id="address" name="address" class="form-input" placeholder="Địa chỉ:" value="Đại học tài nguyên và môi trường Hà Nội" hidden>
            </div>

            <div class="form-group">
                <input type="password" id="mat_khau" name="mat_khau" class="form-input" placeholder="Mật khẩu">
                <div id="empty-password"></div>
                <span onclick="show_password()"><i class="fa-solid fa-eye" style="cursor: pointer;"></i></span>
            </div>
            <div class=" form-group">
                <input type="password" id="mat_khau2" name="mat_khau2" class="form-input" placeholder="Nhập lại mật khẩu">
                <div id="empty-password2"></div>
                <span onclick="show_password2()"><i class="fa-solid fa-eye" style="cursor: pointer;"></i></span>
            </div>
            <div id="empty-number-password"></div>
            </div>
            <input type="checkbox" id="agree">
            <label>Xác nhận rằng quý khách đã đồng ý <a class="dieukhoan" href="https://aristino.com/chinh-sach-bao-mat.html" target="_blank">chính sách bảo mật và chia sẻ
                    thông tin của Aristino.</a></label>
            <div id="empty-agree"></div>
            <input type="submit" id="submit" value="Đăng Ký" class="form-submit">
            <div class="login-link">
                Đã có tài khoản ? <a href="login.php">Đăng nhập</a>
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
    <script src="../js/signup-script.js"></script>
    <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
</body>

</html>