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
    <option value=0>添加一级分类</option>
	<?php
  	$sql = "SELECT id,name FROM category";
  	$result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['id'];
          echo ">".$row["name"]."</option>";
      }

?>
    </select>

<!-- 	<label for="id">编号</label>
	<input type="text" id="id" name="id" placeholder=自动编号 value=0 readonly> -->
	<label for="name">分类名称</label>
	<input type="text" id="name" name="name" required placeholder=请输入分类名称>
<!-- 	<label for="desc">描述</label>
	<textarea id="desc" name="desc" rows="8" placeholder=请输入标签描述></textarea> -->
	<!-- <input type="text" id="desc" name="desc" placeholder=请输入标签描述> -->
    <input type="submit" value="提交"> </fieldset></form>
     
    <form action="addsub.php" method="get">
     <fieldset>
    <legend>二级分类</legend>

    <label for="sub_category">选择</label>
    <select id="sub_category" name="sub_category" onchange="getsub(this.value)">
    <option value=0>添加二级分类</option>
  <?php
    $sql = "SELECT sub_category.id as subid,category.name as cname,sub_category.name as sname FROM category,sub_category where category.id=sub_category.cid";
    $result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row['subid'].">".$row["cname"]."-".$row['sname']."</option>";
      }

?>
    </select>

<!--   <label for="sid">编号</label>
  <input type="text" id="sid" name="sid" placeholder=自动编号 value=0 readonly> -->
  <label for="subname">分类名称</label>
  <input type="text" id="subname" name="subname" required placeholder=请输入分类名称>
    <label for="cid">所属一级分类</label>
    <select id="cid" name="cid">
    <!-- <option value=0>新类别</option> -->
  <?php
    $sql = "SELECT id,name FROM category";
    $result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['id'];
          echo ">".$row["name"]."</option>";
      }

?>
    </select>
    <input type="submit" value="提交">

  </fieldset>
    </form>


<script type="text/javascript">

function getcategory(str)
{
  if (str==0) return;
var xmlhttp;

if (window.XMLHttpRequest)
  xmlhttp=new XMLHttpRequest();
else
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var category=JSON.parse(xmlhttp.responseText);

      // document.getElementById("id").value=xmlhttp.responseText;
      // document.getElementById("id").value=tag.id;
      document.getElementById("name").value=category.name;
      // document.getElementById("desc").value=tag.description;


    }
  }
xmlhttp.open("GET","getcategory.php?id="+str,true);
xmlhttp.send();
}

function getsub(str)
{
	if (str==0) return;
var xmlhttp;

if (window.XMLHttpRequest)
  xmlhttp=new XMLHttpRequest();
else
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	var sub=JSON.parse(xmlhttp.responseText);

	    // document.getElementById("id").value=xmlhttp.responseText;
	    // document.getElementById("id").value=tag.id;
	    document.getElementById("subname").value=sub.name;
      document.getElementById("cid").value=sub.cid;

	    // document.getElementById("desc").value=tag.description;


    }
  }
xmlhttp.open("GET","getsub.php?id="+str,true);
xmlhttp.send();
}
</script>

<?php
	include('footer.php');
?>