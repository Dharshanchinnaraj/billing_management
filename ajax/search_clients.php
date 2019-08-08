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
$id_client=intval($_GET['id']);
$query=mysqli_query($con, "select * from `{$portal_name}_invoices` where id_client='".$id_client."'");
$count=mysqli_num_rows($query);
if ($count==0){
if ($delete1=mysqli_query($con,"DELETE FROM `{$portal_name}_client` WHERE id_client='".$id_client."'")){
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
<strong>Error!</strong> Sorry something went wrong try again.
</div>
<?php
}
} else {
?>
<div class="alert alert-danger alert-dismissible" role="alert" style="width: 361px;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>Error!</strong> Could not delete this client. There are bills related to this product. 
</div>
<?php
}
}
if($action == 'ajax'){
$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
$aColumns = array('name_client');
$sTable = "`{$portal_name}_client`";
$sWhere = "";
if ( $_GET['q'] != "" )
{
$sWhere = "WHERE (";
for ( $i=0 ; $i<count($aColumns) ; $i++ )
{
$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
}
$sWhere = substr_replace( $sWhere, "", -3 );
$sWhere .= ')';
}
$sWhere.=" order by name_client";
include 'pagination.php'; 
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
$per_page = 10;
$adjacents  = 4; 
$offset = ($page - 1) * $per_page;
$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
$row= mysqli_fetch_array($count_query);
$numrows = $row['numrows'];
$total_pages = ceil($numrows/$per_page);
$reload = './clients.php';
$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
$query = mysqli_query($con, $sql);
if ($numrows>0){
?>
<div class="table-responsive">
<table class="table">
<tr  class="red">
<th style="width:15%;">Name</th>
<th style="width:10%;">Phone</th>
<th style="width:10%;">Email</th>
<th style="width:40%;">Address</th>
<th style="width:5%;">Status</th>
<th style="width:10%;">Date</th>
<th style="width:10%;" class='text-center'>Actions</th>

</tr>
<?php
while ($row=mysqli_fetch_array($query)){
$id_client=$row['id_client'];
$name_client=$row['name_client'];
$phone_client=$row['phone_client'];
$email_client=$row['email_client'];
$address_client=$row['address_client'];
$status_client=$row['status_client'];
$gst_number_client=$row['gst_number_client'];

$status=$row['status'];
$tax=$row['tax'];
$cgst=$row['cgst'];
$igst=$row['igst'];

if ($status_client==1){$estado="Active";}
else {$estado="Inactive";}
$date_added= date('d/m/Y', strtotime($row['date_added']));

?>

<input type="hidden" value="<?php echo $name_client;?>" id="name_client<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $phone_client;?>" id="phone_client<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $email_client;?>" id="email_client<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $address_client;?>" id="address_client<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $gst_number_client;?>" id="gst_number_client<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $status;?>" id="status<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $tax;?>" id="tax<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $cgst;?>" id="cgst<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $igst;?>" id="igst<?php echo $id_client;?>">
<input type="hidden" value="<?php echo $status_client;?>" id="status_client<?php echo $id_client;?>">



<tr>
<td><?php echo $name_client; ?></td>
<td ><?php echo $phone_client; ?></td>
<td><?php echo $email_client;?></td>
<td><?php echo $address_client;?></td>
<td><?php echo $estado;?></td>
<td><?php echo $date_added;?></td>

<td class='text-center'>
<div class='labels1'>
<a href="#" class='alert_color' title='edit client' onclick="obtener_datos('<?php echo $id_client;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" class='alert_color' title='delete client' onclick="eliminar('<?php echo $id_client; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
</div>
</td>

</tr>
<?php
}
?>
</table>
<tr>
<td colspan=7><span class="pull-right">
<?php
echo paginate($reload, $page, $total_pages, $adjacents);
?></span></td>
</tr>

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
<?php      
}
}
?>