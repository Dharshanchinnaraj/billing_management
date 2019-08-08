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
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 40px;">
<div class="modal-dialog modal-lg" role="document"  style="max-width: 91%;margin-left: 83px;">
<div class="modal-content">
<div class="modal-body">
<form class="form-horizontal">
    <div class="form-group">
    <div class="col-sm-6" style="bottom: -18px;margin-left: 3px;width:40%"> <br>
    <input type="text" class="form-control" id="q" placeholder="search products" onkeyup="load(1)">
    </div>
<!--<button type="button" class="btn btn-danger" onclick="load(1)"><span class='glyphicon glyphicon-search'></span> search</button>-->
</div>
</form>
<div id="loader" style="position: absolute;	text-align: center;	top: 55px; max-height:50%;	width: 100%;display:none;"></div><!-- Carga gif animado -->
<div class="outer_div" ></div><!-- Datos ajax Final -->
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<?php
}
?>