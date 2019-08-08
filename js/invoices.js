		$(document).ready(function(){
			load(1);
			
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/search_invoices.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					$('[data-toggle="tooltip"]').tooltip({html:true}); 
					
				}
			})
		}

	
		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Really delete invoice")){	
		$.ajax({
        type: "GET",
        url: "./ajax/search_invoices.php",
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
		
		function imprimir_factura(id_bill){
			//alert("My text is: "+id_bill  );
    //die();
			VentanaCentrada('./pdf/document/view_bill.php?id_bill='+id_bill,'Bill','','1024','768','true');
		}
