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
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="col-sm-6">
            <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Change Password</h4>
            </div>
            <div class="col-sm-6">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        </div>
    <div class="modal-body">
    <form class="form-horizontal" method="post" id="editar_password" name="editar_password">
    <div id="resultados_ajax3"></div>
    <div class="form-group">
        <label for="user_password_new3" class="col-sm-4 control-label">New password</label>
        <div class="col-sm-8">
        <input type="password" class="form-control" id="user_password_new3" name="user_password_new3" placeholder="New password" pattern=".{6,}" title="Password � a (min. 6 characters)" required>
        <input type="hidden" id="user_id_mod" name="user_id_mod">
        </div>
    </div>
    <div class="form-group">
        <label for="user_password_repeat3" class="col-sm-4 control-label">Repeat password</label>
        <div class="col-sm-8">
        <input type="password" class="form-control" id="user_password_repeat3" name="user_password_repeat3" placeholder="Repeat password" pattern=".{6,}" required>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" id="actualizar_datos3">Change Password</button>
    </div>
    </form>
    </div>
</div>
</div>
</div>
<?php
}
?>	