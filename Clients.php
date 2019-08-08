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
$active_products="";
$active_client="active";
$active_users="";	
$title="Client | virran Invoice";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php");?>
</head>
<body>
<main class="app-content">
    <div class="col-sm-12">
    <div class="row" >
    <div class="tile" style="margin-left: -56px; margin-right: -61px; bottom: -15px;">
        <div class="tile-body">
         <h4 style="float:left;font-size: 24px;"></i><label class="control-label" style="margin-left: 15px;">Clients</label></h4><br>
        <div class="btn-group pull-right" style="bottom: -18px;margin-right: 12px;">
        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoCliente" style="padding: 7px 12px;margin-top: -25px;"><span class="glyphicon glyphicon-plus" ></span> New Client</button>
        </div>
        <br>
        <!--	<h4><i class='glyphicon glyphicon-search'></i> search Client</h4>-->
        </div>
    <div class="panel-body">
    <?php
    include("modal/register_clients.php");
    include("modal/editer_clients.php");
    ?>
    <form class="form-horizontal" role="form" id="datos_cotizacion">

            <div class="form-group row">
            <!--<label for="q" class="col-md-2 control-label">Client</label>-->
            <div class="col-md-5">
                <input type="text" class="form-control" id="q" placeholder="Client name" onkeyup='load(1);' style="width: 55%; margin-left: -19px;">
            </div>
            <!--<div class="col-md-3">
                <button type="button" class="btn btn-danger" onclick='load(1);'>
                        <span class="glyphicon glyphicon-search" ></span> search</button>
                <span id="loader"></span>
            </div>-->
            </div>
    </form>
        <div id="resultados"></div>
        <div class='outer_div'></div>
    </div>
    </div>
    </div>
    </div>
</main>
<hr>
<?php
include("footer.php");
?>

<script type="text/javascript" src="js/clients.js"></script>
</body>
</html>
<script>
        $(document).ready(function(){
            $(".clientactive").addClass('active');
        });
    </script>
    
    
    
    
    
    <script>
    $(document).ready(function(){
        //alert("hai");
        $("#purpose").trigger("change");
    });

    $('#purpose').on('change', function() {
    
    //alert('red');
    
      if ( this.value == '1')
      //.....................^.......
      {
           $("#igsts").hide();
        $("#csgsts").show();
      }
      else  if ( this.value == '2')
      {
          $("#csgsts").hide();
        $("#igsts").show();
      }
       else  
      {
        $("#csgsts").hide();
         $("#igsts").hide();
      }
    });
    </script>
    
    
    <script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>












<script>
    
$(document).ready(function(){

$("#mod_status").trigger("change");
});

$('#mod_status').on('change', function() {
    //alert(this.value);
      if ( this.value == '1')
      //.....................^.......
      {
          
        $("#igsts1").hide();
        $("#csgsts1").show();
      }
      else  if ( this.value == '2')
      {
          $("#csgsts1").hide();
        $("#igsts1").show();
      }
       else  
      {
        $("#csgsts1").hide();
         $("#igsts1").hide();
      }
    });
    </script>