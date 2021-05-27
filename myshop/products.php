

<?php
include "nav.php";
include "test.php";
include "conn.php";
?>
<form action="" method="get"> 
<ul>
<li><input type="text" name="prod" placeholder="请输入商品名称" required/></li>
<li class="naked"><input type ="submit" name="Save" value="添加商品"/></li>
</ul>
</form>
<?php
    $q = isset($_GET['prod'])? htmlspecialchars($_GET['prod']) : '';
    if($q) {
    $sql="insert into products (pname) values ('".$q."')";
    
    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('新记录插入成功')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }
    $sql = "SELECT * FROM products order by pid desc";
    $result = mysqli_query($conn, $sql);
     
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo $row["pname"]."<span style='float:right'>".$row["pid"]."</span><hr>";
        }
    } else {
        echo "empty.";
    }
     
    mysqli_close($conn);
?>

</body>
</html>

