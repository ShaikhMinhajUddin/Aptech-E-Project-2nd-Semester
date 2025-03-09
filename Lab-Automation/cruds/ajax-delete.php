<?php
include '../config/Conn.php';

$product_id = $_POST["id"];



$sql = "DELETE FROM product WHERE id = '{$product_id}'";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
