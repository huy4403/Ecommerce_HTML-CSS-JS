<?php
include("../database/connect.php");
include("../database/session.php");
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
    <title>Tài khoản</title>
</head>
<link rel="stylesheet" href="../css/profile-style.css">
<link rel="stylesheet" href="../responsive/profile-responsive.css">

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
        <a href="https://www.facebook.com/messages/t/685146471568038"><img class="inbox"
                src="../assets/messenger.png"></a>
    </div>
    <!-- Main -->
    <main>
        <div class="container">
            <div class="tabs">
                <div class="tab-item active">
                    <p>Thông tin cá nhân</p>
                </div>
                <div class="tab-item" id="ordersTab">
                    <p>Đơn mua</p>
                </div>
                <div class="tab-item" id="changepassTab">
                    <p>Đổi mật khẩu</p>
                </div>
                <div class="tab-item">
                    <p>Voucher</p>
                </div>
                <div class="tab-item">
                    <p>Gửi feedback</p>
                </div>
                <div style="height: 100px;"></div>
                <div style="margin-left: 20px;">
                    <p>Mọi vấn đề xin vui lòng liên hệ hotline: <a href="tel:18006226"><i class="fa-solid fa-phone"
                                style="color:black;"></i>
                            18006226</a></p>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active">
                    <h1>Thông tin tài khoản</h1>
                    <form action="../database/update-save.php" method="POST">
                        <div class="input-form">
                            <div class="right-input">
                                <label for="name">Họ tên</label>
                                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
                            </div>
                            <div class="right-input">
                                <label for="number">Số điện thoại</label>
                                <input type="text" id="tel" name="tel" value="<?php echo $row['tel']; ?>">
                            </div>
                            <div class="right-input">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="right-input">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>">
                            </div>
                            <div class="right-input2">
                                <label for="gender">Giới tính</label>
                                <input type="radio" class="gender" name="option" value="nam"
                                    <?php if ($row['gender'] === 'nam') echo 'checked'; ?>>
                                Nam
                                <input type="radio" class="gender" name="option" value="nu"
                                    <?php if ($row['gender'] === 'nu') echo 'checked'; ?>> Nữ
                                <input type="radio" class="gender" name="option" value="khac"
                                    <?php if ($row['gender'] === 'khac') echo 'checked'; ?>>
                                Khác
                            </div>

                            <div class="right-input">
                                <label for="dob">Ngày sinh:</label>
                                <input type="date" name="dob" value="<?php echo $row['birthdate']; ?>">
                            </div>

                        </div>
                        <button type="submit" onclick="uppdateAccount()" name="save">Cập nhật tài khoản</button>
                        <div class="attention">
                            <a><i class="fa-solid fa-location-dot" style="color: #f38a12;"></i> Địa chỉ nhận hàng sẽ dựa
                                trên thông tin tài khoản</a>
                        </div>
                    </form>
                    <?php
                }
                $conn->close();
                    ?>
                </div>
                <div class="tab-pane">
                    <h1>Đơn mua</h1>
                    <?php
                        include("purchase.php");
                        ?>
                    <div style="height: 100px;"></div> <!-- Add this line for spacing -->
                </div>
                <div class="tab-pane">
                    <h1>đỔi mật khẩu</h1>
                    <form method="POST">
                        <div class="input-form" id="input-change">
                            <input type="hidden" name="iduser" value="<?php echo $_SESSION['id'] ?>">
                            <div class="right-input">
                                <label for="password">Mật khẩu mới: </label>
                                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu mới..."
                                    style="width: 395px;">
                            </div>
                            <div id="empty-password"></div>
                            <div class="right-input" id="input-change2">
                                <label for="password2">Xác nhận mật khẩu: </label>
                                <input type="password" name="password2" id="password2" placeholder="Xác nhận mật khẩu"
                                    style="width: 395px;">

                            </div>
                            <div id="empty-password2"></div>
                        </div>
                        <button onclick="return validateForm()" name="save">Đổi mật khẩu</button>
                    </form>
                </div>
                <div class="tab-pane">
                    <h1>Voucher</h1>
                    <form action="">
                        <div class="input-wrapper">
                            <input type="text" id="discount-code" name="discount-code" required>
                            <label for="discount-code">Nhập mã giảm giá</label>
                            <div class="bar"></div>
                        </div>
                    </form>
                    <button type="submit" class="apply-button" disabled>Áp dụng</button>
                </div>
                <div class="tab-pane">
                    <h1>Gửi feedback</h1>
                    <div class="feedback-container">
                        <form>
                            <label for="feedback">Feedback:</label>
                            <textarea id="feedback" name="feedback" placeholder="Nội dung" required></textarea>
                            <button type="button">Gửi feedback</button>
                        </form>
                    </div>
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
    <script src="../js/profile-script.js"></script>
    <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
</body>

</html>

<!-- doi pass -->
<script>
if (window.location.href.includes('changepass')) {
    var changepassTab = document.getElementById('changepassTab');
    changepassTab.click();
}

function validateForm() {
    let pass1 = document.getElementById('password').value;
    // Get the value of pass2
    let pass2 = document.getElementById('password2').value;
    if (pass1.length == 0 && pass2.length == 0) {
        if (pass1.length == 0) {
            document.getElementById('empty-password').innerHTML = 'Vui lòng nhập mật khẩu mới';
        }
        if (pass2.length == 0) {
            document.getElementById('empty-password2').innerHTML = 'Vui lòng xác nhận mật khẩu';
        }
        return false;
    }
    if (pass1.length == 0 || pass2.length == 0) {
        if (pass1.length == 0) {
            document.getElementById('empty-password').innerHTML = 'Vui lòng nhập mật khẩu mới';
        } else {
            document.getElementById('empty-password').innerHTML = ' ';
        }
        if (pass2.length == 0) {
            document.getElementById('empty-password2').innerHTML = 'Vui lòng xác nhận mật khẩu';
        } else {
            document.getElementById('empty-password2').innerHTML = ' ';
        }
        return false;
    } else {
        if (pass1 != pass2) {
            document.getElementById('empty-password').innerHTML = ' ';
            document.getElementById('empty-password2').innerHTML = 'Mật khẩu không khớp';
            return false;
        } else {
            // Make the AJAX request to change the password
            fetch('../database/changepass.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `pass1=${pass1}`,
                })
                .then(response => response.text())
                .then(data => {
                    if (data === "success") {
                        // Password change successful, show alert and redirect
                        alert("Thay đổi mật khẩu thành công");
                        window.location.href = "../view/profile.php?changepass";
                    } else {
                        // Password change unsuccessful, show error alert and clear input fields
                        alert(data);
                        document.getElementById('password').value = "";
                        document.getElementById('password2').value = "";
                    }
                });
            return false;
        }
    }
}
</script>
<style>
.input-form {
    position: relative;
}

#empty-password,
#empty-password2 {
    position: absolute;
    right: 0;
    color: #f44336;
    font-size: 13px;
}

#empty-password {
    top: 15px;
    margin-right: 290px;

}

#empty-password2 {
    top: 80px;
    margin-right: 290px;
}
</style>