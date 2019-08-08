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
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$product_type=$row["product_type"];    
 ?>


<div class="alert " role="alert" style="width: 260px;margin-bottom: 8px;margin-left: 22px;margin-top: 29px;"><span id="Error_Msg"></span><span id="Sucess_Msg"></span></div> 
<?php
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
 $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('code_product', 'name_product');//Columnas de busqueda
         $sTable = "`{$portal_name}_products`";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
                $sWhere = "WHERE (";
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                        $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
                }
                $sWhere = substr_replace( $sWhere, "", -3 );
                $sWhere .= ')';
        }
        include 'pagination.php'; 
        //pagination variables
        

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 5; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  where goods_service =$product_type");
       
        $row= mysqli_fetch_array($count_query);
        
       $numrows = $row['numrows'];
        
        $total_pages = ceil($row['numrows']/$per_page);
        
        $reload = './index.php';
      $sql="SELECT * FROM  $sTable where goods_service =$product_type LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        if ($numrows>0){
            ?>
            <div class="table-responsive">
              <table class="table" style="margin-left: 22px;width: 93%;">
                    <tr  class="red">
                            <th>Code</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th><span class="pull-right">Count</span></th>
                            <th><span class="pull-right">Price</span></th>
                            <th class='text-center' style="width: 36px;">Add</th>

                    </tr>
                    <?php
                    while ($row=mysqli_fetch_array($query)){
                            $id_product=$row['id_product'];
                            $code_product=$row['code_product'];
                            $name_product=$row['name_product'];
                            $description_product=$row['description_product'];
                            $sale_price=$row["price_product"];
                              $stack=$row['stack'];
                             $goods_service=$row['goods_service'];  
                    
                    if ($goods_service == 1 || $goods_service == 3) {
                                   if($stack==1 || $stack==1){
                                   $status_class = "background-color:#f0c4c6";
                                   }

                                  if  ($stack==5 || $stack==4 || $stack==3 || $stack==2){
                                      $status_class = "background-color:#f0eec4";
                                   }
                                  if($stack >6){
                                      $status_class = "background-color:#fff";
                                   }

                                   }
                    
                    
                    
                            ?>
                            
               
                             <tr style="<?php echo $status_class;?>">
                                 
                                     <td class='col-xs-2'><?php echo $code_product; ?></td>
                                
                                    
                                     <td class='col-xs-3'><div class="pull-right">
                                    <input type="text" class="form-control" style="text-align:left" <?php  if ($stack == '0'){ ?> disabled <?php   }else {?> enable <?php } ?> id="name_<?php echo $id_product; ?>"  value="<?php echo $name_product;?>" >
                                    </div></td>  
                                 
                                    <td class='col-xs-3'><div class="pull-right">
                                    <textarea class="form-control" style="text-align:left" id="description_<?php echo $id_product; ?>"  value="" ><?php echo $description_product;?></textarea>
                                    </div></td>   
                                    
                                         
                                     <td class='col-xs-2'>
                                    <div class="pull-right">
                                    <input type="text" <?php if($product_type == 1){ echo "disable";} else { if ($stack == '0'){ ?> enable <?php   }else {?> enable<?php } }?> class="form-control" style="text-align:right" id="quantity_<?php echo $id_product; ?>"  value="1" <?php if($product_type == 2){ echo "enable";} else { if ($stack == '0'){ ?> disabled <?php   }else {?> enable <?php } }?>>
                                    </div>
                                    </td>

                                    <td class='col-xs-3'><div class="pull-right">
                                    <input type="text" class="form-control" style="text-align:right" <?php  if ($stack == '0'){ ?> disabled <?php   }else {?> enable <?php } ?> id="sale_price_<?php echo $id_product; ?>"  value="<?php echo $sale_price;?>" >
                                    </div></td>
                                   

                                    <?php if ($stack == '5'){ ?>
                                     <td class='text-center'> <button class='btn btn-danger' <?php  if ($stack == '0'){ ?> disabled <?php   }else {?> enable <?php } ?> onclick="agregar('<?php echo $id_product ?>');" ><i class="fa fa-plus"></i></button></td>
                                    <?php } else { ?>
                                     <td class='text-center'> <button class='btn btn-danger' <?php if($product_type == 2){ echo "enable";} else { if ($stack == '0'){ ?> disabled <?php   }else {?> enable <?php } }?> onclick="agregar('<?php echo $id_product ?>');" ><i class="fa fa-plus"></i></button></td>
                                    <?php } ?>

                           </tr>
                            <?php
                     }
                    ?>
                    <tr>
                            <td colspan=5><span class="pull-right">
                            <?php
                             echo paginate($reload, $page, $total_pages, $adjacents);
                            ?></span></td>
                    </tr>
              </table>
            </div>
            <?php
        }
    }

?>