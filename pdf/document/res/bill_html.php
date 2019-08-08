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
//echo "$tax_client,$cgst_client,$igst_client,$status";die();
    
    ?>

     <style type="text/css">

.vl {
  border-left: 1px solid #333;
  height: auto;
}
    table { vertical-align: top; }
    tr    { vertical-align: top;}
    td    { vertical-align: top; }
    .midnight-blue{
    background:black;
    padding: 4px 4px 4px;
    color:white;
    font-weight:bold;
    font-size:12px;
    }
    
     .midnight-blue1{
    background:black;
border-right-style:none;
  
    }
    
    .silver{
    background:white;
    padding: 3px 4px 3px;
    }
    .clouds{
    background:#ecf0f1;
    padding: 3px 4px 3px;
    }
    .border-top{
    border-top: solid 1px #bdc3c7;

    }
    .border-left{
    border-left: solid 1px #bdc3c7;
    }
    .border-right{
    border-right: solid 1px #bdc3c7;
    }
    .border-bottom{
    border-bottom: solid 1px #bdc3c7;
    }
    table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
    </style>

    <?php if($status == 1) { ?>

    <page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>

    <table class="page_footer">
    <tr>

    <td style="width: 50%; text-align: left">
    page[[page_cu]]/[[page_nb]]
    </td>
    <td style="width: 50%; text-align: right">
    &copy; <?php echo "virranproduct.com"; echo  $anio=date('Y'); ?>
    </td>
    </tr>
    </table>
    </page_footer>
    <?php include("invoice header.php");?>

    <br>



    <table cellspacing="0" style="width: 100%; font-size: 9pt;">
    <tr>
    <td style="width:50%; text-align: center;" class='midnight-blue'>BILLING</td>
 
    <td style="width:25%; text-align: center;" class='midnight-blue'>DATE</td>
    <td style="width:25%; text-align: center;" class='midnight-blue'>PAYMENT</td>
    </tr>
    <tr>
    <td style="width:50%;  border: 1px solid #222d32;">
    <?php
    $sql_cliente=mysqli_query($con,"select * from `{$portal_name}_client` where id_client='$id_client'");
    $rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <p style="font-size:10pt;"><b> <?php echo $rw_cliente['name_client'];?></b></p>
    <?php
    echo "&nbsp;Address: ";
    echo $rw_cliente['address_client'];
    echo "<br>&nbsp;Phone: ";
    echo $rw_cliente['phone_client'];
    echo "<br>&nbsp;Email: ";
    echo $rw_cliente['email_client'];

    ?>
    <br><br>
    </td>

    <!--    <td style="width:20%;   border: 1px solid #222d32;text-align: center">
    <?php
    $sql_user=mysqli_query($con,"select * from `{$portal_name}_users` where user_id='$id_salesman'");
    $rw_user=mysqli_fetch_array($sql_user); ?>
    <p> <?php echo $rw_user['firstname']." ".$rw_user['lastname']; ?></p>

    </td>-->
    <td style="width:25%;  border: 1px solid #222d32;text-align: center">
    <p> <?php echo date("d/m/Y");?></p> </td>
    <td style="width:25%;  border: 1px solid #222d32;text-align: center">
    <p> <?php if ($terms==1){echo "Cash";}elseif ($terms==2){echo "Cheque";}elseif ($terms==3){echo "Wire transfer";}elseif ($terms==4){echo "Credit";} ?></p>
    <?php echo $bank_details;?>
    </td>
    </tr>
    </table>
    <br>



     <div class="table-responsive"  style="height: 250px; border:1px solid #333;">
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
    <tr>
    <th style="width: 10%;text-align:center" class='midnight-blue'>NO</th>
    <th style="width: 25%;" class='midnight-blue'>PRODUCT</th>
    <th style="width: 25%;" class='midnight-blue'>DESCRIPTION</th>
    <th style="width: 10%;text-align:center" class='midnight-blue'>COUNT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE UNIT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE TOTAL</th>
    </tr>
    <?php

    $nums=1;
    $adder_total=0;
    $i = 0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_tmp` where `{$portal_name}_products`.id_product=`{$portal_name}_tmp`.id_product and `{$portal_name}_tmp`.session_id='".$session_id."'");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_tmp=$row["id_tmp"];
    $id_product=$row["id_product"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity_tmp'];
    $advance=$row['advance_tmp'];
    $discount=$row['discount_tmp'];
    $name_product=$row['name_product'];
    $sale_price=$row['price_tmp'];
    //$advance=number_format($advance,2);
    $invoice_nos=$row['invoice_nos'];
     $po_nos=$row['po_no'];
     $d_date =$row['due_date'];

    //$discount=number_format($discount,2);
    //echo "$discount,$advance";die();
    $sale_price_f=number_format($sale_price,2);
    $sale_price_f=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_f*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;
    $description_product =$row['description_product'];
    if ($nums%2==0){
    $clase="clouds";
    } else {
    $clase="silver";
    }
    $tax=$tax_client;
    $cgst=$cgst_client;
    $subtotal=number_format($adder_total,2,'.','');
    //$discount=$discount;
    $discounts=( $discount* $subtotal )/100;
    $Total_VAT=($subtotal * $tax )/100;
    $Total_VAT1=($subtotal * $cgst )/100;
    $Total_VATSSS=number_format($Total_VAT,2,'.','');
    $Total_VATSSS1=number_format($Total_VAT1,2,'.','');
    $total_tax=$Total_VATSSS+$Total_VATSSS1;
    ?>
    <tbody>
    <tr>

    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo ++$i;?></td>
    <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $name_product;?></td>
    <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $description_product;?></td>
    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; " ><?php echo $quantity; ?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo $sale_price_f;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd;"><?php echo $price_total_f;?></td>

    </tr>
    </tbody>

    <?php

    // $insert_detail=mysqli_query($con, "INSERT INTO `{$portal_name}_billing_detail` VALUES ('','$number_bill','$id_product','$quantity','$sale_price','$discount','$advance','$price_total_r','$name_product','$description_product','$percent_total_igst','$status')");
   $insert_detail=mysqli_query($con, "INSERT INTO `{$portal_name}_billing_detail` VALUES ('','$number_bill','$id_product','$quantity','$sale_price','$discount','$advance','$price_total_r','$name_product','$description_product','$total_tax','$status')");
    $nums++;
    }
    $sql=mysqli_query($con, "SELECT T.quantity_tmp,P.stack,T.id_product FROM `{$portal_name}_tmp` T INNER JOIN `{$portal_name}_products` P ON P.id_product = T.id_product  ");
    while ($row=mysqli_fetch_array($sql))
    {
    $quantity=$row['quantity_tmp'];
    $stack=$row['stack'];
    $id_product=$row['id_product'];
    if (($stack<=0))
    {
    $stack = 0;    
    }

    $total_stack=$stack-$quantity;
    $sql1="UPDATE `{$portal_name}_products` SET stack=$total_stack WHERE id_product=$id_product ";
    mysqli_query($con,$sql1);  
    }
    $tax=$tax_client;
    $cgst=$cgst_client;
    $subtotal=number_format($adder_total,2,'.','');
    $value=$advance;
    $bad_symbols = array(",");
    $advances = str_replace($bad_symbols, "", $value);
    $value1=$discounts;
    $bad_symbols = array(",");
    $discounts = str_replace($bad_symbols, "", $value1);
    $Total_VAT=($subtotal * $tax )/100;
    $Total_VAT1=($subtotal * $cgst )/100;
    $Total_VATSS=number_format($Total_VAT,2,'.','');
    $Total_VATSS1=number_format($Total_VAT1,2,'.','');
    $total_bill=$subtotal+$Total_VATSS+$Total_VATSS1;
    $total_tax=$Total_VATSS+$Total_VATSS1;
    $advancediscount = $advances+$discounts;
    $total_bill_f=$total_bill-$advancediscount;
    $total_bill_f_round  = round($total_bill_f);
    function no_to_words($no)
    {  
    $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
    if($no == 0)
    return ' ';
    else {
    $novalue='';
    $highno=$no;
    $remainno=0;
    $value=100;
    $value1=1000;      
    while($no>=100)    {
    if(($value <= $no) &&($no  < $value1))    {
    $novalue=$words["$value"];
    $highno = (int)($no/$value);
    $remainno = $no % $value;
    break;
    }
    $value= $value1;
    $value1 = $value * 100;
    }      
    if(array_key_exists("$highno",$words))
    return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
    else {
    $unit=$highno%10;
    $ten =(int)($highno/10)*10;            
    return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
    }
    }
    }
    $numbers_total= no_to_words($total_bill_f_round);
    ?>    
    </table>
    </div>
    <div style="padding-left: 10px 1px;">
    <table  style="width: 100.1%; text-align: left; font-size: 8pt;  border: 1px solid #333;">
    <tr>
    <td  style="width:80%;text-align: right;">Total Amount Before Tax <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $subtotal;?></td>
    </tr>

    <tr>
    <td  style="width:80%;text-align: right;">SGST Tax(<?php echo $tax; ?>) % :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $Total_VATSS;?></td>
    </tr>


    <tr>
    <td style="width:80%;text-align: right;">CGST Tax(<?php echo $cgst;?>) % :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $Total_VATSS1;?></td>
    </tr>

    <?php if ($advance > 0.00) { ?>
    <tr>
    <td style="width:80%;text-align: right;">Advance <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $advance;?></td>
    </tr>
    <?php } ?>

    <?php if ($discount > 0) { ?>
    <tr>
    <td style="width:80%;text-align: right;">Discount(<?php echo $discount;?>) % :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $discounts;?></td>
    </tr>

    <?php } ?>

    <tr>
    <td style="width:80%;text-align: right;">Total Tax Amount <?php echo $simbolo_moneda;?>: </td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($total_tax,2);?></td>
    </tr>
    <tr>
    <td style="width:80%;text-align: right;">Total <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($total_bill_f,2);?></td>
    </tr>
    <tr>
    <td style="width:80%;"></td>
    <td style="width:20%;"> <hr></td>

    </tr>
    <tr>
    <td style="width:80%;text-align: right;">ROUND TOTAL <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"><?php echo round($total_bill_f);?></td>
    </tr>
    <tr>
    <td  style="width: 80%;text-transform: uppercase;">&nbsp;<?php echo $numbers_total;?></td>
    </tr>

    </table>
    </div>
    </page>
    <?php } ?>

    <?php if($status == 2 && $status != 1) { ?>


    <page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>

    <table class="page_footer">
    <tr>

    <td style="width: 50%; text-align: left">
    page[[page_cu]]/[[page_nb]]
    </td>
    <td style="width: 50%; text-align: right">
    &copy; <?php echo "virranproduct.com"; echo  $anio=date('Y'); ?>
    </td>
    </tr>
    </table>
    </page_footer>
    <?php include("invoice header.php");?>

    <br>

    <table cellspacing="0" style="width: 100%; font-size: 9pt;">
    <tr>
    <td style="width:50%; text-align: center;" class='midnight-blue'>BILLING</td>
    <!--    <td style="width:20%; text-align: center;" class='midnight-blue'>SALESMAN</td>-->
    <td style="width:25%; text-align: center;" class='midnight-blue'>DATE</td>
    <td style="width:25%; text-align: center;" class='midnight-blue'>PAYMENT</td>
    </tr>
    <tr>
    <td style="width:50%;  border: 1px solid #222d32;">
    <?php
    $sql_cliente=mysqli_query($con,"select * from `{$portal_name}_client` where id_client='$id_client'");
    $rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <p style="font-size:10pt;"><b> <?php echo $rw_cliente['name_client'];?></b></p>
    <?php
    echo "&nbsp;Address: ";
    echo $rw_cliente['address_client'];
    echo "<br>&nbsp;Phone: ";
    echo $rw_cliente['phone_client'];
    echo "<br>&nbsp;Email: ";
    echo $rw_cliente['email_client'];

    ?>
    <br><br>
    </td>

    <!--    <td style="width:20%;   border: 1px solid #222d32;text-align: center">
    <?php
    $sql_user=mysqli_query($con,"select * from `{$portal_name}_users` where user_id='$id_salesman'");
    $rw_user=mysqli_fetch_array($sql_user); ?>
    <p> <?php echo $rw_user['firstname']." ".$rw_user['lastname']; ?></p>

    </td>-->
    <td style="width:25%;  border: 1px solid #222d32;text-align: center">
    <p> <?php echo date("d/m/Y");?></p> </td>
    <td style="width:25%;  border: 1px solid #222d32;text-align: center">
    <p> <?php if ($terms==1){echo "Cash";}elseif ($terms==2){echo "Cheque";}elseif ($terms==3){echo "Wire transfer";}elseif ($terms==4){echo "Credit";} ?></p>
    <?php echo $bank_details;?>
    </td>
    </tr>
    </table>
    <br>



     <div class="table-responsive"  style="height: 250px; border:1px solid #333;">
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
    <tr>
    <th style="width: 10%;text-align:center" class='midnight-blue'>NO</th>
    <th style="width: 25%" class='midnight-blue'>PRODUCT</th>
    <th style="width: 25%" class='midnight-blue'>DESCRIPTION</th>
    <th style="width: 10%;text-align:center" class='midnight-blue'>COUNT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE UNIT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE TOTAL</th>
    </tr>
    <?php
    $nums=1;
    $adder_total=0;
    $i = 0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_tmp` where `{$portal_name}_products`.id_product=`{$portal_name}_tmp`.id_product and `{$portal_name}_tmp`.session_id='".$session_id."'");
   
    while ($row=mysqli_fetch_array($sql))
    {
    $id_tmp=$row["id_tmp"];
    $id_product=$row["id_product"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity_tmp'];
    $advance=$row['advance_tmp'];
    $discount=$row['discount_tmp'];
    //$name_product=$row['name_product'];
    $sale_price=$row['price_tmp'];
    //$advance=number_format($advance,2);
      $invoice_nos=$row['invoice_nos'];
         $po_nos=$row['po_no'];
           $d_date =$row['due_date'];
           
            $name_product =$row['name_product'];
             $description_product =$row['description_product'];
             
             // $name_product;$description_product; 
    //$discount=number_format($discount,2);
    //echo "$discount,$advance";die();
    $sale_price_f=number_format($sale_price,2);
    $sale_price_f=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_f*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;//Sumador

    if ($nums%2==0){
    $clase="clouds";
    } else {
    $clase="silver";
    }
    $igst=$igst_client;
    $subtotal=number_format($adder_total,2,'.','');

    $discounts=( $discount* $subtotal )/100;
    $percent_igst=($subtotal * $igst )/100;
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$total_igst-$advancediscount;

    ?>

    <tbody>
    <tr>

    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo ++$i;?></td>
    <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $name_product;?></td>
    <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $description_product;?></td>
    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; " ><?php echo $quantity; ?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo $sale_price_f;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd;"><?php echo $price_total_f;?></td>

    </tr>
    </tbody>

    <?php

    $insert_detail=mysqli_query($con, "INSERT INTO `{$portal_name}_billing_detail` VALUES ('','$number_bill','$id_product','$quantity','$sale_price','$discount','$advance','$price_total_r','$name_product','$description_product','$percent_total_igst','$status')");
  
    $nums++;
    }
    $sql=mysqli_query($con, "SELECT T.quantity_tmp,P.stack,T.id_product FROM `{$portal_name}_tmp` T INNER JOIN `{$portal_name}_products` P ON P.id_product = T.id_product  ");
    while ($row=mysqli_fetch_array($sql))
    {

    $quantity=$row['quantity_tmp'];
    $stack=$row['stack'];
    $id_product=$row['id_product'];
    //echo  $stack;
    $total_stack=$stack-$quantity;
    //echo $total_stack;
    $sql1="UPDATE `{$portal_name}_products` SET stack=$total_stack WHERE id_product=$id_product ";
    mysqli_query($con,$sql1);  

    }

    $igst=$igst_client;
    $subtotal=number_format($adder_total,2,'.','');
    //$advances=$advance;
    //$discounts=$discount;

    $value=$advance;
    $bad_symbols = array(",");
    $advances = str_replace($bad_symbols, "", $value);

    $value1=$discounts;
    $bad_symbols = array(",");
    $discounts = str_replace($bad_symbols, "", $value1);

    $percent_igst=($subtotal * $igst )/100;
    //echo"$percent_igst";
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$total_igst-$advancediscount;
    $final_total_bill_round  = round($final_total_igst);


    function no_to_words($no)
    {  
    $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
    if($no == 0)
    return ' ';
    else {
    $novalue='';
    $highno=$no;
    $remainno=0;
    $value=100;
    $value1=1000;      
    while($no>=100)    {
    if(($value <= $no) &&($no  < $value1))    {
    $novalue=$words["$value"];
    $highno = (int)($no/$value);
    $remainno = $no % $value;
    break;
    }
    $value= $value1;
    $value1 = $value * 100;
    }      
    if(array_key_exists("$highno",$words))
    return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
    else {
    $unit=$highno%10;
    $ten =(int)($highno/10)*10;            
    return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
    }
    }
    }
    $numbers_total_igst= no_to_words($final_total_bill_round);

    //echo $numbers_total_igst;die();
    ?>
    </table>
    </div>

    <div style="padding-left: 10px 1px;"  >
    <table  style="width: 100.1%; text-align: left; font-size: 8pt;  border: 1px solid  #333;">


    <tr>
    <td  style="width: 80%; text-align: right;">Total Amount Before Tax <?php echo $simbolo_moneda;?> :</td>
    <td style="widtd: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $subtotal;?></td>
    </tr>
    
    
     <tr>
    <td  style="width: 80%; text-align: right;">Subtotal<?php echo $simbolo_moneda;?> :</td>
    <td style="widtd: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $subtotal;?></td>
    </tr>

    <tr>
    <td style="width: 80%; text-align: right;">IGST Tax(<?php echo $igst;?>) % :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $percent_total_igst;?></td>
    </tr>


    <?php if ($advance > 0.00) { ?>
    <tr>
    <td style="width: 80%; text-align: right;">Advance <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $advance;?></td>
    </tr>
    <?php } ?>

    <?php if ($discount > 0) { ?>
    <tr>
    <td style="width: 80%; text-align: right;">Discount(<?php echo $discount;?>) %:</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $discounts;?></td>
    </tr>

    <?php } ?>

    <!--        <tr>
    <td colspan="4" style="widtd: 85%; text-align: right; border: 1px solid #dddddd;">Total Tax Amount <?php echo $simbolo_moneda;?> </td>
    <td style="widtd: 15%; text-align: right; border: 1px solid #dddddd;"> <?php echo number_format($total_tax,2);?></td>
    </tr>
    <tr>-->
    <tr>
    <td style="width: 80%; text-align: right;">Total <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($final_total_igst,2);?></td>
    </tr>

    <tr>
    <td style="width:80%;"></td>
    <td style="width:20%;"> <hr></td>

    </tr>

    <tr>
    <td  style="width: 80%; text-align: right; ">ROUND TOTAL <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"><?php echo round($final_total_igst);?></td>
    </tr>

    <tr>
    <td style="width: 80%;text-transform: uppercase;">&nbsp;<?php echo $numbers_total_igst;?></td>
    </tr>

    </table>

    </div>

    </page>

    <?php } ?>   
    
    
    
    
    
    
    <!-------------------------------------Without GST--------------------------------------------------------->
    
    
    

     <?php if($status == 3 && $status != 1 && $status != 2) { ?>   
    
       <page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>

    <table class="page_footer">
    <tr>

    <td style="width: 50%; text-align: left">
    page[[page_cu]]/[[page_nb]]
    </td>
    <td style="width: 50%; text-align: right">
    &copy; <?php echo "virranproduct.com"; echo  $anio=date('Y'); ?>
    </td>
    </tr>
    </table>
    </page_footer>
    <?php include("invoice header.php");?>

    <br>

    <table cellspacing="0" style="width: 100%; font-size: 9pt;">
    <tr>
    <td style="width:50%; text-align: center;" class='midnight-blue'>BILLING</td>
    <!--    <td style="width:20%; text-align: center;" class='midnight-blue'>SALESMAN</td>-->
    <td style="width:25%; text-align: center;" class='midnight-blue'>DATE</td>
    <td style="width:25%; text-align: center;" class='midnight-blue'>PAYMENT</td>
    </tr>
    <tr>
    <td style="width:50%;  border: 1px solid #222d32;">
    <?php
    $sql_cliente=mysqli_query($con,"select * from `{$portal_name}_client` where id_client='$id_client'");
    $rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <p style="font-size:10pt;"><b> <?php echo $rw_cliente['name_client'];?></b></p>
    <?php
    echo "&nbsp;Address: ";
    echo $rw_cliente['address_client'];
    echo "<br>&nbsp;Phone: ";
    echo $rw_cliente['phone_client'];
    echo "<br>&nbsp;Email: ";
    echo $rw_cliente['email_client'];

    ?>
    <br><br>
    </td>

    <!--    <td style="width:20%;   border: 1px solid #222d32;text-align: center">
    <?php
    $sql_user=mysqli_query($con,"select * from `{$portal_name}_users` where user_id='$id_salesman'");
    $rw_user=mysqli_fetch_array($sql_user); ?>
    <p> <?php echo $rw_user['firstname']." ".$rw_user['lastname']; ?></p>

    </td>-->
    <td style="width:25%;  border: 1px solid #222d32;text-align: center">
    <p> <?php echo date("d/m/Y");?></p> </td>
    <td style="width:25%;  border: 1px solid #222d32;text-align: center">
    <p> <?php if ($terms==1){echo "Cash";}elseif ($terms==2){echo "Cheque";}elseif ($terms==3){echo "Wire transfer";}elseif ($terms==4){echo "Credit";} ?></p>
    <?php echo $bank_details;?>
    </td>
    </tr>
    </table>
    <br>



    <div class="table-responsive"  style="height: 250px; border:1px solid #333;">
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
    <tr>
    <th style="width: 10%;text-align:center" class='midnight-blue'>NO</th>
    <th style="width: 25%" class='midnight-blue'>PRODUCT</th>
    <th style="width: 25%" class='midnight-blue'>DESCRIPTION</th>
    <th style="width: 10%;text-align:center" class='midnight-blue'>COUNT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE UNIT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE TOTAL</th>
    </tr>
    <?php
    $nums=1;
    $adder_total=0;
    $i = 0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_tmp` where `{$portal_name}_products`.id_product=`{$portal_name}_tmp`.id_product and `{$portal_name}_tmp`.session_id='".$session_id."'");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_tmp=$row["id_tmp"];
    $id_product=$row["id_product"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity_tmp'];
    $advance=$row['advance_tmp'];
    $discount=$row['discount_tmp'];
    $name_product=$row['name_product'];
    $sale_price=$row['price_tmp'];
    //$advance=number_format($advance,2);
     $invoice_nos=$row['invoice_nos'];
        $po_nos=$row['po_no'];
         $d_date =$row['due_date'];
    //$discount=number_format($discount,2);
    //echo "$discount,$advance";die();
    $sale_price_f=number_format($sale_price,2);
    $sale_price_f=str_replace(",","",$sale_price_f);
    $price_total=$sale_price_f*$quantity;
    $price_total_f=number_format($price_total,2);
    $price_total_r=str_replace(",","",$price_total_f);
    $adder_total+=$price_total_r;//Sumador
 $description_product =$row['description_product'];
    if ($nums%2==0){
    $clase="clouds";
    } else {
    $clase="silver";
    }
    $igst=$igst_client;
    $subtotal=number_format($adder_total,2,'.','');

    $discounts=( $discount* $subtotal )/100;
    $percent_igst=($subtotal * $igst )/100;
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$total_igst-$advancediscount;

    ?>

    <tbody>
    <tr>

    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo ++$i;?></td>
    <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $name_product;?></td>
    <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $description_product;?></td>
    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; " ><?php echo $quantity; ?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo $sale_price_f;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd;"><?php echo $price_total_f;?></td>

    </tr>
    </tbody>

    <?php

    //$insert_detail=mysqli_query($con, "INSERT INTO `{$portal_name}_billing_detail` VALUES ('','$number_bill','$id_product','$quantity','$sale_price','$discount','$advance','$price_total_r','$name_product','$description_product','$percent_total_igst','$status')");
    $insert_detail=mysqli_query($con, "INSERT INTO `{$portal_name}_billing_detail` VALUES ('','$number_bill','$id_product','$quantity','$sale_price','$discount','$advance','$price_total_r','$name_product','$description_product','$percent_total_igst','$status')");
     
    $nums++;
    }
    $sql=mysqli_query($con, "SELECT T.quantity_tmp,P.stack,T.id_product FROM `{$portal_name}_tmp` T INNER JOIN `{$portal_name}_products` P ON P.id_product = T.id_product  ");
    while ($row=mysqli_fetch_array($sql))
    {

    $quantity=$row['quantity_tmp'];
    $stack=$row['stack'];
    $id_product=$row['id_product'];
    //echo  $stack;
    $total_stack=$stack-$quantity;
    //echo $total_stack;
    $sql1="UPDATE `{$portal_name}_products` SET stack=$total_stack WHERE id_product=$id_product ";
    mysqli_query($con,$sql1);  

    }

   
    $subtotal=number_format($adder_total,2,'.','');
    
    $value=$advance;
    $bad_symbols = array(",");
    $advances = str_replace($bad_symbols, "", $value);

    $value1=$discounts;
    $bad_symbols = array(",");
    $discounts = str_replace($bad_symbols, "", $value1);

    $advancediscount = $advances+$discounts;
    $total_adv_dis=$subtotal-$advancediscount;


    function no_to_words($no)
    {  
    $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
    if($no == 0)
    return ' ';
    else {
    $novalue='';
    $highno=$no;
    $remainno=0;
    $value=100;
    $value1=1000;      
    while($no>=100)    {
    if(($value <= $no) &&($no  < $value1))    {
    $novalue=$words["$value"];
    $highno = (int)($no/$value);
    $remainno = $no % $value;
    break;
    }
    $value= $value1;
    $value1 = $value * 100;
    }      
    if(array_key_exists("$highno",$words))
    return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
    else {
    $unit=$highno%10;
    $ten =(int)($highno/10)*10;            
    return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
    }
    }
    }
    $numbers_total= no_to_words($total_adv_dis);

    ?>
    </table>
    </div>

    <div style="padding-left: 10px 1px;"  >
    <table  style="width: 100.1%; text-align: left; font-size: 8pt;  border: 1px solid  #333;">

     <tr>
    <td  style="width: 80%; text-align: right;">Total Amnt. <?php echo $simbolo_moneda;?> :</td>
    <td style="widtd: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $price_total_f;?></td>
    </tr>

    <?php if ($advance > 0.00) { ?>
    <tr>
    <td style="width: 80%; text-align: right;">Advance <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $advance;?></td>
    </tr>
    <?php } ?>

    <?php if ($discount > 0) { ?>
    <tr>
    <td style="width: 80%; text-align: right;">Discount(<?php echo $discount;?>) %:</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo $discounts;?></td>
    </tr>

    <?php } ?>

   
    <tr>
    <td style="width: 80%; text-align: right;">Subtotal <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($total_adv_dis,2);?></td>
    </tr>

    <tr>
    <td style="width:80%;"></td>
    <td style="width:20%;"> <hr></td>

    </tr>

    <tr>
    <td  style="width: 80%; text-align: right; ">ROUND TOTAL <?php echo $simbolo_moneda;?> :</td>
    <td style="width: 20%; text-align: right; border: 0px solid #dddddd;"><?php echo round($total_adv_dis);?></td>
    </tr>

    <tr>
    <td style="width: 80%;text-transform: uppercase;">&nbsp;<?php echo $numbers_total;?></td>
    </tr>
    </table>
    </div>
    </page>

    <?php } ?>  
    
    <br>
    <div style="font-size:11pt;text-align:center;font-weight:bold">Thanks for your purchase!</div>
    <br><br>

    <?php
    $query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$product_type=$row["product_type"];
    ?>
    <?php if(!empty($row['subject'])) { ?>
    <div class="form-group col-md-3">
        <label class="control-label" style="font-weight:bold">Terms & Condition:</label><br>
        <div style="font-size:10pt;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['subject']?></div>
     </div>
    <br><br>
     <?php }   ?>
    
    
 <?php if($status == 1) {
    $round_total=round($total_bill_f);
    if($bill_date==""){
       $date= date("d-m-Y");
    }else{
    $date=$bill_date;
    }
   
    
     $delete=mysqli_query($con,"DELETE FROM `{$portal_name}_tax_storage`");
    $insert=mysqli_query($con,"INSERT INTO `{$portal_name}_invoices` ( `number_bill`, `date_bill`, `id_client`, `id_salesman`, `terms`, `total_sale`, `round_total`, `state_bill`, `bank_details`,`goods_service_id`,`invoice_nos`,`po_no`,`client_gst`,`tax`,`cgst`,`igst`,`due_date`)VALUES ('$number_bill','$date','$id_client','$id_salesman','$terms','$total_bill_f','$round_total','$state_bill','$bank_details','$goods_service_id','$invoice_nos','$po_nos','$status','$tax_client','$cgst_client','$igst_client','$d_date')");

    $delete=mysqli_query($con,"DELETE FROM `{$portal_name}_tmp` WHERE session_id='".$session_id."'");
    
   
    } 
    
    
if($status == 2) {

    $round_total_igst=round($final_total_igst);
      if($bill_date==""){
      $date= date("d-m-Y");
    }else{
    $date=$bill_date;
    }
    
    $delete=mysqli_query($con,"DELETE FROM `{$portal_name}_tax_storage`");
    $insert=mysqli_query($con,"INSERT INTO `{$portal_name}_invoices` ( `number_bill`, `date_bill`, `id_client`, `id_salesman`, `terms`, `total_sale`, `round_total`, `state_bill`, `bank_details`,`goods_service_id`,`invoice_nos`,`po_no`,`client_gst`,`tax`,`cgst`,`igst`,`due_date`) VALUES ('$number_bill','$date','$id_client','$id_salesman','$terms','$final_total_igst','$round_total_igst','$state_bill','$bank_details','$goods_service_id','$invoice_nos','$po_nos','$status','$tax_client','$cgst_client','$igst_client','$d_date')");

    $delete=mysqli_query($con,"DELETE FROM `{$portal_name}_tmp` WHERE session_id='".$session_id."'");    
    }

if($status == 3) {
   $round_total_final=round($subtotal);
     if($bill_date==""){
     $date= date("d-m-Y");
    }else{
    $date=$bill_date;
    }
      $delete=mysqli_query($con,"DELETE FROM `{$portal_name}_tax_storage`");
    $insert=mysqli_query($con,"INSERT INTO `{$portal_name}_invoices` ( `number_bill`, `date_bill`, `id_client`, `id_salesman`, `terms`, `total_sale`, `round_total`, `state_bill`, `bank_details`,`goods_service_id`,`invoice_nos``po_no``due_date`) VALUES ('$number_bill','$date','$id_client','$id_salesman','$terms','$subtotal','$round_total_final','$state_bill','$bank_details','$goods_service_id','$invoice_nos','$po_nos','$d_date')");

    $delete=mysqli_query($con,"DELETE FROM `{$portal_name}_tmp` WHERE session_id='".$session_id."'");    
    }