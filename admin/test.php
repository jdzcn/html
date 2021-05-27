<?php
    session_start();
    $_SESSION['islogin']=$_COOKIE['islogin'];
    if(!$_SESSION['islogin'])   {
        echo "您还没有登录,请<a href='login.php'>登录</a>";
        // header('location:login.php');
        die();

    }
?>