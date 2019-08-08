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


    $active_invoices="active";
    $active_products="";
    $active_client="";
    $active_users="";	
    $title="New bill| Virran Invoice";
    /* Connect To Database*/
    require_once ("config/db.php");
    require_once ("config/Connection.php");
    $portal_name =  $_SESSION['portal_name'];
    $session_id= session_id();
    
    ?>
    <?php
    ///////////////////  Naveen //////////////       
    $query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
    $row=mysqli_fetch_array($query_empresa);
    $product_type=$row["product_type"];
    //echo $product_type;
    /////////////////////////END///////////// 
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <?php include("head.php");?>
    </head>
    <main class="app-content">
    <div class="col-sm-12">
    <div class="row" >
    <div class="tile" style="margin-left: -45px; margin-right: -45px;bottom: -15px;">
    <div class="tile-body">
    <h4><i class='glyphicon glyphicon-edit'></i><b> New Invoice</b></h4>
    </div>
    <div class="panel-body">
    <?php 
    include("modal/search_products.php");
    include("modal/register_clients.php");
    include("modal/register_products.php");
    ?>
    <form class="form-horizontal" role="form" id="datos_factura">

    <div class="form-group row">
    <div class="col-md-3">
    <label for="name_client" class="control-label">Client</label>
    <input type="text" class="form-control" onclick="document.getElementById('enable_print').disabled=false" id="name_client" placeholder="Select a customer" required>
    <input id="id_client" type='hidden'>	
    </div>


    <div class="col-md-3">
    <label for="tel1" class="control-label">Phone</label>
    <input type="text" class="form-control" id="tel1" placeholder="Phone" readonly>
    </div>

    <div class="col-md-3">
    <label for="mail" class="control-label">Email</label>
    <input type="text" class="form-control" id="mail" placeholder="Email" readonly>
    </div>



    <div class="col-md-3" style="display:none">
    <label for="company" class="control-label">Salesman</label>
    <select class="form-control" id="id_salesman">
    <?php
    $sql_salesman=mysqli_query($con,"select * from `{$portal_name}_users` order by lastname");
    while ($rw=mysqli_fetch_array($sql_salesman)){
    $id_salesman=$rw["user_id"];
    $name_salesman=$rw["firstname"]." ".$rw["lastname"];
    if ($id_vendedor==$_SESSION['user_id']){
    $selected="selected";
    } else {
    $selected="";
    }
    ?>
    <option value="<?php echo $id_salesman?>" <?php echo $selected;?>><?php echo $name_salesman?></option>
    <?php
    }
    ?>
    </select>
    </div>

    <div class="col-md-3">
    <label for="tel2" class="control-label">Invoice Date</label>
    <input type="hidden" class="form-control" name="goods_service_id" id="goods_service_id" value="<?php echo $product_type;?>">
    <input type="date" style="padding: 0px 8px;  text-transform: uppercase;" class="form-control" id="fecha" value="" >
    </div>
    </div>
    <div class="form-group row">  
    <div class="col-md-3">
    <label for="email" class="control-label">Payment</label>
    <select class='form-control' id="terms" onchange="TermsFunction();" name="terms">
    <option value="1">Cash</option>
    <option value="2">Cheque</option>
    <option value="3">Wire transfer</option>
    <option value="4">Credit</option>
    </select>
    </div>
    <div class="col-md-3"style="display: none;" id="terms_bank_input">
    <label for="mail" class="control-label">Bank Details</label>
    <input type="text" class="form-control" name="bank_details" id="bank_details" >
    </div>

    <div class="col-md-3">
    <label for="email" class="control-label">Payment Method</label>
    <select class='form-control' id="state_bill" name="state_bill">
    <option class="reds" value="1">Paid out</option>
    <option class="reds" value="2">Pending</option>
    </select>
    </div> 

    <div class="col-md-3">
    <label for="mail" class="control-label">Invoice number (If you need *)</label>
    <input type="text" class="form-control" id="invoice_nos" placeholder="invoice no." >
    <input type="hidden" class="form-control" value="0" id="save_inv">
    <input type="hidden" class="form-control"  id="status1">
    <input type="hidden" class="form-control"  id="tax1">
    <input type="hidden" class="form-control"  id="cgst1">
    <input type="hidden" class="form-control"  id="igst1">
    <input type="hidden" class="form-control" value="<?php echo $session_id; ?>" id="session_ids">
   
    </div>
  <div class="col-md-3">
    <label for="mail" class="control-label">Po/so number (If you need *)</label>
    <input type="text" class="form-control" id="po_nos" placeholder="po/so no." >
  </div>
            <div class="col-md-3">
    <label for="tel2" class="control-label">Invoice Due Date</label>
    <input type="date" class="form-control" style="padding: 0px 8px;  text-transform: uppercase;" id="d_date" value="" >
    </div>
    </div>
    </div>
    </div>
    <div class="col-md-12">
    <div class="pull-right" style="margin-right: 78px;">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#nuevoProducto">
    <span class="glyphicon glyphicon-plus"></span>New product
    </button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#nuevoCliente">
    <span class="glyphicon glyphicon-user"></span> New Client
    </button>

    <input type="hidden" value="1" id="delete_temps" >
    <button type="button" id="enable_print" class="btn btn-danger" onclick="delete_temp_folder()" data-toggle="modal" data-target="#myModal" disabled>
    <span class="glyphicon glyphicon-search"></span> Add products
    </button>

    <button style="display:none" id="btn4"  class="btn btn-danger">Prinast</button>
    <button style="display:none" class="btn btn-danger"  id='two'>Save</button>


    </div>	
    </div>
    </form>	
    <button id="button1"  class="btn btn-danger" disabled style="float: right;margin: -30px -20px;"><span class="glyphicon glyphicon-print"></span> Print</button>

    <button id="save_pro"  onclick="change()" class="btn btn-danger" style="float: right;margin: -30px 45px;"><span class="glyphicon glyphicon-print"></span> Save </button>

    <div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
    </div>
    </div>		
    <div class="row-fluid">
    <div class="col-md-12">
    </div>	
    </div>
    </main>
    <hr>
    <?php
    include("footer.php");
    ?>
    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <script type="text/javascript" src="js/new_bill.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
    $('#save_pro').click(function(){
    $('#save_inv').val('1');
    $('#total').text('Product price: $1000');
    });


    function add(id)
    {

    var advance=$('#advance_'+id).val();
    var discount=$('#discount_'+id).val();

    //            alert(advance);
    //            alert(discount);


    if (isNaN(advance))
    {
    alert('This is not a number');
    document.getElementById('advance_'+id).focus();
    return false;
    }


    //Final validacion

    $.ajax({



    type: "POST",
    url: "./ajax/add_billing.php",
    data: "id="+id+"&advance="+advance+"&discount="+discount,
    beforeSend: function(objeto){
    $("#resultados").html("Message: Loading...");
    },
    success: function(response){
    $("#resultados").html(response);

    //alert('reds');
    $("#btn4").click();
    }
    });
    }



    function red(id)
    {

    var advance=$('#advance_'+id).val();
    var discount=$('#discount_'+id).val();

    //            alert(advance);
    //            alert(discount);
    if (isNaN(advance))
    {
    alert('This is not a number');
    document.getElementById('advance_'+id).focus();
    return false;
    }
    $.ajax({               
    type: "POST",
    url: "./ajax/add_billing.php",
    data: "id="+id+"&advance="+advance+"&discount="+discount,
    beforeSend: function(objeto){
    $("#resultados").html("Message: Loading...");
    },
    success: function(response){
    $("#resultados").html(response);

    $("#two").click();
    }
    });
    }




    function delete_temp_folder(){
    var delete_temps = $('#delete_temps').val();
    //alert(delete_temps);
    $.ajax({
    url:"ajax/delete_temp.php",
    type: 'POST',
    data: {delete_temps:delete_temps},
    dataType: "json",
    datatype: 'json',
    async: false,
    success: function (response) {

    alert("hiiiiiiiiiii");
    }
    });  

    }  

    $(document).on('click', '#button1', function() {
    $("#bt1").click();
    });


    $(document).on('click', '#save_pro', function() {
    $("#bt9").click();
    });

    $(function() {
    $("#name_client").autocomplete({
    source: "./ajax/autocomplete/clients.php",
    minLength: 1,
    select: function(event, ui) {
    event.preventDefault();
    $('#id_client').val(ui.item.id_client);
    $('#name_client').val(ui.item.name_client);
    $('#tel1').val(ui.item.phone_client);
    $('#mail').val(ui.item.email_client);
    $('#status1').val(ui.item.status1);
    $('#tax1').val(ui.item.tax);
    $('#cgst1').val(ui.item.cgst);
    $('#igst1').val(ui.item.igst);
    //alert(ui.item.status1);

    }
    });


    });

    $("#name_client" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
    {
    $("#id_client" ).val("");
    $("#tel1" ).val("");
    $("#mail" ).val("");

    }
    if (event.keyCode==$.ui.keyCode.DELETE){
    $("#name_client" ).val("");
    $("#id_client" ).val("");
    $("#tel1" ).val("");
    $("#mail" ).val("");
    }
    });	

    function getvalue(val)

    {
    var advance=document.getElementById('advance_'+id).value;
    var discount=document.getElementById('discount_'+id).value;

    //            alert(advance);
    //            alert(discount);

    if (isNaN(advance))
    {
    alert('This is not a number');
    document.getElementById('advance_'+id).focus();
    return false;
    }

    //Final validacion

    $.ajax({


    type: "POST",
    url: "./ajax/add_billing.php",
    data: "id="+id+"&advance="+advance+"&discount="+discount,
    beforeSend: function(objeto){
    $("#resultados").html("Message: Loading...");
    },
    success: function(datos){
    $("#resultados").html(datos);
    }
    });
    }

    function SwitchButtons(){

    } 

////////////////////////////////////////////////////////////////////////////////

    $(document).on('click', '#enable_print', function() {
    document.getElementById("button1").disabled = false;
    passgsttype_to_billing();
    });


    function passgsttype_to_billing(){
    var status=$('#status1').val();
    var tax=$('#tax1').val();
    var cgst=$('#cgst1').val();
    var igst=$('#igst1').val();
    var session_ids=$('#session_ids').val();
    
    $.ajax({               
    type: "POST",
    url: "./ajax/gst.php",
    data:"tax="+tax+"&cgst="+cgst+"&igst="+igst+"&status="+status+"&session_ids="+session_ids,
    datatype: 'json',
    async: false,

    beforeSend: function(){
    },
    success: function(response){

    }
    });
    }


    ////////////////////////////////////////////////////////////////////////////////


    function TermsFunction(){
    var terms_val = $("#terms").val();

    if(terms_val != 2){
    $('#terms_bank_input').hide();

    $('#bank_details').removeAttr('name');

    }else{
    $('#terms_bank_input').show(); 
    $('#bank_details').attr('name', 'bank_details');
    }

    }
    </script>





    <script>
    $(document).ready(function(){
    $(".invoiceactive").addClass('active');
    });
    </script>





