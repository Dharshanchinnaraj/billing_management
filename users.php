<?php

/* Connect To Database*/
require_once ("config/db.php");
require_once ("config/Connection.php");
$active_invoices="";
$active_products="";
$active_client="";
$active_users="active";	
$title="Users | Virran Invoice";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
   <main class="app-content">
   <div class="col-sm-12">
    <div class="tile" style="margin-left: -62px; margin-right: -70px;bottom: -15px;">
    <div class="row" >
    <div class="btn-group pull-right" style="bottom: -18px;margin-right: 12px;">
        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="padding: 7px 20px;"><span class="glyphicon glyphicon-plus" ></span> New user</button>
    </div>
 
    <div class="panel-body">
        <?php
        include("modal/register_users.php");
        include("modal/editer_users.php");
        include("modal/change_password.php");
        ?>
    <form class="form-horizontal" role="form" id="datos_cotizacion">

    <div class="form-group row">
     <div class="col-md-5">
        <input type="hidden" class="form-control" id="q" placeholder="Name" onkeyup='load(1);' style="width: 55%; margin-left: -19px;">
    </div>
    <div class="col-md-3">
        <!--<button type="button" class="btn btn-danger" onclick='load(1);'>
        <span class="glyphicon glyphicon-search" ></span> search</button>-->
   <span id="loader"></span>
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
	<script type="text/javascript" src="js/users.js"></script>
  </body>
</html>
<script>
$( "#guardar_usuario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/new_user.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Message: Loading...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editer_user.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Message: Loading...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos2').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editer_password.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax3").html("Message: Loading...");
			  },
			success: function(datos){
			$("#resultados_ajax3").html(datos);
			$('#actualizar_datos3').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})
	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id){
			var nombres = $("#nombres"+id).val();
			var apellidos = $("#apellidos"+id).val();
			var usuario = $("#usuario"+id).val();
			var email = $("#email"+id).val();
			
			$("#mod_id").val(id);
			$("#firstname2").val(nombres);
			$("#lastname2").val(apellidos);
			$("#user_name2").val(usuario);
			$("#user_email2").val(email);
			
		}
</script>