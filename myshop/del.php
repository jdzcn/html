<?php

    include('conn.php');
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="delete from orders where oid='$id'";
        if(mysqli_query($conn, $sql)) {
            header('location:index.php');
        }
    }
    mysqli_close($conn);
?>
