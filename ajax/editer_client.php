<?php
	//include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
        
       
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID empty";
        }else if (empty($_POST['mod_name'])) {
           $errors[] = "empty name";
        }  else if ($_POST['mod_state']==""){
			$errors[] = "Select client status";
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_name']) &&
			$_POST['mod_state']!="" 
		)
                    
                    {
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/Connection.php");//Contiene funcion que conecta a la base de datos
		 $portal_name =  $_SESSION['portal_name'];
                // escaping, additionally removing everything that could be (html/javascript-) code
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["mod_name"],ENT_QUOTES)));
		$phone=mysqli_real_escape_string($con,(strip_tags($_POST["mod_phone"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$address=mysqli_real_escape_string($con,(strip_tags($_POST["mod_address"],ENT_QUOTES)));
		
		                 $state=intval($_POST['mod_state']);
    
	//////////////////	
                
        $id_client=intval($_POST['mod_id']);
        $sTable = "`{$portal_name}_products`";
$sWhere = "";
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$gst_type=$row["gst_type"];   
 //////////////////////////////////////
                             
                
                 if($gst_type==0){
               
                $gst_number_client=mysqli_real_escape_string($con,(strip_tags($_POST["mod_gst_number_client"],ENT_QUOTES)));

             //    $status=mysqli_real_escape_string($con,(strip_tags($_POST["mod_status"],ENT_QUOTES)));
              $status=mysqli_real_escape_string($con,(strip_tags($_POST["mod_status"],ENT_QUOTES)));
                $tax=mysqli_real_escape_string($con,(strip_tags($_POST["mod_tax"],ENT_QUOTES)));
                $cgst=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cgst"],ENT_QUOTES)));
                $igst=mysqli_real_escape_string($con,(strip_tags($_POST["mod_igst"],ENT_QUOTES)));
		
                
		$sql="UPDATE `{$portal_name}_client` SET name_client='".$name."', phone_client='".$phone."', email_client='".$email."', address_client='".$address."', status_client='.$state.',gst_number_client='".$gst_number_client."',status='".$status."',tax='".$tax."',cgst='".$cgst."',igst='".$igst."' WHERE id_client='".$id_client."'";
		$query_update = mysqli_query($con,$sql);
                
			if ($query_update){
				$messages[] = "Client has been updated successfully.";
			} else{
				$errors []= "Sorry something went wrong try again.".mysqli_error($con);
			}
		} 
 else {
     
   	$sql="UPDATE `{$portal_name}_client` SET name_client='".$name."', phone_client='".$phone."', email_client='".$email."', address_client='".$address."', status_client='.$state.' WHERE id_client='".$id_client."'";
        $query_update = mysqli_query($con,$sql);
                
			if ($query_update){
				$messages[] = "Client has been updated successfully.";
			} else{
				$errors []= "Sorry something went wrong try again.".mysqli_error($con);
			}  
 }
                
                }else {
			$errors []= "unknown Error.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert" style="width: 361px;">
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
				<div class="alert alert-success" role="alert" style="width: 361px;">
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