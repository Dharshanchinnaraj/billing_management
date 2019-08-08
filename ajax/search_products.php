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
include("../funcions.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if (isset($_GET['id'])){
$id_product=intval($_GET['id']);
$query=mysqli_query($con, "select * from `{$portal_name}_billing_detail` where id_product='".$id_product."'");
$count=mysqli_num_rows($query);
if ($count==0){
    if ($delete1=mysqli_query($con,"DELETE FROM `{$portal_name}_products` WHERE id_product='".$id_product."'")){
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
      <strong>Error!</strong> Could not delete this item. There are quotes related to this product. 
    </div>
    <?php
}
}
if($action == 'ajax'){
$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
$aColumns = array('code_product', 'name_product');//Columnas de busqueda
$sTable = "`{$portal_name}_products`";
$sWhere = "";
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$product_type=$row["product_type"];   

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
$sWhere.=" order by id_product desc";
include 'pagination.php'; 
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
$per_page = 10; 
$adjacents  = 4; 
$offset = ($page - 1) * $per_page;
$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  where goods_service =$product_type");  
$row= mysqli_fetch_array($count_query);
$numrows = $row['numrows'];
$total_pages = ceil($row['numrows']/$per_page);
$reload = './index.php';
$sql="SELECT * FROM  $sTable where goods_service =$product_type LIMIT $offset,$per_page";
$query = mysqli_query($con, $sql);
if ($numrows>0){
    $simbolo_moneda=get_row("`{$portal_name}_profile`",'currency', 'id_profile', 1);
    ?>



    <div class="table-responsive" >
      <table class="table">
            <tr  class="red" >

                <th>Code</th>
                <th>Product Name</th>
                  <th>Product Description</th>
                <th>Status</th>
                <th>Date</th>
                <th class='text-lift'>Price</th>
               <?php if($product_type==1){ ?>
                <th class='text-lift'>Stock</th>
               <?php } ?>
                <th class=''>Actions</th>

            </tr>
            <?php
            while ($row=mysqli_fetch_array($query)){
            $id_product=$row['id_product'];
            $code_product=$row['code_product'];
            $name_product=$row['name_product'];
             $description_product=$row['description_product'];
            $status_product=$row['status_product'];
            if ($status_product==1){$state="Active";}
            else {$state="Inactive";}
            $date_added= date('d/m/Y', strtotime($row['date_added']));
            $price_product=$row['price_product'];
            $goods_service=$row['goods_service'];
             $stack=$row['stack'];
          
          if ($goods_service == 1 || $goods_service == 3 || $goods_service == 4) {
                   if($stack==1 || $stack==0){
                   $status_class = "background-color:#f0c4c6";
                   }
                 
                  if  ($stack==5 || $stack==4 || $stack==3 || $stack==2){
                      $status_class = "background-color:#f0eec4";
                   }
                  if($stack >6){
                      $status_class = "background-color:#fff";
                   }
                   }
          
          
          
                   ?>
            <input type="hidden" value="<?php echo $code_product;?>" id="code_product<?php echo $id_product;?>">
            <input type="hidden" value="<?php echo $name_product;?>" id="name_product<?php echo $id_product;?>">
             <input type="hidden" value="<?php echo $description_product;?>" id="description_product<?php echo $id_product;?>">
            <input type="hidden" value="<?php echo $state;?>" id="state<?php echo $id_product;?>">
            <input type="hidden" value="<?php echo number_format($price_product,2,'.','');?>" id="price_product<?php echo $id_product;?>">
            <input type="hidden" value="<?php echo $stack;?>" id="stack<?php echo $id_product;?>">
            
            <tr>
            
            <?php if($product_type==$goods_service){ ?>
             <tr style="<?php echo $status_class;?>">
            <td><?php echo $code_product; ?></td>
            <td ><?php echo $name_product; ?></td>
            <td ><?php echo $description_product; ?>
            <td><?php echo $state;?></td>
            <td><?php echo $date_added;?></td>
            <td><?php echo $simbolo_moneda;?><?php echo number_format($price_product,2);?></span></td>
             <?php if($product_type==1){ ?>
            <td><span class='pull-left'><?php echo $stack;?></span></td>
             <?php } ?>
            <td class='text-center'>
            <div class="labels">
            <a href="#" class='alert_color' title='Editer product' onclick="obtener_datos('<?php echo $id_product;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" class='alert_color' title='Remove product' onclick="eliminar('<?php echo $id_product; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
            </div>
            </td>&nbsp;
             <?php } ?>
            </tr>

            <?php } ?>
        </table>
        <tr>
        <td colspan=6><span class="pull-right">
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