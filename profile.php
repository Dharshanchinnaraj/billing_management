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


/* Connect To Database*/
require_once ("config/db.php");
require_once ("config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$active_invoices="";
$active_products="";
$active_client="";
$active_users="";
$active_profile="active";
$title="Configuration | Virran Invoice";

$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
if(!$row){
  }
$product_type=$row["product_type"];
$status=$row["status"];
?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php");
?>



<main class="app-content">
<form method="post" id="profile" style="margin-left: -30px; margin-right: -40px;">
<div class="tile" style="bottom: -15px;">
<div class="tile-body">
    <h4 style="float:left;font-size: 24px;"><label class="control-label" style="margin-left: 12px;">Configuration</label></h4><br>
<!--    <h4 class="panel-title" style="float:left;"><i class='glyphicon glyphicon-cog'></i>Configuration</h4>-->
     <div class='col-md-12' id="resultados_ajax"></div>
</div>
<div class="panel-body" style=" margin-right: -40px; margin-left: -30px;">
<div class="row">
<div class="form-group col-md-3">
    <label class="control-label">Company name:</label>
    <input class="form-control txtOnlywithspace" type="text" name="company_name" value="<?php echo $row['company_name']?>" required>
</div>

<div class="form-group col-md-3">
    <label class="control-label">Email</label>
    <input class="form-control" type="email"  name="email" value="<?php echo $row['email']?>" >
</div>

<div class="form-group col-md-3">
    <label class="control-label">Phone</label>
    <input class="form-control"  type="text" name="phone" value="<?php echo $row['phone']?>" required>
</div>


<div class="form-group col-md-3">
<label class="control-label">Currency symbol</label>
        <select class='form-control' name="currency" required>
        <?php

                $sql="select name, symbol from `{$portal_name}_currencies` group by symbol order by name ";
                $query=mysqli_query($con,$sql);
                while($rw=mysqli_fetch_array($query)){
                        $simbolo=$rw['symbol'];
                        $currency=$rw['name'];
                        if ($row['currency']==$simbolo){
                                $selected="selected";
                        } else {
                                $selected="";
                        }
                        ?>
                        <option value="<?php echo $simbolo;?>" <?php echo $selected;?>><?php echo ($simbolo);?></option>
                        <?php
                }
        ?>
        </select>
</div>
</div>
<div class="row">
    <div class="form-group col-md-3">
        <label class="control-label">Address</label>
        <input class="form-control"  type="text" name="address" value="<?php echo $row["address"];?>" required>
    </div>

    <div class="form-group col-md-3">
        <label class="control-label">City</label>
        <input class="form-control"  type="text" name="city" value="<?php echo $row["city"];?>" required>
    </div>

    <div class="form-group col-md-3">
        <label class="control-label">Region / Province</label>
        <input class="form-control"  type="text" name="state" value="<?php echo $row["state"];?>" required>
    </div>

    <div class="form-group col-md-3">
        <label class="control-label">Postal Code</label>
        <input class="form-control"  type="text" name="postal_code" value="<?php echo $row["postal_code"];?>" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3">
        <label class="control-label">GST Number</label>
        <input class="form-control"  type="text" name="gst_no" value="<?php echo $row["gst_no"];?>" required>
    </div>
     <div class="form-group col-md-3">
        <label class="control-label">Pan Number</label>
        <input class="form-control" type="text" name="pan_number" value="<?php echo $row["pan_number"];?>" required>
    </div>
    <div class="form-group col-md-3">
        <label class="control-label">Product Type</label>
        <select id="" class='form-control' name="product_type">  
            <option value="1" <?=$product_type == '1' ? ' selected="selected"' : '';?>>Goods</option>
            <option value="2" <?=$product_type == '2' ? ' selected="selected"' : '';?>>Service</option>
            <option value="3" <?=$product_type == '3' ? ' selected="selected"' : '';?>>Rental</option>
            <option value="4" <?=$product_type == '4' ? ' selected="selected"' : '';?>>Contract</option>
        </select>
    </div>
    
         <div class="form-group col-md-3">
        <label class="control-label">Enter Prefix</label>
        <input class="form-control"  type="text" name="client_prefix" value="<?php echo $row["client_prefix"];?>" required>
    </div>
 
    </div>

    <div class="row">
      <div class="form-group col-md-3" >
     <label class="control-label">Bank Details</label>
     <textarea id="subject" class="form-control" name="bank_details" placeholder="Write something.."  ><?php echo $row['bank_details']?></textarea>
     </div> 
     
      
       <div class="form-group col-md-3">
     <label class="control-label">Terms & Condition</label>
     <textarea id="subject" class="form-control" name="subject" placeholder="Write something.."  ><?php echo $row['subject']?></textarea>
     </div>
     
      <div class="form-group col-md-3">
           <label class="control-label">Logo</label>
        <br>
    <div class="form-group">
        <input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
    </div>
    <div id="load_img">
    <img class="img-responsive" src="<?php echo $row['logo_url'];?>" alt="Logo" >
    </div>
    </div> 
             <div class="form-group col-md-3">
        <label class="control-label">GST Type</label>
        <br>
         <label class="radio-inline">
         <input type="radio" name="gst_type" value="0"<?php if ($row['gst_type'] == '0') echo 'checked="checked"'; ?>>Yes
    
         </label>
    <label class="radio-inline">
    
        <input type="radio" name="gst_type" value="1"<?php if ($row['gst_type'] == '1') echo 'checked="checked"'; ?>>No
    
    </label>
        
             </div>
 
     
    </div>
    <div class="row">
    <div class="form-group col-md-9"></div>
     <div class="form-group col-md-3">
     <button type="submit" class="btn btn-sm btn-danger" style="border: 1px solid white;width:100%"><i class="glyphicon glyphicon-refresh"></i> Update</button>
    </div>
     </div>
   
   
   
   
    </div>
    </div>
     </form>
</main>

<?php
include("footer.php");
?>


<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
$(document).ready(function(){
        //alert("hai");
        $("#purpose").trigger("change");
});

$('#purpose').on('change', function() {
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
<script>
$( "#profile" ).submit(function( event ) {
$('.guardar_datos').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "ajax/editer_profile.php",
data: parametros,
beforeSend: function(objeto){

},
success: function(datos){
$("#resultados_ajax").html(datos);
$('.guardar_datos').attr("disabled", false);

}
});
event.preventDefault();
})

</script>

<script>
function upload_image(){
//alert('hai');
var inputFileImage = document.getElementById("imagefile");

//alert(inputFileImage);
var file = inputFileImage.files[0];
if( (typeof file === "object") && (file !== null) )
{
$("#load_img").text('Loading...');
var data = new FormData();
data.append('imagefile',file);
$.ajax({
url: "ajax/image_ajax.php",        // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: data,  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
        $("#load_img").html(data);
}
});
}

}
</script>
 </body>
 <script>
        $(document).ready(function(){
            $(".settingactive").addClass('active');
        });
    </script>