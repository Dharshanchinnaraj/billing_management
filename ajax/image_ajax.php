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
    /* Connect To Database*/
    require_once ("../config/db.php");
    require_once ("../config/Connection.php");
    $portal_name =  $_SESSION['portal_name'];
    if (isset($_FILES["imagefile"])){
    $target_dir="../img/";
    $image_name = time()."_".basename($_FILES["imagefile"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imageFileZise=$_FILES["imagefile"]["size"];
    if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) and $imageFileZise>0) {
    $errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
    } else if ($imageFileZise > 1048576) {
    $errors[]= "<p>We are sorry, but the file is too large. Select less than 1MB logo</p>";
    }  else
{
    if ($imageFileZise>0){
            move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
            $logo_update="logo_url='img/$image_name' ";

    }	else { $logo_update="";}
        $sql = "UPDATE `{$portal_name}_profile` SET $logo_update WHERE id_profile='1';";
        $query_new_insert = mysqli_query($con,$sql);


        if ($query_new_insert) {
            ?>
            <img class="img-responsive" src="img/<?php echo $image_name;?>" alt="Logo">
            <?php
        } else {
            $errors[] = "Sorry, update failed. Try again. ".mysqli_error($con);
        }
            }
    }			
    ?>
    <?php 
            if (isset($errors)){
    ?>
            <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error! </strong>
            <?php
                    foreach ($errors as $error){
                            echo $error;
                    }
            ?>
            </div>	
    <?php
                    }
    ?>
