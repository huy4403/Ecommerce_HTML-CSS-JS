<?php
$sql = "SELECT * FROM users WHERE role = '0'";
$stmt = $conn->prepare($sql);
// Execute the query
$stmt->execute();
// Get the result set
$result = $stmt->get_result();
?>
<table border="1" class="qlkh">
    <tr>
        <th>ID</th>
        <th>Tên khách hàng</th>
        <th>Số điện thoại</th>
        <th>Password</th>
        <th>Ngày tạo tài khoản</th>
        <th colspan="3">Thao tác</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $timestamp = $row['created_time'];
        $formattedTime = date(' H:i:s d-m-Y', $timestamp);
    ?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['tel'] ?></td>
        <td><?php echo $row['password']; ?></td>
        <td><?php echo $formattedTime ?></td>
        <td><a href="admin-user.php?iduser=<?php echo $row['id'] ?>">Xem chi tiết</a></td>
        <td><a href="admin-update.php?id=<?php echo $row['id'] ?>">Sửa</a></td>
        <td><a href="../database/admin-delete-users.php?id=<?php echo $row['id'] ?>">Xóa</a></td>
    </tr>
    <?php } ?>
</table>