<?php
    ob_start();
    include("includes/sidebar.php");
    include("includes/database.php");
?>
<?php
    $customer_name=$_POST["name"];
    $customer_id_info=mysqli_query($con,"select customer_id from customer_master where customer_name='".$customer_name."'"); 
    $customer_id_fetch=mysqli_fetch_assoc($customer_id_info);
    $customer_id=$customer_id_fetch["customer_id"];


    $product_info=mysqli_query($con,"select * from product_master");  
    $invoice_info=mysqli_query($con,"select * from invoice_master where customer_id='".$customer_id."' and invoice_date between '".$_POST["from"]."' and '".$_POST["to"]."'"); 

    $n=0;
    $i=1;
?>
<html>
    <head>
        <link href="css/bootstrap.min_1.css" rel="stylesheet" type="text/css"/>
        <link href="css/tableexport.min.css" rel="stylesheet" type="text/css"/>
        <title>Sachin Enterprise</title>
    </head>
<body>  
<h2 style="text-align: center;"><?php echo $_POST["name"]  ?> </h2>  
<h2 style="text-align: center;"><?php echo $_POST["from"] . "  <b>TO</b>  " . $_POST["to"];   ?> </h2>
    <br>
<table border="1" class="table table-bordered" id="history" style="margin-left:auto;margin-right:auto;">
    <tr>
        <th>Sr. No.</th>
        <th>Invoice No.</th>
        <th>Date</th>
        <?php
            
            while($product_name=mysqli_fetch_assoc($product_info))
            {
                echo "<th>".$product_name["product_name"]."</th>";
                
                $n++;
            }
        ?>
    </tr>
    <?php 
        //print_r($array_product);
        while($rs=mysqli_fetch_assoc($invoice_info))
        { 
            $product_info=mysqli_query($con,"select * from product_master");
            $array_product=array();
            while($product_name=mysqli_fetch_assoc($product_info))
            {
                $array_product[$product_name["product_id"]]="-";
            }
        ?>
        <tr>
        <td><?php echo $i; $i++; ?></td>


        <td><?php echo $rs["invoice_id"] ?></td>
        <td><?php echo $rs["invoice_date"]?></td>
        <?php
           // echo $rs["invoice_id"]."->";
            $product_per_invoice=mysqli_query($con,"select customer_id,product_id,bill_product_qty from customer_bill_history where invoice_id='".$rs["invoice_id"]."'");
            while($rs1=mysqli_fetch_assoc($product_per_invoice))
            {
                foreach($array_product as $key => $value)
                {
                    if($rs1["product_id"] == $key)
                    {
                        $array_product[$key]=$rs1["bill_product_qty"];
                    }
                }
                
                /*echo $rs1["product_id"]."*";
                echo $rs1["bill_product_qty"];
                echo "  ";
                */
                
            }
            
            //print_r($array_product);
            //echo "<br>";
            
                foreach($array_product as $key => $value)
                {
                    echo "<td>".$value."</td>";
                }
            
        ?>
        </tr>
        <?php } ?>

        <?php ob_end_flush();?>

</table>
            <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script src="js/FileSaver.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.min_1.js" type="text/javascript"></script>
            <script src="js/tableexport.min.js" type="text/javascript"></script>
            <script>
                $("#history").tableExport();
            </script>

</body>
</html>
