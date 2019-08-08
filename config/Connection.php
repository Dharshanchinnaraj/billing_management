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
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("Unable to connect: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connection failure: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>
