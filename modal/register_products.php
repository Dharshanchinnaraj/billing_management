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
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
    $row=mysqli_fetch_array($query_empresa);
    $product_type=$row["product_type"];
/* Connect To Database*/
require_once ("config/db.php");
require_once ("config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$active_invoices="";
$active_products="";
$active_client="";
$active_users="";	
$active_profile="active";	
$title="Configuration | Virran Invoice";
if (isset($con))
{
?>
<!-- Modal -->
<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <div class="col-sm-6" style="margin-top: 15px;">
    <h4 class="modal-title" id="myModalLabel"><b> Add new product</b></h4>
    </div>
    <div class="col-sm-6">
    <label type="button" class="close-btn" data-dismiss="modal" id="close_product" style="margin-top: 15px;">X</label>
    </div>
</div>
<div class="modal-body">
<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
<div id="resultados_ajax_productos"></div>
<div class="form-group">
    <label for="codigo" class="col-sm-3 control-label">Code</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" id="codigo" name="code" placeholder="Product code" required>
    <input type="hidden" class="form-control" id="codigo" name="product_type_code" value="<?php echo $product_type; ?>">
    </div>
</div>

<div class="form-group">
    <label for="nombre" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
    </div>
</div>


<div class="form-group">
    <label for="nombre" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-8">
    <textarea class="form-control" id="nombre" name="description" placeholder="Description" required maxlength="255" ></textarea>
    </div>
</div>

<div class="form-group">
    <label for="estado" class="col-sm-3 control-label">Status</label>
    <div class="col-sm-8">
    <select class="form-control" id="estado" name="state" required>
    <option value="">Select</option>
    <option value="1" selected>Active</option>
    <option value="0">Inactive</option>
    </select>
    </div>
</div>

<div class="form-group">
    <label for="precio" class="col-sm-3 control-label">Price</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" id="precio" name="price" placeholder="Product sales price" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Enter only numbers 0 or 2 decimals" maxlength="8">
    </div>
</div>
<?php if($product_type == 1) { ?>
<div class="form-group">
    <label for="stack" class="col-sm-3 control-label">Stock</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="stack" name="stack" placeholder="Enter the Stock" <?php if($product_type == 2) { ?> disabled <?php }else{?>  <?php } ?>>
        <input type="hidden" class="form-control" id="product_type_id" name="product_type_id"  value="<?php echo $product_type; ?>">                            
    </div>
</div>
<?php } ?>

<div class="modal-footer" style="margin-bottom: 15px;">
    <button type="submit" class="btn btn-danger" id="guardar_datos">Save data</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
}
?>