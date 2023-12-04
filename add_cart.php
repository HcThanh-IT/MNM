<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["ThemSanPham"])) {
        ThemMatHang($_GET["ThemSanPham"]);
        
    } elseif (isset($_GET["deleteCart"])) {
        XoaGioHang();
    } elseif (isset($_GET["XoaSanPham"])) {
        $maSanPhamToDelete = $_GET["XoaSanPham"];
        echo "Trying to delete product with ID: $maSanPhamToDelete";
        XoaSanPham($maSanPhamToDelete);
    } elseif (isset($_GET["CapNhatSoLuong"])) {
        $maSanPhamToUpdate = $_GET["CapNhatSoLuong"];
        $soLuongMoi = $_GET["newQuantity"];
        // echo "Trying to update quantity for product with ID: $maSanPhamToUpdate to $soLuongMoi";
        CapNhatSoLuong($maSanPhamToUpdate, $soLuongMoi);
    }
}

function ThemMatHang($MaHang) {
    $ChuoiMaHang = isset($_SESSION["ChuoiMaHang"]) ? $_SESSION["ChuoiMaHang"] : "";
    $ChuoiSoLuong = isset($_SESSION["ChuoiSoLuong"]) ? $_SESSION["ChuoiSoLuong"] : "";

    if (!strpos(";$ChuoiMaHang", $MaHang)) {
        $ChuoiMaHang .= $MaHang . ";";
        $ChuoiSoLuong .= "1;";

        $_SESSION["ChuoiMaHang"] = $ChuoiMaHang;
        $_SESSION["ChuoiSoLuong"] = $ChuoiSoLuong;
    } else {
        $DayMaHang = explode(";", $ChuoiMaHang);
        $DaySoLuong = explode(";", $ChuoiSoLuong);

        for ($i = 0; $i < count($DayMaHang) - 1; $i++) {
            if (intval($DayMaHang[$i]) == intval($MaHang)) {
                $DaySoLuong[$i] = intval($DaySoLuong[$i]) + 1;
                $_SESSION["ChuoiSoLuong"] = implode(";", $DaySoLuong);
                break;
            }
        }
    }
}

function XoaSanPham($MaHang) {
    $ChuoiMaHang = isset($_SESSION["ChuoiMaHang"]) ? $_SESSION["ChuoiMaHang"] : "";
    $ChuoiSoLuong = isset($_SESSION["ChuoiSoLuong"]) ? $_SESSION["ChuoiSoLuong"] : "";

    $DayMaHang = explode(";", $ChuoiMaHang);
    $DaySoLuong = explode(";", $ChuoiSoLuong);

    foreach ($DayMaHang as $i => $Hang) {
        if ($Hang == $MaHang) {
            unset($DayMaHang[$i]);
            unset($DaySoLuong[$i]);

            $_SESSION["ChuoiMaHang"] = implode(";", $DayMaHang);
            $_SESSION["ChuoiSoLuong"] = implode(";", $DaySoLuong);
            break;
        }
    }

    header("Location: GioHang.php");
    exit();
}

function CapNhatSoLuong($MaHang, $SoLuongMoi) {
    $ChuoiMaHang = isset($_SESSION["ChuoiMaHang"]) ? $_SESSION["ChuoiMaHang"] : "";
    $ChuoiSoLuong = isset($_SESSION["ChuoiSoLuong"]) ? $_SESSION["ChuoiSoLuong"] : "";

    $DayMaHang = explode(";", $ChuoiMaHang);
    $DaySoLuong = explode(";", $ChuoiSoLuong);

    foreach ($DayMaHang as $i => $Hang) {
        if ($Hang == $MaHang) {
            $DaySoLuong[$i] = $SoLuongMoi;

            $_SESSION["ChuoiSoLuong"] = implode(";", $DaySoLuong);

            // echo "Quantity for product with ID: $MaHang updated to $SoLuongMoi.";
            
            // header("Location: GioHang.php");
            // exit();
        }
    }

    // echo "Product with ID: $MaHang not found in the cart.";
}

function XoaGioHang() {
    unset($_SESSION['ChuoiMaHang']);
    unset($_SESSION['ChuoiSoLuong']);

    header("Location: GioHang.php");
    exit();
}

function SoLuong($MaHang)
{
    $ChuoiMaHang = isset($_SESSION["ChuoiMaHang"]) ? $_SESSION["ChuoiMaHang"] : "";
    $ChuoiSoLuong = isset($_SESSION["ChuoiSoLuong"]) ? $_SESSION["ChuoiSoLuong"] : "";

    $DayMaHang = explode(";", $ChuoiMaHang);
    $DaySoLuong = explode(";", $ChuoiSoLuong);

    foreach ($DayMaHang as $i => $Hang) {
        if ($Hang == $MaHang) {
            return $DaySoLuong[$i];
        }
    }

    return 0;
}

function LayThongTinSanPham()
{
    $ChuoiMaHang = isset($_SESSION["ChuoiMaHang"]) ? $_SESSION["ChuoiMaHang"] : "";
    $ChuoiSoLuong = isset($_SESSION["ChuoiSoLuong"]) ? $_SESSION["ChuoiSoLuong"] : "";

    $dsThongTinSanPham = array();

    $DayMaHang = explode(";", $ChuoiMaHang);
    $DaySoLuong = explode(";", $ChuoiSoLuong);

    foreach ($DayMaHang as $index => $MaSanPham) {
        $SoLuong = isset($DaySoLuong[$index]) ? $DaySoLuong[$index] : 0;

        $dsThongTinSanPham[] = array(
            "MaSanPham" => $MaSanPham,
            "SoLuong" => $SoLuong
        );
    }

    return $dsThongTinSanPham;
}
?>
</body>
</html>