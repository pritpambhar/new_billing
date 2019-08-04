<?php
    ob_start();
    include("includes/sidebar.php"); 
    include("includes/database.php");
?>
<?php
   
    $bill_history=mysqli_query($con,"select * from customer_bill_history");
    
    $customer=mysqli_query($con,"select * from customer_master");
    
    $customer_id_fetch=mysqli_query($con,"select customer_id from customer_master where customer_name='".$_POST["name"]."'");
    $customer_id_row=mysqli_fetch_assoc($customer_id_fetch);
    $customer_id=$customer_id_row["customer_id"];

    $invoice=mysqli_query($con,"SELECT created_on as date,transaction_date as date_b,invoice_id as invoice_id,credit as credit,null as debit FROM transaction_master
    where customer_id=".$customer_id."
    UNION ALL
    SELECT created_on as date,invoice_date as date_b,invoice_id as invoice_id,null as credit,debit as debit FROM invoice_master
    WHERE customer_id=".$customer_id."
    ORDER BY date ASC");
?>
<html>
<head>
	<title>Sachin Enterprise</title>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
</head>
<body>
    <h2 style="text-align: center;"><?php echo $_POST["name"]  ?> </h2>  
    <h2 style="text-align: center;"><?php echo $_POST["from"] . "  <b>TO</b>  " . $_POST["to"];   ?> </h2>
    <br>
    <table class="table table-bordered">
        <tr>
            <td><b>Date</b></td>
            <td><b>Opening</b></td>
            <td><b>Invoice Id</b></td>
            <td><b>credit</b></td>
            <td><b>debit</b></td>
            <td><b>closing</b></td>
        </tr>
        
        <?php 
        $closing=0;
        $opening=0;
        while($rs=mysqli_fetch_assoc($invoice))
        { 
            $closing = $closing + $rs["debit"] -$rs["credit"];  

            if($rs["date_b"]>=$_POST["from"] && $rs["date_b"]<=$_POST["to"])
            { 
             ?> 
                <tr>
                    <td><?php echo $rs["date"]; ?></td>
                    <td><?php echo "<b>".$opening."</b>"; ?></td>
                    <td><?php echo $rs["invoice_id"]; ?></td>
                    <td><?php echo $rs["credit"]; ?></td>
                    <td><?php echo $rs["debit"]; ?></td>
                    <td><?php 
                        if($closing<0)
                        {
                            echo "<b>".(-1)*$closing." CR</b>"; 
                            $opening=(-1)*$closing." CR";
                        }
                        else
                        {
                            echo "<b>".$closing." DB</b>"; 
                            $opening=$closing." DB";
                        }
                    ?></td>
                </tr>
            <?php
            }
            else
            {
                if($closing<0)
                {
                    $opening=(-1)*$closing." CR";
                }
                else
                {
                    $opening=$closing." DB";
                }
            }
        } 
     ?>
     <tr>
        <td colspan="5" align="right">
            <b>TOTAL:</b>
        </td>
        <td>
            <b>
            <?php 
                if($closing<0)
                {
                    echo "<b>".(-1)*$closing." CR</b>"; 
                }
                else
                {
                    echo "<b>".$closing." DB</b>"; 
                }
            ?></b>
        </td>
    </tr>
    </table>

     <button style="width:150px; height:60px; float:right; margin:50px;" type="submit" id="print-btn" name="print-btn" class="btn btn-success" onclick="printt()">Print</button>


     <form method="post" action="addCreditAmount.php">
        <input type="hidden" name="name" value="<?php echo $_POST["name"]; ?>">
        <button style="width:150px; height:60px; float:right; margin:50px; margin-right: -30px;" type="submit" id="add-credit" name="add-credit" class="btn btn-danger">ADD CREDIT</button>
     </form>
     <?php ob_end_flush();?>
     <script>
     function printt()
     {
        window.location.href = 'index.php';
        document.getElementById("main").style.display="none";
        document.getElementById("print-btn").style.display="none";
        document.getElementById("add-credit").style.display="none";
        window.print();
     }
     </script>
</body>
</html>     