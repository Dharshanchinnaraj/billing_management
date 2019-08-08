<?php


if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{

$fetch = mysqli_query($con,"SELECT * FROM `{$portal_name}_client` where name_client like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50");

/* Retrieve and store in array the results of the query.*/
while ($row = mysqli_fetch_array($fetch)) {
$id_client=$row['id_client'];
$row_array['value'] = $row['name_client'];
$row_array['id_client']=$id_client;
$row_array['name_client']=$row['name_client'];
$row_array['phone_client']=$row['phone_client'];
$row_array['email_client']=$row['email_client'];
$row_array['status1']=$row['status'];
$row_array['tax']=$row['tax'];
$row_array['cgst']=$row['cgst'];
$row_array['igst']=$row['igst'];

array_push($return_arr,$row_array);
    }

}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>