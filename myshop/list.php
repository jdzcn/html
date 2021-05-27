<?php
    echo "<div style='width:35%;text-align:left;color:gray;font-size:0.9em;'>".$row['odate']."</div>";
    echo "<div style='width:55%;text-align:left;color:gray;font-size:0.9em;'>".$row['remark']."</div>";
    echo "<a style='font-size:0.9em' onClick=\"javascript: return confirm('确定删除这条记录吗？');\" href='del.php?id=".$row['oid']."'>删除</a>"; 
    $co=$row['four']>0?'green':'red';
    echo "<div style='text-align:left;width:30%;font-weight:bold'>".$row["pname"]."</div><div style='width:20%'>".$row['number']."</div><div>".$row["amount"]."</div><div style='color:$co'>".$row["four"]."</div><hr>";
?>