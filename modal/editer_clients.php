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
        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editer client</h4>
        </div>
        <div class="col-sm-6">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
    <div class="modal-body">
    <form class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">
    <div id="resultados_ajax2"></div>
        <div class="form-group">
        <label for="mod_nombre" class="col-sm-3 control-label">First name</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_name" name="mod_name"  required>
        <input type="hidden" name="mod_id" id="mod_id">
        </div>
        </div>
    <div class="form-group">
        <label for="mod_telefono" class="col-sm-3 control-label">Phone</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_phone" name="mod_phone">
        </div>
    </div>

    <div class="form-group">
        <label for="mod_email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-8">
        <input type="email" class="form-control" id="mod_email" name="mod_email">
        </div>
    </div>
    <div class="form-group">
        <label for="mod_direccion" class="col-sm-3 control-label">Address</label>
        <div class="col-sm-8">
        <textarea class="form-control" id="mod_address" name="mod_address" ></textarea>
        </div>
    </div>
    
    
    <?php
$sTable = "`{$portal_name}_products`";
$sWhere = "";
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$gst_type=$row["gst_type"];   

?>
<?php if($gst_type==0){?>
    <div class="form-group">
    <label for="telefono" class="col-sm-3 control-label">GST Number</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_gst_number_client" name="mod_gst_number_client">
    </div>
    </div>
    
    
    <div class="form-group">
    <label for="estado" class="col-sm-3 control-label">GST Type</label>
    <div class="col-sm-8">
        <select class="form-control" id="mod_status" name="mod_status" required >
        <option value="1">SGST / CGST</option>
        <option value="2">IGST</option>
        <option value="3">SEZONE</option>
        </select>
    </div>
    </div>
    
    <div id="csgsts1"  style="display:none;">
    <div class="form-group">
    <label for="tax" class="col-sm-3 control-label">SGST(%)</label>
    <div class="col-sm-8">
        <input type="text" class="form-control"  id="mod_tax" name="mod_tax">
    </div>
    </div>
         
      <div class="form-group">
    <label for="cgst" class="col-sm-3 control-label">CGST(%)</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_cgst" name="mod_cgst">
    </div>
    </div>
     </div>
    
      <div  style="display:none;"  id='igsts1'>
    <div class="form-group">
    <label for="igst" class="col-sm-3 control-label">IGST(%)</label>
    <div class="col-sm-8">
        <input type="igst" class="form-control"  id="mod_igst" name="mod_igst">
    </div>
    </div>
      </div>
    <?php } ?>

    <div class="form-group">
        <label for="mod_estado" class="col-sm-3 control-label">Status</label>
        <div class="col-sm-8">
        <select class="form-control" id="mod_state" name="mod_state" required>
        <option value="">-- Select status --</option>
        <option value="1" selected>Active</option>
        <option value="0">Inactive</option>
        </select>
        </div>
    </div>
    
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" id="close_client" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-danger" id="actualizar_datos">Update</button>
    </div>
    </form>
    </div>
</div>
</div>
</div>
<?php
}
?>



