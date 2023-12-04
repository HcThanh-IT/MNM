<?php
    $xml = simplexml_load_file("TaiKhoan.xml");
    echo "So_TK: " . $xml->stk . "<br>";
    echo "So_Du: " . $xml->sodu . "<br>";
?>
