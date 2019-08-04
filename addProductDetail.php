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
            <?php 
            if(isset($_POST["add-item"]))
            { ?>
            <form class="contact100-form validate-form" method="post" onsubmit="return validate()">
                <span class="contact100-form-title">
                    Bill Generation
                </span>

                <label class="label-input100" for="customer_name"><b>Customer Name</b></label>
                <div class="wrap-input100">
                    <input id="customer_name" class="input100 border border-secondary" type="text" name="customer_name"  value="<?php if(isset($_POST["add-item"])){echo $_POST["customer_name"];}?>" required="required">
                    <span class="focus-input100"></span>
                </div>


                <label class="label-input100" for="number"><b>No. Of Items</b></label>
                <div class="wrap-input100">
                    <input id="number" class="input100 border border-secondary" type="number" name="number" value="<?php if(isset($_POST["add-item"])){echo $_POST["number"];}?>" required="required">
                    <span class="focus-input100"></span>
                </div>

                <br>
                    <hr style="border-width:3px;border-color:black">
                    <br>
            <?php } ?>
                    <?php
                        if(isset($_POST["add-item"]))
                        {
                            $n=$_POST["number"];
                            for($i=0;$i<$n;$i++)
                            {
                                ?><h2>Product Details <?php echo $i+1;?></h2>

                                <label class="label-input100" style="margin-top: 25px;"><b>Product name</b></label>
                                <?php 
                                            //$rs=mysqli_query($con,"select product_name from product");
                                            //$b=mysqli_fetch_assoc($rs);
                                ?>

                                <div class="wrap-input100">
                                    <select class="form-control" name="product_<?php echo $i+1;?>">
                                        <?php 
                                            $products=mysqli_query($con,"select * from product_master");
                                            while($rs=mysqli_fetch_assoc($products))
                                            {
                                                ?><option class="input100 border border-secondary" value="<?php echo $rs["product_name"]; ?>"><?php echo $rs["product_name"]; ?></option>
                                            <?php }
                                        ?>
                                        </select>  
                                    <span class="focus-input100"></span>
                                </div>


                                <label class="label-input100"><b>QTY</b></label>
                                <div class="wrap-input100">
                                     <input id="qty<?php echo $i+1;?>" name="qty<?php echo $i+1;?>" class="input100 border border-secondary" type="text" required="required" pattern="^([1-9][0-9]{0,3})$">
                                     <span class="focus-input100"></span>
                                </div>


                                <label class="label-input100"><b>PRICE</b></label>
                                <div class="wrap-input100">
                                     <input id="price<?php echo $i+1;?>" name="price<?php echo $i+1;?>" class="input100 border border-secondary" type="text" required="required" pattern="^([1-9][0-9]{0,4}*(\.\d{1,2}))$">
                                     <span class="focus-input100"></span>
                                </div>

                                <hr style="border-width:3px;border-color:black">

                    <?php } ?>


                                <h1 style="color:red">TOTAL</h1>
                                <br>

                                 <label class="label-input100" style="margin-top: 25px;"><b>TOTAL</b></label>
                                <div class="wrap-input100">
                                     <input id="total" name="total" class="input100 border border-secondary" type="number" required onclick="sum()" readonly>
                                     <span class="focus-input100"></span>
                                </div>


                                 <label class="label-input100"><b>credit</b></label>
                                <div class="wrap-input100">
                                     <input id="credit" name="credit" class="input100 border border-secondary" type="text" required="required" pattern="[0-9]+(\.[0-9][0-9]?)?">
                                     <span class="focus-input100"></span>
                                </div>


                                <label class="label-input100"><b>debit</b></label>
                                <div class="wrap-input100">
                                     <input id="debit" name="debit" class="input100 border border-secondary" type="number" required readonly onclick="displayDebit()">
                                     <span class="focus-input100"></span>
                                </div>






                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn" id="submit" name="submit">
                        <span>
                            Generate Bill
                            <i class="zmdi zmdi-arrow-right m-l-8"></i>
                        </span>
                    </button>
                </div>
                <?php 
                    }
                 ?>
            </form>


        </div>
    </div>


<?php
        if(isset($_POST["submit"]))
        {
            //print_r($_POST);

            $customer_id_fetch=mysqli_query($con,"select customer_id from customer_master where customer_name='".$_POST["customer_name"]."'");
            $customer_id_row=mysqli_fetch_assoc($customer_id_fetch);
            $customer_id=$customer_id_row["customer_id"];
        
            $invoice=mysqli_query($con,"insert into invoice_master (customer_id,invoice_date,credit,debit) values ('".$customer_id."',CURDATE(),'".$_POST["credit"]."','".$_POST["debit"]."')");
            
            $last_id = mysqli_insert_id($con);

            //echo $last_id;
            
            //$bill=mysqli_query($con,"insert into user_product_price (user_id) values ('".$last_id."')");
            
            

            $n=$_POST["number"];

            for($i=1;$i<=$n;$i++)
            {
                
                $product_id_fetch=mysqli_query($con,"select product_id from product_master where product_name='".$_POST["product_".$i.""]."'");
                $product_id_row=mysqli_fetch_assoc($product_id_fetch);
                $product_id=$product_id_row["product_id"];

                $product_total=($_POST["qty".$i.""])*($_POST["price".$i.""]);
                
                $bill=mysqli_query($con,"insert into customer_bill_history (customer_id,product_id,bill_product_qty,bill_product_price,product_total,invoice_id,bill_date) values ('".$customer_id."','".$product_id."','".$_POST["qty".$i.""]."','".$_POST["price".$i.""]."','".$product_total."','".$last_id."',CURDATE())");   
                
               // $rs=mysqli_query($con,"update  set product_".$_POST["product_".$i.""]." = '".$_POST["qty".$i.""]."' where user_id='".$last_id."'");
               // $rs2=mysqli_query($con,"update user_product_price set product_".$_POST["product_".$i.""]." = '".$_POST["price".$i.""]."' where user_id='".$last_id."'");
            
            }
            if($bill & $invoice)
            {
                //echo "succeed";
                $grandtotal=0;
                $customer_info=mysqli_query($con,"select * from customer_bill_history where invoice_id='".$last_id."'");
                while($rs=mysqli_fetch_assoc($customer_info))
                {
                    $grandtotal=$grandtotal+$rs["product_total"];
                } 
                //echo $grandtotal;
                
                $invoice_total=mysqli_query($con,"update invoice_master set invoice_grand_total='".$grandtotal."' where invoice_id='".$last_id."'");
                header("location:preview.php?invoice_id=$last_id&customer_id=$customer_id&grandtotal=$grandtotal");
            }
            else
            {   
                echo mysqli_error($con);
                echo "failed to insert data";
            }
        }
   ob_end_flush(); ?>


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
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');

        var summ=0;
        var item=document.getElementById("number").value;
        //alert(item);
        
        function sum()
        {
            for(var i=1;i<=item;i++)
            {
                //alert();
                var qty=document.getElementById("qty" + i +"").value;
                
                var price=document.getElementById("price" + i +"").value;
                var temp=qty*price;
                //alert(temp);
                summ=summ+temp;
            }
            document.getElementById("total").value=summ;
            summ=0;
        } 
        
        var debit=0;
        function displayDebit()
        {
            var total=document.getElementById("total").value;
            var credit=document.getElementById("credit").value;
            debit=total-credit;
            //document.getElementById("submit").disabled=false;    
            document.getElementById("debit").value=debit;
        }

        function validate()
        {
            if(debit<0)
            {
                alert("your credit is more then your total amount");
                return false;
            }
            return true;
        }
</script>

</body>
</html>
