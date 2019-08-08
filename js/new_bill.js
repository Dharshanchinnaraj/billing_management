
		$(document).ready(function(){
			load(1);
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
                   
		    var invoice_nos = $('#invoice_nos').val();
           var po_nos = $('#po_nos').val();
       var d_date = $('#d_date').val();
	
	var sale_price=document.getElementById('sale_price_'+id).value;
	
           var quantity=document.getElementById('quantity_'+id).value;
           
            var name=document.getElementById('name_'+id).value;
                     
            var description=document.getElementById('description_'+id).value;
      
			//starts validacion
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
                        
			//Final validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/add_billing.php",
        data: "id="+id+"&sale_price="+sale_price+"&quantity="+quantity+"&invoice_nos="+invoice_nos+"&po_nos="+po_nos+"&d_date="+d_date+"&name="+name+"&description="+description,
         beforeSend: function(objeto){
			$("#resultados").html("Message: Loading...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
                
              

         
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/add_billing.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Message: Loading...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
                
                
                
                
		
		$("#datos_factura").submit(function(){
		  //  alert('susscc');
		  var id_client = $("#id_client").val();
		  var id_salesman = $("#id_salesman").val();
		  var terms = $("#terms").val();
                   var bank_details = $("#bank_details").val();
                   var goods_service_id = $("#goods_service_id").val();
                    var state_bill = $("#state_bill").val();
                    var save_inv = $("#save_inv").val();
                    var status = $("#status1").val();
                      var tax = $("#tax1").val();
                        var cgst = $("#cgst1").val();
                          var igst = $("#igst1").val();
                           var bill_date = $("#fecha").val();
                   // alert(save_inv);
                    
		  //alert(bank_details);
		  if (id_client==""){
			  alert("You must select a client");
			  $("#name_client").focus();
			  return false;
		  }
                  
           if(save_inv==1){
              
		 VentanaCentrada1('./pdf/document/bill_pdf.php?id_client='+id_client+'&id_salesman='+id_salesman+'&terms='+terms+'&bank_details='+bank_details+'&state_bill='+state_bill+'&goods_service_id='+goods_service_id+'&tax='+tax+'&cgst='+cgst+'&igst='+igst+'&status='+status+'&bill_date='+bill_date,'Bill','','1024','768','true');
           } else if(save_inv==0){
               
        VentanaCentrada('./pdf/document/bill_pdf.php?id_client='+id_client+'&id_salesman='+id_salesman+'&terms='+terms+'&bank_details='+bank_details+'&state_bill='+state_bill+'&goods_service_id='+goods_service_id+'&tax='+tax+'&cgst='+cgst+'&igst='+igst+'&status='+status+'&bill_date='+bill_date,'Bill','','1024','768','true');
           }
	 
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

                  //With a function, I am able to perform multiple tasks 
function SwitchButtons(buttonId) {
  var hideBtn, showBtn, menuToggle;
  if (buttonId == 'button1') {
    menuToggle = 'menu2';
    showBtn = 'button2';
    hideBtn = 'button1';
  } else {
    menuToggle = 'menu3';
    showBtn = 'button1';
    hideBtn = 'button2';
  }
  //I don't have your menus, so this is commented out.  just uncomment for your usage
  // document.getElementById(menuToggle).toggle(); //step 1: toggle menu
  document.getElementById(hideBtn).style.display = 'none'; //step 2 :additional feature hide button
  document.getElementById(showBtn).style.display = ''; //step 3:additional feature show button


}



