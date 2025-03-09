<?php

include './config/Conn.php';

$query=mysqli_query($conn,"UPDATE srstbl SET srs_result='".$_POST['val']."' WHERE srs_id='".$_POST['srs_id']."'");

if ($query) {
    # code...

    $q=mysqli_query($conn,"SELECT * FROM srstbl WHERE srs_id='".$_POST['srs_id']."'");
    $data=mysqli_fetch_assoc($query);
    echo $data['$srs_result'];
}

?>