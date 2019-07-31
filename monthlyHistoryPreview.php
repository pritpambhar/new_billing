<?php
    include("includes/sidebar.php");
    include("includes/database.php");
?>
<?php
    $product_info=mysqli_query($con,"select * from product_master");  
    $invoice_info=mysqli_query($con,"select * from invoice_master where invoice_date between '".$_POST["from"]."' and '".$_POST["to"]."'"); 
    $n=0;
    $i=1;
?>
<html>
    <head>
        <link href="css/bootstrap.min_1.css" rel="stylesheet" type="text/css"/>
        <link href="css/tableexport.min.css" rel="stylesheet" type="text/css"/>
    </head>
<body>    
    <h2 style="text-align: center;"><?php echo $_POST["from"] . "  <b>TO</b>  " . $_POST["to"];   ?> </h2>
    <br>
<table border="1" class="table table-bordered" id="history" style="margin-left:auto;margin-right:auto;">
    <tr>
        <th>Sr. No.</th>
        <th>Name</th>
        <th>status</th>
        <th>Rs.</th>
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

        <td> <?php
            $customer_name_fetch=mysqli_query($con,"select customer_name from customer_master where customer_id='".$rs["customer_id"]."'");  
            $customer_name_row=mysqli_fetch_assoc($customer_name_fetch);
            $customer_name=$customer_name_row["customer_name"];
            echo $customer_name;
            ?>
        </td>
        <td><?php 

        if($rs["invoice_status"]=="cancel")
        {
            echo "<b>".$rs["invoice_status"]."</b>";
        }
        else
        {
            echo "";
        }

        ?>
        </td>

        <td><?php echo $rs["invoice_grand_total"] ?></td>
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
