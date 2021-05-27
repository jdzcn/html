<?php
$servername = "localhost";
$username = "song";
$password = "123456";
$dbname = "store";
$imgdir = "images/"; 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
} 
?>