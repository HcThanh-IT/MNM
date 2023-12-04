<?php
    include_once "database.php";
    session_start(); 
    include "add_cart.php";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
    <title>EBook</title>
</head>
<body>
<?php

?>
<header class="bg-dark text-light">
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-12 col-md-4">
                <a class="text-decoration-none text-light" href="./index.php"><h1>BookShop</h1></a>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-md-center">
                <h3 class="slogan">"Sách là nguồn tri thức"</h3>
            </div>
            <div class="col-12 col-md-2">
                <a href="GioHang.php" class="text-decoration-none text-white" ><h3>Giỏ Hàng</h3></a>
            </div>
            <div class="col-12 col-md-2 text-right">
                <form action="" method="post" class="input-group mt-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2">Tìm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
    <div class="row">
        <div class="col-8">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tên sách</th>
                <th scope="col">Giá bán</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $conn = connectDatabase();
                if ($conn == null) {
                    exit();
                }
                $num=1;
                $TongSL=0;
                $TongTien=0;
                $dsThongTinSanPham = LayThongTinSanPham();
                foreach ($dsThongTinSanPham as $thongTinSanPham) {
                    $sql = "SELECT * FROM `sach` WHERE ISBN = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $thongTinSanPham['MaSanPham']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row_sach = mysqli_fetch_array($result)) {
                        $ThanhTien=$row_sach["GiaBan"] * $thongTinSanPham['SoLuong'];
            ?>
                <tr>
                    <th scope="row"><?php echo $num ?></th>
                    <td><?= $row_sach["Tua"]; ?></td>
                    <td><?= number_format($row_sach["GiaBan"])."đ"; ?></td>
                    <td><input type="number" name="qty" id="sst<?php echo $row_sach['ISBN']?>" min="0" max="1000" value="<?= $thongTinSanPham['SoLuong']; ?>" title="Quantity:" class="input-text qty">
                    <td><?=number_format($ThanhTien)."đ"; ?></td>
                    <td><a href="<?php echo $_SERVER['PHP_SELF'] . '?XoaSanPham=' . $row_sach['ISBN']?>">Xóa</a></td>
                    <!-- <td><a href="javascript:void(0);" onclick="deleteQuantity('<?php echo $row_sach['ISBN']; ?>')">Xóa</a></td> -->
<td><a href="javascript:void(0);" onclick="updateQuantity('<?php echo $row_sach['ISBN']; ?>')">Cập Nhật</a></td>

                </tr>
                


            <?php
           $TongSL += $thongTinSanPham['SoLuong'];
           $TongTien+=$ThanhTien;
           $num++;
                    } 
                mysqli_stmt_close($stmt);
                }
            ?>
            </tbody>
            </table>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-6"><h4>Tổng số lượng:</h4></div>
                <div class="col-6"><h4><?php echo $TongSL ?></h4></div>
            </div>
            <div class="row">
                <div class="col-6"><h4>Tổng tiền:</h4></div>
                <div class="col-6"><h4 class="text-danger"><?=number_format($TongTien)."đ"; ?></h4></div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col text-center"><button>Cập nhật giỏ hàng</button></div>
        <div class="col"></div>
        <div class="col"></div>
    </div> -->
    <script>
function updateQuantity(isbn) {
    if (document.getElementById('sst' + isbn).value == 0) {
        deleteQuantity(isbn);
    } else {
        var newQuantity = document.getElementById('sst' + isbn).value;
        window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?CapNhatSoLuong=' + isbn + '&newQuantity=' + newQuantity;
    }
}

function deleteQuantity(isbn) {
    window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?XoaSanPham=' + isbn;
}
</script>


</body>
</html>