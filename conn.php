<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('admin/product.db');
      }
   }
   $db = new MyDB();
?>