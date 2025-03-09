<?php

session_start();

include 'cripfunction.php';

error_reporting(0);

if (!isset($_SESSION['empid']) || $_SESSION['role']!="crip") {
    header("location:index.php");
}
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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo.png">
    <title>ELECTRONICA LAB | CRIP TESTING PANEL</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
 
    
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 

</head>

<body>

<style>

.sidebar-nav #sidebarnav .sidebar-item .sidebar-link.active, .sidebar-nav #sidebarnav .sidebar-item .sidebar-link:hover {
    border-radius: 0 60px 60px 0;
    color: #fff!important;
    background: #0d141d;
    box-shadow: 0 7px 12px 0 ;
    border-color:#fff;
    opacity: 1;
}

.bg-danger {
    background-color: #fff!important
}

a.bg-danger:focus,a.bg-danger:hover,button.bg-danger:focus,button.bg-danger:hover {
    background-color: #ccd1d5!important
}

.bg-light {
    background-color: #1c2d41!important
}

a.bg-light:focus,a.bg-light:hover,button.bg-light:focus,button.bg-light:hover {
    background-color: #0d141d!important
}

.btn{
    color:#0d141d;
    background-color: #fff;
    border-color:#0d141d;
    border-radius: 40px;
}


.btn-primary:hover {
    color: #0d141d;
    background-color: #ccd1d5;
    border-color:#ccd1d5;
}


.table .thead-dark th {
    color: #fff;
    background-color: #0d141d;
    border-color: #0d141d;
    
}

.btn-warning:hover {
    color: #212529;
    background-color: #57b846;
    border-color: #57b846;
}


.btn-danger:hover {
    color: #212529;
    background-color: #dc3545;
    border-color: #dc3545;
}


</style>

<!--update profile Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  method="POST" enctype="multipart/form-data" novalidate>
      <?php 
            
            $sql = "SELECT * FROM users WHERE id='{$_SESSION["empid"]}'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
             while ($row = mysqli_fetch_assoc($result)) {
           ?>
      <div class="row pb-2">
                  <div class="col-sm-6 mb-4">
                    <label for="fn" class="form-label fs-base">Full Name</label>
                    <input type="text" id="fn" class="form-control form-control-lg" name="full_name" placeholder="Full Name" value="<?php echo $row['full_name']; ?>" require >
                    <div class="invalid-feedback">Please enter your full name!</div>
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label for="email" class="form-label fs-base">Email address</label>
                    <input type="email" id="email" class="form-control form-control-lg" name="email" placeholder="Email Address" value="<?php echo $row['email']; ?>"  >
                    <div class="invalid-feedback">Please provide a valid email address!</div>
                  </div>
                  <div class="col-12 mb-4">
                    <label for="bio" class="form-label fs-base">Profile <small class="text-muted">(optional)</small></label>
                    <input id="bio" type="file" accept="image/*" name="photo" class="form-control form-control-lg" placeholder="Add Your Profile" src="profile/<?php echo $row["photo"]; ?>"  >
                  </div>
                </div>
                <?php
                }
            }

            ?>
                <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update">Save changes</button>
      </div>
      </form>
      </div>
    
    </div>
  </div>
</div>




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
<!-- Modal -->
<div class="modal fade" id="testproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">T TESTING</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

 <form action="cripinsert.php" class="row g-3" method="POST">

<div class="col-12">
<label  class="form-label">Select Products</label>
<select id="inputState" name="product" class="form-select">
 <option selected>Choose...</option>
  <?php echo getproductid()?>
</select>
</div>

<div class="col-12">
  <label  class="form-label">Testing Remarks</label>
 <input type="text" name="crip_remarks" class="form-control" >
</div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="inserttest" class="btn btn-success" value="Save changes">
      </div>

</form>

      </div>
    
    </div>
  </div>
</div>



    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="admind.html">
                            
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="assets/images/logo.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <?php 
            
                            $sql = "SELECT * FROM users WHERE id='{$_SESSION["empid"]}'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <li class="nav-item dropdown">
        
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo $row["photo"]; ?>" alt="profile" class="rounded-circle"
                                         width="40">
                                        <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark"><?php echo $row["full_name"]; ?></span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                                </a>
                            <?php
                                    }
                                }

                            ?>
                          <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a  type="button" data-toggle="modal" data-target="#exampleModalCenter" class="dropdown-item" href="javascript:void(0)"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    My Profile</a>
                                
                        
                                <div class="dropdown-divider"></div>
                                <a  class="dropdown-item bg-danger" href="logout.php"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="crip.php"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Crip Testing</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="criptest.php"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Testing
                                </span></a>
                        </li>
            
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="logout.php"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome <?= $_SESSION['name']?></h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="crip.php">Dashboard</a>                            
                                    </li>
                                    <li class="breadcrumb-item"><a href="criptest.php">Crip Testing</a> 
                                    </li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                 
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">
                <div class="card border-right">
                        <div class="card-body">
                        <?php
                            $countproduct = "SELECT * FROM product";
                            $queryrun1 = mysqli_query($conn,$countproduct);
                            if ($totalproduct = mysqli_num_rows($queryrun1)) {
                                
                            }else{
                                echo '<h3 class="mb-0" >No Data</h3>';
                            }
                            ?>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                            <?php echo $totalproduct?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">MANUFACTURING PRODUCTS 
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="edit-3"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <?php
                            $countquery = "SELECT * FROM criptbl where crip_result = 'send'";
                            $queryrun = mysqli_query($conn,$countquery);
                            if ($totalcount = mysqli_num_rows($queryrun)) {
                                
                            }else{
                                echo '<h3 class="mb-0" >No Data</h3>';
                            }
                            ?>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $totalcount?></h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">LAUNCH PRODUCTS</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="send"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                        <?php
                            $countsend = "SELECT * FROM criptbl where crip_result = 'reture'";
                            $queryrun2 = mysqli_query($conn,$countsend);
                            if ($totalsend = mysqli_num_rows($queryrun2)) {
                                
                            }else{
                                echo '<h3 class="mb-0" >No Data</h3>';
                            }
                            ?>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $totalsend?></h2>
              
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">RETURE PRODUCTS</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="alert-triangle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                        <?php
                            $countpend = "SELECT * FROM srstbl where srs_result = 'pass'";
                            $queryrun3 = mysqli_query($conn,$countpend);
                            if ($totalpend = mysqli_num_rows($queryrun3)) {
                                
                            }else{
                                echo '<h3 class="mb-0" >No Data</h3>';
                            }
                            ?>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo $totalpend?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">TESTING PRODUCTS</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="alert-triangle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#testproduct">
                                     Product Testing
                                    </button>
                                        
                                    <table id="example" class="table table-hover" >
                                    <thead class="thead-dark">
            <tr>
            <th>Image</th>
            <th>Product_Id</th> 
            <th>Name</th> 
            <th>Price</th> 
            <th>Remarks</th>
            <th>Result</th>
            <th class="text-center">Action</th>
            </tr>
          </thead>


          <?php
$sql = "SELECT * FROM criptbl INNER JOIN srstbl on criptbl.product_id=srstbl.product_id INNER JOIN product on srstbl.product_id=product.product_id ";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
          ?>
          <tbody>
            <tr>
            <td><?php echo '<img src = "upload/'.$row['p_img'].'" height="80px;" width="80px;" class="rounded-circle">'?> </td>
              <td><?php echo $row['product_id'];?></td>
              <td><?php echo $row['p_name'];?></td>
              <td><?php echo $row['p_price'];?></td>
              <td><?php echo $row['crip_remarks'];?></td>
              <td>
            <?php
            if ($row['crip_result']=='send') {
                echo "<p id=str".$row['crip_id']." style=color:green>Send</p>";

            }elseif($row['crip_result']=='reture'){
                echo "<p id=str".$row['crip_id']." style=color:red>Reture</p>";
            }
            else{
                echo $row['crip_result']; ;
            }
            ?>
            
            </td>


<td>
<button value="send" onclick="pass_fail(this.value,<?php echo $row['crip_id'];?>)" class="btn btn-warning" >Send <i class="fa fa-paper-plane"></i></button>
<button value="reture" onclick="pass_fail(this.value,<?php echo $row['crip_id'];?>)" class="btn btn-danger" >Reture <i class="fa fa-recycle"></i></button>
</td>

            </tr>
          </tbody>
<?php
}
mysqli_free_result($result);
  }
}
?>





                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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
    <script>
 // Insert New Records



function pass_fail(val,crip_id){
$.ajax({
type:'post',
url:'testcrip.php',
data:{val:val,crip_id:crip_id},
success:function(result){
  if(result == 'send'){
    $('#str'+crip_id).html('Send');
 
  }
  else{
    $('#str'+crip_id).html('Send');
    
  }
}
});
}





//  $("#save-button").on("click",function(e){
//       e.preventDefault();
//       var product = $("#product").val();
//       var remark = $("#remark").val();
      
      
//       if(product == "" || remark == "" ){
//         $("#error-message").html("All fields are required.").slideDown();
//         $("#success-message").slideUp();
//       }else{
//         $.ajax({
//           url: "test.php",
//           type : "POST",
//           data : {product_id: product,remarks: remark},
//           success : function(data){
//             if(data == 1){
              
//               $("#addForm").trigger("reset");
//               $("#success-message").html("Data Inserted Successfully.").slideDown();
//               $("#error-message").slideUp();
//               loadTable();
              
//             }else{
//               $("#error-message").html("Can't Save Record.").slideDown();
//               $("#success-message").slideUp();
//             }

//           }
//         });
//       }

//     });


// </script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap -->
<!-- Ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" ></script>

<!-- <script src="assets/libs/jquery/dist/jquery.min.js"></script> -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  
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

    <script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>

</body>
</html>