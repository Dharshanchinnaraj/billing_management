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
        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> edit user</h4>
    </div>
    <div class="col-sm-6">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
</div>
<div class="modal-body">
<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
<div id="resultados_ajax2"></div>
    <div class="form-group">
        <label for="firstname2" class="col-sm-3 control-label">Firstname</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname2" name="firstname2" placeholder="Firstname" required>
        <input type="hidden" id="mod_id" name="mod_id">
    </div>
    </div>
<div class="form-group">
        <label for="lastname2" class="col-sm-3 control-label">Lastname</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="lastname2" name="lastname2" placeholder="Lastname" required>
    </div>
</div>
<div class="form-group">
        <label for="user_name2" class="col-sm-3 control-label">User</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="user_name2" name="user_name2" placeholder="User" pattern="[a-zA-Z0-9]{2,64}" title="Username (only letters and numbers, 2-64 characters)"required>
    </div>
</div>
<div class="form-group">
        <label for="user_email2" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-8">
        <input type="email" class="form-control" id="user_email2" name="user_email2" placeholder="Email" required>
    </div>
</div>
</form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-danger" id="actualizar_datos">Update data</button>
</div>
</div>
</div>
</div>
<?php
}
?>