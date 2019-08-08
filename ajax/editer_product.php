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
if (empty($_POST['mod_id'])) {
$errors[] = "ID empty";
}else if (empty($_POST['mod_code'])) {
$errors[] = "code empty";
} else if (empty($_POST['mod_name'])){
    $errors[] = "Name empty product";
} else if ($_POST['mod_state']==""){
    $errors[] = "Select the product status";
} 
else if ($_POST['mod_des']==""){
    $errors[] = "Select the product description";
} 

else if (empty($_POST['mod_price'])){
    $errors[] = "Empty price sale";
} 
else if (
    !empty($_POST['mod_id']) &&
    !empty($_POST['mod_code']) &&
    !empty($_POST['mod_name']) &&
    $_POST['mod_state']!="" &&
    !empty($_POST['mod_price'])
){
require_once ("../config/db.php");
require_once ("../config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$code=mysqli_real_escape_string($con,(strip_tags($_POST["mod_code"],ENT_QUOTES)));
$name=mysqli_real_escape_string($con,(strip_tags($_POST["mod_name"],ENT_QUOTES)));
$description=mysqli_real_escape_string($con,(strip_tags($_POST["mod_des"],ENT_QUOTES)));
$state=intval($_POST['mod_state']);
$price=floatval($_POST['mod_price']);
//$stack=intval($_POST['mod_stack']);
if(isset($_POST['mod_stack'])){
$stack=$_POST['mod_stack'];
}else{
$stack = 0;
}
$id_product=$_POST['mod_id'];
$sql="UPDATE `{$portal_name}_products` SET code_product='".$code."', name_product='".$name."',description_product='".$description."', status_product='".$state."', price_product='".$price."', stack='".$stack."' WHERE id_product='".$id_product."'";
$query_update = mysqli_query($con,$sql);
    if ($query_update){
            $messages[] = "Product has been updated successfully."; ?>
            
                <script>
    $('#close_edit_product').click();
    </script>
            
  <?php  } else{
            $errors []= "Sorry something went wrong try again.".mysqli_error($con);
    }
} else {
    $errors []= "unknown Error.";
}

if (isset($errors)){

    ?>
    <div class="alert alert-danger" role="alert" style="width: 385px;">
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
            <div class="alert alert-success" role="alert" style="width: 385px;">
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