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
if (empty($_POST['name'])) {
   $errors[] = "empty name";
} else if (!empty($_POST['name'])){
    /* Connect To Database*/
    require_once ("../config/db.php");
    require_once ("../config/Connection.php");
    $portal_name =  $_SESSION['portal_name'];
    $name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
    $phone=mysqli_real_escape_string($con,(strip_tags($_POST["phone"],ENT_QUOTES)));
    $email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
    $address=mysqli_real_escape_string($con,(strip_tags($_POST["address"],ENT_QUOTES)));
  
    $date_added=date("Y-m-d H:i:s");
     
      $state=intval($_POST['state']);
    
    $sTable = "`{$portal_name}_products`";
$sWhere = "";
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$gst_type=$row["gst_type"];   


      if($gst_type==0){
      $gst_number_client=mysqli_real_escape_string($con,(strip_tags($_POST["gst_number_client"],ENT_QUOTES)));
    
      $status=mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));   
 $tax=mysqli_real_escape_string($con,(strip_tags($_POST["tax"],ENT_QUOTES)));
    $cgst=mysqli_real_escape_string($con,(strip_tags($_POST["cgst"],ENT_QUOTES)));
    $igst=mysqli_real_escape_string($con,(strip_tags($_POST["igst"],ENT_QUOTES)));
    
 
    $sql="INSERT INTO `{$portal_name}_client` (name_client, phone_client, email_client, address_client, status_client, date_added,gst_number_client,status,tax,cgst,igst) VALUES ('$name','$phone','$email','$address','$state','$date_added','$gst_number_client','$status','$tax','$cgst','$igst')";
    $query_new_insert = mysqli_query($con,$sql);
            if ($query_new_insert){
                    $messages[] = "Client has been entered successfully.";
            } else{
                    $errors []= "Sorry something went wrong try again.".mysqli_error($con);
            }
    } 
 else {
         
    $sql="INSERT INTO `{$portal_name}_client` (name_client, phone_client, email_client, address_client, status_client, date_added) VALUES ('$name','$phone','$email','$address','$state','$date_added')";
    $query_new_insert = mysqli_query($con,$sql);
            if ($query_new_insert){
                    $messages[] = "Client has been entered successfully.";
            } else{
                    $errors []= "Sorry something went wrong try again.".mysqli_error($con);
            }  
    }
    
 } 
    else {
            $errors []= "unknown Error.";
    }

    if (isset($errors)){
            ?>
            <div class="alert alert-danger" role="alert" style="width: 361px;">
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
                    <div class="alert alert-success" role="alert" style="width: 361px;">
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