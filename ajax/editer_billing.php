<?php
/*
 * Author        :   BARATHI/KARPAGAM
 * Date          :   03-07-2019
 * Modified      :  
 * Modified By   :  
 * Description   :  
 */


require_once ("../config/db.php");
require_once ("../config/Connection.php");
 $portal_name =  $_SESSION['portal_name'];


$id_bill= $_SESSION['id_bill'];
$number_bill= $_SESSION['number_bill'];

$query_empresa=mysqli_query($con,"select * from `{$portal_name}_invoices` where id_bill = $id_bill");
$row=mysqli_fetch_array($query_empresa);
$status=$row["client_gst"];
$tax_client=$row["tax"];
$cgst_client=$row["cgst"];
$igst_client=$row["igst"];


if (isset($_POST['id'])){$id=intval($_POST['id']);}
if (isset($_POST['quantity'])){$quantity=intval($_POST['quantity']);}
if (isset($_POST['advance'])){$advance=intval($_POST['advance']);}
if (isset($_POST['discount'])){$discount=intval($_POST['discount']);}
if (isset($_POST['sale_price'])){$sale_price=floatval($_POST['sale_price']);}

if (isset($_POST['name_product'])){$name=$_POST['name_product'];}
if (isset($_POST['description_product'])){$description=$_POST['description_product'];}

require_once ("../config/db.php");
require_once ("../config/Connection.php");
include("../funcions.php");
if (!empty($id) and !empty($quantity) and !empty($sale_price))
{
$insert_tmp=mysqli_query($con, "INSERT INTO `{$portal_name}_billing_detail` (number_bill,id_product,name_product,description_product,quantity,sale_price,discount,advance, status) VALUES ('$number_bill','$id','$name','$description','$quantity','$sale_price',0,0,'$status')");
}

if   (!empty($discount) or !empty($advance) )
{
$update=mysqli_query($con,"update `{$portal_name}_billing_detail` set discount='$discount', advance='$advance' where number_bill='$number_bill' ");
}


if (isset($_GET['id']))
{
$id_detail=intval($_GET['id']);
$delete=mysqli_query($con, "DELETE FROM `{$portal_name}_billing_detail` WHERE id_detail='".$id_detail."'");
}

$simbolo_moneda=get_row("`{$portal_name}_profile`",'currency', 'id_profile', 1);
?>

<table class="table" style="background-color: #fff;">
<tr class="red">
    <th class='text-center'>NO</th>
    <th class='text-center'>CODE</th>
    <th class='text-center'>COUNT</th>
    <th>NAME</th>
     <th>DESCRIPTION</th>
    <th class='text-right'>PRICE UNIT</th>
    <th class='text-right'>PRICE TOTAL</th>
    <th></th>
</tr>
<?php
 if($status == 1) {
    $adder_total=0;
    $i = 0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_invoices`, `{$portal_name}_billing_detail` where `{$portal_name}_invoices`.number_bill=`{$portal_name}_billing_detail`.number_bill and  `{$portal_name}_invoices`.id_bill='$id_bill' and `{$portal_name}_products`.id_product=`{$portal_name}_billing_detail`.id_product");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_detail=$row["id_detail"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity'];
    $advances=$row['advance'];
    $discounts=$row['discount'];
    $status=$row['status'];
    $value=$advances;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discounts;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    $name_product=$row['name_product'];
    $description_product=$row['description_product'];
    $sale_price=$row['sale_price'];
    $sale_price_f=$sale_price;
    $sale_price_r=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_r*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;
?>
<tr>

    <td class='text-center'><?php echo ++$i;?></td>
        <td class='text-center'><?php echo $code_product;?></td>
      
        
           <td class='text-center' id="quantity<?php echo $id_detail;?>"><?php echo $quantity;?></td>
   
        <td id="name<?php echo $id_detail;?>"><?php echo $name_product;?></td>
   
       <td id="description<?php echo $id_detail;?>"><?php echo $description_product;?></td>
   
        <td class='text-right' id="sale_price<?php echo $id_detail;?>"><?php echo $sale_price_f;?></td>
   
        <td class='text-right' id="sale_price_total<?php echo $id_detail;?>"><?php echo $price_total_f;?></td>
        
    <!--<td id="sale_price<?php echo $id_detail;?>"><?php echo $sale_price_f;?></td>-->
    
    <td class='text-center'>
        
        <a href="#"  id="edit_button<?php echo $id_detail;?>" class='btn btn-danger' onclick="editbill('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-pencil" ></i>
        </a> 
        
  <a href="#" style="display: none;padding: 4px 0px;margin-right: 69px;margin-bottom: -32px;margin-top: 1px;" id="save_bill<?php echo $id_detail;?>" class='btn btn-danger' onclick="save_bill('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-ok" ></i>
        </a>
        <a href="#"  class='btn btn-danger'onclick="eliminar('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-trash"></i></a>
    </td>

</tr>
<?php
}
$tax=$tax_client;
$cgst=$cgst_client;
$igst=$igst_client;
$subtotal=number_format($adder_total,2,'.','');
 if(isset($advance)){
     $advance=$advance;
}else{
     $advance = 0;
}

   if(isset($discount)){
     $discount=$discount;
}else{
     $discount = 0;
}
    $value=$advance;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discount;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    
    //echo $discount;
    
    $Total_VAT=($subtotal * $tax )/100;
    $Total_VAT1=($subtotal * $cgst )/100;
    $discounts=( $discount * $subtotal )/100;
    $Total_VAT=number_format($Total_VAT,2,'.','');
    $Total_VAT1=number_format($Total_VAT1,2,'.','');
    $discounts=number_format($discounts,2,'.','');
    $total_bill=$subtotal+$Total_VAT+$Total_VAT1;
    $total= $advance+$discounts;
    $total_bill_f=$total_bill-$total;
    $total_bill_fround  = round($total_bill_f);
    $percent_igst=($subtotal * $igst )/100;
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$total_igst-$advancediscount;
    $final_total_bill_round  = round($final_total_igst);
?>
<tr>
    <td class='text-right' colspan=5>SUBTOTAL  <?php echo $simbolo_moneda;?></td>
    <td class='text-right'><input type="hidden" value="<?php echo $subtotal; ?>" id="m_subtotal"> <input type="hidden" value="<?php echo number_format($subtotal,2);?>" id="php_subtotal"> <span id="a_subtotal"><?php echo number_format($subtotal,2);?></span></td>
    <td></td>
</tr>

<tr>
     <td class='text-right'colspan=5>ADVANCE</td>
     <td class='text-right'><?php echo $advance;?>
     <input type="hidden" class="form-control advance_key" value="<?php echo $advance;?>" id="advance_<?php echo $id_detail; ?>"  ></td>
     <td class='text-center'><input  type="hidden"  id="add_bill_btn" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_detail ?>')"/></i></td>
</tr>

<tr>
    <td class='text-right'colspan=5>DISCOUNT</td>
    <td class='text-right'><?php echo $discount;?>
        <input type="hidden" class="form-control discound_key" value="<?php echo $discount;?>" id="discount_<?php echo $id_detail; ?>"  ></td>
    <td class='text-center'><input  type="hidden"  id="add_bill_btn" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_detail ?>')"/></i></td>
</tr>
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
<tr>
    <td class='text-right' colspan=5>TOTAL  <?php echo $simbolo_moneda;?></td>
    <td class='text-right'><?php echo number_format($total_bill_fround,2);?></td>
    <td class='text-right'><input type="hidden" id="m_total" value="<?php echo $total_bill_fround; ?>"> <input type="hidden" id="php_total" value="<?php echo number_format($total_bill_fround,2);?>"> <span class="m_total"> <?php echo number_format($total_bill_fround,2);?> </span></td>
    
</tr>

<?php } ?>






<!--------------------------------------status 2---------------------------->
<?php if($status == 2) {
$adder_total=0;
    $i = 0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_invoices`, `{$portal_name}_billing_detail` where `{$portal_name}_invoices`.number_bill=`{$portal_name}_billing_detail`.number_bill and  `{$portal_name}_invoices`.id_bill='$id_bill' and `{$portal_name}_products`.id_product=`{$portal_name}_billing_detail`.id_product");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_detail=$row["id_detail"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity'];
    $advances=$row['advance'];
    $discounts=$row['discount'];
    $status=$row['status'];
    $description_product=$row['description_product'];
    $value=$advances;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discounts;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    $name_product=$row['name_product'];
    $sale_price=$row['sale_price'];
    $sale_price_f=number_format($sale_price,2);
    $sale_price_r=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_r*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;
?>
<tr>

    <td class='text-center'><?php echo ++$i;?></td>
        <td class='text-center'><?php echo $code_product;?></td>
      
        
           <td class='text-center' id="quantity<?php echo $id_detail;?>"><?php echo $quantity;?></td>
   
        <td id="name<?php echo $id_detail;?>"><?php echo $name_product;?></td>
   
       <td id="description<?php echo $id_detail;?>"><?php echo $description_product;?></td>
   
        <td class='text-right' id="sale_price<?php echo $id_detail;?>"><?php echo $sale_price_f;?></td>
   
        <td class='text-right' id="sale_price_total<?php echo $id_detail;?>"><?php echo $price_total_f;?></td>
        
     <!--<td id="sale_price<?php echo $id_detail;?>"><?php echo $sale_price_f;?></td>-->
    
    <td class='text-center'>
        
        <a href="#"  id="edit_button<?php echo $id_detail;?>" class='btn btn-danger' onclick="editbill('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-pencil" ></i>
        </a> 
        
   <a href="#" style="display: none;padding: 4px 0px;margin-right: 69px;margin-bottom: -32px;margin-top: 1px;" id="save_bill<?php echo $id_detail;?>" class='btn btn-danger' onclick="save_bill('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-ok" ></i>
        </a>
        
        <a href="#"  class='btn btn-danger'onclick="eliminar('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-trash"></i></a>
    </td>

</tr>
<?php
}
$tax=$tax_client;
$cgst=$cgst_client;
$igst=$igst_client;
$subtotal=number_format($adder_total,2,'.','');
 if(isset($advance)){
     $advance=$advance;
}else{
     $advance = 0;
}

   if(isset($discount)){
     $discount=$discount;
}else{
     $discount = 0;
}
    $value=$advance;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discount;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    
    //echo $discount;
    
    $Total_VAT=($subtotal * $tax )/100;
    $Total_VAT1=($subtotal * $cgst )/100;
    $discounts=( $discount * $subtotal )/100;
    $Total_VAT=number_format($Total_VAT,2,'.','');
    $Total_VAT1=number_format($Total_VAT1,2,'.','');
    $discounts=number_format($discounts,2,'.','');
    $total_bill=$subtotal+$Total_VAT+$Total_VAT1;
    $total= $advance+$discounts;
    $total_bill_f=$total_bill-$total;
    $total_bill_fround  = round($total_bill_f);
    $percent_igst=($subtotal * $igst )/100;
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$total_igst-$advancediscount;
    $final_total_bill_round  = round($final_total_igst);
?>
<tr>
    <td class='text-right' colspan=5>SUBTOTAL  <?php echo $simbolo_moneda;?></td>
    <td class='text-right'><input type="hidden" value="<?php echo $subtotal; ?>" id="m_subtotal"> <input type="hidden" value="<?php echo number_format($subtotal,2);?>" id="php_subtotal"> <span id="a_subtotal"><?php echo number_format($subtotal,2);?></span></td>
    <td></td>
</tr>

<tr>
<td class='text-right' colspan=5>IGST (<?php echo $igst;?>)% <?php echo $simbolo_moneda;?></td>
<td class='text-right'><?php echo number_format($percent_total_igst,2);?></td>
<td></td>
</tr>

<tr>
     <td class='text-right'colspan=5>ADVANCE</td>
     <td class='text-right'>
         <?php echo $advance;?>
         <input type="hidden" class="form-control advance_key" value="<?php echo $advance;?>" id="advance_<?php echo $id_detail; ?>"  ></td>
     
</tr>

<tr>
    <td class='text-right'colspan=5>DISCOUNT</td>
    <td class='text-right'><?php echo $discount;?>
        <input type="hidden" class="form-control discound_key" value="<?php echo $discount;?>" id="discount_<?php echo $id_detail; ?>"  ></td>
    <td class='text-center'><input  type="hidden"  id="add_bill_btn" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_detail ?>')"/></i></td>
</tr>

<tr>
    <td class='text-right' colspan=5>TOTAL  <?php echo $simbolo_moneda;?></td>
    <td class='text-right'><?php echo number_format($final_total_igst,2);?></td>
    <td class='text-right'><input type="hidden" id="m_total" value="<?php echo $final_total_igst; ?>"> <input type="hidden" id="php_total" value="<?php echo number_format($final_total_igst,2);?>"> <span class="m_total"> <?php echo number_format($final_total_igst,2);?> </span></td>
    
</tr>



<?php } ?>



<!--------------------------------------status 3---------------------------->
<?php if($status == 3) {
$adder_total=0;
    $i = 0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_invoices`, `{$portal_name}_billing_detail` where `{$portal_name}_invoices`.number_bill=`{$portal_name}_billing_detail`.number_bill and  `{$portal_name}_invoices`.id_bill='$id_bill' and `{$portal_name}_products`.id_product=`{$portal_name}_billing_detail`.id_product");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_detail=$row["id_detail"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity'];
    $advances=$row['advance'];
    $discounts=$row['discount'];
    $status=$row['status'];
    $value=$advances;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discounts;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    $name_product=$row['name_product'];
    $sale_price=$row['sale_price'];
    $sale_price_f=number_format($sale_price,2);
    $sale_price_r=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_r*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;
?>
<tr>

    <td class='text-center'><?php echo ++$i;?></td>
        <td class='text-center'><?php echo $code_product;?></td>
      
        
           <td class='text-center' id="quantity<?php echo $id_detail;?>"><?php echo $quantity;?></td>
   
        <td id="name<?php echo $id_detail;?>"><?php echo $name_product;?></td>
   
       <td id="description<?php echo $id_detail;?>"><?php echo $description_product;?></td>
   
        <td class='text-right' id="sale_price<?php echo $id_detail;?>"><?php echo $sale_price_f;?></td>
   
        <td class='text-right' id="sale_price_total<?php echo $id_detail;?>"><?php echo $price_total_f;?></td>
        
   <!--<td id="sale_price<?php echo $id_detail;?>"><?php echo $sale_price_f;?></td>-->
    
    <td class='text-center'>
        
        <a href="#"  id="edit_button<?php echo $id_detail;?>" class='btn btn-danger' onclick="editbill('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-pencil" ></i>
        </a> 
        
   <a href="#" style="display: none;padding: 4px 0px;margin-right: 69px;margin-bottom: -32px;margin-top: 1px;" id="save_bill<?php echo $id_detail;?>" class='btn btn-danger' onclick="save_bill('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-ok" ></i>
        </a>
        
        <a href="#"  class='btn btn-danger'onclick="eliminar('<?php echo $id_detail ?>')"><i class="glyphicon glyphicon-trash"></i></a>
    </td>

</tr>
<?php
}
$tax=$tax_client;
$cgst=$cgst_client;
$igst=$igst_client;
$subtotal=number_format($adder_total,2,'.','');
 if(isset($advance)){
     $advance=$advance;
}else{
     $advance = 0;
}

   if(isset($discount)){
     $discount=$discount;
}else{
     $discount = 0;
}
    $value=$advance;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discount;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    
    //echo $discount;
    
    $Total_VAT=($subtotal * $tax )/100;
    $Total_VAT1=($subtotal * $cgst )/100;
    $discounts=( $discount * $subtotal )/100;
    $Total_VAT=number_format($Total_VAT,2,'.','');
    $Total_VAT1=number_format($Total_VAT1,2,'.','');
    $discounts=number_format($discounts,2,'.','');
    $total_bill=$subtotal+$Total_VAT+$Total_VAT1;
    $total= $advance+$discounts;
    $total_bill_f=$total_bill-$total;
    $total_bill_fround  = round($total_bill_f);
    $percent_igst=($subtotal * $igst )/100;
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$total_igst-$advancediscount;
    $final_total_bill_round  = round($final_total_igst);
?>
<tr>
    <td class='text-right' colspan=5>SUBTOTAL  <?php echo $simbolo_moneda;?></td>
    <td class='text-right'><input type="hidden" value="<?php echo $subtotal; ?>" id="m_subtotal"> <input type="hidden" value="<?php echo number_format($subtotal,2);?>" id="php_subtotal"> <span id="a_subtotal"><?php echo number_format($subtotal,2);?></span></td>
    <td></td>
</tr>

<tr>
     <td class='text-right'colspan=5>ADVANCE</td>
     <td class='text-right'> <?php echo $advance;?>
         <input type="hidden" class="form-control advance_key" value="<?php echo $advance;?>" id="advance_<?php echo $id_detail; ?>"  >
         </td>
     <td class='text-center'><input  type="hidden"  id="add_bill_btn" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_detail ?>')"/></i></td>
</tr>

<tr>
    <td class='text-right'colspan=5>DISCOUNT</td>
    <td class='text-right'> <?php echo $discount;?> 
    <input type="hidden" class="form-control discound_key" value="<?php echo $discount;?>" id="discount_<?php echo $id_detail; ?>"  >
    </td>
    <td class='text-center'><input  type="hidden"  id="add_bill_btn" class='btn btn-danger'href="#"  onclick="add('<?php echo $id_detail ?>')"/></i></td>
</tr>

<tr>
    <td class='text-right' colspan=5>TOTAL  <?php echo $simbolo_moneda;?></td>
    <td class='text-right'><?php echo number_format($total_bill_fround,2);?></td>
    <td class='text-right'><input type="hidden" id="m_total" value="<?php echo $total_bill_fround; ?>"> <input type="hidden" id="php_total" value="<?php echo number_format($total_bill_fround,2);?>"> <span class="m_total"> <?php echo number_format($total_bill_fround,2);?> </span></td>
    
</tr>
<tr>
<td class='text-right' colspan=5>TOTAL  <?php echo $simbolo_moneda;?></td>
  <td class='text-right'><input type="hidden" id="m_total" value="<?php echo $final_total_igst; ?>"> <input type="hidden" id="php_total" value="<?php echo number_format($final_total_igst,2);?>"> <span class="m_total"> <?php echo number_format($final_total_igst,2);?> </span></td>
</tr>
<?php } ?>

</table>



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
    
    
    //alert(advance_key);
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