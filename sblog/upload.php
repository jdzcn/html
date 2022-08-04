<?php

  $filename=$_FILES['file']['name'];
  echo $filename;
  $newfilename='_posts/'.$filename;

  if(move_uploaded_file($_FILES['file']['tmp_name'],$newfilename)) echo '上传成功!';
  else echo '上传失败!'

  
?>
