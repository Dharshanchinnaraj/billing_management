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

//echo $_POST['gst_type']; die();
if (empty($_POST['company_name'])) {
$errors[] = "Company name is empty";
}else if (empty($_POST['phone'])) {
$errors[] = "Phone is empty";
} else if (empty($_POST['email'])) {
$errors[] = "E-mail is empty";
} else if (empty($_POST['currency'])) {
$errors[] = "currency is empty";
} else if (empty($_POST['address'])) {
$errors[] = "address is empty";
}  else if (empty($_POST['pan_number'])) {
$errors[] = "Pan number is empty";
} else if (empty($_POST['bank_details'])) {
$errors[] = "bank details is empty";
}else if (empty($_POST['city'])) {
$errors[] = "city is empty";
}   else if (
            !empty($_POST['company_name']) &&
            !empty($_POST['phone']) &&
            !empty($_POST['email']) &&
            !empty($_POST['currency']) &&
            !empty($_POST['address']) &&
            !empty($_POST['city']) &&
             !empty($_POST['pan_number']) &&
              !empty($_POST['bank_details']) &&
            !empty($_POST['product_type'])
    ){
    /* Connect To Database*/
    require_once ("../config/db.php");
    require_once ("../config/Connection.php");
    $portal_name =  $_SESSION['portal_name'];
    $company_name=mysqli_real_escape_string($con,(strip_tags($_POST["company_name"],ENT_QUOTES)));
    $phone=mysqli_real_escape_string($con,(strip_tags($_POST["phone"],ENT_QUOTES)));
    $email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
    $currency=mysqli_real_escape_string($con,(strip_tags($_POST["currency"],ENT_QUOTES)));
    $address=mysqli_real_escape_string($con,(strip_tags($_POST["address"],ENT_QUOTES)));
    $city=mysqli_real_escape_string($con,(strip_tags($_POST["city"],ENT_QUOTES)));
    $state=mysqli_real_escape_string($con,(strip_tags($_POST["state"],ENT_QUOTES)));
    $postal_code=mysqli_real_escape_string($con,(strip_tags($_POST["postal_code"],ENT_QUOTES)));
    $gst_no=mysqli_real_escape_string($con,(strip_tags($_POST["gst_no"],ENT_QUOTES)));
    $product_type=mysqli_real_escape_string($con,(strip_tags($_POST["product_type"],ENT_QUOTES)));
    $client_prefix=mysqli_real_escape_string($con,(strip_tags($_POST["client_prefix"],ENT_QUOTES)));
    $subject=mysqli_real_escape_string($con,(strip_tags($_POST["subject"],ENT_QUOTES)));
    $pan_number=mysqli_real_escape_string($con,(strip_tags($_POST["pan_number"],ENT_QUOTES)));
    $bank_details=mysqli_real_escape_string($con,(strip_tags($_POST["bank_details"],ENT_QUOTES)));
   $gst_type=mysqli_real_escape_string($con,(strip_tags($_POST["gst_type"],ENT_QUOTES)));

   $sql="UPDATE `{$portal_name}_profile` SET company_name='".$company_name."', phone='".$phone."', email='".$email."', currency='".$currency."', address='".$address."', city='".$city."', state='".$state."', gst_no='".$gst_no."', postal_code='".$postal_code."', product_type='".$product_type."',client_prefix='".$client_prefix."',subject = '".$subject."',pan_number='".$pan_number."',bank_details='".$bank_details."',gst_type='".$gst_type."',status = '1' WHERE id_profile='1'";

    $query_update = mysqli_query($con,$sql);
      
    
    if ($query_update){
                    $messages[] = "Data has been updated successfully.";
            }
            else{
                    $errors []= "Sorry something went wrong try again.".mysqli_error($con);
            }
    } else {
            $errors []= "unknown Error.";
    }
    if (isset($errors)){
            ?>
            <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>

            <?php
            foreach ($errors as $error) 
                {
                echo $error;
                }
            ?>
                </div>
            <?php
            }
            if (isset($messages)){

            ?>
            <div class="alert alert-success" role="alert" style="width:270px;margin: -43px 168px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>

            <?php
            foreach ($messages as $message) 
                {
                echo $message;
                }
            ?>
                </div>
            <?php
            }

?>