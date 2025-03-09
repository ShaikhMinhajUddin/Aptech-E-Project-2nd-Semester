<?php
 
 function getproductid()
 {
     include('./config/Conn.php');
     $sql = "SELECT * FROM srstbl INNER JOIN product on srstbl.product_id=product.product_id WHERE srs_result = 'pass'";
     $rs = mysqli_query($conn,$sql);
     if (mysqli_num_rows($rs)>0) {
         while ($rec = mysqli_fetch_array($rs)) {
             ?> <option value="<?=$rec['product_id']?>"> <?=$rec['p_name']?> </option> <?php
         }
     }
     else{
         ?> <option>No Product Found</option><?php
     }
 }
 

?>