<?php
include("../database/connect.php");
include("../database/session-admin.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$iduser = $_GET['iduser'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
</head>
<link rel="stylesheet" href="../css/admin.css">

<body>

    <main>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane">
                    <h1 class="purchase">Thông tin khách hàng</h1>
                    <?php
                    $Sql = "SELECT * FROM users WHERE id = " . $iduser;
                    $Result = $conn->query($Sql);
                    if ($Result->num_rows > 0) {
                        $row = $Result->fetch_assoc();
                        $timestamp = $row['created_time'];
                        $lastUpdated = $row['last_updated'];
                        $formattedTime = date('d-m-Y', $timestamp);
                        $formatUpdated = date('d-m-Y', $lastUpdated);
                    }
                    ?>

                    <form class="infoKH" action="">
                        <div class="input-form">
                            <div class="right-input">
                                <label for="name">Mã KH:</label>
                                <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly>
                            </div>
                            <div class="right-input">
                                <label for="name">Họ tên</label>
                                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" readonly>
                            </div>
                            <div class="right-input">
                                <label for="number">Số điện thoại</label>
                                <input type="text" id="tel" name="tel" value="<?php echo $row['tel']; ?>" readonly>
                            </div>
                            <div class="right-input">
                                <label for="password">Password</label>
                                <input type="text" id="password" name="password" value="<?php echo $row['password']; ?>" readonly>
                            </div>
                            <div class="right-input">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" readonly>
                            </div>
                            <div class="right-input">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>" readonly>
                            </div>
                            <div class="right-input2">
                                <label for="gender">Giới tính</label>
                                <input type="radio" class="gender" name="option" value="nam" <?php if ($row['gender'] === 'nam') echo 'checked'; ?> readonly>
                                Nam
                                <input type="radio" class="gender" name="option" value="nu" <?php if ($row['gender'] === 'nu') echo 'checked'; ?> readonly> Nữ
                                <input type="radio" class="gender" name="option" value="khac" <?php if ($row['gender'] === 'khac') echo 'checked'; ?> readonly>
                                Khác
                            </div>
                            <div class="right-input4">
                                <label for="dob">Ngày sinh:</label>
                                <input type="date" name="dob" value="<?php echo $row['birthdate']; ?>" readonly>
                            </div>
                            <div class="right-input">
                                <label for="dob">Ngày tạo tài khoản:</label>
                                <input type="text" name="dob" value="<?php echo $formattedTime; ?>" readonly>
                            </div>
                            <div class="right-input">
                                <label for="dob">Cập nhật lần cuối:</label>
                                <input type="text" name="dob" value="<?php echo $formatUpdated; ?>" readonly>
                            </div>



                        </div>
                    </form>
                </div>
            </div>

            <!-- <div id="tinhtoan"></div> -->
        </div>
    </main>
</body>

</html>