		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/search_clients.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	
		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("You really want to remove the client")){	
		$.ajax({
        type: "GET",
        url: "./ajax/search_clients.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Message: Loading...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}
		
		
	
$( "#guardar_cliente" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/new_client.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Message: Loading...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			 $('#click_close').click();
			 	$('#nombre').val('');
			$('#telefono').val('');
			$('#email').val('');
			$('#address').val('');
			$('#purpose').val('');
			$('#gst_number_client').val('');
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_cliente" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editer_client.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Message: Loading...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			$('#close_client').click();
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var name_client = $("#name_client"+id).val();
			var phone_client = $("#phone_client"+id).val();
			var email_client = $("#email_client"+id).val();
			var address_client = $("#address_client"+id).val();
			var status_client = $("#status_client"+id).val();
			var gst_number_client = $("#gst_number_client"+id).val();
			
			
			var status = $("#status"+id).val();
			var tax = $("#tax"+id).val();
			var cgst = $("#cgst"+id).val();
			var igst = $("#igst"+id).val();
	
			$("#mod_name").val(name_client);
			$("#mod_phone").val(phone_client);
			$("#mod_email").val(email_client);
			$("#mod_address").val(address_client);
			$("#mod_state").val(status_client);
			$("#mod_gst_number_client").val(gst_number_client);
			
			
			$("#mod_status").val(status);
			$("#mod_tax").val(tax);
			$("#mod_cgst").val(cgst);
			$("#mod_igst").val(igst);
			
			$("#mod_id").val(id);
			
				         
	//	alert(status);
		
		
		if ( status == 1)
                  //.....................^.......
                  {

                    $("#igsts1").hide();
                    $("#csgsts1").show();
                  }
                 
			if ( status == 2)
                  //.....................^.......
                  {

                    $("#igsts1").show();
                    $("#csgsts1").hide();
                  }
                  
                  	if ( status == 3)
                  //.....................^.......
                  {

                    $("#igsts1").hide();
                    $("#csgsts1").hide();
                  }
		}
	
	


