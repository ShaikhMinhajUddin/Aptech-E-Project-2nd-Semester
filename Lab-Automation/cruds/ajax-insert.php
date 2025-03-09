<?php

include '../config/Conn.php';


$p_name = $_POST['p_name'];
$p_desc = $_POST['p_desc'];
$p_price = $_POST['p_price'];
$p_img = $_FILES['p_img']['name'];



  if (0 < $_FILES['file'] ['error']) {
    echo 'error : ' .$_FILES['file'] ['error'] . '<br>';
  }else{
    move_uploaded_file($_FILES['p_img']['tmp_name'],'../upload/' .$_FILES['p_img']['name']);
    $sql = "INSERT INTO product(p_name, p_desc, p_price, p_img ) VALUES ('{$p_name}','{$p_desc}','{$p_price}','{$p_img}')";
  }


  if ($sql) {
    echo 1;

  }else{
    echo 0;
  }

if(mysqli_query($conn,$sql)){
  $last_id = mysqli_insert_id($conn);
  $code = rand(1,99999);
  $product_id = "PRO_".$code."_".$last_id;
  $query = "UPDATE product SET product_id ='".$product_id."' WHERE id = '".$last_id."'";
  $res = mysqli_query($conn,$query);
  echo 1;
  
}else{
  echo 0;
} 

?>
