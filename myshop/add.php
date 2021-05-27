

<?php
// include "nav.php";
include "conn.php";

$sql="insert into orders (pid,odate,number,amount,cost,remark) values (";
$sql=$sql.$_GET["pname"].",'".$_GET["date"]."',".$_GET["number"].",".$_GET['amount'].",";
$sql=$sql.$_GET["cost"].",'".$_GET['remark']."')";
// echo $sql;
if (mysqli_query($conn, $sql)) {
    // echo "<script>alert('新记录插入成功')</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 
mysqli_close($conn);
header("Location: index.php");
exit();
?>


</body>
</html>

