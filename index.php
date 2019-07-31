<?php
    include("includes/sidebar.php");
    include("includes/database.php");
?>
<html>
<head>
<title>Sachin Enterprise</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
        .common
        {
                width:300px;
                height:100px;
                margin-left:-200px;
        }
        body
        {
                background-image:url("images/bg.jpg");
                background-repeat:no-repeat;
                background-size:cover;
        }
</style>
<head>
<body>
<div style="margin-left:40%;margin-top:3%;">

<form method="post" action="billGeneration.php">
        <button type="submit" class="btn btn-warning common"><h3>Bill Generation</h3></button>
</form>
<br>
<form method="post" action="monthlyHistory.php">
        <button type="submit" class="btn btn-success common"><h3>Monthly History</h3></button>
</form>
<br>
<form method="post" action="customerHistory.php">
        <button type="submit" class="btn btn-danger common"><h3>Customer History</h3></button>
</form>
<br>
<form method="post" action="addCredit.php">
        <button type="submit" class="btn btn-primary common"><h3>Add Credit</h3></button>
</form>
<br>
<form method="post" action="billCancellation.php">
        <button type="submit" class="btn btn-warning common"><h3>Bill Cancellation</h3></button>
</form>
<br>
<form method="post" action="addProduct.php">
        <button type="submit" class="btn btn-success common"><h3>Add Product</h3></button>
</form>
<br>
</div>
<body>
<html>
    
<----------------------------Updated UI Code---------------------------------------->
<?php /*
        include'includes/sidebar.php';
*/
?>        
<html>
<head>
<title>Sachin Enterprise</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
        .common
        {
                width:300px;
                height:100px;
                margin-left:-200px;
        }
        body
        {
                background-image:url("images/bg.jpg");
                background-repeat:no-repeat;
                background-size:cover;
                z-index:1;
        }
        .main{
                float:left;
                width:30%;
        }
        .sub{
                float:right;
                width:70%;
                
        }
</style>
<head>
<body>
<div style="margin-left:25%;margin-top:13%;">

<div class="main">
        
<form method="post" action="billGeneration.php">
        <button type="submit" class="btn btn-warning common"><h3>Bill Generation</h3></button>
</form>
<br>
<form method="post" action="monthlyHistory.php">
        <button type="submit" class="btn btn-success common"><h3>Monthly History</h3></button>
</form>
<br>
<form method="post" action="customerHistory.php">
        <button type="submit" class="btn btn-danger common"><h3>Customer History</h3></button>
</form>
</div>
<div class="sub">
<form method="post" action="addCredit.php">
        <button type="submit" class="btn btn-danger common"><h3>Add Credit</h3></button>
</form>
<br>
<form method="post" action="billCancellation.php">
        <button type="submit" class="btn btn-success common"><h3>Bill Cancellation</h3></button>
</form>
<br>
<form method="post" action="addProduct.php">
        <button type="submit" class="btn btn-warning common"><h3>Add Product</h3></button>
</form>
</div>

</div>
</body>
</html>    
<--------------------------Done---------------------------------------------->    
