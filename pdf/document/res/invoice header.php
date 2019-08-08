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
$portal_name =  $_SESSION['portal_name'];
if ($con){
$date=date("Ymd");


  $query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
    $row=mysqli_fetch_array($query_empresa);
    $client_prefix=$row["client_prefix"];  
    ?>
<table style="width: 100%; p.inset {border-style: inset;}">
    <tr>
        <td style="width: 100%;text-align:right ">
            
           
        </td>
    </tr>
</table>

<div style="border:1px solid #333;margin-top: 5px;margin-bottom: -19px; margin-right:3px ">
    <h5>&nbsp;GST IN :<?php echo  $gst_no=get_row("`{$portal_name}_profile`",'gst_no', 'id_profile', 1);?></h5>
          <?php
$sql=mysqli_query($con, "select * from `{$portal_name}_products`, `{$portal_name}_tmp` where `{$portal_name}_products`.id_product=`{$portal_name}_tmp`.id_product and `{$portal_name}_tmp`.session_id='".$session_id."'");
  
 while ($row=mysqli_fetch_array($sql))
    {
        
    $invoice_nos=$row['invoice_nos'];
  
    ?>
    <p style="text-align: right;margin-top: -34px;font-size: 12px;padding: 5px"><b>INVOICES BILL NO:
        
  
   <?php
         if(!empty($row['invoice_nos'])){
             echo $invoice_nos = $row['invoice_nos'];
         } else{
             
             echo $client_prefix.$date.$number_bill;
         }
   
        
        ?></b></p>
    <?php } ?>
<br><br>

<table  style="width: 100%;padding: 5px">
    <tr>
    <td style="width: 10%; color: #444444;">
        <img style="width: 100%;" src="../../<?php echo get_row("`{$portal_name}_profile`",'logo_url', 'id_profile', 1);?>" alt="Logo"><br>
    </td>

    <td style="width: 90%; color: #34495e;font-size:12px;text-align:right">
        <span style="color: #34495e;font-size:14px;font-weight:bold;text-transform: uppercase;"><?php echo get_row("`{$portal_name}_profile`",'company_name', 'id_profile', 1);?>&nbsp;</span>
        <br><?php echo get_row("`{$portal_name}_profile`",'address', 'id_profile', 1).", ". get_row("`{$portal_name}_profile`",'city', 'id_profile', 1)." ".get_row("`{$portal_name}_profile`",'state', 'id_profile', 1);?>&nbsp;<br> 
        Phone: <?php echo get_row("`{$portal_name}_profile`",'phone', 'id_profile', 1);?>&nbsp;<br>
        Email: <?php echo get_row("`{$portal_name}_profile`",'email', 'id_profile', 1);?>&nbsp;
    </td>
    </tr>
</table>
</div>

<?php }?>	