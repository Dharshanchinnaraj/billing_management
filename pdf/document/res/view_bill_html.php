    <?php 
    /*
    * Author        :   BARATHI/KARPAGAM
    * Date          :   03-07-2019
    * Modified      :   
    * Modified By   :   
    * Description   :  
    */
    
   
    $query_empresa=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_billing_detail`, `{$portal_name}_invoices` where `{$portal_name}_products`.id_product=`{$portal_name}_billing_detail`.id_product and `{$portal_name}_billing_detail`.number_bill=`{$portal_name}_invoices`.number_bill and `{$portal_name}_invoices`.id_bill='".$id_bill."'");
    $row=mysqli_fetch_array($query_empresa);
    $status=$row["client_gst"];
    
    
    $portal_name =  $_SESSION['portal_name'];
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
    <page  backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>
    <table class="page_footer">
    <tr>

    <td style="width: 50%; text-align: left">
    page [[page_cu]]/[[page_nb]]
    </td>
    <td style="width: 50%; text-align: right">
    &copy; <?php echo "virranproduct.com "; echo  $anio=date('Y'); ?>
    </td>
    </tr>
    </table>
    </page_footer>
    <?php include("invoice header_editor.php");?>
    <br>
    <table cellspacing="0" style="width: 100%; font-size: 9pt;">
    <tr>
    <td style="width:50%; text-align: center;" class='midnight-blue'>BILLING</td>
    <!--<td style="width:20%; text-align: center;" class='midnight-blue'>SALESMAN</td>-->
    <td style="width:25%; text-align: center;" class='midnight-blue'>DATE</td>
    <td style="width:25%; text-align: center;" class='midnight-blue'>PAYMENT</td>
    </tr>
    <tr>
    <td style="width:50%; border: 1px solid #222d32;" >
    <?php 
    $sql_cliente=mysqli_query($con,"select * from `{$portal_name}_client` where id_client='$id_client'");
    $rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <p style="font-size:10pt;"><b> <?php echo $rw_cliente['name_client'];?></b></p>
    <?php
    echo "&nbsp;Addres: ";
    echo $rw_cliente['address_client'];
    echo "<br>&nbsp;Phone: ";
    echo $rw_cliente['phone_client'];
    echo "<br>&nbsp;Email: ";
    echo $rw_cliente['email_client'];
    ?>
    <br><br>
    </td>
    
    <td style="width:15%;  border: 1px solid#222d32;text-align: center;"><p><?php echo date("d/m/Y", strtotime($date_bill));?></p></td>
    <td style="width:15%; border: 1px solid #222d32;text-align: center;" >
    <p><?php 
    if ($terms==1){echo "Cash";}
    elseif ($terms==2){echo "Cheque";}
    elseif ($terms==3){echo "Wire transfer";}
    elseif ($terms==4){echo "Credit";}
    ?></p>
    <?php
    //echo $id_bill;
    $sql=mysqli_query($con,"select * from `{$portal_name}_invoices` where id_bill=$id_bill");
    $rw_user=mysqli_fetch_array($sql);
    echo $rw_user['bank_details']; ?>
    </td>		      
    </tr>
    </table>
    <br>
     <div class="table-responsive"  style="height: 250px; border:1px solid #333;">
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
    <tr>
    <th style="width: 10%;text-align:center" class='midnight-blue'>NO</th>
    <th style="width: 10%;text-align:center" class='midnight-blue'>COUNT</th>
    <th style="width: 25%" class='midnight-blue'>PRODUCT</th>
    <th style="width: 25%" class='midnight-blue'>DESCRIPTION</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE UNIT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE TOTAL</th>
    </tr>

    <?php 

    $nums=1;
    $adder_total=0;
    $i=0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_billing_detail`, `{$portal_name}_invoices` where `{$portal_name}_products`.id_product=`{$portal_name}_billing_detail`.id_product and `{$portal_name}_billing_detail`.number_bill=`{$portal_name}_invoices`.number_bill and `{$portal_name}_invoices`.id_bill='".$id_bill."'");

    while ($row=mysqli_fetch_array($sql))
    {
    $id_product=$row["id_product"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity'];
    $advance=$row['advance'];
    $discount=$row['discount'];
//echo $advance,$discount;
    $description_product =$row['description_product'];
    $name_product=$row['name_product'];
    $sale_price=$row['sale_price'];
    // $discount=number_format($discount,2);
    $sale_price_f=number_format($sale_price,2);//Formateo variables
    $sale_price_r=str_replace(",","",$sale_price_f);//Reemplazo las comas
    $price_total=$sale_price_r*$quantity;
    $price_total_f=number_format($price_total,2);//Precio total formateado
    $price_total_r=str_replace(",","",$price_total_f);//Reemplazo las comas
    $adder_total+=$price_total_r;//Sumador

    if ($nums%2==0){
    $clase="clouds";
    } else {
    $clase="silver";
    }
    $update=mysqli_query($con,"update `{$portal_name}_billing_detail` set advance='$advance',discount='$discount' where number_bill='$number_bill'"); 
    ?>
   <tbody>
    <tr>

    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo ++$i;?></td>
    <td class='' style="width: 10%; text-align: center;height:5%; border: 0px solid #dddddd; " ><?php echo $quantity; ?></td>
    <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $name_product;?></td>
     <td class='' style="width: 25%; text-align: left;height:5%;  border: 0px solid #dddddd; "><?php echo $description_product;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd; "><?php echo $sale_price_f;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%; border: 0px solid #dddddd;"><?php echo $price_total_f;?></td>

    </tr>
    </tbody>
    <?php 
    $nums++;
    }
    $tax=$rw_cliente['tax'];
    $cgst=$rw_cliente['cgst'];
    //echo $tax,$cgst;die();
    $gst_no=get_row("`{$portal_name}_profile`",'gst_no', 'id_profile', 1);
    $value=$advance;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discount;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    $subtotal=number_format($adder_total,2,'.','');
    $Total_VAT=($subtotal * $tax )/100;
    $Total_VAT1=($subtotal * $cgst )/100;
    $discounts=( $discount* $subtotal )/100;
    $Total_VAT=number_format($Total_VAT,2,'.','');
    $Total_VAT1=number_format($Total_VAT1,2,'.','');
    $total_tax=$Total_VAT+$Total_VAT1;
    $total_bill=$subtotal+$Total_VAT+$Total_VAT1;
    $total = $advance+$discounts;
    $total_bill_f=$total_bill-$total;
    $total_bill_f_round  = round($total_bill_f);
    $sql1="UPDATE `{$portal_name}_invoices` set total_sale='$total_bill_f',round_total='$total_bill_f_round' where id_bill='$id_bill'";
    mysqli_query($con,$sql1);
    function no_to_words($no)
    {   
    $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
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
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($subtotal,2);?></td>
    </tr>  
    <tr>
    <td  style="width:80%;text-align: right;">Subtotal <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($subtotal,2);?></td>
    </tr>
    <tr>
    <td  style="width:80%;text-align: right;">SGST (<?php echo $tax;?>)% <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($Total_VAT,2);?></td>
    </tr>
    <tr>
    <td  style="width:80%;text-align: right;">CGST (<?php echo $cgst;?>)% <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($Total_VAT1,2);?></td>
    </tr>
    <?php if ($advance > 0.00) { ?>
    <tr>
    <td  style="width:80%;text-align: right;">Advance<?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($advance,2);?></td>
    </tr>
    <?php } ?>

    <?php if ($discount > 0) { ?>
    <tr>
    <td  style="width:80%;text-align: right;">Discount(<?php echo $discount;?>)% :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($discounts,2);?></td>
    </tr>

    <?php } ?>

    <tr>
    <td  style="width:80%;text-align: right;">Total Tax Amount <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($total_tax,2);?></td>
    </tr>
    <tr>

    <td  style="width:80%;text-align: right;">Total <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($total_bill_f,2);?></td>
    </tr>

    <tr>
    <td style="width:80%;"></td>
    <td style="width:20%;"> <hr></td>
    </tr>
    <tr>
    <td style="width:80%;text-align: right;">ROUND TOTAL <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"><?php echo round($total_bill_f);?></td>
    </tr>
    <tr>
    <td  style="width: 80%;text-transform: uppercase;">&nbsp;<?php echo $numbers_total;?></td>
    </tr>
    </table>
    </div>
    </page>
    <?php } ?>
    
    
    
    <?php if($status == 2 && $status != 1 ) { ?>
    
    <page  backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
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
    <?php include("invoice header_editor.php");?>
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
    <?php
    //echo $id_bill;
    $sql=mysqli_query($con,"select * from `{$portal_name}_invoices` where id_bill=$id_bill");
    $rw_user=mysqli_fetch_array($sql);
    echo $rw_user['bank_details']; ?>
    </td>
    </tr>
    </table>
    <br>
    <div class="table-responsive"  style="height: 250px; border:1px solid #333;">
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
    <tr>
    <th style="width: 10%;text-align:center" class='midnight-blue'>NO</th>
    <th style="width: 10%;text-align:center" class='midnight-blue'>COUNT</th>
    <th style="width: 25%;text-align:left" class='midnight-blue'>PRODUCT</th>
     <th style="width: 25%;text-align:left" class='midnight-blue'>DESCRIPTION</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE UNIT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE TOTAL</th>
    </tr>
    <?php
    $nums=1;
    $adder_total=0;
    $i=0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_billing_detail`, `{$portal_name}_invoices` where `{$portal_name}_products`.id_product=`{$portal_name}_billing_detail`.id_product and `{$portal_name}_billing_detail`.number_bill=`{$portal_name}_invoices`.number_bill and `{$portal_name}_invoices`.id_bill='".$id_bill."'");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_product=$row["id_product"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity'];
    $advance=$row['advance'];
    $discount=$row['discount'];
    $name_product=$row['name_product'];
    $sale_price=$row['sale_price'];
    $advance=number_format($advance,2);
    // $discount=number_format($discount,2);
    $description_product =$row['description_product'];
    $sale_price_f=number_format($sale_price,2);//Formateo variables
    $sale_price_r=str_replace(",","",$sale_price_f);//Reemplazo las comas
    $price_total=$sale_price_r*$quantity;
    $price_total_f=number_format($price_total,2);//Precio total formateado
    $price_total_r=str_replace(",","",$price_total_f);//Reemplazo las comas
    $adder_total+=$price_total_r;//Sumador

    if ($nums%2==0){
    $clase="clouds";
    } else {
    $clase="silver";
    }
    $update=mysqli_query($con,"update `{$portal_name}_billing_detail` set advance='$advance',discount='$discount' where number_bill='$number_bill'"); 
    ?>
    <tbody>
    <tr>
    <td class='' style="width: 10%; text-align: center;height:5%;border: 0px solid #dddddd;"> <?php echo ++$i;?></td>
    <td class='' style="width: 10%; text-align: center;height:5%;border: 0px solid #dddddd;"><?php echo $quantity; ?></td>
    <td class='' style="width: 25%; text-align: left; height:5%;border: 0px solid #dddddd;"><?php echo $name_product;?></td>
    <td class='' style="width: 25%; text-align: left; height:5%;border: 0px solid #dddddd;"><?php echo $description_product;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%;border: 0px solid #dddddd;"><?php echo $sale_price_f;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%;border: 0px solid #dddddd;"><?php echo $price_total_f;?></td>
    </tr>
    </tbody>
    <?php 
    $nums++;
    }
    $igst=$rw_cliente['igst'];
    //$igst=get_row("`{$portal_name}_profile`",'igst', 'id_profile', 1);
    $gst_no=get_row("`{$portal_name}_profile`",'gst_no', 'id_profile', 1);
    $value=$advance;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discount;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    $subtotal=number_format($adder_total,2,'.','');
    $discounts=( $discount* $subtotal )/100;
    $percent_igst=($subtotal * $igst )/100;
    $percent_total_igst=number_format($percent_igst,2,'.','');
    $total_igst=$subtotal+$percent_total_igst;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$total_igst-$advancediscount;
    $final_total_bill_round  = round($final_total_igst);
    $sql2="UPDATE `{$portal_name}_invoices` set total_sale='$final_total_igst',round_total='$final_total_bill_round' where id_bill='$id_bill'";
    mysqli_query($con,$sql2);
    function no_to_words($no)
    {   
    $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
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
    ?>
    </table>
    </div>
    <div style="padding-left: 10px 1px;">
    <table  style="width: 100.1%; text-align: left; font-size: 8pt;  border: 1px solid #333;">
    <tr>
    <td  style="width:80%;text-align: right;">Total Amount Before Tax <?php echo $simbolo_moneda;?> :</td>
    <td  style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($subtotal,2);?></td>
    </tr>  
    <tr>
    <td style="width:80%;text-align: right;">Subtotal <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($subtotal,2);?></td>
    </tr>
    <tr>
    <td  style="width:80%;text-align: right;">IGST (<?php echo $igst;?>)% <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($percent_total_igst,2);?></td>
    </tr>
    <?php if ($advance > 0.00) { ?>
    <tr>
    <td style="width:80%;text-align: right;">Advance<?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($advance,2);?></td>
    </tr>
    <?php } ?>
    <?php if ($discount > 0) { ?>
    <tr>
    <td  style="width:80%;text-align: right;">Discount(<?php echo $discount;?>)% :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($discounts,2);?></td>
    </tr>
    <?php } ?>
    <tr>
    <td  style="width:80%;text-align: right;">Total Tax Amount <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($percent_total_igst,2);?></td>
    </tr>
    <tr>
    <td style="width:80%;text-align: right;">Total <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($final_total_igst,2);?></td>
    </tr>
    <tr>
    <td style="width:80%;"></td>
    <td style="width:20%;"> <hr></td>
    </tr>
    <tr>
    <td  style="width:80%;text-align: right;">ROUND TOTAL <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"><?php echo round($final_total_igst);?></td>
    </tr>   
    <tr>
    <td style="width: 80%;text-transform: uppercase;">&nbsp;<?php echo $numbers_total_igst;?></td>
    </tr>
    </table>
    </div>
    </page>
    <?php } ?>        
     <?php if($status == 3 && $status != 1 && $status != 2) { ?> 
    <page  backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
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
    <?php include("invoice header_editor.php");?>
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
    <?php
    //echo $id_bill;
    $sql=mysqli_query($con,"select * from `{$portal_name}_invoices` where id_bill=$id_bill");
    $rw_user=mysqli_fetch_array($sql);
    echo $rw_user['bank_details']; ?>
    </td>
    </tr>
    </table>
    <br>
    <div class="table-responsive"  style="height: 250px; border:1px solid #333;">
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
    <tr>
    <th style="width: 10%;text-align:center" class='midnight-blue'>NO</th>
    <th style="width: 10%;text-align:center" class='midnight-blue'>COUNT</th>
    <th style="width: 25%;text-align:left" class='midnight-blue'>PRODUCT</th>
    <th style="width: 25%;text-align:left" class='midnight-blue'>DESCRIPTION</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE UNIT</th>
    <th style="width: 15%;text-align: center" class='midnight-blue'>PRICE TOTAL</th>
    </tr>
    <?php
    $nums=1;
    $adder_total=0;
    $i=0;
    $sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_billing_detail`, `{$portal_name}_invoices` where `{$portal_name}_products`.id_product=`{$portal_name}_billing_detail`.id_product and `{$portal_name}_billing_detail`.number_bill=`{$portal_name}_invoices`.number_bill and `{$portal_name}_invoices`.id_bill='".$id_bill."'");
    while ($row=mysqli_fetch_array($sql))
    {
    $id_product=$row["id_product"];
    $code_product=$row['code_product'];
    $quantity=$row['quantity'];
    $advance=$row['advance'];
    $discount=$row['discount'];
    $name_product=$row['name_product'];
    $sale_price=$row['sale_price'];
    $advance=number_format($advance,2);
    // $discount=number_format($discount,2);
    $description_product =$row['description_product'];
    $sale_price_f=number_format($sale_price,2);//Formateo variables
    $sale_price_r=str_replace(",","",$sale_price_f);//Reemplazo las comas
    $price_total=$sale_price_r*$quantity;
    $price_total_f=number_format($price_total,2);//Precio total formateado
    $price_total_r=str_replace(",","",$price_total_f);//Reemplazo las comas
    $adder_total+=$price_total_r;//Sumador
    if ($nums%2==0){
    $clase="clouds";
    } else {
    $clase="silver";
    }
    $update=mysqli_query($con,"update `{$portal_name}_billing_detail` set advance='$advance',discount='$discount' where number_bill='$number_bill'"); 
    ?>
    <tbody>
    <tr>
    <td class='' style="width: 10%; text-align: center;height:5%;border: 0px solid #dddddd;"> <?php echo ++$i;?></td>
    <td class='' style="width: 10%; text-align: center;height:5%;border: 0px solid #dddddd;"><?php echo $quantity; ?></td>
    <td class='' style="width: 50%; text-align: left; height:5%;border: 0px solid #dddddd;"><?php echo $name_product;?></td>
    <td class='' style="width: 50%; text-align: left; height:5%;border: 0px solid #dddddd;"><?php echo $description_product;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%;border: 0px solid #dddddd;"><?php echo $sale_price_f;?></td>
    <td class='' style="width: 15%; text-align: center;height:5%;border: 0px solid #dddddd;"><?php echo $price_total_f;?></td>
    </tr>
    </tbody>
    <?php 
    $nums++;
    }
    //$igst=get_row("`{$portal_name}_profile`",'igst', 'id_profile', 1);
    $gst_no=get_row("`{$portal_name}_profile`",'gst_no', 'id_profile', 1);
    $value=$advance;
    $bad_symbols = array(",");
    $advance = str_replace($bad_symbols, "", $value);
    $value1=$discount;
    $bad_symbols = array(",");
    $discount = str_replace($bad_symbols, "", $value1);
    $subtotal=number_format($adder_total,2,'.','');
    $discounts=( $discount* $subtotal )/100;
    $advancediscount = $advance+$discounts;
    $final_total_igst =$subtotal-$advancediscount;
    $final_total_bill_round  = round($final_total_igst);
    $sql2="UPDATE `{$portal_name}_invoices` set total_sale='$final_total_igst',round_total='$final_total_bill_round' where id_bill='$id_bill'";
    mysqli_query($con,$sql2);
    function no_to_words($no)
    {   
    $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
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
    ?>
    </table>
    </div>
    <div style="padding-left: 10px 1px;">
    <table  style="width: 100.1%; text-align: left; font-size: 8pt;  border: 1px solid #333;">

    <tr>
    <td style="width:80%;text-align: right;">Total <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($subtotal,2);?></td>
    </tr>

    <?php if ($advance > 0.00) { ?>
    <tr>
    <td style="width:80%;text-align: right;">Advance<?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($advance,2);?></td>
    </tr>
    <?php } ?>

    <?php if ($discount > 0) { ?>
    <tr>
    <td  style="width:80%;text-align: right;">Discount(<?php echo $discount;?>)% :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($discounts,2);?></td>
    </tr>
    <?php } ?>


    <tr>
    <td style="width:80%;text-align: right;">Subtotal <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"> <?php echo number_format($final_total_igst,2);?></td>
    </tr>

    <tr>
    <td style="width:80%;"></td>
    <td style="width:20%;"> <hr></td>
    </tr>
    <tr>
    <td  style="width:80%;text-align: right;">ROUND TOTAL <?php echo $simbolo_moneda;?> :</td>
    <td style="width:20%; text-align: right; border: 0px solid #dddddd;"><?php echo round($final_total_igst);?></td>
    </tr>   
    <tr>
    <td style="width: 80%;text-transform: uppercase;">&nbsp;<?php echo $numbers_total_igst;?></td>

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


