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


    <div class="content">
        <?php
        $conn = connectDatabase();
        if ($conn == null) {
            exit();
        }
        
        $sql = "SELECT * FROM theloai";
        $rs = mysqli_query($conn, $sql);
        ?>
        <div class="row">
            <div class="col-sm-2">
                <?php include "LietKeTheLoai.php" ?>
            </div>
            <div class="col-sm-7">
                <?php include "LietKeSach.php" ?>
            </div>
            <div class="col-sm-3">
                <h1>Quảng cáo</h1>
            </div>
        </div>
    </div>
</body>
</html>