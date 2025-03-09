<?php

include '../config/Conn.php';

$query=mysqli_query($conn,"UPDATE criptbl SET crip_result='".$_POST['val']."' WHERE crip_id='".$_POST['crip_id']."'");

if ($query) {
    # code...

    $q=mysqli_query($conn,"SELECT * FROM criptbl WHERE crip_id='".$_POST['crip_id']."'");
    $data=mysqli_fetch_assoc($query);
    echo $data['$crip_result'];
}

?>