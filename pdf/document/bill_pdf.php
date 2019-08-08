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
    include("../../config/db.php");
    include("../../config/Connection.php");
    include("../../funcions.php");
    $portal_name =  $_SESSION['portal_name'];
    $session_id= session_id();
    $sql_count=mysqli_query($con,"select * from `{$portal_name}_tmp` where session_id='".$session_id."'");
    $count=mysqli_num_rows($sql_count);
    if ($count==0)
    {
    echo "<script>alert('No products added to the products bill')</script>";
    echo "<script>window.close();</script>";
    exit;
    }
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    $id_client=intval($_GET['id_client']);
    $id_salesman=intval($_GET['id_salesman']);
    $bank_details=$_GET['bank_details'];
    $state_bill=$_GET['state_bill'];
     $goods_service_id=$_GET['goods_service_id'];
     $status=$_GET['status'];
     $cgst_client=$_GET['cgst'];
     $tax_client=$_GET['tax'];
     $igst_client=$_GET['igst'];
     $bill_date=$_GET['bill_date'];
     
    $terms=mysqli_real_escape_string($con,(strip_tags($_REQUEST['terms'], ENT_QUOTES)));
    //$sql=mysqli_query($con, "select LAST_INSERT_ID(number_bill) as last from `{$portal_name}_invoices` WHERE MONTH(date_bill) = MONTH(CURRENT_DATE())order by id_bill desc limit 0,1 ");
    $sql=mysqli_query($con, "select LAST_INSERT_ID(number_bill) as last from `{$portal_name}_invoices` order by id_bill desc limit 0,1 ");
    $rw=mysqli_fetch_array($sql);
    $number_bill=$rw['last']+1;	
    $simbolo_moneda=get_row("`{$portal_name}_profile`",'currency', 'id_profile', 1);
 ob_start();
 include(dirname('__FILE__').'/res/bill_html.php');
$content = ob_get_clean();

try
{
    $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('virran_invoice"'.date('d-m-y').'".pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
