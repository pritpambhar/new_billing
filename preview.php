<?php
    include("includes/database.php");
?>
<?php 
    $grandtotal=0;
    $invoice_id=$_GET["invoice_id"];

    $customer_id=$_GET["customer_id"];
    $customer_name_fetch=mysqli_query($con,"select * from customer_master where customer_id='".$customer_id."'");
    $customer_name_row=mysqli_fetch_assoc($customer_name_fetch);
    $customer_name=$customer_name_row["customer_name"];
    $customer_city=$customer_name_row["customer_city"];

    $invoice_info=mysqli_query($con,"select * from invoice_master where invoice_id='".$invoice_id."'");
    $invoice_info_fetch=mysqli_fetch_assoc($invoice_info);

    $customer_info=mysqli_query($con,"select * from customer_bill_history where invoice_id='".$invoice_id."'");
    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
    </head>
    <body>
        <table width="50%" class="table table-bordered">
            <tr>
                <td colspan="4"><b>Bill To:-&nbsp &nbsp<?php echo $customer_name; ?></b></td>
                <td align="right" style="padding-right:30px;"><b>Invoice ID:-&nbsp &nbsp<?php echo $invoice_id; ?></b></td>
            </tr>
            <tr>
                <td colspan="4"><b>City:-&nbsp &nbsp<?php echo $customer_city; ?></b></td>
                <td align="right"><b>Date:-&nbsp &nbsp<?php echo date("d/m/Y"); ?></b></td>
            </tr>
        </table>
        <table width="50%" border="1" class="table table-bordered">
            <tr>
                <td colspan="4" align="center"><b>Product</b></td>
                <td align="center" border="1"><b>QTY</b></td>
                <td align="center"><b>Unit Price</b></td>
                <td colspan="2" align="center"><b>Amount</b></td>
            </tr>
            <?php 
            while($rs=mysqli_fetch_assoc($customer_info))
            { 
      
                $product_info=mysqli_query($con,"select product_name from product_master where product_id='".$rs["product_id"]."'");
                $product_name=mysqli_fetch_assoc($product_info);
                
                //echo $rs["product_id"];
            ?>
            
            <tr>
                <td colspan="4" align="center"><?php echo $product_name["product_name"]; ?></td>
                <td align="center"><?php echo $rs["bill_product_qty"]; ?></td>
                <td align="center"><?php echo $rs["bill_product_price"]; ?></td>
                <td colspan="2" align="right"><?php echo $rs["product_total"]."/-"; ?></td>
            </tr>

            <?php 
            $grandtotal=$grandtotal+$rs["product_total"];
            } ?>

        </table>

        <table width="50%" class="table table-bordered">
            <tr>
                <td width="70%" align="right">Subtotal:</td>
                <td colspan="2" align="right"><?php echo $grandtotal."/-"; ?></td>
            </tr>
            <tr>
                <td align="right">Tax:</td>
                <td colspan="2" align="right">-</td>
            </tr>
            <tr>
                <td align="right"><b>Total:</b></td>
                <td colspan="2" align="right"> <?php echo "<b>".$grandtotal."/-</b>"; ?></td>
            </tr>
            <tr>
                <td align="right"><b>Paid:</b></td>
                <td colspan="2" align="right"> <?php echo "<b>".$invoice_info_fetch["credit"]."/-</b>"; ?></td>
            </tr>
            <tr>
                <td align="right"><b>Unpaid:</b></td>
                <td colspan="2" align="right"> <?php echo "<b>".$invoice_info_fetch["debit"]."/-</b>"; ?></td>
            </tr>
        </table>
        
        <form method="post">
            <br>
            <button style="width:150px; height:60px;" type="submit" id="cancel" name="cancel" class="btn btn-danger">Cancel</button>   
            <button style="width:150px; height:60px;" type="submit" id="print" name="print" class="btn btn-success" onclick="printt()">Print</button>
        </form>    
        <?php 
        if(isset($_POST["cancel"]))
        {
            //$con=mysqli_connect("localhost","root","","account_esta");
        
            $cancel_transaction1=mysqli_query($con,"delete from customer_bill_history where invoice_id='".$invoice_id."'");
            $cancel_transaction2=mysqli_query($con,"delete from invoice_master where invoice_id='".$invoice_id."'");
       
            if($cancel_transaction2 && $cancel_transaction1)
            {
                header("location:index.php");
            }
            else
            {
                echo "<h2>failed to cancel</h2>";
            }
        }
        ?>
        <script>
            function printt()
            {
                //alert("76");
                //window.print();
                window.location.href = 'index.php';
                //document.getElementById("home").style.display="none";
                document.getElementById("cancel").style.display="none";
                document.getElementById("print").style.display="none";
                window.print();
            }
        </script>
    </body>
</html>