<?php
include("../database/connect.php");
include("../database/session-admin.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn mua</title>
</head>
<link rel="stylesheet" href="../css/admin.css">

<body>

    <main>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane">
                    <h1 class="purchase">Cập nhật khách hàng</h1>
                </div>
                <?php
                $Sql = "SELECT * FROM users WHERE id = $id";
                $Result = $conn->query($Sql);
                if ($Result->num_rows > 0) {
                    $row = $Result->fetch_assoc();
                    $timestamp = $row['created_time'];
                    $lastUpdated = $row['last_updated'];
                    $formattedTime = date('H:i:s d-m-Y', $timestamp);
                    $formatUpdated = date('H:i:s d-m-Y', $lastUpdated);

                ?>
                <form action="../database/admin-update-user.php" method="POST">
                    <div class="input-form">
                        <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                        <div class="right-input">
                            <label for="name">Họ tên</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
                        </div>
                        <div class="right-input">
                            <label for="number">Số điện thoại</label>
                            <input type="text" id="tel" name="tel" value="<?php echo $row['tel']; ?>">
                        </div>
                        <div class="right-input">
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" value="<?php echo $row['password']; ?>">
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

                        <div class="right-input3">
                            <label for="dob">Ngày sinh:</label>
                            <input type="date" name="dob" value="<?php echo $row['birthdate']; ?>">
                        </div>

                    </div>
                    <button type="submit" onclick="uppdateKH()" name="save">Cập nhật</button>
                </form>
                <?php } else {
                    echo "Thôi có Khách hàng ID= $id đâu mà update";
                }
                ?>
            </div>
    </main>
</body>
<?php
?>
<script src="../js/admin-script.js"></script>

</html>