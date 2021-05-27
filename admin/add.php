<?php

  // namespace syc;
  // require("smms.class.php");
  include('test.php');
  require("../conn.php");

	// echo "name:".$_POST["name"]."<br>";
	// echo "category:".$_POST["category"]."<br>";
	// echo "tech:".$_POST["tech"]."<br>";
	// echo "desc:".$_POST["desc"]."<br>";

	// echo "spec:".$_POST["spec"]."<br>";
	// echo "price:".$_POST["price"]."<br>";

  $total = count($_FILES['images']['name']);

  for( $i=0 ; $i < $total ; $i++ ) {
      $tmpFilePath = $_FILES['images']['tmp_name'][$i];
      if ($tmpFilePath != ""){
        $filename=$_FILES['images']['name'][$i];
        $newFilePath = "../images/".$filename;
        $thumbnail="../thumbnail/".$filename;
        //imagemagick:composite -dissolve 30% -gravity center logo.png 1.jpg 2.jpg
        //convert 1.jpg -resize 100x100 resize_1.jpg
        // if(file_exists($newFilePath) || file_exists($thumbnail)) {
        //   echo "文件已经存在！"；
        //   exit(0);
        // }
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
          exec("convert ".$newFilePath." -resize 1000x1000 ".$newFilePath);
          exec("convert ".$newFilePath." -resize 300x300 ".$thumbnail);

          exec("composite -dissolve 30% -gravity southeast ../logo.png ".$newFilePath." ".$newFilePath);

          // $sdk = new sdk\smms("ifpobuWYbVskHEpeHueDavbm5GftHmSW");
          // $upload = $sdk->Image_Upload($newFilePath);
          // print_r($upload);
          // $data=json_decode($upload,true);
          // $storename=$data["data"]["storename"];
          // $newfilename= "../images/".$storename;
          // rename($newFilePath,$newfilename);
          // $imgstr=$imgstr.$filename."|";
         
        }

      }
  }
          // $imgstr=substr_replace($imgstr,'',-1);
          $prod=$_POST["prod"];
          $name=$_POST["name"];
          $cid=$_POST["category"];
          $imgstr=$_POST["imgstr"];
          $tags=implode(',',$_POST["tags"]);
          $spec=$_POST["spec"];
          $price=$_POST["price"];
          if ($prod==0) {
            $sql="insert into product (name,cid,images,tags,spec,price) values ('".$name."',";
            $sql.=$cid.",'".$imgstr."','".$tags."','".$spec."',";
            $sql.=$price.")";
          }
          else {
            $sql="update product set name='".$name."',cid=".$cid.",images='".$imgstr."',tags='".$tags."',spec='".$spec."',price=".$price;
            $sql.=" where id=".$prod;
          }
          echo $sql;

          
          if (mysqli_query($conn, $sql)) {
              echo "商品变更成功！<br><br>";
              echo "<a href='index.php'>继续变更</a>&nbsp; <a href='../index.php'>回到首页</a><br><br>";
              echo "sql:".$sql;
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          } 

  mysqli_close($conn);
?>
