<?php
include("../database/connect.php");
include("../database/session-admin.php");
$page = isset($_GET['pg']) ? $_GET['pg'] : '';
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<link rel="stylesheet" href="../css/admin-style.css">
<link rel="stylesheet" href="../responsive/admin-responsive.css">

<body>
    <!-- Main -->
    <main>
        <div class="container">
            <div class="tabs">
                <div class="tab-item">
                    <a id="link" href="admin-panel.php?pg=qldh">Quản lý đơn hàng</a>
                </div>
                <div class="tab-item">
                    <a id="link" href="admin-panel.php?pg=thongke">Thống kê</a>
                </div>
                <div class="tab-item">
                    <a id="link" href="admin-panel.php?pg=qlkh">Quản lý khách hàng</a>
                </div>
                <div class="tab-item" id="qlysanpham">
                    <a id="link" href="admin-panel.php?pg=listsp">Quản lý sản phẩm</a>
                </div>
                <div class="tab-item" id="insert">
                    <a id="link" href="admin-panel.php?pg=insert">Thêm sản phẩm mới</a>
                </div>
                <div class="tab-item">
                    <a id="link" href="../view/trangchu.php"><i id="eye" class="fa-solid fa-eye"></i> Xem dưới
                        dạng
                        người dùng</a>
                </div>
                <div class="tab-item" class="logout">
                    <a href="../database/log-out.php" style="color: red;">Đăng Xuất</a>
                </div>
            </div>
            <div class="tab-content">
                <?php
                // Use switch case to include the corresponding content based on the 'pg' parameter
                switch ($page) {
                    case 'qldh':
                ?>
                        <div class="tab-pane active">
                            <h1>Quản lý đơn hàng</h1>
                            <?php include("./quanlydonhang.php"); ?>
                            <div style="height: 100px;"></div> <!-- Add this line for spacing -->
                        </div>
                    <?php
                        break;

                    case 'thongke':
                    ?>
                        <div class="tab-pane active">
                            <h1 style="margin-left: 0px;">Thống kê</h1>
                            <?php
                            include("./admin-thongke.php");
                            ?>
                        </div>
                    <?php
                        break;
                    case 'qlkh':
                    ?>
                        <div class="tab-pane active">
                            <h1>Quản lý khách hàng</h1>
                            <?php include("./quanlykhachhang.php"); ?>
                        </div>
                    <?php
                        break;

                    case 'listsp':
                    ?>
                        <div class="tab-pane active">
                            <h1>Quản lý sản phẩm</h1>
                            <?php include("./list_sanpham.php"); ?>
                        </div>
                    <?php
                        break;

                    case 'insert':
                    ?>
                        <div class="tab-pane active">
                            <h1>Thêm sản phẩm mới</h1>
                            <?php include("./admin-insert.php"); ?>
                        </div>
                    <?php
                        break;

                    default:
                        // Default to the first tab if 'pg' parameter is not set or unrecognized
                    ?>
                        <div class="tab-pane active">
                            <h1>Quản lý đơn hàng</h1>
                            <?php include("./quanlydonhang.php"); ?>
                            <div style="height: 100px;"></div> <!-- Add this line for spacing -->
                        </div>
                <?php
                        break;
                }
                ?>
            </div>
        </div>
    </main>
    <script src="../js/admin-script.js"></script>
    <script src="https://kit.fontawesome.com/7a215b7bf9.js" crossorigin="anonymous"></script>
</body>

</html>