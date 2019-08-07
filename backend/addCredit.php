<?php 
    ob_start();
    include("../includes/database.php");
?>
<html>
    <head>
    <title>Credit-Debit</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    </head>
<body>
<?php

?>
<?php
     if(isset($_POST["add-debit"]))
     {  
        date_default_timezone_set('Asia/Kolkata');
        $datee = date('Y-m-d H:i:s');
            
        $transaction=mysqli_query($con,"insert into transaction_master (customer_id,transaction_date,credit,created_on) values ('".$_POST["id"]."','".$datee."','".$_POST["credit_amt"]."','".$datee."')");
        //echo $transaction."";
        header("location:../index.php?debit=true");
     }
?>
        <form method="post" action="../index.php">
            <br>
            <button style="width:150px; height:60px;" type="submit" id="cancel" name="cancel" class="btn btn-danger">Go To Home</button>   
        </form>    
</body>
</html>
