<?php
include_once "database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        a:hover {
            background: linear-gradient(25deg, rgba(255, 114, 176, 1) 0%, rgba(51, 255, 250, 1) 100%);
        }
    </style>
</head>
<body>
    <?php
    $conn = connectDatabase();
    if ($conn == null) {
        exit();
    }
    $sql = "SELECT * FROM theloai";
    $rs = mysqli_query($conn, $sql);
    ?>
    <?php while (true) {
        $row = mysqli_fetch_array($rs);
        if ($row == null) {
            break;
        }
        ?>
        <ul class="nav flex-column">
                <li class="item-link">
                    <a href="index.php?MaTheLoai=<?php echo $row["MaTheLoai"]; ?>" class="nav-link text-dark"><?php echo $row["TenTheLoai"]; ?></a>
                </li>
        </ul>
    <?php
    } ?>
</body>
</html>