<?php
 	ob_start();
  	include("includes/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sachin Enterprise</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
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
	<div class="container-contact100">
		<div class="wrap-contact100">


			<form class="contact100-form validate-form" action="" method="post">
				<span class="contact100-form-title">
					LOGIN
				</span>


				<label class="label-input100"><b>Email</b></label>
				<div class="wrap-input100">
					<input id="email" class="input100 border border-secondary" type="email" name="email" placeholder="Enter Email" required="required">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100"><b>Password</b></label>
				<div class="wrap-input100">
					<input id="password" class="input100 border border-secondary" type="password" name="password" placeholder="Enter Password" required="required">
					<span class="focus-input100"></span>
				</div>


				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" id="login" name="login">
						<span>
							LOGIN
							<i class="zmdi zmdi-arrow-right m-l-8"></i>
						</span>
					</button>
				</div>

			</form>
		</div>
	</div>

<?php 
	if(isset($_POST["login"]))
	{
		$login=mysqli_query($con,"select * from user where email='".$_POST["email"]."' and password='".$_POST["password"]."'");
		$login_fetch=mysqli_fetch_assoc($login);

		if($login_fetch)
		{
			session_start();
			$_SESSION["auth"]=true;
			header("location:index.php");
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("invalid email or password");';
			echo '</script>';
		}
	}
?>
<?php ob_end_flush();?>


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


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
