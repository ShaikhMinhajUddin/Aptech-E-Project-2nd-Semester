<?php

include './config/Conn.php';


$eId = $_POST['eId'];
$sql = "select * from users where id = $eId";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($result);
$status = $data['status'];

if ($status == 'connected') {
    $status = 'disconnect';
}
else{
    $status = 'connected';
}

$update = "update users set status = '$status' where id = $eId ";
$result1 = mysqli_query($conn,$update);
if ($result1) {
    echo $status;
}
?>






