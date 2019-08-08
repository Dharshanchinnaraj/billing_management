
  
                function add(id)
		{
			
                    var advance=document.getElementById('advance_'+id).value;
	           var discount=document.getElementById('discount_'+id).value;
                   
                  
			
        
			if (isNaN(advance))
                        
			{
			alert('This is not a number');
			document.getElementById('advance_'+id).focus();
			return false;
			}
			if (isNaN(discount))
			{
			alert('This is not a number');
			document.getElementById('discount_'+id).focus();
			return false;
			}
                     
			//Final validacion
			
			$.ajax({
                            
                            
                            
        type: "POST",
        url: "./ajax/editer_billing.php",
        data: "id="+id+"&advance="+advance+"&discount="+discount,
		 beforeSend: function(objeto){
			$("#resultados").html("Message: Loading...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
                


		$(document).ready(function(){
			load(1);
			$( "#resultados" ).load( "ajax/editer_billing.php" );
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/products_bill.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	function agregar (id)
		{
               
                  var name_product=document.getElementById('name_'+id).value;
                    //alert(name_product);   
                 var description_product=document.getElementById('description_'+id).value;
	
            var sale_price=document.getElementById('sale_price_'+id).value;
            	
	var quantity=document.getElementById('quantity_'+id).value;
                        
			//Inicia validacion
			if (isNaN(quantity))
			{
			alert('This is not a number');
			document.getElementById('quantity_'+id).focus();
			return false;
			}
			if (isNaN(sale_price))
			{
			alert('This is not a number');
			document.getElementById('sale_price_'+id).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/editer_billing.php",
        data: "id="+id+"&sale_price="+sale_price+"&quantity="+quantity+"&name_product="+name_product+"&description_product="+description_product,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Loading...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
              
                		function editbill (id)
		{
                    
var name=document.getElementById("name"+id).innerHTML;

 document.getElementById("name"+id).innerHTML="<input type='text' id='name_"+id+"' value='"+name+"'>";



var description=document.getElementById("description"+id).innerHTML;

 
 document.getElementById("description"+id).innerHTML="<input type='text' id='description_"+id+"' value='"+description+"'>";


var quantity=document.getElementById("quantity"+id).innerHTML;

 document.getElementById("quantity"+id).innerHTML="<input type='text' id='quantity_"+id+"' value='"+quantity+"'>";


var sale_price=document.getElementById("sale_price"+id).innerHTML;

 document.getElementById("sale_price"+id).innerHTML="<input type='text' id='sale_price_"+id+"' value='"+sale_price+"'>";


var sale_price_total=document.getElementById("sale_price_total"+id).innerHTML;



 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_bill"+id).style.display="block";

		}
                
         function save_bill (id)
		{
                 var sale_price_total=document.getElementById("sale_price_total"+id).innerHTML;

                  var name_product=document.getElementById('name_'+id).value;
                   
                 var description_product=document.getElementById('description_'+id).value;
	
            var sale_price=document.getElementById('sale_price_'+id).value;
          	
                
                
	var quantity=document.getElementById('quantity_'+id).value;
                        
		
			
			$.ajax({
        type: "POST",
        url: "./ajax/save_billing.php",
        data: "id="+id+"&sale_price="+sale_price+"&quantity="+quantity+"&name_product="+name_product+"&description_product="+description_product+"&sale_price_total="+sale_price_total,
	
        success: function(response){
         setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
      }, 0005); 
    if(response ="sucess") {
    document.getElementById("sale_price"+id).innerHTML=sale_price;
    document.getElementById("quantity"+id).innerHTML=quantity;
    document.getElementById("sale_price_total"+id).innerHTML=sale_price_total;
    document.getElementById("name"+id).innerHTML=name_product;
    document.getElementById("description"+id).innerHTML=description_product;
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_bill"+id).style.display="none";

    }
		}
			});
		}
               	
                    
          	
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/editer_billing.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Message: Loading...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
                
                
		
		$("#datos_factura").submit(function(event){
		  var id_client = $("#id_client").val();
	
		  if (id_client==""){
			  alert("You must select a client");
			  $("#name_client").focus();
			  return false;
		  }
			var parametros = $(this).serialize();
                        //alert(parametros);
			 $.ajax({
					type: "POST",
					url: "ajax/editer_bill.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".editar_factura").html("Message: Loading...");
					  },
					success: function(datos){
						$(".editar_factura").html(datos);
					}
			});
			
			 event.preventDefault();
	 	});
		
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
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/new_product.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Message:Loading...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})

		function Print_invoice(id_bill){
                    
                    $( "#add_bill_btn" ).trigger( "click" );
                    //$("#bt1").click();
			VentanaCentrada('./pdf/document/view_bill.php?id_bill='+id_bill,'','1024','768','true');
                     
		}