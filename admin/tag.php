<?php
	include('header.php');
  include('test.php');
?>
    <form action="addtag.php" method="get" >
    <!-- </select> -->
  
    <label for="tags">选择</label>
    <select id="tags" name="tags" onchange="getag(this.value)">
    <option value=0>添加标签</option>
	<?php
  	$sql = "SELECT id,name FROM tag";
  	$result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['id'];
          echo ">".$row["name"]."</option>";
      }

?>
    </select>

	<label for="id">编号</label>
	<input type="text" id="id" name="id" placeholder=自动编号 value=0 readonly>
	<label for="name">标签名称</label>
	<input type="text" id="name" name="name" required placeholder=请输入标签名称>
	<label for="desc">描述</label>
	<textarea id="desc" name="desc" rows="8" placeholder=请输入标签描述></textarea>
	<!-- <input type="text" id="desc" name="desc" placeholder=请输入标签描述> -->
    <input type="submit" value="提交">      
    </form>
<script type="text/javascript">
function getag(str)
{
	if (str==0) {
		document.getElementById("id").value=0;
		return;
	}
var xmlhttp;

if (window.XMLHttpRequest)
  xmlhttp=new XMLHttpRequest();
else
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	var tag=JSON.parse(xmlhttp.responseText);

	    // document.getElementById("id").value=xmlhttp.responseText;
	    document.getElementById("id").value=tag.id;
	    document.getElementById("name").value=tag.name;
	    document.getElementById("desc").value=tag.description;


    }
  }
xmlhttp.open("GET","getag.php?id="+str,true);
xmlhttp.send();
}
</script>

<?php
	include('footer.php');
?>