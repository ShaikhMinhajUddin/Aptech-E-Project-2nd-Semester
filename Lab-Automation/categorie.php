<?php
session_start();


error_reporting(0);

if (!isset($_SESSION['empid']) || $_SESSION['role']!="admin") {
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
      mkdir("");
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
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Favicon icon -->
      <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">

    <title>ADMIN DASHBORAD</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.0/af-2.4.0/b-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css"/>
 
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


  </head>

  <body>

<style>.sidebar-nav #sidebarnav .sidebar-item.selected>.sidebar-link,.sidebar-link:hover {
    border-radius: 0 60px 60px 0;
    color: #fff!important;
    background: #0d141d;
    box-shadow: 0 7px 12px 0 rgba(95,118,232,.21);
    opacity: 1
}

.bg-warning {
    color: #fff!important;
    background-color: #0d141d!important;
    border-radius: 35px;
   padding: 2%;
}

.bg-danger {
  color: #fff!important;
    background-color: #0d141d!important;
    border-radius: 35px;
    padding: 1%;
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


.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #7c8798;
}
.table .thead-dark th {
    color: #fff;
    background-color: #0d141d;
    border-color: #0d141d;
 
}


.btn-primary {
  color:#0d141d;
    background-color: #fff;
    border-color:#0d141d;
    border-radius: 40px;
    margin-left: 0.2em;
}

.btn-primary:hover {
    color: #0d141d;
    background-color: #ccd1d5;
    border-color:#ccd1d5;
}
</style>

<!--update profile Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Profile</h5>
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
<!--product insert Modal -->
<div class="modal fade" id="insertModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="form-control"  id="addForm" class="row g-3"  method="POST" enctype="multipart/form-data">
          
          <div class="col-12">
          <span class="input-group-text" id="basic-addon1">Product Name</span>
          <input class="form-control" type="text" id="p_name" name="p_name" placeholder="Add Product Name" required>
          </div>
          <div class="col-12">
          <span class="input-group-text" id="basic-addon2">Product Price</span>
          <input class="form-control" type="number" id="p_price" name="p_price" placeholder="Add Product Price" required>
          </div>
          <div class="col-12">
          <span class="input-group-text" id="basic-addon3">Product Description</span>
          <textarea class="form-control" id="p_desc" name="p_desc" placeholder="Add Product Description" required></textarea>
          </div>
          <div class="col-12">
          <span class="input-group-text" id="basic-addon3">Product Image</span>
          <input type="file" accept="image/*" id="p_img"  name="p_img" class="form-control form-control-lg" placeholder="Add Product Image" required>
          </div>

          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" id="save-button" name="save-button" onclick="addProduct()">Launch</button>
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
                        <a href="admin.php">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
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
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="admin.php"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>    
                        <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>             
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Details</span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="empdetails.php" class="sidebar-link"><span
                                            class="hide-menu"> Employees
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="product.php" class="sidebar-link"><span
                                            class="hide-menu"> Products
                                        </span></a>
                                </li>

                                <li class="sidebar-item"><a href="categorie.php" class="sidebar-link"><span
                                            class="hide-menu"> Categorie
                                        </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-divider"></li>  
                        <li class="nav-small-cap"><span class="hide-menu">SRS Depart</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Testing</span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="accept.php" class="sidebar-link"><span
                                            class="hide-menu"> Accept
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="reject.php" class="sidebar-link"><span
                                            class="hide-menu"> Reject
                                        </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-divider"></li>  
                        <li class="nav-small-cap"><span class="hide-menu">CRIP Depart</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">Testing</span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="launch.php" class="sidebar-link"><span
                                            class="hide-menu"> Launch
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="reture.php" class="sidebar-link"><span
                                            class="hide-menu"> Reture
                                        </span></a>
                                </li>
                            </ul>
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

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome <?= $_SESSION['role']?></h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="admin.php">Dashboard</a>                            
                                    </li>
                                    <li class="breadcrumb-item"><a href="product.php">Categorie</a> 
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                 
                </div>
            </div>
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
                            $countquery = "SELECT * FROM users";
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
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">TOTAL EMPLOYEES</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            $countsend = "SELECT * FROM product where status = 'sending'";
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
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">SENDING PRODUCTS</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="send"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                        <?php
                            $countpend = "SELECT * FROM product where status = 'pending'";
                            $queryrun3 = mysqli_query($conn,$countpend);
                            if ($totalpend = mysqli_num_rows($queryrun3)) {
                                
                            }else{
                                echo '<h3 class="mb-0" >No Data</h3>';
                            }
                            ?>
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo $totalpend?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">PENDING</h6>
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





                <!-- <h1 class="text-center bg-danger text-white">PRODUCT MANUFACTURING</h1> -->
              <div id="error-message"></div>
              <div id="success-message"></div>


        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph table-responsive">
      <td id="table-form">

      <!-- Button trigger modal -->

      <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#insertModalCenter">Add Categorie</button>

  <table id="table_id" class="table" id="main" >
    <thead class="thead-dark">
    
        
    <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Product_Id</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
    </tr>
    </thead>

  <tbody id="tableload">
   
  </tbody>

  </table>
              </div>
            </div>
        </div>
        

   
        
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
                        <!-- ============================================================== -->
       
    
    <!-- End Wrapper -->
    <!-- ============================================================== -->


        

</div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
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
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <div  class="modal" tabindex="-1">
  <div  class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table id="example"  cellpadding="10px" width="100%">

      </table>
      </div>
      <div class="modal-footer">
        
        <button type="submit" id="edit-submit" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>
















    <!-- <div  class="modal" tabindex="-1">
  <div  class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table id="example"  cellpadding="10px" width="100%">
      <form action="cruds/ajax-update-form.php" id="updateform" method="POST" enctype="multipart/form-data" novalidate>
   
      </form>
      </table>
      </div>
      <div class="modal-footer">
        
        <button type="submit" id="edit-submit" name="edit-submit" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div> -->




 
 <!-- jQuery -->
 <script src="dist/js/jquery.min.js"></script>


<!-- -sending code
<script type="text/javascript">

function send_pend(val,id){
  $.ajax({
  type:'post',
  url:'send.php',
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

</script> -->




<script type="text/javascript">

  $(document).ready(function(){

    loadTable(); // Load Table Records on Page Load
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "cruds/ajax-load.php",
        type : "POST",
        success : function(data){
          $("#tableload").html(data);
          
        }
      });
    }
    


 // Insert New Records
$("#addForm").on("submit",function(e){
e.preventDefault();

var formdata = new FormData(this);

if(formdata == "" ){
   $("#error-message").html("All fields are required.").slideDown();
   $("#success-message").slideUp();
 }else{
$.ajax({
  method : "POST",
  url : "cruds/ajax-insert.php",
  data : formdata,
  contentType : false,
  processData : false,

  success : function(data)
  {
    if(data == 1){
        
        
        $("#success-message").html("Data Inserted Successfully.").slideDown();
        $("#error-message").slideUp();
        
              
         }else{
          $('#addForm')[0].reset();
          header("location: product.php");
              loadTable();
          // $("#success-message").html("Data Inserted Successfully.").slideDown();
         
            
        }
  
    
  }

});
}
});


    //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var productId = $(this).data("id");
        var element = this;

        $.ajax({
          url: "cruds/ajax-delete.php",
          type : "POST",
          data : {id : productId},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

    //Show Modal Box
    $(document).on("click",".edit-btn", function(){
      $(".modal").fadeIn();
      var productId = $(this).data("eid");

      $.ajax({
        url: "cruds/load-update-form.php",
        type: "POST",
        data: {id : productId},
        success: function(data) {
          $(".modal-dialog table").html(data);
        }
      })
    });

    // Hide Modal Box
    $(".btn-close").on("click",function(){
      $(".modal").fadeOut();
    });





//Save Update Form
    $(document).on("click","#edit-submit", function(){
        var proId = $("#edit-id").val();
        var pname = $("#edit-pname").val();
        var pdesc = $("#edit-pdesc").val();
        var pprice = $("#edit-pprice").val();
        

        $.ajax({
          
          url: "cruds/ajax-update-form.php",
          type : "POST",
          data : {id: proId, p_name: pname,p_desc: pdesc, p_price: pprice},
          success: function(data) {
            if(data == 1){
              $(".modal").hide();
              loadTable();
            }
          }
        })
      });




//  $("#updateform").on("submit","#edit-submit",function(e){
// e.preventDefault();

// var form_data = new FormData(this);

// if(form_data == "" ){
//    $("#error-message").html("All fields are required.").slideDown();
//    $("#success-message").slideUp();
//  }else{
// $.ajax({
//   method : "POST",
//   url : "cruds/ajax-update-form.php",
//   data : form_data,
//   contentType : false,
//   processData : false,

//   success : function(data)
//   {
//     if(data == 1){
        
//       $(".modal").hide();
//               loadTable();
//         $("#success-message").html("Data Inserted Successfully.").slideDown();
//         $("#error-message").slideUp();
        
              
//          }else{
//           $('#updateform')[0].reset();
//           header("location: product.php");
//               loadTable();
//           // $("#success-message").html("Data Inserted Successfully.").slideDown();
         
            
//         }
  
    
//   }

// });
// }
// });







    //Save Update Form
      //   $("#updateform").on("submit",function(event){
      //   event.preventDefault();
      //   var form_data = new FormData(this);

      //   $.ajax({
      //     url: "cruds/ajax-update-form.php",
      //     method : "POST",
      //     data : form_data,
      //     contentType : false,
      //     processData : false,
      //     success: function(data) {
      //       if(data == 1){
      //         $(".modal").hide();
      //         loadTable();
      //       }
      //     }
      //   })
      // });

    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "cruds/ajax-live-search.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#tableload").html(data);
         }
       });
     });
  });
</script>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.0/af-2.4.0/b-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.js"></script>

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
$(document).ready( function () {
    $('#table_id').DataTable();
} );
    </script>

</body>

</html>
