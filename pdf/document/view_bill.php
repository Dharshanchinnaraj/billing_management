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
    include("../../config/db.php");
    include("../../config/Connection.php");
    include("../../funcions.php");
    $portal_name =  $_SESSION['portal_name'];
    $id_bill= intval($_GET['id_bill']);
    $sql_count=mysqli_query($con,"select * from `{$portal_name}_invoices` where id_bill='".$id_bill."'");
    $count=mysqli_num_rows($sql_count);
    if ($count==0)
    {
    echo "<script>alert('Invoice not found')</script>";
    echo "<script>window.close();</script>";
    exit;
    }
    $sql_bill=mysqli_query($con,"select * from `{$portal_name}_invoices` where id_bill='".$id_bill."'");
    $rw_bill=mysqli_fetch_array($sql_bill);
    $number_bill=$rw_bill['number_bill'];
    $id_client=$rw_bill['id_client'];
    $id_salesman=$rw_bill['id_salesman'];
    $date_bill=$rw_bill['date_bill'];
    $terms=$rw_bill['terms'];
    $simbolo_moneda=get_row("`{$portal_name}_profile`",'currency', 'id_profile', 1);
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
 ob_start();
 include(dirname('__FILE__').'/res/view_bill_html.php');
$content = ob_get_clean();

try
{
    $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Virran_invoice"'.date('d-m-y h:i:sa').'".pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
