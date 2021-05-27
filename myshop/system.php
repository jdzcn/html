

<?php
include "nav.php";
include "test.php";
   
    $backup_file = date("Ymd").'.sql';
    echo '<ul>';
    echo "<li><a href='$backup_file'>下载数据库备份</a></li>";
    echo '</ul';
?>
</body>
</html>

