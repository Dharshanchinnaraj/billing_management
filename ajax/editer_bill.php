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
    require_once ("../config/db.php");
    require_once ("../config/Connection.php");
      $portal_name =  $_SESSION['portal_name'];
  
    $id_bill= $_SESSION['id_bill'];
    if (empty($_POST['id_client'])) {
    $errors[] = "ID empty";
    }else if (empty($_POST['id_salesman'])) {
    $errors[] = "Select the seller";
    }
    else if (empty($_POST['terms'])){
    $errors[] = "Select a payment method";
    } 
    else if ($_POST['state_bill']==""){
    $errors[] = "Select the invoice status";
    }
    
    else if (
    !empty($_POST['id_client']) &&
    !empty($_POST['id_salesman']) &&
    !empty($_POST['terms']) &&
    $_POST['state_bill']!="" 
    ){

    
        $id_client=intval($_POST['id_client']);
        $id_salesman=intval($_POST['id_salesman']);
        $terms=intval($_POST['terms']);
        $invoice_nos=$_POST['invoice_nos'];
       
      $due_date =$_POST['d_date'];
        $po_nos=$_POST['po_nos'];
        $date_bill=$_POST['date_bill'];

        $state_bill=intval($_POST['state_bill']);
        //$bank_details=$_POST['bank_details'];
        if(isset($_POST['bank_details'])){
             $bank_details=$_POST['bank_details'];
        }
            else{
             $bank_details = "";
        }

        $sql="UPDATE `{$portal_name}_invoices` SET id_client='".$id_client."', id_salesman='".$id_salesman."', terms='".$terms."', state_bill='".$state_bill."',bank_details='".$bank_details."',invoice_nos='".$invoice_nos."',due_date='".$due_date."' ,po_no='".$po_nos."',date_bill='".$date_bill."'  WHERE id_bill='".$id_bill."'";
       
        
        $query_update = mysqli_query($con,$sql);
        if ($query_update){
        $messages[] = "Invoice has been successfully updated.";
        } else{
        $errors []= "Sorry something went wrong try again.".mysqli_error($con);
        }
        } else {
        $errors []= "unknown Error.";
        }

        if (isset($errors)){

?>
    <div class="alert alert-danger" role="alert" style="width: 280px;margin-top: 9px;margin-left: 19px;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>

<?php
    foreach ($errors as $error) {
    echo $error;
    }
?>
    </div>
<?php
    }
    if (isset($messages)){
?>
    <div class="alert alert-success" role="alert" style="width: 280px;margin-top: 9px;margin-left: 19px;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>

<?php
    foreach ($messages as $message) {
    echo $message;
    }
?>
    </div>
<?php
}
?>