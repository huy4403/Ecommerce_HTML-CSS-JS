<?php
$time1 = time();
$daungay = strtotime('midnight', $time1);
$dautuan = strtotime('last monday', $time1);
$dauthang = strtotime('midnight first day of this month', $time1);
$daunam = strtotime('first day of January', $time1);

//Cuối quý 4
$quy4 = strtotime('last day of December', $time1);
$last_quy4 = strtotime('23:59:59', $quy4);

//Đầu quý 4
$first_quy4 = strtotime('first day of October', $time1);
//Cuối quý 3
$last_quy3 = strtotime('-1 second', $first_quy4);
//đầu quý 3
$first_quy3 = strtotime('first day of July', $time1);

//Cuối quý 2
$last_quy2 = strtotime('-1 second', $first_quy3);
//đầu quý 2
$first_quy2 = strtotime('first day of April', $time1);
//cuối quý 1
$last_quy1 = strtotime('-1 second', $first_quy2);

$defaultTime = 5;
$defaultLoai = 3;
// Check if the sorting option is set in the request, otherwise use the default
$loai_sort = isset($_GET['loai_sort']) ? $_GET['loai_sort'] : $defaultLoai;
$time_sort = isset($_GET['time_sort']) ? $_GET['time_sort'] : $defaultTime;
switch ($time_sort) {
        //Hôm nay
    case '5':
        $time = "WHERE thongke.created_time >= '$daungay' AND thongke.created_time <= '$time1'";
        break;
        //Tuần này
    case '6':
        $time = "WHERE thongke.created_time >= '$dautuan' AND thongke.created_time <= '$time1'";
        break;
        //Tháng này
    case '7':
        $time = "WHERE thongke.created_time >= '$dauthang' AND thongke.created_time <= '$time1'";
        break;
        //Quý 4
    case '8':
        $time = "WHERE thongke.created_time >= '$first_quy4' AND thongke.created_time <= '$last_quy4'";
        break;
        //Quý 3
    case '9':
        $time = "WHERE thongke.created_time >= '$first_quy3' AND thongke.created_time <= '$last_quy3'";
        break;
        //Quý 2
    case '10':
        $time = "WHERE thongke.created_time >= '$first_quy2' AND thongke.created_time <= '$last_quy2'";
        break;
        //Quý 1
    case '11':
        $time = "WHERE thongke.created_time >= '$daunam' AND thongke.created_time <= '$last_quy1'";
        break;
        //Năm nay
    case '12':
        $time = "WHERE thongke.created_time >= '$daunam' AND thongke.created_time <= '$time1'";
        break;
        //Hôm nay
    default:
        $time = "WHERE thongke.created_time >= '$daungay' AND thongke.created_time <= '$time1'";
}

// Modify the SQL query based on the selected filters
switch ($loai_sort) {
        //danh mục
    case '1':
        $sql = "SELECT danhmuc.name AS masp, SUM(thongke.doanhthu) AS tong_doanhthu FROM thongke JOIN danhmuc ON thongke.iddm = danhmuc.id $time GROUP BY thongke.iddm";
        break;
    case '2':
        $sql = "SELECT danhmuc.name AS masp, SUM(thongke.daban) AS tong_doanhthu FROM thongke JOIN danhmuc ON thongke.iddm = danhmuc.id $time GROUP BY thongke.iddm";
        break;

        //sản phẩm
        //doanh thu
    case '3':
        $sql = "SELECT thongke.masp, SUM(thongke.doanhthu) AS tong_doanhthu FROM thongke $time GROUP BY thongke.masp";
        break;
    case '4':
        //đã bán
        $sql = "SELECT thongke.masp, SUM(thongke.daban) AS tong_doanhthu FROM thongke $time GROUP BY thongke.masp";
        break;
    default:
        //doanhthu
        $sql = "SELECT thongke.masp, SUM(thongke.doanhthu) AS tong_doanhthu FROM thongke $time GROUP BY thongke.masp";
}

$result = mysqli_query($conn, $sql);
$data = [];
$sum = 0;
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
    $sum += $row['tong_doanhthu'];
}
?>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['masp', 'tong_doanhthu'],
                <?php
                foreach ($data as $key) {
                    echo "['" . $key['masp'] . "' , " . $key['tong_doanhthu'] . "],";
                }
                ?>
            ]);

            <?php
            $titleTemp = '';

            if ($loai_sort == 2 || $loai_sort == 4) {
                $titleTemp = "Tổng số lượng sản phẩm đã bán ";
            } else if ($loai_sort == 1 || $loai_sort == 3) {
                $titleTemp = "Tổng doanh thu ";
            }

            $timeTemp = '';

            if ($time_sort == 5) {
                $timeTemp = "hôm nay:";
            } else if ($time_sort == 6) {
                $timeTemp = "tuần này:";
            } else if ($time_sort == 7) {
                $timeTemp = "tháng này:";
            } else if ($time_sort == 8) {
                $timeTemp = "quý 4:";
            } else if ($time_sort == 9) {
                $timeTemp = "quý 3:";
            } else if ($time_sort == 10) {
                $timeTemp = "quý 2:";
            } else if ($time_sort == 11) {
                $timeTemp = "quý 1:";
            } else if ($time_sort == 12) {
                $timeTemp = "năm nay:";
            }

            $Tong_DoanhThu = number_format($sum);
            $DonVi = ($loai_sort == 1 || $loai_sort == 3) ? " Đồng" : '';

            $title = $titleTemp . ' ' . $timeTemp . ' ' . $Tong_DoanhThu . $DonVi;
            ?>

            var options = {
                title: '<?php echo $title; ?>'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div class="boloc">
        <label for="sort-doanhthu" style="margin-right: 20px;">Lọc theo</label>
        <div class="loc">
            <select name="loai_sort" onchange="SortLoaiTime(this.value, <?php echo $time_sort; ?>)">
                <option value="1" <?php echo ($loai_sort == 1) ? 'selected' : ''; ?>>Doanh thu(Danh mục)</option>
                <option value="2" <?php echo ($loai_sort == 2) ? 'selected' : ''; ?>>Đã bán(Danh mục)</option>
                <option value="3" <?php echo ($loai_sort == 3) ? 'selected' : ''; ?>>Doanh thu(Sản phẩm)</option>
                <option value="4" <?php echo ($loai_sort == 4) ? 'selected' : ''; ?>>Đã bán(Sản phẩm)</option>
            </select>
            <select class="loc1" name="time_sort" onchange="SortLoaiTime(<?php echo $loai_sort; ?>, this.value)">
                <option value="5" <?php echo ($time_sort == 5) ? 'selected' : ''; ?>>Hôm nay</option>
                <option value="6" <?php echo ($time_sort == 6) ? 'selected' : ''; ?>>Tuần này</option>
                <option value="7" <?php echo ($time_sort == 7) ? 'selected' : ''; ?>>Tháng này</option>
                <option value="8" <?php echo ($time_sort == 8) ? 'selected' : ''; ?>>Quý 4</option>
                <option value="9" <?php echo ($time_sort == 9) ? 'selected' : ''; ?>>Quý 3</option>
                <option value="10" <?php echo ($time_sort == 10) ? 'selected' : ''; ?>>Quý 2</option>
                <option value="11" <?php echo ($time_sort == 11) ? 'selected' : ''; ?>>Quý 1</option>
                <option value="12" <?php echo ($time_sort == 12) ? 'selected' : ''; ?>>Năm nay</option>
            </select>
        </div>
    </div>
    <?php
    if ($result->num_rows == 0) {
        echo "Đã bán được cái lào đâu =))";
    } else {
    ?>
        <div id="piechart" style="width: 820px; height: 500px; margin-left: 250px;">
        </div>
    <?php
    }
    ?>
</body>

</html>