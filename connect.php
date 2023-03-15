<?php
$conn = mysqli_connect("localhost", "root", "", "oneatwob");
if(!$conn){
    echo "<script>window.alert('無法連接至資料庫，請稍後再試。')</script>";
    die("Failed to connect to MySQL.".mysqli_connect_error());
}
mysqli_query($conn, "set names utf8mb4");
?>