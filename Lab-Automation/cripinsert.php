<?php

include('./config/Conn.php');

if (isset($_POST['inserttest'])) {
    $product = $_POST['product'];
    $remark = $_POST['crip_remarks'];
    
    $query = "INSERT INTO criptbl (product_id,crip_remarks) VALUES ('$product','$remark')";
    $query_run = mysqli_query($conn,$query);
    
    if ($query_run) {
        echo '<script>alert("Testing Saved "); </script>';
        header('location:criptest.php');
    }
    else {
        echo '<script>alert("Testing Not Saved "); </script>';
        header('location:criptest.php');
    }
 
    
 } 

?>