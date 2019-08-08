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
        if (empty($_POST['firstname'])){
                $errors[] = "empty names";
        } elseif (empty($_POST['lastname'])){
                $errors[] = "empty lastnames";
        }  elseif (empty($_POST['user_name'])) {
    $errors[] = "Empty username";
} elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
    $errors[] = "empty password";
} elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
    $errors[] = "password and repeat password are not the same";
} elseif (strlen($_POST['user_password_new']) < 6) {
    $errors[] = "The password must be at least 6 characters";
} elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
    $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
} elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
    $errors[] = "Username does not fit the scheme name: Only aZ and numbers are allowed, 2 to 64 characters";
} elseif (empty($_POST['user_email'])) {
    $errors[] = "Email can not be empty";
} elseif (strlen($_POST['user_email']) > 64) {
    $errors[] = "Email can not exceed 64 characters";
} elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Your email address is not in a valid email format";
} elseif (
            !empty($_POST['user_name'])
            && !empty($_POST['firstname'])
            && !empty($_POST['lastname'])
&& strlen($_POST['user_name']) <= 64
&& strlen($_POST['user_name']) >= 2
&& preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
&& !empty($_POST['user_email'])
&& strlen($_POST['user_email']) <= 64
&& filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
&& !empty($_POST['user_password_new'])
&& !empty($_POST['user_password_repeat'])
&& ($_POST['user_password_new'] === $_POST['user_password_repeat'])
) {
    require_once ("../config/db.php");
            require_once ("../config/Connection.php");  
            $portal_name =  $_SESSION['portal_name'];
    $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["firstname"],ENT_QUOTES)));
                    $lastname = mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
                    $user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name"],ENT_QUOTES)));
    $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["user_email"],ENT_QUOTES)));
                    $user_password = $_POST['user_password_new'];
                    $date_added=date("Y-m-d H:i:s");
                    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM `{$portal_name}_users` WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
    $query_check_user_name = mysqli_query($con,$sql);
                    $query_check_user=mysqli_num_rows($query_check_user_name);
    if ($query_check_user == 1) {
        $errors[] = "We are sorry ,the user name or e-mail address is already in use.";
    } else {
        $sql = "INSERT INTO `{$portal_name}_users` (firstname, lastname, user_name, user_password_hash, user_email, date_added)
                VALUES('".$firstname."','".$lastname."','" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "','".$date_added."');";
        $query_new_user_insert = mysqli_query($con,$sql);
        if ($query_new_user_insert) {
            $messages[] = "The account has been successfully created.";
        } else {
            $errors[] = "Sorry something went wrong try again.";
        }
        }

} else {
    $errors[] = "unknown Error.";
}

if (isset($errors)){

    ?>
    <div class="alert alert-danger" role="alert" style="width: 410px;">
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
    <div class="alert alert-success" role="alert" style="width: 410px;">
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