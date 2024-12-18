<?php

// if (!isset($_POST['search']) && empty($_SESSION['id'])) {
//     header("Location: javascript://history.go(-1)");
// }

$defaultSortOption = 1;
// Check if the sorting option is set in the request, otherwise use the default
$sortOptionSP = isset($_GET['sortsp']) ? $_GET['sortsp'] : $defaultSortOption;

// Define the column and order based on the selected option
switch ($sortOptionSP) {
    case 1:
        $sortBy = "created_time DESC"; // Mới nhất
        break;
    case 2:
        $sortBy = "created_time ASC"; // Cũ nhất
        break;
    case 3:
        $sortBy = "best_seller DESC"; // Giảm dần
        break;
    case 4:
        $sortBy = "soluong ASC"; // tăng
        break;
    case 5:
        $sortBy = "soluong DESC"; // Giảm
        break;
    default:
        $sortBy = "created_time DESC"; // Default sorting
}
if (isset($_POST['noidung'])) {
    // Get the search query from the form
    $noidung = $_POST['noidung'];
    $sql = "SELECT * FROM sanpham WHERE name LIKE '%$noidung%' OR masp LIKE '%$noidung%' OR color LIKE '%$noidung%' LIMIT 9";
    // Prepare and execute a SQL query to search for products in your database
} else {
    $sql = "SELECT * FROM sanpham ORDER BY $sortBy";
}
$result = $conn->query($sql);

$stmt = $conn->prepare($sql);
// Execute the query
$stmt->execute();
// Get the result set
$result = $stmt->get_result();
// Check the number of rows returned
?>
<?php if ($result->num_rows > 0) { ?>
<div class="sortsp">
    <label for="sortsp">Sắp xếp theo</label>
    <select class="sort-content-sp" name="sortsp" onchange="changeSortsp(this.value)">
        <optgroup label="Thời gian">
            <option value="1" <?php echo ($sortOptionSP == 1) ? 'selected' : ''; ?>>Mới nhất</option>
            <option value="2" <?php echo ($sortOptionSP == 2) ? 'selected' : ''; ?>>Cũ nhất</option>
        </optgroup>
        <option value="3" <?php echo ($sortOptionSP == 3) ? 'selected' : ''; ?>>Bán chạy
        </option>
        <optgroup label="Kho">
            <option value="4" <?php echo ($sortOptionSP == 4) ? 'selected' : ''; ?>>Tăng</option>
            <option value="5" <?php echo ($sortOptionSP == 5) ? 'selected' : ''; ?>>Giảm</option>
        </optgroup>
    </select>
</div>
<div class="searchsp">
    <form action="admin-panel.php?pg=listsp" method="POST" class="search-form">
        <input type="text" name="noidung" class="search-content" placeholder="Tìm kiếm sản phẩm">
        <button type="submit" onclick="showProduct()" class="search-button"><i id="search-icon"
                class="fa-solid fa-magnifying-glass" style="color: black;"></i></button>
    </form>
</div>
<table border="1" class="listsp">
    <tr>
        <th>STT</th>
        <th>mã sản phẩm</th>
        <th>Danh mục</th>
        <th>Kho</th>
        <th>Đã bán</th>
        <th>Giá nhập</th>
        <th>Giá bán</th>
        <th>Lãi</th>
        <th>Thời gian nhập hàng</th>
        <th colspan="3">Thao tác</th>
    </tr>
    <?php
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $timestamp = $row['created_time'];
            $formattedTime = date(' H:i:s d-m-Y', $timestamp);
            $gianhap = intval(preg_replace('/[,.]/', '', $row['gianhap']));
            $giaban = intval(preg_replace('/[,.]/', '', $row['giaban']));
            $tienlai = ($giaban - $gianhap) * ($row['best_seller']);
            $formatTienlai = number_format($tienlai);
        ?>
    <tr>
        <td style="font-weight: 600;"><?php echo $count++ ?></td>
        <td><?php echo $row['masp'] ?></td>
        <td><?php if ($row['iddm'] == 1) {
                        echo "Áo sơ mi";
                    } else if ($row['iddm'] == 2) {
                        echo "Áo Polo";
                    } else if ($row['iddm'] == 3) {
                        echo "Quần";
                    } else if ($row['iddm'] == 4) {
                        echo "Suit";
                    } else if ($row['iddm'] == 5) {
                        echo "Giảm giá";
                    }
                    ?></td>
        <td><?php echo $row['soluong'] ?></td>
        <td><?php echo $row['best_seller'] ?></td>
        <td><?php echo $row['gianhap'] ?></td>
        <td><?php echo $row['giaban'] ?></td>
        <td style="color: red;"><?php echo $formatTienlai . "đ" ?></td>
        <td><?php echo $formattedTime ?></td>
        <td><a href="admin-spdetails.php?idsp=<?php echo $row['id'] ?>">Xem chi tiết</a></td>
        <td><a href="./form-update-sanpham.php?id=<?php echo $row['id'] ?>">Sửa</a></td>
        <td><a href="../database/admin-delete-sanpham.php?id=<?php echo $row['id'] ?>">Xóa</a></td>
    </tr>
    <?php
        }
    } else {
        echo "Không có khách hàng =))";
    }
    ?>
</table>