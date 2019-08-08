
<?php 
require_once ("../config/db.php");
require_once ("../config/Connection.php");
$portal_name =  $_SESSION['portal_name'];

 
  if(isset($_POST['status'])){
        $status = $_POST['status'];
         $cgst = $_POST['cgst'];
          $tax = $_POST['tax'];
           $igst = $_POST['igst'];
            $session_ids = $_POST['session_ids'];
        $insert_detail=mysqli_query($con, "INSERT INTO `{$portal_name}_tax_storage`(`gst_value`,`tax`,`cgst`,`igst`,`session_ids`) VALUES  ('$status','$tax','$cgst','$igst','$session_ids')");
        
        }
?>