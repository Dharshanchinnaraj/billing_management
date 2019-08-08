<?php 
/* Author  :   BARATHI/KARPAGAM /03-07-2019  */


if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['advance'])){$advance=$_POST['advance'];}
if (isset($_POST['discount'])){$discount=$_POST['discount'];}
if (isset($_POST['quantity'])){$quantity=$_POST['quantity'];}
if (isset($_POST['sale_price'])){$sale_price=$_POST['sale_price'];}
if (isset($_POST['invoice_nos'])){
   $invoice_nos=$_POST['invoice_nos'];
    
}
if (isset($_POST['d_date'])){
   $d_date=$_POST['d_date'];
    
}
if (isset($_POST['name'])){
   $name=$_POST['name'];
    
}
if (isset($_POST['description'])){
   $description=$_POST['description'];
    
}

if (isset($_POST['po_nos'])){
   $po_nos=$_POST['po_nos'];
    
}

/* Connect To Database*/
require_once ("../config/db.php");
require_once ("../config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$session_id= session_id();
include("../funcions.php");

if(!empty($_POST['advance'])  OR (!empty($_POST['discount']))){
    $update=mysqli_query($con,"update `{$portal_name}_tmp` set advance_tmp='$advance',discount_tmp='$discount'  where session_id='$session_id'"); 

if ($update == 1)
{
$response[] = array("report"=>200);
} else
{
$response[] = array("report"=>400);
}
 json_encode($response);   

 }

    
    if (isset($_GET['id']))
    {
    $id_tmp=intval($_GET['id']);	
    $delete=mysqli_query($con, "DELETE FROM `{$portal_name}_tmp` WHERE id_tmp='".$id_tmp."'");
    }
    $simbolo_moneda=get_row("`{$portal_name}_profile`",'currency', 'id_profile', 1);

    if(isset($id)){
    $id=$id;
    }else{
    $id = 0;
    }

    if(isset($quantity)){
    $quantity=$quantity;
    }else{
    $quantity = 0;
    }

$check="SELECT * FROM `{$portal_name}_tmp` WHERE id_product = '$id' AND quantity_tmp = '$quantity'" ;
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);

    if($data[0] > 1) {

    ?>
<script>


$('#Error_Msg').text("PLEASE CHANGE THE COUNT");

$('.alert').addClass("alert-danger");


</script>
<script>
$('.alert').removeClass("alert-success");
$('#Sucess_Msg').text("")
</script>
    <?php
    }
    else if((!empty($id) and !empty($quantity)  and !empty($sale_price))) 
    {
    $check1="DELETE FROM `{$portal_name}_tmp` WHERE id_product ='$id'"; 
    $insert_tmp="INSERT INTO `{$portal_name}_tmp` (id_product,quantity_tmp,price_tmp,session_id,invoice_nos,po_no,due_date ,name_product,description_product ) VALUES ('$id','$quantity','$sale_price','$session_id','$invoice_nos','$po_nos','$d_date','$name','$description')";
    if (mysqli_query($con,$check1))
    {
    if (mysqli_query($con,$insert_tmp))
    {
    $messages[] = "Product has been entered successfully.";
    ?>
<script>
$('.alert').removeClass("alert-danger");
$('#Error_Msg').text("")
</script>
<script>

$('#Sucess_Msg').text("Product has been entered successfully");

$('.alert').addClass("alert-success");

</script>
    <?php
    }
    }
    else
    {
    }
    }  else {

    ?>
<script>
$('.alert').removeClass("alert-danger");
$('#Error_Msg').text("")
</script>
<script>
$('.alert').removeClass("alert-success");
$('#Sucess_Msg').text("")
</script>
    <?php


    }
    ?>

    <?php

    $query_empresa=mysqli_query($con,"select * from  `{$portal_name}_tax_storage` where session_ids ='$session_id' ORDER BY id DESC LIMIT 1 ;");
    $row_client=mysqli_fetch_array($query_empresa);
    $status=$row_client["gst_value"];
    $cgst=$row_client["cgst"];  
    $tax=$row_client["tax"];  
    $igst=$row_client["igst"];  
    
    //echo $cgst,$tax,$igst;
    
    ?>
   <div class="tile">
    <table class="table">
        <tr class="red">
            <th class='text-center'>NO</th>
            <th class='text-center'>COUNT</th>
            <th class='text-center'>CODE</th>
              <th class='text-center'>NAME</th>
            <th>DESCRIPTION</th>
            <th class='text-right'>PRICE UNIT.</th>
            <th class='text-right'>PRICE TOTAL</th>
           
        </tr>
        <?php if($status == 1) {
        $adder_total=0;
        $i=0;
        $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_tmp` where `{$portal_name}_products`.id_product=`{$portal_name}_tmp`.id_product and `{$portal_name}_tmp`.session_id='".$session_id."'");
        while ($row=mysqli_fetch_array($sql))
        {
        $id_tmp=$row["id_tmp"];
        $id_product=$row['id_product'];
        $code_product=$row['code_product'];
        $quantity=$row['quantity_tmp'];
        $advance=$row['advance_tmp'];
        $discount=$row['discount_tmp'];

        $name_product=$row['name_product'];
         $description_product=$row['description_product'];
        $sale_price=$row['price_tmp'];
        $advance=number_format($advance,2);
        $discount=number_format($discount,2);
        $sale_price_f=number_format($sale_price,2);
        $sale_price_f=str_replace(",","",$sale_price_f);
        $price_total=$sale_price_f*$quantity;
        $price_total_f=number_format($price_total,2);
        $price_total_r=str_replace(",","",$price_total_f);
        $adder_total+=$price_total_r;


    ?>
    <tr>
        <td class='text-center'><?php echo ++$i;?></td>
        <td class='text-center'><?php echo $quantity;?></td>
        <td class='text-center'><?php echo $code_product;?></td>
        <td><?php echo $name_product;?></td>
         <td><?php echo $description_product;?></td>
        <td class='text-right'><?php echo $sale_price_f;?></td>
        <td class='text-right'> <?php echo $price_total_f;?></td>
        <td class='text-center'><a class='btn btn-danger'style="width: 45px;" href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>	

    <?php

    }
    $cgst=$row_client["cgst"];  
    $tax=$row_client["tax"];  
     
    $subtotal=number_format($adder_total,2,'.','');
    if(isset($advance)){
    $advance=number_format($advance,2);
    }else{
    $advance = 0;
    }

    if(isset($discount)){
    $discount=number_format($discount,2);
    }else{
    $discount = 0;
    }
    $Total_VAT=($subtotal * $tax )/100;
    $Total_VAT1=($subtotal * $cgst )/100;
    $Total_VAT=number_format($Total_VAT,2,'.','');
    $Total_VAT1=number_format($Total_VAT1,2,'.','');
    $total_bill=$subtotal+$Total_VAT+$Total_VAT1;
    $advancediscount = $advance+$discount;
    $total_bill_f=$total_bill-$advancediscount;

    ?>
    <tr>
        <td class='text-right' colspan=5>SUBTOTAL <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><input type="hidden" value="<?php echo $subtotal; ?>" id="m_subtotal"> <input type="hidden" value="<?php echo number_format($subtotal,2);?>" id="php_subtotal"> <span id="a_subtotal"><?php echo number_format($subtotal,2);?></span></td>
        <td></td>
    </tr>
     <?php if ($status == 1) { ?> 
    <tr>
        <td class='text-right' colspan=5>SGST (<?php echo $tax;?>)% <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><?php echo number_format($Total_VAT,2);?></td>
        <td></td>
    </tr>
    <tr>
        <td class='text-right' colspan=5>CGST (<?php echo $cgst;?>)% <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><?php echo number_format($Total_VAT1,2);?></td>
        <td></td>
    </tr>
     <?php } ?> 
    <tr>
        <td class='text-right'colspan=5>ADVANCE </td>  
        <td><input type="text" class="form-control advance_key"  id="advance_<?php echo $id_tmp; ?>"  ></td>
        <td class='text-center'><input  type="hidden"  id="bt1" class='btn btn-danger' href="#"  onclick="add('<?php echo $id_tmp ?>')"/></i></td>
        <input  type="hidden"  id="bt9" class='btn btn-danger' href="#"  onclick="red('<?php echo $id_tmp ?>')"/>
     </tr>

    <tr>
        <td class='text-right'colspan=5>DISCOUNT</td>
        <td><input type="text" class="form-control discound_key"  id="discount_<?php echo $id_tmp; ?>"  ></td>
        <td class='text-center'><input  type="hidden"  id="bt2" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_tmp ?>')"/></i></td>
        <input  type="hidden"  id="bt9" class='btn btn-danger' href="#"  onclick="red('<?php echo $id_tmp ?>')"/>
      </tr>

    <tr>
        <td class='text-right' colspan=5>TOTAL <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><input type="hidden" id="m_total" value="<?php echo $total_bill_f; ?>"> <input type="hidden" id="php_total" value="<?php echo number_format($total_bill_f,2);?>"> <span class="m_total"> <?php echo number_format($total_bill_f,2);?> </span></td>
        <td></td>
    </tr>

    <?php } ?>
  <?php if ($status == 2) { 

    $adder_total=0;
    $i=0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_tmp` where `{$portal_name}_products`.id_product=`{$portal_name}_tmp`.id_product and `{$portal_name}_tmp`.session_id='".$session_id."'");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_tmp=$row["id_tmp"];
    $id_product=$row['id_product'];
    $code_product=$row['code_product'];
    $quantity=$row['quantity_tmp'];
    $advance=$row['advance_tmp'];
    $discount=$row['discount_tmp'];
$description_product=$row['description_product'];
    $name_product=$row['name_product'];
    $sale_price=$row['price_tmp'];
    $advance=number_format($advance,2);
    $discount=number_format($discount,2);
    $sale_price_f=number_format($sale_price,2);
    $sale_price_f=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_f*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;


    ?>
    <tr>
        <td class='text-center'><?php echo ++$i;?></td>
        <td class='text-center'><?php echo $quantity;?></td>
        <td class='text-center'><?php echo $code_product;?></td>
        <td><?php echo $name_product;?></td>
         <td><?php echo $description_product;?></td>
        <td class='text-right'><?php echo $sale_price_f;?></td>
        <td class='text-right'> <?php echo $price_total_f;?></td>
        <td class='text-center'><a class='btn btn-danger'style="width: 45px;" href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>		
    <?php
    } 
    $igst=$row_client["igst"];  
    
    $subtotal=number_format($adder_total,2,'.','');
    if(isset($advance)){
    $advance=number_format($advance,2);
    }else{
    $advance = 0;
    }
    if(isset($discount)){
    $discount=number_format($discount,2);
    }else{
    $discount = 0;
    }
    $percent_igst=($subtotal * $igst )/100;
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discount;
    $final_total_igst =$total_igst-$advancediscount;
    ?>
    <tr>
        <td class='text-right' colspan=5>SUBTOTAL <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><input type="hidden" value="<?php echo $subtotal; ?>" id="m_subtotal"> <input type="hidden" value="<?php echo number_format($subtotal,2);?>" id="php_subtotal"> <span id="a_subtotal"><?php echo number_format($subtotal,2);?></span></td>
        <td></td>
    </tr>
    <?php if ($status == 2) { ?> 
    <tr>
        <td class='text-right' colspan=5>IGST (<?php echo $igst;?>)% <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><?php echo number_format($percent_total_igst,2);?></td>
        <td></td>
    </tr>
    <?php } ?>
    <tr>
        <td class='text-right' colspan=5>ADVANCE </td>  
        <td><input type="text" class="form-control advance_key"  id="advance_<?php echo $id_tmp; ?>"  ></td>
        <td class='text-center'><input  type="hidden"  id="bt1" class='btn btn-danger' href="#"  onclick="add('<?php echo $id_tmp ?>')"/></i></td>
       <input  type="hidden"  id="bt9" class='btn btn-danger' href="#"  onclick="red('<?php echo $id_tmp ?>')"/>
    </tr>
    <tr>
        <td class='text-right' colspan=5>DISCOUNT</td>
        <td><input type="text" class="form-control discound_key"  id="discount_<?php echo $id_tmp; ?>"  ></td>
        <td class='text-center'><input  type="hidden"  id="bt1" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_tmp ?>')"/></i></td>
        <input  type="hidden"  id="bt9" class='btn btn-danger' href="#"  onclick="red('<?php echo $id_tmp ?>')"/>
    </tr>

    <tr>
        <td class='text-right' colspan=5>TOTAL <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><input type="hidden" id="m_total" value="<?php echo $final_total_igst; ?>"> <input type="hidden" id="php_total" value="<?php echo number_format($final_total_igst,2);?>"> <span class="m_total"> <?php echo number_format($final_total_igst,2);?> </span></td>
    </tr>
    <?php } ?>
    
    
    
    <?php if ($status == 3) { 

    $adder_total=0;
    $i=0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_tmp` where `{$portal_name}_products`.id_product=`{$portal_name}_tmp`.id_product and `{$portal_name}_tmp`.session_id='".$session_id."'");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_tmp=$row["id_tmp"];
    $id_product=$row['id_product'];
    $code_product=$row['code_product'];
    $quantity=$row['quantity_tmp'];
    $advance=$row['advance_tmp'];
    $discount=$row['discount_tmp'];

    $name_product=$row['name_product'];
    $sale_price=$row['price_tmp'];
    $advance=number_format($advance,2);
    $discount=number_format($discount,2);
    $sale_price_f=number_format($sale_price,2);
    $sale_price_f=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_f*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;


    ?>
    <tr>
        <td class='text-center'><?php echo ++$i;?></td>
        <td class='text-center'><?php echo $quantity;?></td>
        <td class='text-center'><?php echo $code_product;?></td>
        <td><?php echo $name_product;?></td>
         <td><?php echo $description_product;?></td>
        <td class='text-right'><?php echo $sale_price_f;?></td>
        <td class='text-right'> <?php echo $price_total_f;?></td>
        <td class='text-center'><a class='btn btn-danger'style="width: 45px;" href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>		
    <?php
    }
  
    $subtotal=number_format($adder_total,2,'.','');
    if(isset($advance)){
    $advance=number_format($advance,2);
    }else{
    $advance = 0;
    }
    if(isset($discount)){
    $discount=number_format($discount,2);
    }else{
    $discount = 0;
    }
    $advancediscount = $advance+$discount;
    ?>
    <tr>
        <td class='text-right' colspan=5>SUBTOTAL <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><input type="hidden" value="<?php echo $subtotal; ?>" id="m_subtotal"> <input type="hidden" value="<?php echo number_format($subtotal,2);?>" id="php_subtotal"> <span id="a_subtotal"><?php echo number_format($subtotal,2);?></span></td>
        <td></td>
    </tr>
    <tr>
        <td class='text-right' colspan=5>ADVANCE </td>  
        <td><input type="text" class="form-control advance_key"  id="advance_<?php echo $id_tmp; ?>"  ></td>
        <td class='text-center'><input  type="hidden"  id="bt1" class='btn btn-danger' href="#"  onclick="add('<?php echo $id_tmp ?>')"/></i></td>
        <input  type="hidden"  id="bt9" class='btn btn-danger' href="#"  onclick="red('<?php echo $id_tmp ?>')"/>
    </tr>
    <tr>
        <td class='text-right' colspan=5>DISCOUNT</td>
        <td><input type="text" class="form-control discound_key"  id="discount_<?php echo $id_tmp; ?>"  ></td>
        <td class='text-center'><input  type="hidden"  id="bt1" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_tmp ?>')"/></i></td>
        <input  type="hidden"  id="bt9" class='btn btn-danger' href="#"  onclick="red('<?php echo $id_tmp ?>')"/>
    </tr>

    <tr>
        <td class='text-right' colspan=5>TOTAL <?php echo $simbolo_moneda;?></td>
        <td class='text-right'><input type="hidden" id="m_total" value="<?php echo $subtotal; ?>"> <input type="hidden" id="php_total" value="<?php echo number_format($subtotal,2);?>"> <span class="m_total"> <?php echo number_format($subtotal,2);?> </span></td>
    </tr>
    <?php } ?>
    
    
    
    
    </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script> 

    $(document).ready(function(){
    $('.discound_key').keyup(function(){

    var discound_key = $('.discound_key').val();
    var m_total = $('#m_total').val();
    var php_total = $('#php_total').val();
    if((discound_key == "") || (discound_key == null) || (discound_key == "undefined") || (discound_key == undefined)){
    discound_key = 0;
    $('.m_total').text(php_total.toLocaleString(window.document.documentElement.lang));
    } else if(discound_key == 100){
    $('.m_total').text(0);

    }else if(discound_key > 100){

    $('.discound_key').val("");
    $('.m_total').text(php_total.toLocaleString(window.document.documentElement.lang));
    }
    else{
    var b_total = (discound_key/100) * m_total;
    var a_total = m_total - b_total;
    }

    $('.m_total').text(a_total.toLocaleString(window.document.documentElement.lang));
    });

    $('.advance_key').keyup(function(){
    var advance_key = $('.advance_key').val();
    var m_subtotal = $('#m_subtotal').val();
    var php_subtotal = $('#php_subtotal').val();

    if((advance_key == "") || (advance_key == null) || (advance_key == "undefined") || (advance_key == undefined)){
    advance_key = 0;
    $('#a_subtotal').text(php_subtotal.toLocaleString(window.document.documentElement.lang));
    } else {

    var a_subtotal = m_subtotal - advance_key;


    if(a_subtotal >= 0){

    $('#a_subtotal').text(a_subtotal.toLocaleString(window.document.documentElement.lang));

    }else{
    advance_key = 0;
    $('#a_subtotal').text(php_subtotal.toLocaleString(window.document.documentElement.lang));
    $('.advance_key').val("");
    }
    }
    });
    });
    $(document).ready(function() { 
    $("#name").click(function() { 
    alert('sdsa');
    $("#name").trigger("focus"); 
    });
    }); 
    </script> 