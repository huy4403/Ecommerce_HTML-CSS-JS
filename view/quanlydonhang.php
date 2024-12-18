<?php
$defaultSortOption = 1;
// Check if the sorting option is set in the request, otherwise use the default
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : $defaultSortOption;

// Define the column and order based on the selected option
switch ($sortOption) {
    case 1:
        $sortBy = "ORDER BY created_time DESC"; // Mới nhất
        break;
    case 2:
        $sortBy = "ORDER BY created_time ASC"; // Cũ nhất
        break;
    case 3:
        $sortBy = "ORDER BY thanhtienint ASC"; // Tăng dần
        break;
    case 4:
        $sortBy = "ORDER BY thanhtienint DESC"; // Giảm dần
        break;
    case 5:
        $sortBy = "WHERE status = '0'"; // Giảm dần
        break;
    case 6:
        $sortBy = "WHERE status = '1'"; // Giảm dần
        break;
    case 7:
        $sortBy = "WHERE status = '2'"; // Giảm dần
        break;
    case 8:
        $sortBy = "WHERE status = '3'"; // Giảm dần
        break;
    default:
        $sortBy = "ORDER BY created_time DESC"; // Default sorting
}

// SQL query with dynamic sorting
$sql = "SELECT * FROM purchase $sortBy";
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();
?>
<div class="sort">
    <label for="sort">Sắp xếp-Lọc</label>
    <select class="sort-content" name="sort" onchange="changeSort(this.value)">
        <optgroup label="Thời gian">
            <option value="1" <?php echo ($sortOption == 1) ? 'selected' : ''; ?>>Mới nhất</option>
            <option value="2" <?php echo ($sortOption == 2) ? 'selected' : ''; ?>>Cũ nhất</option>
        </optgroup>
        <optgroup label="Đơn giá">
            <option value="3" <?php echo ($sortOption == 3) ? 'selected' : ''; ?>>Tăng dần</option>
            <option value="4" <?php echo ($sortOption == 4) ? 'selected' : ''; ?>>Giảm dần</option>
        </optgroup>
        <optgroup label="Tình trạng">
            <option value="5" <?php echo ($sortOption == 5) ? 'selected' : ''; ?>>Đang xử lý</option>
            <option value="6" <?php echo ($sortOption == 6) ? 'selected' : ''; ?>>Đang vận chuyển</option>
            <option value="7" <?php echo ($sortOption == 7) ? 'selected' : ''; ?>>Đã hoàn thành</option>
            <option value="8" <?php echo ($sortOption == 8) ? 'selected' : ''; ?>>Đổi hàng</option>
        </optgroup>
    </select>
</div>
<table class="QLDH" align="center" border="1" style="margin-top: 50px;">
    <tr>
        <th>ID</th>
        <th>Tên khách hàng</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ nhận hàng</th>
        <th>Tổng tiền (VNĐ)</th>
        <th>Thời gian</th>
        <th colspan="2">Tình trạng</th>
        <th colspan="2">Thao tác</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $timestamp = $row['created_time'];
        $formattedTime = date('H:i d-m-Y', $timestamp);
    ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name_user'] ?></td>
            <td><?php echo $row['tel_user'] ?></td>
            <td><?php echo $row['address_user'] ?></td>
            <td><?php echo $row['dongia'] ?></td>
            <td><?php echo $formattedTime ?></td>
            <form class="updateVanchuyen" action="../database/update-status.php" method="POST">
                <td>
                    <input type="hidden" name="idpurchase" value="<?php echo $row['id']; ?>">
                    <select name="status" style="cursor: pointer;">
                        <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>>Đang xử lý</option>
                        <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>>Đang vận chuyển</option>
                        <option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>>Đã hoàn thành</option>
                        <option value="3" <?php if ($row['status'] == 3) echo 'selected'; ?>>Đổi hàng</option>
                    </select>
                </td>
                <td>
                    <button type="submit" name="update" style="color: aliceblue; background-color: #00CC00; border-radius: 5px; cursor: pointer;" onclick="updateVanchuyen(<?php echo $row['id']; ?>)">
                        Cập nhật
                    </button>
                </td>
            </form>
            <td>
                <a href="../view/admin-donhang.php?idp=<?php echo $row['id']; ?>">Xem chi tiết</a>
            </td>
        </tr>
    <?php } ?>
</table>
<script>
</script>