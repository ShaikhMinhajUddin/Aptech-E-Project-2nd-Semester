<?php
 
 function getproductid()
 {
     include('../config/Conn.php');
     $sql = "SELECT * FROM srstbl WHERE srs_result = 'pass'";
     $rs = mysqli_query($conn,$sql);
     if (mysqli_num_rows($rs)>0) {
         while ($rec = mysqli_fetch_array($rs)) {
             ?> <option value="<?=$rec['srs_id']?>"> <?=$rec['product_id']?> </option> <?php
         }
     }
     else{
         ?> <option>No Product Found</option><?php
     }
 }
 

?>