<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../css/default.css">

  <link rel="stylesheet" type="text/css" href="../css/lightform.css">
<title>添加商品</title>
</head>
<body>
<?php
    include("conn.php");

?>


    <form action="product.php" method="post" enctype="multipart/form-data">


          <label for="pid">选择</label>
    <select id="pid" name="pid" onchange="geprod(this.value)">
    <option value=0>添加商品</option>
  <?php
    $sql = "SELECT pid,name FROM product order by pid desc";
    $ret = $db->query($sql);
   
      while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
          echo "<option value=".$row['pid'];
          echo ">".$row['pid']."-".$row["name"]."</option>";
      }

?>
    </select>

    
      <label for="name">商品名称</label>
      <input type="text" id="name" name="name" required placeholder=请输入商品名称>
      <output id="result" ></output>

      <label for="images">商品图片</label>     
      <input id="images" name="images" type="file" accept="image/*" />
      <input type="text" id="imgstr" name="imgstr" placeholder=商品图片>


  
    <label for="craft">工艺</label>
    <select id="craft" name="craft" onchange="getname()">
<?php
  $sql = "SELECT cid,name from craft";
  $ret = $db->query($sql);
   
      while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
          echo "<option value=".$row['cid'].">".$row["name"]."</option>";
      }

?>
    </select>

     <label for="graph">图案</label>
    <select id="graph" name="graph" onchange="getname()">
<?php
  $sql = "SELECT gid,name from graph";
  $ret = $db->query($sql);
   
      while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
          echo "<option value=".$row['gid'].">".$row["name"]."</option>";
      }

?>
    </select>  

    <label for="style">器型</label>
    <select id="style" name="style" onchange="getname()">
<?php
  $sql = "SELECT sid,name from style";
  $ret = $db->query($sql);
   
      while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
          echo "<option value=".$row['sid'].">".$row["name"]."</option>";
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
        document.getElementById("name").value=prod[0].name;
        document.getElementById("result").innerHTML="";

        document.getElementById("images").value=null;
        document.getElementById("imgstr").value=prod[0].image;
        var output = document.getElementById("result");
        // var img=prod[0].images.split('|');
        var div = document.createElement("div");
                // div.style="display:inline";
                div.innerHTML = "<img class='thumbnail' src='../thumbnail/" + prod[0].image+ "' />";
                output.insertBefore(div, null);
        // output.innerHTML = "<img class='thumbnail' src='../thumbnail/" + img[0]+ "' width=100px/>";
        document.getElementById("craft").value=prod[0].cid;
        document.getElementById("graph").value=prod[0].gid;
        document.getElementById("style").value=prod[0].sid;


        // document.getElementById("prod[0]s").value=implode(',',prod[0].prod[0]s);
        document.getElementById("spec").value=prod[0].spec;
        document.getElementById("price").value=prod[0].price;


      }
    }
  xmlhttp.open("GET","product.php?pid="+str,true);
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
getname();

  function getname() {
      var craft=document.getElementById('craft');
      var c=craft.options[craft.selectedIndex].text;

      var graph=document.getElementById('graph');
      var g=graph.options[graph.selectedIndex].text;

       var style=document.getElementById('style');
      var s=style.options[style.selectedIndex].text;     
      document.getElementById('name').value=c+g+s;
  }

  </script> 

  <?php
    
    $db->close();
  ?>
</body></html>