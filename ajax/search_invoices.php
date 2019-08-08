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
require_once ("../config/db.php");
require_once ("../config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if (isset($_GET['id'])){
$number_bill=intval($_GET['id']);
$del1="delete from `{$portal_name}_invoices` where number_bill='".$number_bill."'";
$del2="delete from `{$portal_name}_billing_detail` where number_bill='".$number_bill."'";
if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
?>
<div class="alert alert-success alert-dismissible" role="alert" style="width: 361px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success!</strong> Deleted data successfully.
</div>
<?php 
}else {
?>
<div class="alert alert-danger alert-dismissible" role="alert" style="width: 361px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> it can not delete data.
</div>
<?php
}
}


$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$product_type=$row["product_type"];


$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
    $row=mysqli_fetch_array($query_empresa);
    $client_prefix=$row["client_prefix"]; 

if($action == 'ajax'){
$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
$sTable = "`{$portal_name}_invoices`, `{$portal_name}_client`, `{$portal_name}_users`";
$sWhere = "";
$sWhere.=" WHERE `{$portal_name}_invoices`.id_client=`{$portal_name}_client`.id_client and `{$portal_name}_invoices`.id_salesman=`{$portal_name}_users`.user_id and `{$portal_name}_invoices`.goods_service_id = $product_type";
if ( $_GET['q'] != "" )
{
$sWhere.= " and  (`{$portal_name}_client`_client like '%$q%' or `{$portal_name}_invoices`.number_bill like '%$q%')";
}
$sWhere.=" order by `{$portal_name}_invoices`.id_bill  asc";
include 'pagination.php'; 
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
$per_page = 10; 
$adjacents  = 4; 
$offset = ($page - 1) * $per_page;
$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
$row= mysqli_fetch_array($count_query);
$numrows = $row['numrows'];
$total_pages = ceil($numrows/$per_page);
$reload = './invoices.php';
$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
$query = mysqli_query($con, $sql);
if ($numrows>0){
echo mysqli_error($con);
?>

<?php
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$product_type=$row["product_type"];
?>
<div class="table-responsive">
<table class="table" id="headerTable">
<tr  class="red">
    <th>Invoice NO</th>
    <th>Date</th>
    <th>Client</th>
<!--<th>Salesman</th>-->
    <th>Status</th>
    <th class='text-left'>Total</th>
    <th class='text-left'><?php if($product_type ==1){echo "Goods";} else {echo "Service"; } ?></th>
    <th class='text-center'>Actions</th>

</tr>
<?php
while ($row=mysqli_fetch_array($query)){
            $id_bill=$row['id_bill'];
            $number_bill=$row['number_bill'];
            $date=date("d/m/Y", strtotime($row['date_bill']));
            $name_client=$row['name_client'];
            $phone_client=$row['phone_client'];
            $email_client=$row['email_client'];
            $name_salesman=$row['firstname']." ".$row['lastname'];
            $state_bill=$row['state_bill'];
            if ($state_bill==1){$text_state="Paid";$label_class='label-success';}
            else{$text_state="Pending";$label_class='label-warning';}
            $round_total=$row['round_total']; 
            $goods_service_id=$row['goods_service_id']; 
    ?>
    <tr>

      <?php if($product_type==$goods_service_id){ ?>  
            <?php $dates =date('dmY');?>
            <td><?php echo $client_prefix; ?><?php echo $dates; ?><?php echo $number_bill;?></td>
            <td><?php echo $date; ?></td>
            <td><a href="#" data-toggle="tooltip" data-placement="top" title="<i class='glyphicon glyphicon-phone'></i> <?php echo $phone_client;?><br><i class='glyphicon glyphicon-envelope'></i>  <?php echo $email_client;?>" ><?php echo $name_client;?></a></td>
            <!--<td><?php echo $name_salesman; ?></td>-->
            <td><span class="label <?php echo $label_class;?>"><?php echo $text_state; ?></span></td>
            <td class='text-left'><?php echo number_format ($round_total,2); ?></td>
            <td class='text-left'><?php if($goods_service_id ==1){echo "Goods";} else {echo "Service"; } ?></td>
            <td class="text-center">
                <span style="display:none;">Close</span>
                <div class="tabledatalist4">
                    <a href="editer_invoice.php?id_bill=<?php echo $id_bill;?>" class='alert_color' title='Editer invoice' ><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a  href="#"class='alert_color' title='delete invoice' onclick="eliminar('<?php echo $number_bill; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="tabledatalist5">
                <a href="#" class='alert_color' title='downoload invoice' onclick="imprimir_factura('<?php echo $id_bill;?>');"><i class="glyphicon glyphicon-download"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class='alert_color' href="send_mail.php?id_bill=<?php echo $id_bill;?>"><i class="glyphicon glyphicon-envelope"></i></a> 
                </div>
            </td>
  <?php } ?>
    </tr>
    <?php
}
?>
</table>
<tr>
    <td colspan=7><span class="pull-right"><?php
     echo paginate($reload, $page, $total_pages, $adjacents);
    ?></span></td>
</tr>

</div>

<div class="btn-group pull-right">
<button id="btnExport" onclick="fnExcelReport();" class="btn btn-danger"><i class="glyphicon glyphicon-download"></i> GET EXCEL SHEET</button>
</div>

<?php
}else{
?>
<table class="table" id="headerTable">
<tr  class="red">
    <th>ID</th>
    <th>Date</th>
    <th>Client</th>
    <th>Status</th>
    <th class='text-left'>Total</th>
    <th class='text-center'>Actions</th>
</tr>
<tr>
<td colspan="6" style="text-align: center;"> No Record</td>   


</tr>
</table>
<?php      
}
}
?>
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
