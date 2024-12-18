<?php
include("../database/connect.php");
$sql_purchase = "SELECT * FROM purchase WHERE id_user = " . $_SESSION['id'] . " ORDER BY created_time DESC";
$result_purchase = $conn->query($sql_purchase);
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($result_purchase->num_rows > 0) {
    $currentDate = null; // Biến để theo dõi ngày hiện tại
?>
<h4>Đơn hàng mới:</h4>
<?php
    while ($row_purchase = $result_purchase->fetch_assoc()) {
        $timestamp = $row_purchase['created_time'];
        $formattedTime = date('d-m-Y', $timestamp);
        $timeFormat = date(' H:i:s', $timestamp);
        // Kiểm tra xem ngày có thay đổi không
        if ($formattedTime !== $currentDate) {
            // Nếu có, đóng bảng trước (nếu có) và mở bảng mới
            if ($currentDate !== null) {
                echo "</table>";
                echo "</div>";
                echo "<h5>" . $formattedTime . "</h5>";
            } else {
                echo "<h5>" . $formattedTime . "</h5>";
            }
    ?>
<div class='purchase-content'>
    <table class='purchase-table' border='2'>
        <tr>
            <th class="pt-id">ID BILL</th>
            <th class="pt-time">Thời gian</th>
            <th class="pt-total">Tổng tiền</th>
            <th class="pt-status">Tình trạng</th>
            <th class="action">Thao tác</th>
        </tr>
        <?php
                $currentDate = $formattedTime;
            }
                ?>
        <tr>
            <td class="pt-id"><?php echo $row_purchase['id'] ?></td>
            <td class="pt-time"><?php echo $timeFormat ?> </td>
            <td class="pt-total"><?php echo $row_purchase['dongia'] . " VNĐ" ?></td>
            <td class="pt-status">
                <?php
                        if ($row_purchase['status'] == 0) {
                            echo '<span style="color: #ff0000;">Đang xử lý</span>';
                        } else if ($row_purchase['status'] == 1) {
                            echo '<span style="color: #33CCFF;">Đang vận chuyển</span>';
                        } else if ($row_purchase['status'] == 2) {
                            echo '<span style="color: #00DD00;">Đã hoàn thành</span>';
                        } else if ($row_purchase['status'] == 3) {
                            echo '<span style="color: #FFB90F;">Đổi hàng</span>';
                        }
                        ?>
            </td>
            <td class="pt-action"><a href="purchase_details.php?idpurchase=<?php echo $row_purchase['id'] ?>">Xem chi
                    tiết</a></td>
        </tr>
        <?php
        // Add more details as needed
    }

    // Đóng bảng cuối cùng
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>Bạn chưa mua đơn nào</p>";
}
        ?>