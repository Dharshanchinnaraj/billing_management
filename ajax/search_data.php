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
include('is_logged.php');
/* Connect To Database*/
require_once ("../config/db.php");
require_once ("../config/Connection.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
 $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
          $sTable = "`{$portal_name}_products`";
         $sWhere = "";
         if (isset($__POST["submit"])) {
   $from_date=($_POST['from_date']);
                $to_date=($_POST['to_date']);
                 }
        include 'pagination.php'; 
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM products  ");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './data.php';
         if (isset($__POST["submit"])) {
                 $sql="SELECT * FROM `products` WHERE (date_added BETWEEN $from_date AND $to_date) ";
                echo $from_date;
         }
         else
         {
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page ";
         }
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
                echo mysqli_error($con);
                ?>
                <div class="table-responsive">
                  <table class="table" >
                        <tr  class="red">
                                <th>Product ID</th>
                                <th>Date</th>
                                <th>Product code</th>
                                <th>Product name</th>
                                <th>State</th>
                                <th class='text-right'>Price of product</th>


                        </tr>
                        <?php
                        while ($row=mysqli_fetch_array($query)){
                                        $id_producto=$row['id_producto'];
                                        $codigo_producto=$row['codigo_producto'];
                                        $fecha=date("d/m/Y", strtotime($row['date_added']));
                                        $nombre_producto=$row['nombre_producto'];
                                        $status_producto=$row['status_producto'];
                                        $precio_producto=$row['precio_producto'];

                                ?>
                                <tr>
                                        <td><?php echo $id_producto; ?></td>
                                    <td><?php echo $fecha; ?></td>
                                        <td><?php echo $codigo_producto; ?></td>
                                        <td><?php echo $nombre_producto; ?></td>
                                        <td><?php echo $status_producto; ?></td>
                                    <td><?php echo $precio_producto; ?></td>
                                </tr>
                                <?php
                        }
                        ?>
                         </table>
                        <tr>
                                <td colspan=7><span class="pull-right"><?php
                                 echo paginate($reload, $page, $total_pages, $adjacents);
                                ?></span></td>
                        </tr>

                </div>
                <?php
        }
	}
?>