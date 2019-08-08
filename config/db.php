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

session_start();
 $portal_name =  $_SESSION['portal_name'];
define('DB_HOST', 'localhost');
define('DB_USER', 'virranpr_oduct');
define('DB_PASS', 'virranpr_oduct@123a');
define('DB_NAME', 'virranpr_oduct');

if(strstr($_SERVER['HTTP_HOST'],'uat.virranproducts.com')){
$_SERVER['HTTP_HOST'] = 'uat.virranproducts.com';
define('SITE_URL_LOGOUTS','https://'.$_SERVER['HTTP_HOST']."/$portal_name/virran_invoice/logout.php");

}

else if(strstr($_SERVER['HTTP_HOST'],'virranproducts.com')){
$_SERVER['HTTP_HOST'] = 'virranproducts.com';
define('SITE_URL_LOGOUTS','https://'.$_SERVER['HTTP_HOST']."/$portal_name/virran_invoice/logout.php");

}
else{
define('SITE_URL_LOGOUTS','http://'.$_SERVER['HTTP_HOST']."/virranbrand/$portal_name/virran_invoice/logout.php");
}
if(strstr($_SERVER['HTTP_HOST'],'uat.virranproducts.com')){
$_SERVER['HTTP_HOST'] = 'uat.virranproducts.com';
define('SITE_URL','https://'.$_SERVER['HTTP_HOST']."/$portal_name/virran_invoice/");

}
else if(strstr($_SERVER['HTTP_HOST'],'virranproducts.com')){
$_SERVER['HTTP_HOST'] = 'virranproducts.com';
define('SITE_URL','https://'.$_SERVER['HTTP_HOST']."/$portal_name/virran_invoice/");

}
else{
define('SITE_URL','http://'.$_SERVER['HTTP_HOST']."/virranbrand/$portal_name/virran_invoice/");
}
?>
