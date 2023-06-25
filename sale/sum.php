<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers

	include('conn.php');
	$start_date = isset($_GET['start_date'])? htmlspecialchars($_GET['start_date']) : '';
	$end_date = isset($_GET['end_date'])? htmlspecialchars($_GET['end_date']) : '';
	$fs = isset($_GET['fs'])? htmlspecialchars($_GET['fs']) : 0;

	$datestr=" date>='".$start_date."' and date<='".$end_date."'";	
	$sql= array("select date as one,sum(amount) as two,sum(amount-cost) as three from sale where".$datestr." group by date order by date desc",
                "select substr(date,1,7) as one,sum(amount) as two,sum(amount-cost) as three from sale where".$datestr." group by substr(date,1,7) order by substr(date,1,7) desc",
                "select category.name as one,sum(amount) as two,sum(amount-sale.cost)as three from sale,product,category where sale.pid=product.pid AND product.cid=category.cid and ".$datestr."GROUP by category.name ORDER by three DESC",
                "select category.name||'"."->"."'||product.name as one,sum(amount) as two,sum(amount-sale.cost) as three from sale,product,category where sale.pid=product.pid and category.cid=product.cid and ".$datestr." group by one order by three desc");
	$i=(integer)$fs;

	// echo $sql[$i]."<br>";

	$ret = $db->query($sql[$i]);

	$dbdata = array();

			while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
				$dbdata[]=$row;
			}

	echo json_encode($dbdata);


	$db->close();



?>
