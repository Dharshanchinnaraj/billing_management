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

require_once ("config/db.php");
require_once ("config/Connection.php");
$active_invoices="";
$active_products="active";
$active_client="";
$active_users="";	
$title="Products | Virran Invoice";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php");?>
</head>
<body>
<main class="app-content">	
<div class="col-sm-12">
<div class="row">
<div class="tile" style="margin-left: -56px; margin-right: -61px;bottom: -15px;">
<div class="tile-body">
     <h4 style="float:left;font-size: 24px;"></i><label class="control-label" style="margin-left: 15px;">Products</label></h4> <br>
<div class="btn-group pull-right" style="bottom: -18px;margin-right: 12px;">
<button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoProducto" style="padding: 6px; margin-top: -25px;"><span class="glyphicon glyphicon-plus" ></span> New product</button>
</div>
     <br>
</div>
<div class="panel-body">
<?php
include("modal/register_products.php");
include("modal/editer_products.php");
?>
<form class="form-horizontal" role="form" id="datos_cotizacion">
<div class="form-group row">
    <div class="col-md-5">
        <input type="text" class="form-control" id="q" placeholder="Code or product name" onkeyup='load(1);' style="width: 55%; margin-left:-20px;">
    </div>
</div>
</form>
<div id="resultados"></div><!-- Carga los datos ajax -->
<div class='outer_div'></div><!-- Carga los datos ajax -->
</div>
</div>
</div>
</div>
</main>
<hr>
<?php
include("footer.php");
?>
<script type="text/javascript" src="js/products.js"></script>
</body>
</html>
<script>
$( "#guardar_producto" ).submit(function( event ) {
$('#guardar_datos').attr("disabled", true);

var parametros = $(this).serialize();
alert(parametros);
$.ajax({
type: "POST",
url: "ajax/new_product.php",
data: parametros,
beforeSend: function(objeto){
$("#resultados_ajax_productos").html("Message: Loading...");
},
success: function(datos){
$("#resultados_ajax_productos").html(datos);
$('#guardar_datos').attr("disabled", false);
load(1);
}
});
event.preventDefault();
})

$( "#editar_producto" ).submit(function( event ) {
$('#actualizar_datos').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "ajax/editer_product.php",
data: parametros,
beforeSend: function(objeto){
$("#resultados_ajax2").html("Message: Loading...");
},
success: function(datos){
$("#resultados_ajax2").html(datos);
$('#actualizar_datos').attr("disabled", false);
load(1);
}
});
event.preventDefault();
})

function obtener_datos(id)
{
var code_product = $("#code_product"+id).val();
var name_product = $("#name_product"+id).val();
var description_product = $("#description_product"+id).val();
var state = $("#state"+id).val();
var price_product = $("#price_product"+id).val();
var stack = $("#stack"+id).val();

$("#mod_id").val(id);
$("#mod_codigo").val(code_product);
$("#mod_nombre").val(name_product);
$("#mod_des").val(description_product);
$("#mod_precio").val(price_product);
$("#mod_stack").val(stack);
}
</script>

<script>
        $(document).ready(function(){
            $(".productactive").addClass('active');
        });
    </script>