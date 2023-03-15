<?php
session_start();
if(!isset($_SESSION['login'])){
    echo "<script>window.location.assign('index.php');</script>";
}

require_once "connect.php";
mysqli_query($conn, "DELETE FROM accounts WHERE nickname=\"{$_SESSION['login']}\"");

session_destroy();
echo "
    <script>
        window.alert('帳號刪除成功！');
        window.location.assign('index.php');
    </script>
    ";
?>