<?php
 	ob_start();
  	include("includes/sidebar.php");
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

					<form method="post" action="addCustomer.php">
                        <button type="submit" style=" margin-left: 110px; width: 200px; float: left;" class="btn btn-success">Add New Customer</button>
                    </form>
                    <form method="post" action="editCustomer.php">
                        <button type="submit" style="margin-right: 80px; margin-bottom: 35px; width: 200px; float: right;" class="btn btn-success">Edit Customer</button>
                    </form>


			<form class="contact100-form validate-form" action="addProductDetail.php" method="post">
				<span class="contact100-form-title">
					Bill Generation
				</span>

				<label class="label-input100" for="customer_name"><b>Customer Name</b></label>
				<div class="wrap-input100">
					<span class="focus-input100"></span>
					<?php 
                        $customer=mysqli_query($con,"select * from customer_master");
                                        
                    ?>
                       <select class="form-control" name="customer_name" id="customer_name">
                             <?php 
                                 while($rs=mysqli_fetch_assoc($customer))
                                 {
                                     ?><option class="input100 border border-secondary" value="<?php echo $rs["customer_name"]; ?>"><?php echo $rs["customer_name"]; ?></option>
                                <?php }
                                    ?>
                            </select> 
				</div>


				<label class="label-input100" for="number"><b>No. Of Items</b></label>
				<div class="wrap-input100">
					<input id="number" class="input100 border border-secondary" type="text" name="number" placeholder="No.Of Items" required="required" pattern="^(0*([1-9]|[1-8][0-9]|9[0-9]|100))$">
					<span class="focus-input100"></span>
				</div>


				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" id="add-item" name="add-item">
						<span>
							ADD ITEM
							<i class="zmdi zmdi-arrow-right m-l-8"></i>
						</span>
					</button>
				</div>

			</form>
		</div>
	</div>
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
