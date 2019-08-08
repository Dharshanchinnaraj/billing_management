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
if(isset($_POST['delete_temps']))
{
$delete_temps = $_POST['delete_temps'];
echo  $sql = "DELETE FROM `{$portal_name}_tmp`";   
if (mysqli_query($con, $sql))
{
$response[] = array("report"=>200);
} else
{
$response[] = array("report"=>400);
}
echo json_encode($response);   

}


