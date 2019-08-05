<?php
 	ob_start();
	include("includes/sidebar.php");
	include("includes/database.php");
?>
<?php 
	$customer_fetch=mysqli_query($con,"select * from customer_master where customer_name='".$_POST["name"]."'");

	if(mysqli_num_rows($customer_fetch)== 0)
	{
		echo "select proper Customer name";
	}
	else
	{
		$customer=mysqli_fetch_assoc($customer_fetch);
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sachin Enterprise</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
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
			<form class="contact100-form validate-form" method="post">
				<span class="contact100-form-title">
					EDIT CUSTOMER
				</span>

				<label class="label-input100"><b>Customer name *</b></label>
				<div class="wrap-input100">
					<input id="customer_name" class="input100 border border-secondary" type="text" name="customer_name" placeholder="enter name" required="required" value="<?php echo $customer["customer_name"]; ?>">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100"><b>City *</b></label>
				<div class="wrap-input100 validate-input">
					<input id="city" class="input100 border border-secondary" type="text" name="city" placeholder="enter city" required="required" value="<?php echo $customer["customer_city"]; ?>">
					<span class="focus-input100"></span>
				</div>



				<label class="label-input100"><b>Phone Number</b></label>
				<div class="wrap-input100">
					<input id="mobile" class="input100 border border-secondary" type="text" name="mobile" placeholder="enter phone number" required="required" value="<?php echo $customer["customer_phone_no"]; ?>">
					<span class="focus-input100"></span>
				</div>

					<input type="hidden" name="customer_id" value="<?php echo $customer["customer_id"]; ?>">

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" id="edit-customer" name="edit-customer">
						<span>
							Submit
							<i class="zmdi zmdi-arrow-right m-l-8"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>

	 <!--form submition -->
						<?php
							if(isset($_POST["edit-customer"]))
							{
                                $editCustomer=mysqli_query($con,"update customer_master set customer_name='".$_POST["customer_name"]."',customer_city='".$_POST["city"]."',customer_phone_no='".$_POST["mobile"]."' where customer_id='".$_POST["customer_id"]."'");
                                
                                if($editCustomer)
                                {
                                   header("location:billGeneration.php");
                                }
                                else
                                {
                                    echo "customer not added successfully";
                                }
							}	
						ob_end_flush();?>

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
