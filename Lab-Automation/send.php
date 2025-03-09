<?php

include './config/Conn.php';

$query=mysqli_query($conn,"UPDATE product SET status='".$_POST['val']."' WHERE id='".$_POST['id']."'");

if ($query) {
    # code...

    $q=mysqli_query($conn,"SELECT * FROM product WHERE id='".$_POST['id']."'");
    $data=mysqli_fetch_assoc($query);
    echo $data['$status'];
}



?>