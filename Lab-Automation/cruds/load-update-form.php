 <?php

include '../config/Conn.php';

$product_id = $_POST["id"];


$sql = "SELECT * FROM product WHERE id = '{$product_id}'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr class='thead-dark'>
      <td>Product Name</td>
      <td><input type='text' id='edit-pname' value='{$row["p_name"]}'>
          <input type='text' id='edit-id' hidden value='{$row["id"]}'>
          <input type='text' id='edit-id' hidden value='{$row["product_id"]}'>
      </td>
    </tr>
    <tr>
    <td>Product description</td>
    <td><textarea type='text' id='edit-pdesc'>{$row["p_desc"]}</textarea></td>
  </tr>
    <tr>
      <td>Product Price</td>
      <td><input type='number' id='edit-pprice' value='{$row["p_price"]}'></td>
    </tr>
    <tr>
      <td></td>

    </tr>";

  }

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>

      
