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
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$return_arr = array();

if ($con)
{

$fetch = mysqli_query($con,"SELECT * FROM `{$portal_name}_client` where name_client like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
while ($row = mysqli_fetch_array($fetch)) {
$id_client=$row['id_client'];
$row_array['value'] = $row['name_client'];
$row_array['id_client']=$id_client;
$row_array['name_client']=$row['name_client'];
$row_array['phone_client']=$row['phone_client'];
$row_array['email_client']=$row['email_client'];
array_push($return_arr,$row_array);
}

}

mysqli_close($con);
echo json_encode($return_arr);

}
?>