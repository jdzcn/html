<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>管家婆</title>
        <link rel="stylesheet" type="text/css" href="../css/default_full.css">
        <link rel="stylesheet" type="text/css" href="../css/header_black.css">
        <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
        <link rel="stylesheet" type="text/css" href="../css/snackbar.css">
        <link rel="stylesheet" type="text/css" href="../css/float_button.css">
    </head>
    <style type="text/css">
        article img {
            border-radius: 10px;
            float: left;
            width: 100px;
            height: 100px;

        }
        article li div {
            padding: 10px;
            margin: 0 auto;

        }
        article li p {
            margin: 0 auto;
            padding: 5px;
        }

        article ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        article li {
            padding: 5px;
            height: 100px;
            border-bottom: 1px lightgray solid;
        }        
        article li:hover {
            background: #eee;
            cursor: pointer;
        }
        article h3 {
            margin: 0 auto;
            padding: 5px;
        }        

    </style>
    <body>
        <header>
        	<h2>
        		<span onclick="document.getElementById('sidebar_left').style.width='300px'" >&#9776;&nbsp;</span>
        		<script type="text/javascript">document.write(document.title)</script>
                <span onclick="document.getElementById('sidebar_right').style.width='300px'" style="float: right;">&#8285;</span>

        		<!-- <input type="search" name="search" style="float: right;"> -->
        	</h2>
        </header>



        <main>


        	<article>
                <ul>
                <?php
                    include('conn.php');

                    $sql = "select id,date,name,number,sale.price,amount,img,sale.cost from sale,product where sale.pid=product.pid order by id desc limit 10";
                    $ret = $db->query($sql);

                    $dbdata = array();
                    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
                        $dbdata[]=$row;
                        // echo base64_encode($row['img'])."<br>";
                ?>
                        <li>
                            <img alt="<?= $row['name'] ?>" src="data:image/jpeg;base64,<?= base64_encode($row['img']) ?>" >
                            <div>
                            <p><?=$row['date']?><a href="#" onclick="show_msg('第<?=$row['id']?>条记录已经被删除！')" style="float: right;">删除</a></p>
                            
                            <h3><?=$row['name']?></h3>
                            <p style="text-align: right;">
                            <span><?=$row['number']?>X</span>
                            <span><?=$row['price']?>=</span>
                            <span><?=$row['amount']?></span>
                            <!-- <span><?=$row['cost']?>=</span>
                            <span><?=($row['amount']-$row['cost'])?></span> -->
                            </p>
                            </div>
                        </li>
                <?php
                    }
                    echo "</ul>";

                    $db->close();
                ?>

            </article>
        </main>
        <div id="sidebar_left" class="sidebar_left">
            <span class="close" onclick="this.parentElement.style.width = '0';">&times;</span>
                <ul>               
                    <li><a href="#" onclick="document.getElementById('sidebar_left').style.width='400px'">左侧对话框</a>  </li>
                    <li><a href="#" onclick="document.getElementById('sidebar_right').style.width='400px'">右侧对话框</a> </li> 
                    <li><a href="#" onclick="document.getElementById('sidebar_bottom').style.height='400px'">底部对话框</a> </li> 
                    <li><a href="#" onclick="document.getElementById('dialog').style.display='block'">普通对话框</a>  </li>
                    <li><a href="#" onclick="show_msg('这是一个自动关闭通知。')">弹出一个通知</a></li>
                </ul>
        </div>

        <div id="sidebar_right" class="sidebar_right">
            <span class="close" onclick="this.parentElement.style.width = '0';">&times;</span>
        </div> 

        <div id="sidebar_bottom" class="sidebar_bottom">
            <span class="close" onclick="this.parentElement.style.height = '0';">&times;</span>
        </div> 

        <div id="dialog" class="dialog">
            <span class="close" onclick="this.parentElement.style.display = 'none';">&times;</span>
        </div> 

        <button onclick="document.getElementById('sidebar_bottom').style.height='400px'" class="float_button" id="add" title="add">&#43;</button>
        <!--
        <footer>
            <a href="mailto:jdzcn@qq.com" >联系我们</a>
        </footer>
		-->
        <div id="snackbar"></div>

        <script type="text/javascript">
            function show_msg(msg) {
              var x = document.getElementById("snackbar");

              // Add the "show" class to DIV
              x.className = "show";
              x.innerHTML=msg;
              // After 3 seconds, remove the show class from DIV
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }
        </script>

    </body>
</html>