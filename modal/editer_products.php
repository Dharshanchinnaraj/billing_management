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
if (isset($con))
{
?>
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <div class="col-sm-6">
    <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
    </div>
    <div class="col-sm-6">
    <button type="button" class="close" id="close_edit_product" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
</div>
<div class="modal-body">
<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
<div id="resultados_ajax2"></div>
    <div class="form-group">
        <label for="mod_codigo" class="col-sm-3 control-label">Code</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_codigo" name="mod_code" placeholder="Product code" required>
        <input type="hidden" name="mod_id" id="mod_id">
        </div>
    </div>
<div class="form-group">
        <label for="mod_nombre" class="col-sm-3 control-label">First name</label>
    <div class="col-sm-8">
        <input class="form-control" id="mod_nombre" name="mod_name" placeholder="Product name" required>
    </div>
</div>


<div class="form-group">
        <label for="mod_des" class="col-sm-3 control-label"> Description</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="mod_des" name="mod_des" placeholder="Product Description" required></textarea>
    </div>
</div>
<div class="form-group">
<label for="mod_estado" class="col-sm-3 control-label">State</label>
    <div class="col-sm-8">
        <select class="form-control" id="mod_estado" name="mod_state" required>
        <option value="">-- Select state --</option>
        <option value="1" selected>Active</option>
        <option value="0">Inactive</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="mod_precio" class="col-sm-3 control-label">Price</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" id="mod_precio" name="mod_price" placeholder="Product sales price"  required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Enter only numbers 0 or 2 decimals" maxlength="8">
    </div>
</div>
<?php if($product_type == 1) { ?>
<div class="form-group">
    <label for="mod_stack" class="col-sm-3 control-label">stock</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" id="mod_stack" name="mod_stack" placeholder="Enter the product" <?php if($product_type == 2) { ?> disabled <?php }else{?>  <?php } ?>>
    </div>
</div>
<?php } ?>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-danger" id="actualizar_datos">Update data</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
}
?>