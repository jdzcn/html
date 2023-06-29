<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers

include "conn.php";

	
			$sql = "SELECT count(*) as count from sale ";

			$ret = $db->query($sql);

			$dbdata = array();
			$row = $ret->fetchArray(SQLITE3_ASSOC);
			
			echo $row["count"];

	$db->close();



?>
