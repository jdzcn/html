<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('blog.db');
      }
   }
   $db = new MyDB();
?>
