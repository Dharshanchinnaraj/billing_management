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
$title="Editer invoice | virran Invoice";

    /* Connect To Database*/
    require_once ("config/db.php");
    require_once ("config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
    if (isset($_GET['id_bill']))
    {
    $id_bill=intval($_GET['id_bill']);
    $campos="`{$portal_name}_client`.id_client, `{$portal_name}_client`.name_client, `{$portal_name}_client`.phone_client, `{$portal_name}_client`.email_client, `{$portal_name}_invoices`.id_salesman, `{$portal_name}_invoices`.date_bill, `{$portal_name}_invoices`.terms, `{$portal_name}_invoices`.state_bill, `{$portal_name}_invoices`.number_bill,`{$portal_name}_invoices`.bank_details,`{$portal_name}_invoices`.invoice_nos,`{$portal_name}_invoices`.po_no,`{$portal_name}_invoices`.due_date";
    $sql_bill=mysqli_query($con,"select $campos from `{$portal_name}_invoices`, `{$portal_name}_client` where `{$portal_name}_invoices`.id_client=`{$portal_name}_client`.id_client and id_bill='".$id_bill."'");
    $count=mysqli_num_rows($sql_bill);
    if ($count==1)
    {
    $rw_bill=mysqli_fetch_array($sql_bill);
    $id_client=$rw_bill['id_client'];
    $name_client=$rw_bill['name_client'];
    $phone_client=$rw_bill['phone_client'];
    $email_client=$rw_bill['email_client'];
    $id_salesman_db=$rw_bill['id_salesman'];
    $date_bill=$rw_bill['date_bill'];
    
  //  echo $date_bill;die();
    $terms=$rw_bill['terms'];
    $state_bill=$rw_bill['state_bill'];
    $bank_details=$rw_bill['bank_details'];
    $number_bill=$rw_bill['number_bill'];
    $invoice_nos=$rw_bill['invoice_nos'];
     $po_nos=$rw_bill['po_no'];
      $due_date=$rw_bill['due_date'];
    $_SESSION['id_bill']=$id_bill;
    $_SESSION['number_bill']=$number_bill;
    }	
    else
    {
    header("location: invoice.php");
    exit;	
    }
    } 
    else 
    {
    header("location: invoice.php");
    exit;
    }
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
    <body>
    <main class="app-content">
    <div class="col-sm-12">
        <div class="tile" style="margin-left: -45px; margin-right: -45px;bottom: -15px;">
    <div class="tile-body">
    <div class="row">
    <h4><i class='glyphicon glyphicon-edit'></i> edit Invoice</h4>
    </div>
    <div class="panel-body">
        <?php 
        include("modal/search_products.php");
        include("modal/register_clients.php");
        include("modal/register_products.php");
        ?>
    <form class="form-horizontal " role="form" id="datos_factura">
    <div>
    <div class="form-group row">
    <div class="col-md-3">
       <label for="nombre_cliente" class="control-label">Client</label>
    <input type="text" class="form-control"  id="name_client" placeholder="client" value="<?php echo $name_client;?>" <?php if($_GET['id_bill']) { ?> disabled <?php }else{?>  <?php } ?>>
    <input id="id_client" name="id_client" type='hidden' value="<?php echo $id_client;?>">	
    </div>
    <div class="col-md-3">
        <label for="tel1" class="control-label">Phone</label>
    <input type="text" class="form-control" id="tel1" placeholder="Phone" value="<?php echo $phone_client;?>" readonly>
    </div>
    <div class="col-md-3">
        <label for="mail" class="control-label">Email</label>
    <input type="text" class="form-control" id="mail" placeholder="Email" readonly value="<?php echo $email_client;?>">
    </div>
    <div class="col-md-3" style="display:none">
        <label for="empresa" class="control-label">Salesman</label>
        <select class="form-control" id="id_salesman" name="id_salesman" readonly>
    <?php
    $sql_vendedor=mysqli_query($con,"select * from `{$portal_name}_users` order by lastname");
    while ($rw=mysqli_fetch_array($sql_vendedor)){
    $id_salesman=$rw["user_id"];
    $name_salesman=$rw["firstname"]." ".$rw["lastname"];
    if ($id_salesman==$id_salesman_db){
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
        <input type="date" class="form-control" id="date_bill" name="date_bill" style="padding: 0px 8px;  text-transform: uppercase;" value="<?php echo $date_bill;?>"  >
        <input type="hidden" class="form-control" name="goods_service_id" id="goods_service_id" value="<?php echo $product_type;?>">
    </div>
    </div>
    <div class="form-group row">
    <div class="col-md-3">
        <label for="email" class="control-label">Payment</label>
        <select class='form-control input-sm ' id="terms" onchange="TermsFunction();" name="terms">
        <option class="reds" value="1" <?php if ($terms==1){echo "selected";}?>>Cash</option>
        <option class="reds" value="2" <?php if ($terms==2){echo "selected";}?>>Cheque</option>
        <option class="reds" value="3" <?php if ($terms==3){echo "selected";}?>>Wire transfer</option>
        <option class="reds" value="4" <?php if ($terms==4){echo "selected";}?>>Credit</option>
    </select>
    </div>
        <div class="col-md-3" style="display: none;" id="terms_bank_input">
    <label for="tel2" class="control-label">Bank Details</label>
     <?php //if($terms==1 || $terms==3|| $terms==4){ ?>  <?php // } ?>
    <input type="text" class="form-control" name="bank_details" id="bank_details" value="<?php echo $bank_details;?>">
    </div>
    <div class="col-md-3">
    <label for="email" class="control-label">Payment Method</label>
        <select class='form-control' id="state_bill" name="state_bill">
            <option class="reds" value="1" <?php if ($state_bill==1){echo "selected";}?>>Paid out</option>
            <option class="reds" value="2" <?php if ($state_bill==2){echo "selected";}?>>Pending</option>
        </select>
    </div>
    
       <div class="col-md-3">
        <label for="mail" class="control-label">Invoice number</label>
        <input type="text" class="form-control" id="invoice_nos" name="invoice_nos" placeholder="invoice_nos" value="<?php echo $invoice_nos;?>">
    </div>
    
      <div class="col-md-3">
    <label for="mail" class="control-label">Po/so number (If you need *)</label>
    <input type="text" class="form-control" id="po_nos" name="po_nos"  placeholder="po/so no." value="<?php echo $po_nos;?>">
  </div>
            <div class="col-md-3">
    <label for="tel2" class="control-label">Invoice Due Date</label>
    <input type="date" style="padding: 0px 8px;  text-transform: uppercase;" class="form-control" id="d_date"  name="d_date"   value="<?php echo $due_date;?>">
    </div>    
        
    </div>
    </div>
        
    <div class="col-md-12">
    <div class="pull-right">
    <button type="submit" id="update_data_submit" class="btn btn-danger">
        <span class="glyphicon glyphicon-refresh set_action"></span> Update data
    </button>
        
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#nuevoProducto">
        <span class="glyphicon glyphicon-plus"></span> New product
    </button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#nuevoCliente">
        <span class="glyphicon glyphicon-user"></span> New client
    </button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
        <span class="glyphicon glyphicon-search"></span> Add products
    </button>
    <button type="button" id="button1" class="btn btn-danger fansed" onclick="">
        <span class="glyphicon glyphicon-print"></span> To print
    </button>
    </div>	
    </div>
    </form>	
    <div class="editar_factura" class='col-md-12' style="margin-top:33px"></div>	
    <div id="resultados" class='col-md-12' style="margin-top:10px">
        
      
    </div>			
    </div>
    </div>
       </div> 
        </div>
    </main>
    <hr>
    <?php
    include("footer.php");
    ?>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/editer_bill.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
  <script type="text/javascript">
        $("#button1").click(function () {
          $( "#add_bill_btn" ).trigger( "click" );
          alert('Edit Invoice Successfully');
          Print_invoice('<?php echo $id_bill;?>');
        });
</script>


<script>


   // $(document).on('click', '#button1', function() {
        //alert('sassasas');
         // $( "#add_bill_btn" ).trigger( "click" );
         // alert('Edit Invoice Successfully');
         // Print_invoice('<?php echo $id_bill;?>')
        
   // });


$(function() { 
$("#terms").trigger('change')
$("#name_client").autocomplete({
source: "./ajax/autocomplete/clients.php",
minLength: 2,
select: function(event, ui) {
event.preventDefault();
$('#id_client').val(ui.item.id_client);
$('#name_client').val(ui.item.name_client);
$('#tel1').val(ui.item.phone_client);
$('#mail').val(ui.item.email_client);

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

function enableButton2() {
//alert("hiiii");
document.getElementById("button1").disabled = false;
}

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



$(document).ready(function(){
  $(".reds").click(function(){
  $("#button1").prop('disabled', true);
   $(".set_action").css("color","#fff");
  });
  $("#update_data_submit").click(function(){
      $(".fansed").prop('disabled', false);
       $(".set_action").css("color","#fff");
     
  });
});


  <script>
    $(document).ready(function(){
    $(".editer_invoiceactive").addClass('active');
    });
    </script>

</script>
</body>
</html>





