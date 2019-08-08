<?php 
/*
 * Author        :   BARATHI/KARPAGAM
 * Date          :   03-07-2019
 * Modified      :   
 * Modified By   :   
 * Description   :  
 */


//echo $portal_name;die();
?>
<?php
if (empty($_POST['code'])) {
$errors[] = "Empty code";
} else if (empty($_POST['name'])){
            $errors[] = "Name Empty product";
    } else if ($_POST['state']==""){
            $errors[] = "Select the product status";
    } else if (empty($_POST['price'])){
            $errors[] = " Empty price sale";
                 } 
    else if (
            !empty($_POST['code']) &&
            !empty($_POST['name']) &&
            $_POST['state']!="" &&
            !empty($_POST['price'])
){
    /* Connect To Database*/
    require_once ("../config/db.php");
    require_once ("../config/Connection.php");
    $portal_name =  $_SESSION['portal_name'];
    $code=mysqli_real_escape_string($con,(strip_tags($_POST["code"],ENT_QUOTES)));
    $name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
    $description=mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
    
    $state=intval($_POST['state']);
    $price=floatval($_POST['price']);
    $date_added=date("Y-m-d");
    $product_type_code=$_POST['product_type_code'];
    $product_type_id = intval($_POST['product_type_id']);
     if(isset($_POST['stack'])){
 $stack=$_POST['stack'];
}else{
if($product_type_id = 2){
     $stack = 0;
}else{
 $stack = 0;
}
}


$sql="INSERT INTO `{$portal_name}_products` (code_product, name_product,description_product, status_product, date_added, price_product,stack,goods_service) VALUES ('$code','$name','$description','$state','$date_added','$price','$stack','$product_type_code')";

$query_new_insert = mysqli_query($con,$sql);
        if ($query_new_insert){
                $messages[] = "Product has been entered successfully."; ?>
                
    <script>
    $('#close_product').click();
    </script>
    
       <?php } else{
                $errors []= "Sorry something went wrong try again.".mysqli_error($con);
        }
} else {
        $errors []= "unknown Error.";
}
    if (isset($errors)){
    ?>
    <div class="alert alert-danger" role="alert" style="width: 368px;">
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
    if (isset($messages))
    {
    ?>
    <div class="alert alert-success" role="alert" style="width: 368px;">
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