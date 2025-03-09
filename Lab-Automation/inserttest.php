<?php
include('./config/Conn.php');

if (isset($_POST['insertdata'])) {
    $product = $_POST['product'];
    $remark = $_POST['remarks'];
    
 
    $query = "INSERT INTO srstbl (product_id,remarks) VALUES ('$product','$remark')";
    $query_run = mysqli_query($conn,$query);
    
    if ($query_run) {
        echo '<script>alert("Testing Saved "); </script>';
        header('location:srstest.php');
    }
    else {
        echo '<script>alert("Testing Not Saved "); </script>';
        header('location:srstest.php');
    }
 
    
 } 

?>