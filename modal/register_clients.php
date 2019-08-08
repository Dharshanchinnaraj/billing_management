<?php
/*
 * Author        :   BARATHI/KARPAGAM
 * Date          :   03-07-2019
 * Modified      :  
 * Modified By   :  
 * Description   :  
 */

$portal_name =  $_SESSION['portal_name'];
?>
<?php
if (isset($con))
{
?>
<!-- Modal -->
<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document"  style="max-width: 70%;">
<div class="modal-content">
<div class="modal-header">
    <div class="col-sm-6" style="margin-top: 15px;">
        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><b> Add new client</b></h4>
    </div>
    <div class="col-sm-6" style="margin-top: 15px;">
        <label type="button" class="close-btn" data-dismiss="modal" id="click_close">X</label>
    </div>
</div>
<div class="modal-body" style="margin-right: -82px;">
<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
<div id="resultados_ajax"></div>
 <div class='col-md-12'>
<div class="row">
<div class="form-group col-md-4">
    <label for="nombre" class="control-label">Name</label>
        <input type="text" class="form-control" id="nombre" name="name" required>
    </div>
<div class="form-group col-md-4">
    <label for="telefono" class="control-label">Phone</label>
        <input type="text" class="form-control" id="telefono" name="phone">
    </div>
<div class="form-group col-md-4">
    <label for="email" class="control-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" >
    </div>
    </div>
 <div class="row">
<div class="form-group col-md-4">
    <label for="direccion" class="control-label">Address</label>
        <textarea class="form-control" id="direccion" name="address"   maxlength="255" ></textarea>
 </div>
     
<div class="form-group col-md-4">
    <label for="estado" class="control-label">Status</label>
        <select class="form-control" id="estado" name="state" required>
        <option value="">-- Select status --</option>
        <option value="1" selected>Active</option>
        <option value="0">Inactive</option>
        </select>
    </div>
<?php
$sTable = "`{$portal_name}_products`";
$sWhere = "";
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$gst_type=$row["gst_type"];  

?>

<?php if($gst_type==0){?>

<div class="form-group col-md-4">
    <label class="control-label">GST Number</label>
        <input type="text" class="form-control" id="telefono" name="gst_number_client" >
    </div>
</div>
  <div class="row">
<div class="form-group col-md-4">
    <label for="GST Type" class="control-label" >GST Type</label>
        <select class="form-control" id="purpose" required name="status" >
        <option value="" selected>Select</option>
        <option value="1">SGST / CGST</option>
        <option value="2">IGST</option>
        <option value="3">SEZONE</option>
        </select>
    </div>
    <div style='display:none;' id='csgsts'>
<div class="form-group col-md-4">
    <label for="tax" class="control-label">SGST(%)</label>
        <input type="tax" class="form-control" id="tax" name="tax">
    </div>
<div class="form-group col-md-4">
    <label for="text" class="control-label">CGST(%)</label>
        <input type="text" class="form-control" id="cgst" name="cgst">
    </div>
    </div>
   
   
      <div style='display:none;' id='igsts'>
    <div class="form-group col-md-4">
    <label for="igst" class="control-label">IGST(%)</label>
        <input type="igst" class="form-control" id="igst" name="igst">
    </div>
    </div>
       </div>
<?php } ?>
      </div>
 </div>
<div class="modal-footer" style="margin-bottom: 15px;">
    <button type="submit"  class="btn btn-danger" id="guardar_datos">Save</button>
</div>
     </div>
     </div>
 </form>
</div>
</div>

<?php
}
?>


