<?php
session_start();


error_reporting(0);


include './config/Conn.php';
//profile image-uploading 

if(isset($_POST['update'])){
   
    $image_name = $_FILES['photo']['name'];
    $image_temp = $_FILES['photo']['tmp_name'];
    $full_name = $_POST['full_name'];
    $mail = $_POST['email'];
    
    $exp = explode(".", $image_name);
    $end = end($exp);
    $name = time().".".$end;
    if(!is_dir("./profile"))
        mkdir("profile");
    $path = "profile/".$name;
    $allowed_ext = array("gif", "jpg", "jpeg", "png");
    if(in_array($end, $allowed_ext)){
        
            if(move_uploaded_file($image_temp, $path)){
                

                mysqli_query($conn, "UPDATE users SET full_name = '$full_name', email = '$mail', photo = '$path' WHERE id='{$_SESSION["empid"]}'");
                echo "<script>alert('User account updated!')</script>";
                header("location: admin.php");
            }
        		
    }else{
        mysqli_query($conn, "UPDATE users SET full_name = '$full_name', email = '$mail' WHERE id='{$_SESSION["empid"]}'");
        echo "<script>alert('User account updated!')</script>";
    }
}








// if (isset($_POST["update"])) {
//     $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
//         $mail = mysqli_real_escape_string($conn, $_POST["email"]);
//     $photo_name = mysqli_real_escape_string($conn, $_FILES["photo"]["name"]);
//     if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        

//         $photo_tmp_name = $_FILES["photo"]["tmp_name"];
//         $photo_size = $_FILES["photo"]["size"];
//         $file_type = $_FILES['photo']['type'];
//         $photo_new_name = rand() . $photo_name;
  
//         if ($photo_size > 5242880) {
//             echo "<script>alert('Photo is very big. Maximum photo uploading size is 5MB.');</script>";
//         }else{
//             $sql = "UPDATE users SET  full_name='$full_name', email='$mail',photo='$photo_new_name' WHERE id='{$_SESSION["empid"]}'";
//             $result = mysqli_query($conn, $sql);
//             if ($result) {
//                 echo "<script>alert('Profile Updated successfully.');</script>";
//                 move_uploaded_file($photo_tmp_name, "profile/" . $photo_new_name);
//             } else {
//                 echo "<script>alert('Profile can not Updated.');</script>";
//                 echo  $conn->error;
//             }
//         }
//     } else {
//         echo "<script>alert('Please try again.');</script>";
//     }
//   }

?>

<!DOCTYPE html>
<html  lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Adminmart</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="css/productcard.scss">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

</head>

<body>



    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

<!---======= view profile -->


        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
        <?php
$productid=$_GET['id'];
$sqls = "SELECT * FROM criptbl INNER JOIN srstbl on criptbl.product_id=srstbl.product_id INNER JOIN product on srstbl.product_id=product.product_id WHERE crip_id = {$productid}";
if($res = mysqli_query($conn, $sqls)){
  if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_array($res)){
          ?>
<section style="background-color: #eee;">
  <div class="container-fluid py-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card text-black">
          
          <?php echo '<img class="card-img-top" src = "upload/'.$row['p_img'].'"  width="50%" height="50%" >'?>
          <div class="card-body">
            <div class="text-center">
              <h5 class="card-title"><?php echo $row['p_name']?></h5>
              <p class="text-muted mb-4"><?php echo $row['p_desc']?></p>
            </div>
           
            <div class="d-flex justify-content-between total font-weight-bold mt-4">
              <span>Total ₨:</span><?php echo $row['p_price']?>
              
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





  <?php
}
mysqli_free_result($res);
  }
}
?> 
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                All Rights Reserved by Lab Automation. Designed and Developed by <a
                    href="https://wrappixel.com/">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap -->
<!-- Ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" ></script>

<!-- <script src="assets/libs/jquery/dist/jquery.min.js"></script> -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/card.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
</body>



</html>