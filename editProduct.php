<?php
 	ob_start();
  	include("includes/sidebar.php");
  	include("includes/database.php");
?>
<?php

	$product_fetch=mysqli_query($con,"select * from product_master where product_id='".$_GET["id"]."'");
	$product=mysqli_fetch_assoc($product_fetch);

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
			<form class="contact100-form validate-form" method="post" action="">
				<span class="contact100-form-title">
					VIEW PRODUCT
				</span>
					
				<label class="label-input100"><b>PRODUCT NAME</b></label>
				<div class="wrap-input100 validate-input">
					<input id="product_name" class="input100 border border-secondary" type="name" name="product_name" placeholder="enter product name" required="required" value="<?php echo $product["product_name"]; ?>">
					<span class="focus-input100"></span>
				</div>

				<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" id="add-product" name="add-product">
						<span>
							SUBMIT
							<i class="zmdi zmdi-arrow-right m-l-8"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>

	<?php
	if(isset($_POST["add-product"]))
	{
		$add_product=mysqli_query($con,"update product_master set product_name='".$_POST["product_name"]."' where product_id='".$_POST["id"]."'");
		if($add_product)
		{
			header("location:addProduct.php");
		}
		else
		{
			echo "failed to edit product";
		}
	}
	ob_end_flush();
	?>

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
