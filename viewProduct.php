<?php
    ob_start();
    include("includes/sidebar.php"); 
    include("includes/database.php");
?>
<?php
   
   $product=mysqli_query($con,"select * from product_master");
?>
<html>
<head>
	<title>Sachin Enterprise</title>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
</head>
<body>
    <br>
    <table class="table table-bordered">
        <?php while($rs=mysqli_fetch_assoc($product))
        {
        ?>
        <tr>
            <td>
                <?php echo $rs["product_name"];?> 
            </td>
            <td>
                <form action="editProduct.php">
                    <input type="hidden" name="id" value="<?php echo $rs["product_id"]; ?>">
                    <button type="submit" id="edit" name="edit" class="btn btn-success">edit</button>
                </form>
            </td>
        </tr>
   <?php  } ?>
    </table>

     <?php ob_end_flush();?>
     <script>
     </script>
</body>
</html>     