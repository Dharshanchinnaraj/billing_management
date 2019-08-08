<?php 
/*
 * Author        :   BARATHI/KARPAGAM
 * Date          :   03-07-2019
 * Modified      :   
 * Modified By   :   
 * Description   :  
 */
?>
<?php

if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
header("location: login.php");
exit;
}
$active_facturas="active";
$active_productos="";
$active_clientes="";
$active_usuarios="";	
$title="New data | Virran Invoice";

/* Connect To Database*/
require_once ("config/db.php");
require_once ("config/conexion.php");
$query = "SELECT * FROM products ORDER BY date_added desc";
$sql = mysqli_query($con, $query);
?>
<style>

#purchase_order {
display: none;
}
#ui-datepicker-div{
top:0px;
bottom:1px;
height: 8px;

}

.ui-datepicker table {
background: #e1d9d9;
}

#submit{
color: white;
background-color: black;
}
</style>
<html>
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
</head>
<body>
<?php include("head.php");?>
<div class="col-sm-2"></div>
    <div class="col-sm-10">
    <div class="row" >
    <div class="panel panel-info">
    <div class="panel-heading">
            <h4>Report</h4>
    </div>
    <div class="panel-body">
    <br/>
    <br/>
    <div class="col-md-1" style="margin: 0px -13px;"><label>From</label></div>			
    <div class="col-md-3">
        <input type="text" name="From" id="From" class="form-control" placeholder="From Date"/>
    </div>
    <div  class="col-md-1"style="margin: 0px -13px;" ><label>To</label></div>	
    <div class="col-md-3">
        <input type="text" name="to" id="to" class="form-control"  placeholder="To Date"/>
    </div>
    <div class="col-md-4">
        <input type="button" name="range" id="submit" value="Search" onclick="myFunction()"  class="btn"/>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div  id="purchase_order" class="table-responsive">
    <table  class="table">
    <tr class="red">
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Product Price</th>
        <th>Total</th>
        <th>GST</th>
        <th>GST with Total</th>
        <th>Date</th>
        </tr>
        <?php
        while($row= mysqli_fetch_array($sql))
        {
        ?>
    <tr>
        <td><?php echo $row["nombre_cliente"]; ?></td>
        <td><?php echo $row["nombre_producto"]; ?></td>
        <td><?php echo $row["cantidad"]; ?></td>
        <td><?php echo $row["precio_producto"]; ?></td>
        <td><?php echo $row["impuesto"]; ?></td>
        <td><?php echo $row["total_venta"];?></td>
        <td><?php echo $row["total_venta"];?></td>
        <td><?php echo $row["date_added"];?></td>

    </tr>
    <?php
    }
    ?>
</table>
</div>
    <div class="btn-group pull-right">
        <a  href="data.php" class="btn btn-danger" >Download</a>
    </div>
</div>
</div>
</div>		
</div>
</body>
</html>		
<hr>
<?php
include("footer.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<!-- Script -->
<script>
function myFunction() {
  document.getElementById("purchase_order").style.display = "block";
}
</script>
<script>
$(document).ready(function(){
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd'
	});
	$(function(){
		$("#From").datepicker();
		$("#to").datepicker();
	});
	$('#range').click(function(){
		var From = $('#From').val();
		var to = $('#to').val();
		if(From != '' && to != '')
		{
			$.ajax({
				url:"range.php",
				method:"POST",
				data:{From:From, to:to},
				success:function(data)
				{
					$('#purchase_order').html(data);
				}
			});
		}
		else
		{
			alert("Please Select the Date");
		}
	});
});
</script>
  