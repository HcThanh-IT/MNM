<?php
  function connectDatabase()
  {
    $cnn = mysqli_connect("localhost", "root", "");
    if (!$cnn) { return null; }
    $db= mysqli_select_db($cnn, "ebookdb");
    if (!$db) { return null; }
    return $cnn;
}
?>