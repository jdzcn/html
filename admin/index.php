<?php
    include("header.php");
    include('test.php');
?>


    <form action="add.php" method="post" enctype="multipart/form-data">


          <label for="prod">选择</label>
    <select id="prod" name="prod" onchange="geprod(this.value)">
    <option value=0>添加商品</option>
  <?php
    $sql = "SELECT id,name FROM product order by id desc";
    $result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['id'];
          echo ">".$row['id']."-".$row["name"]."</option>";
      }

?>
    </select>

    
      <label for="name">商品名称</label>
      <input type="text" id="name" name="name" required placeholder=请输入商品名称>
      <output id="result" ></output>

      <label for="images">商品图片</label>     
      <input id="images" name="images[]" type="file" accept="image/*" multiple />
      <input type="text" id="imgstr" name="imgstr" placeholder=商品图片>
    <label for="category">商品分类</label>
    <select id="category" name="category">
<?php
  $sql = "SELECT sub_category.id as subid,category.name as cname,sub_category.name as sname FROM category,sub_category where category.id=sub_category.cid";
  $result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['subid'].">".$row["cname"]."-".$row['sname']."</option>";
      }

?>
    </select>
  
    <label for="tags">标签</label>
    <select id="tags" name="tags[]" size=10 multiple>
<?php
  $sql = "SELECT * FROM tag";
  $result = mysqli_query($conn, $sql);
   
      while($row = mysqli_fetch_assoc($result)) {
          echo "<option value=".$row['id'];
          if ($row['id']==1) echo ' selected="selected"';
          echo ">".$row["name"]."</option>";
      }

?>
    </select>

    <label for="spec">规格</label>
    <input type="text" id="spec" name="spec" placeholder=请输入规格>
  
    <label for="price">价格</label>
    <input type="number" id="price" name="price" value=0 placeholder=请输入价格>

    <input type="submit" value="提交">

  </form>	
	<script type="text/javascript">

function geprod(str)
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
        var prod=JSON.parse(xmlhttp.responseText);

        // document.getElementById("id").value=xmlhttp.responseText;
        // document.getElementById("id").value=prod.id;
        document.getElementById("name").value=prod.name;
        document.getElementById("result").innerHTML="";

        document.getElementById("images").value=null;
        document.getElementById("imgstr").value=prod.images;
        var output = document.getElementById("result");
        var img=prod.images.split('|');
        var div = document.createElement("div");
                // div.style="display:inline";
                div.innerHTML = "<img class='thumbnail' src='../thumbnail/" + img[0]+ "' />";
                output.insertBefore(div, null);
        // output.innerHTML = "<img class='thumbnail' src='../thumbnail/" + img[0]+ "' width=100px/>";
        document.getElementById("category").value=prod.cid;

        var values = prod.tags;
        var splitValues = values.split(',');
        var multi = document.getElementById('tags');

        multi.value = null; // Reset pre-selected options (just in case)
        var multiLen = multi.options.length;
        for (var i = 0; i < multiLen; i++) {
          if (splitValues.indexOf(multi.options[i].value) >= 0) {
            multi.options[i].selected = true;
          }
        }
        // document.getElementById("prods").value=implode(',',prod.prods);
        document.getElementById("spec").value=prod.spec;
        document.getElementById("price").value=prod.price;


      }
    }
  xmlhttp.open("GET","getprod.php?id="+str,true);
  xmlhttp.send();
}



		function handleFileSelect() {
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {

        var files = event.target.files; //FileList object
        var output = document.getElementById("result");
        var imgs=document.getElementById("imgstr");
        imgs.value="";
        output.innerHTML="";
        var len=files.length;
        for (var i = 0; i < len; i++) {
            var file = files[i];
            //Only pics
            // if (!file.type.match('image')) continue;
            
            const maxAllowedSize = 2 * 1024 * 1024;
              if (file.size > maxAllowedSize) {
                alert('文件大小超出限制！');
                event.target.value ='';
                break;
                // Here you can ask your users to load correct file
                // alert("文件大小超出限制！")；
                // exit(0);
              }
            var picReader = new FileReader();
            picReader.addEventListener("load", function (event) {
                var picFile = event.target;
                var div = document.createElement("div");
                // div.style="display:inline";
                div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                output.insertBefore(div, null);
            });
            //Read the image
            picReader.readAsDataURL(file);
            imgs.value+=file.name+(i==(len-1)?"":"|");
        }
        // imgs.value=imgs.value.substr(0,(len-1));

    } else {
        console.log("Your browser does not support File API");
    }
}

document.getElementById('images').addEventListener('change', handleFileSelect, false);

  </script>

  <?php
    
    include('footer.php');
  ?>
