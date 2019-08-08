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
if(isset($_SESSION['user_fill_id'])) 
?>
<?php

require_once ("config/db.php");
require_once ("config/Connection.php");
$active_productos="";
$active_clientes="";
$active_usuarios="";	
$title="Invoice| Virran Invoice";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php");?>
</head>
<body>
<main class="app-content">
    <div class="col-sm-12">
    <div class="row" >
    <div class="tile" style="margin-left: -56px; margin-right: -61px;bottom: -15px;">
    <div class="tile-body">
        <h4 style="float:left;font-size: 24px;"></i><label class="control-label" style="margin-left: 15px;">Invoice</label></h4> <br>
        <div class="btn-group pull-right" style="bottom: -18px;margin-right: 12px;">
            <a  href="new_bill.php" class="btn btn-danger" style="padding: 6px;margin-top: -25px;"><span class="glyphicon glyphicon-plus" ></span> New Invoice</a>
        </div>
        <br>
    </div>
<div class="panel-body">
<form class="form-horizontal" role="form" id="datos_cotizacion">
<div class="form-group row">
    <div class="col-md-5">
        <input type="text" class="form-control" id="q" placeholder="Client name or invoice " onkeyup='load(1);' style="width: 55%; margin-left: -19px;">
    </div>
</div>
</form>
<div id="resultados"></div>
<div class='outer_div'></div>
<?php
$sql = "SELECT round_total FROM `{$portal_name}_invoices`";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) { ?>
<!--<div class="btn-group pull-right">
<button id="btnExport" onclick="fnExcelReport();" class="btn btn-danger"><i class="glyphicon glyphicon-download"></i> GET EXCEL SHEET</button>
</div>-->
<?php } else { ?>
<?php }
?>
</div>
</div>	
</div>
</div>
</main>
<br>
<hr>
<?php
include("footer.php");
?>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/invoices.js"></script>
<script>
function fnExcelReport()
{
var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
var textRange; var j=0;
tab = document.getElementById('headerTable'); // id of table
var dataexcelrow = tab.rows.length;

for(j = 0 ; j < dataexcelrow ; j++) 
{     

tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
//tab_text=tab_text+"</tr>";
}
tab_text=tab_text+"</table>";
tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE "); 

if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
{
txtArea1.document.open("txt/html","replace");
txtArea1.document.write(tab_text);
txtArea1.document.close();
txtArea1.focus(); 
sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
}  
else                 //other browser not tested on IE 11
sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

return (sa);
}
</script>
</body>
</html>

<script>
        $(document).ready(function(){
            $(".invoiceactive").addClass('active');
        });
    </script>

