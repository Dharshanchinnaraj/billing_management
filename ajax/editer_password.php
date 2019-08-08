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
    if (empty($_POST['user_id_mod'])){
    $errors[] = "ID empty";
    }  elseif (empty($_POST['user_password_new3']) || empty($_POST['user_password_repeat3'])) {
    $errors[] = "empty password";
    } elseif ($_POST['user_password_new3'] !== $_POST['user_password_repeat3']) {
    $errors[] = "password and repeat password are not the same";
    }  elseif (
    !empty($_POST['user_id_mod'])
    && !empty($_POST['user_password_new3'])
    && !empty($_POST['user_password_repeat3'])
    && ($_POST['user_password_new3'] === $_POST['user_password_repeat3'])
    ) {
        require_once ("../config/db.php");
        require_once ("../config/Connection.php");
        $portal_name =  $_SESSION['portal_name'];
    $user_id=intval($_POST['user_id_mod']);
    $user_password = $_POST['user_password_new3'];
    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
    $sql = "UPDATE `{$portal_name}_users` SET user_password_hash='".$user_password_hash."' WHERE user_id='".$user_id."'";
    $query = mysqli_query($con,$sql);
    if ($query) {
    $messages[] = "password has been changed successfully.";
    } else {
    $errors[] = "Sorry, registration failed. Please go back and try again.";
    }
    } else {
    $errors[] = "An unknown error occurred.";
    }
        if (isset($errors)){
        ?>
        <div class="alert alert-danger" role="alert">
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
        <div class="alert alert-success" role="alert" >
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