<?php
include_once "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php

$conn = connectDatabase();
if ($conn == null) {
    exit();
}




$maTheLoai = null;
if (isset($_GET["MaTheLoai"])) {
    $maTheLoai = $_GET["MaTheLoai"];
}
if ($maTheLoai == null) {
    $sql_sach = "SELECT sach.*, nhaxb.TenNXB
    FROM sach
    LEFT JOIN nhaxb ON sach.MaNXB = nhaxb.MaNXB";
    if (isset($_POST['submit'])) {
        $keyword = $_POST['search'];
        if (!empty($keyword)) {
            $sql_sach .= " WHERE Tua LIKE '%$keyword%'";
        }
    }
} else {
    $sql_sach = "SELECT sach.*, nhaxb.TenNXB 
    FROM sach
    LEFT JOIN nhaxb ON sach.MaNXB = nhaxb.MaNXB
    WHERE sach.MaTheLoai = '$maTheLoai'";

    if (isset($_POST['submit'])) {
        $keyword = $_POST['search'];
        if (!empty($keyword)) {
            $sql_sach .= " AND Tua LIKE '%$keyword%'";
        }
    }
}
$rs_sach = mysqli_query($conn, $sql_sach);
$total_records = mysqli_num_rows($rs_sach);
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 2;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
    $current_page = $total_page;
} elseif ($current_page < 1) {
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;
if($total_records==0){
    $sql_sach.="";
}
else $sql_sach.=" LIMIT $start, $limit";
$rs_sach = mysqli_query($conn, $sql_sach);
?>
<div class="row">

    <?php 
    while (true) {
        $row_sach = mysqli_fetch_array($rs_sach);
        if ($row_sach == null) {
            break;
        }
        ?>
        <div class="col-md-4 mt-2">
            <div class="card mb-4 h-100">
                <img src="./Images/<?php echo $row_sach["Hinh"]; ?>" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo $row_sach["Tua"]; ?></h5>
                    <div class="card-text d-flex flex-column">
                        <p class="card-text">Tác giả: <?php echo $row_sach["TacGia"]; ?></p>
                        <p class="card-text">Nhà xuất bản: <?php echo $row_sach["TenNXB"]; ?></p>
                        <p class="card-text">Năm xuất bản: <?php echo $row_sach["NamXB"]; ?></p>
                        <p class="card-text">Số trang: <?php echo $row_sach["SoTrang"]; ?></p>
                        <p class="card-text">Giá bán: <?php echo $row_sach["GiaBan"]; ?> VNĐ</p>
                        <a href="<?php echo $_SERVER['PHP_SELF'] . '?ThemSanPham=' . $row_sach['ISBN']; ?>">Thêm vào giỏ hàng</a>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<nav aria-label="Page navigation example" class="mt-3">
    <ul class="pagination justify-content-center">
        <?php 
        $link = $maTheLoai == null ? "index.php?page=" : "index.php?MaTheLoai=" . $maTheLoai . "&page=";
        ?>

        <li class="page-item " id="previousPage">
            <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="page-link" href="' . $link . ($current_page - 1) . '">Previous</a>';
            }
            ?>
        </li>
        <?php
        for ($i = 1; $i <= $total_page; $i++) {
            echo '<li class="page-item" id="page' . $i . '">';
            if ($i == $current_page) {
                echo '<span class="page-link text-light fw-bold bg-dark">' . $i . '</span>';
            } else {
                echo '<a class="page-link" href="' . $link . $i . '">' . $i . '</a>';
            }
            echo '</li>';
        }
        ?>
        <li class="page-item" id="nextPage">
            <?php
            if ($current_page < $total_page) {
                echo '<a class="page-link" href="' . $link . ($current_page + 1) . '">Next</a>';
            }
            ?>
        </li>
    </ul>
</nav>
-

</body>
</html>