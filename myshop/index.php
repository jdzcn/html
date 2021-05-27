

<?php
include "nav.php";
include "test.php";
?>
<form id="add" action="add.php">
<ul>
<li><input type="date" name="date" value="<?php echo date("Y-m-d"); ?>"></li>
<li><select name="pname">
<?php
include "conn.php";
/*conn.php 
$servername = "localhost";
$username = "song";
$password = "123456";
$dbname = "myshop";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
} 
*/
 
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row["pid"].">".$row["pname"]."</option>";
    }
} else {
    echo "empty.";
}
 
// mysqli_close($conn);
?>
</select></li>
<li><input type ="number" name="number" placeholder="数量" required/></li>

<li><input type ="number" name="amount" placeholder="金额" required/></li>
<li><input type="number" name="cost" placeholder="成本" required/></li>    
<li><input type="text" name="remark" placeholder="备注" value="<?php echo $tmpvar ?>"/></li>    
	
    <li class="naked"><input type ="submit" name="Save" value="添加销售"/></li>
</ui>

</form>
<?php
    $sql = "SELECT *,(amount-cost) as four FROM orders,products where products.pid=orders.pid order by oid desc limit 5";
    $result = mysqli_query($conn, $sql);
     
    if (mysqli_num_rows($result) > 0) {
        // 输出数据
        while($row = mysqli_fetch_assoc($result)) {
            include 'list.php';
/*             echo "<div style='width:35%;text-align:left;color:gray;font-size:0.9em;'>".$row['odate']."</div>";
            echo "<div style='width:65%;text-align:left;color:gray;font-size:0.9em;'>".$row['remark']."</div>";
            echo "<div style='text-align:left;width:30%;font-weight:bold'>".$row["pname"]."</div><div style='width:20%'>".$row['number']."</div><div>".$row["amount"]."</div><div style='color:green'>".$row["four"]."</div><hr>"; */
        }
    } else {
        echo "empty.";
    }
     
    mysqli_close($conn);
?>
</body>
</html>

