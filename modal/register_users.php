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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <div class="col-sm-6">
        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><b>Add New User</b></h4>
    </div>
    <div class="col-sm-6">
        <a type="button" class="close" style="background-color:red;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
    </div>
</div>
<div class="modal-body">
<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
<div id="resultados_ajax"></div>
<div class="form-group">
    <label for="firstname" class="col-sm-3 control-label">Names</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Names" required>
    </div>
</div>
<div class="form-group">
    <label for="lastname" class="col-sm-3 control-label">lastname</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname" required>
    </div>
</div>
<div class="form-group">
    <label for="user_name" class="col-sm-3 control-label">User</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User" pattern="[a-zA-Z0-9]{2,64}" title="Username( only letters and numbers, 2-64 characters)"required>
    </div>
</div>
<div class="form-group">
    <label for="user_email" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-8">
        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" required>
    </div>
</div>
<div class="form-group">
    <label for="user_password_new" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Password" pattern=".{6,}" title="Password ( min.6 caracteres)" required>
    </div>
</div>
<div class="form-group">
    <label for="user_password_repeat" class="col-sm-3 control-label">repeat password</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="repeat password" pattern=".{6,}" required>
    </div>
    </div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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