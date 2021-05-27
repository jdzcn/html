<?php
    include 'header.php';
?>
<form action="" method="post"> 
<ul>
<li><input type="password" name="pw" placeholder="请输入登录密码" required/></li>

<li class="naked"><input type ="submit" name="login" value="登录"/></li>
</ul>
</form>
<?php
if (isset($_POST['login'])&&($_POST['pw']=='7831')) {
    session_start();
    $_SESSION['islogin'] = 1;
    setcookie('islogin',1,time()+3600*24*30);
    header('location:index.php');
    die();
    }
?> 
</body>
</html>