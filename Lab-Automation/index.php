<?php
session_start();

include './config/Conn.php';

	error_reporting(0);

$msg="";

if (isset($_POST["login"])) {

$email = $_POST["email"];
$password = $_POST["password"];
$password = sha1($password);
$userType = $_POST["userType"];

$sql =  "SELECT * FROM users WHERE email=? AND password=? AND role_type=? AND status='connected' ";
$stmt=$conn->prepare($sql);
$stmt->bind_param("sss",$email,$password,$userType);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

session_regenerate_id();
$_SESSION['empid'] = $row['id'];
$_SESSION['name'] = $row['full_name'];
$_SESSION["photo"] = $row['photo'];
$_SESSION['role'] = $row['role_type'];
$_SESSION['mail'] = $row['email'];
session_write_close();

if ($result->num_rows==1 && $_SESSION['role']=="srs") {
	header("location:srs.php");
}
else if($result->num_rows==1 && $_SESSION['role']=="crip"){
	header("location:crip.php");
}
else if($result->num_rows==1 && $_SESSION['role']=="admin"){
	header("location:admin.php");
}
else{
	$msg = "Email And Password Is Incorrect!!";
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/icons8-login-96.png"/>
<!--===============================================================================================-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32">
						Account Login
						<div class="text-danger">
						<a>
						<?= $msg; ?>
						</a>
					</div>
						
					</span>




					<span class="txt1 p-b-11">
						Email
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Email is required">
						<input class="input100" type="email" name="email" >
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							
							<label  for="userType">
								I'M A:
							</label>
							<input class="custom-radio" id="ckb1" 
							type="radio" name="userType" value="srs" required>&nbsp;SRS |
							<input class="custom-radio" id="ckb1" 
							type="radio" name="userType" value="crip" required>&nbsp;CRIP |
							<input class="custom-radio" id="ckb1" 
							type="radio" name="userType" value="admin" required>&nbsp;ADMIN |
						</div>

					
					</div>
				
					<div class="container-login100-form-btn">
						<input type="submit" name="login" class="login100-form-btn" value="Log In">
					</div>
					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->


</body>
</html>