<?php
	include('header.php');
  include('test.php');
?>
    <form action="addcategory.php" method="get" >
    <!-- </select> -->
   <fieldset>
    <legend>一级分类</legend>
    <label for="category">选择</label>
    <select id="category" name="category" onchange="getcategory(this.value)">
    <option value=0>新类别</option>
	<?php
  	$sql = "SELECT id,name FROM category";
  	$result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['id'];
          echo ">".$row["name"]."</option>";
      }

?>
    </select>

	<label for="id">编号</label>
	<input type="text" id="id" name="id" placeholder=自动编号 value=0 readonly>
	<label for="name">分类名称</label>
	<input type="text" id="name" name="name" required placeholder=请输入分类名称>
<!-- 	<label for="desc">描述</label>
	<textarea id="desc" name="desc" rows="8" placeholder=请输入标签描述></textarea> -->
	<!-- <input type="text" id="desc" name="desc" placeholder=请输入标签描述> -->
    <input type="submit" value="提交"> </fieldset></form>
     
    <form action="addsub.php" method="get">
     <fieldset>
    <legend>二级分类</legend>

    <label for="sub">选择</label>
    <select id="sub" name="sub" onchange="getsub(this.value)">
    <option value=0>新类别</option>
  <?php
    $sql = "SELECT * FROM sub_category";
    $result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['id'];
          echo ">".$row["name"]."</option>";
      }

?>
    </select>

  <label for="sid">编号</label>
  <input type="text" id="sid" name="sid" placeholder=自动编号 value=0 readonly>
  <label for="subname">分类名称</label>
  <input type="text" id="subname" name="subname" required placeholder=请输入分类名称>
<!--  <label for="desc">描述</label>
  <textarea id="desc" name="desc" rows="8" placeholder=请输入标签描述></textarea> -->
  <!-- <input type="text" id="desc" name="desc" placeholder=请输入标签描述> -->
    <input type="submit" value="提交">

  </fieldset>
    </form>
<script type="text/javascript">
function gesub(str)
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
	    // document.getElementById("desc").value=tag.description;


    }
  }
xmlhttp.open("GET","gesub.php?id="+str,true);
xmlhttp.send();
}
</script>

<?php
	include('footer.php');
?>