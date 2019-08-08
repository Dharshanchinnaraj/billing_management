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
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
  require_once("../libraries/password_compatibility_library.php");
}		
    if (empty($_POST['firstname2'])){
            $errors[] = "empty name";
    } elseif (empty($_POST['lastname2'])){
            $errors[] = "empty lastname";
    }  elseif (empty($_POST['user_name2'])) {
        $errors[] = "Empty username";
        }  elseif (strlen($_POST['user_name2']) > 64 || strlen($_POST['user_name2']) < 2) {
        $errors[] = "Username can not be less than 2 or more than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])) {
        $errors[] = "Username does not fit the scheme name: Only aZ and numbers are allowed, 2 to 64 characters";
        } elseif (empty($_POST['user_email2'])) {
        $errors[] = "Email can not be empty";
        } elseif (strlen($_POST['user_email2']) > 64) {
        $errors[] = "Email can not exceed 64 characters";
        } elseif (!filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Your email address is not in a valid email format";
        } elseif (
                    !empty($_POST['user_name2'])
                    && !empty($_POST['firstname2'])
                    && !empty($_POST['lastname2'])
        && strlen($_POST['user_name2']) <= 64
        && strlen($_POST['user_name2']) >= 2
        && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])
        && !empty($_POST['user_email2'])
        && strlen($_POST['user_email2']) <= 64
        && filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)
        )
        {
        require_once ("../config/db.php");
                    require_once ("../config/Connection.php");
                    $portal_name =  $_SESSION['portal_name'];
    $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["firstname2"],ENT_QUOTES)));
                    $lastname = mysqli_real_escape_string($con,(strip_tags($_POST["lastname2"],ENT_QUOTES)));
                    $user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name2"],ENT_QUOTES)));
    $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["user_email2"],ENT_QUOTES)));
        $user_id=intval($_POST['mod_id']);
        $sql = "UPDATE `{$portal_name}_users` SET firstname='".$firstname."', lastname='".$lastname."', user_name='".$user_name."', user_email='".$user_email."'
                WHERE user_id='".$user_id."';";
        $query_update = mysqli_query($con,$sql);
        if ($query_update) {
            $messages[] = "The account has been successfully modified.";
        } else {
            $errors[] = "Sorry, registration failed. Please go back and try again.";
        }
} else {
$errors[] = "An unknown error occurred.";
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