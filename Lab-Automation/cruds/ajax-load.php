<?php

include '../config/Conn.php';


    $query = "SELECT * FROM product";
if($result1 = mysqli_query($conn, $query)){
  if(mysqli_num_rows($result1) > 0){
    while($row = mysqli_fetch_array($result1)){
          ?>


      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["product_id"];?></td>
        <td><?php echo $row["p_name"];?></td> 
        <td><?php echo $row["p_desc"];?></td> 
        <td><?php echo $row["p_price"];?></td>
        <td><?php echo '<img src = "upload/'.$row['p_img'].'" height="80px;" width="80px;" class="rounded-circle">'?> </td>
                
                <td class= align = "center"><?php echo $row["status"];?> </td>
                <td>
                <select onchange="send_pend(this.value, <?php echo $row['id'];?>) " class="form-select" aria-label="Default select example">
                  <option selected>Default</option>
                  <option value="sending"><a class="label theme-bg text-white">Sending</a></option>
                  <option value="pending"><a class="label theme-bg text-white">Pending</a></option>
                  
                </select>
                </td>
                <td align="center"><button class="btn btn-outline-success edit-btn" data-eid= <?php echo $row["id"]; ?> >Edit <i class='far fa-edit'></i></button></td><td align="center"><button Class="btn btn-outline-danger delete-btn" data-id= <?php echo $row["id"];?>  >Delete <i class="fa fa-trash"></i></button></td>
              </tr>
    
 
  <?php
}
mysqli_free_result($result1);
  }
}
?>



 <!---sending code-->
 <script type="text/javascript">

function send_pend(val,id){
  $.ajax({
  type:'post',
  url:'./send.php',
  data:{val:val,id:id},
  success:function(result){
    if(result == 'pending'){
      $('#str'+id).html('pending');
      loadTable();
    }
    else{
      $('#str'+id).html('sending');
      
    }
  }
  });
  }

</script>