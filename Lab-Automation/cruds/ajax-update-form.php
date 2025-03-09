<?php

include '../config/Conn.php';



// $p_id = $_POST["id"];
// $p_name = $_POST['p_name'];
// $p_desc = $_POST['p_desc'];
// $p_price = $_POST['p_price'];
// $p_img = $_FILES['p_img']['name'];


// $product_id = $_POST["id"];
// $Product_Name = $_POST["p_name"];
// $Product_Description = $_POST["p_desc"];
// $Product_Price = $_POST["p_price"];
// $p_img = $_FILES['p_img']['name'];

// if($Product_Name == "" || $Product_Description == "" || $Product_Price == "" || $p_img == ""){
//   echo "<script>alert('All fields are required.')</script>";
//   if (0 < $_FILES['file'] ['error']) {
//     echo 'error : ' .$_FILES['file'] ['error'] . '<br>';
//   }
// }else{
//     move_uploaded_file($_FILES['p_img']['tmp_name'],'upload/' .$_FILES['p_img']['name']);
//     $sql = "UPDATE product SET p_name = '{$Product_Name}',p_desc = '{$Product_Description}',p_price = '{$Product_Price}',p_img = '{$p_img}' WHERE id = '{$product_id}'";
//   }


//   if ($sql) {
//     echo 1;
    

//   }else{
//     echo 0;
//   }




  // $product_id = $_POST["id"];
  // $Product_Name = $_POST["p_name"];
  // $Product_Description = $_POST["p_desc"];
  // $Product_Price = $_POST["p_price"];
  //   $image_name = $_FILES['p_img']['name'];
  //   $image_temp = $_FILES['p_img']['tmp_name'];

    
  //   $exp = explode(".", $image_name);
  //   $end = end($exp);
  //   $name = time().".".$end;
  //   if(!is_dir("./upload"))
  //       mkdir("");
  //   $path = "upload/".$name;
  //   $allowed_ext = array("gif", "jpg", "jpeg", "png");
  //   if(in_array($end, $allowed_ext)){
        
  //           if(move_uploaded_file($image_temp, $path)){
                
  
  //               mysqli_query($conn, "UPDATE product SET p_name = '{$Product_Name}',p_desc = '{$Product_Description}',p_price = '{$Product_Price}',p_img = '{$path}' WHERE id = '{$product_id}'");
  //               echo "<script>alert('User account updated!')</script>";
  //               header("location: product.php");
  //           }
            
  //   }else{
  //       mysqli_query($conn, "UPDATE users SET full_name = '$full_name', email = '$mail' WHERE id='{$_SESSION["empid"]}'");
  //       echo "<script>alert('User account updated!')</script>";
  //   }
  














$product_id = $_POST["id"];
$Product_Name = $_POST["p_name"];
$Product_Description = $_POST["p_desc"];
$Product_Price = $_POST["p_price"];


$sql = "UPDATE product SET p_name = '{$Product_Name}',p_desc = '{$Product_Description}',p_price = '{$Product_Price}' WHERE id = '{$product_id}'";
 
if(mysqli_query($conn, $sql)){
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
