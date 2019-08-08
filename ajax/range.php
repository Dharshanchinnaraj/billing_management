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
if(isset($_POST["From"], $_POST["to"]))
{
/* Connect To Database*/
require_once ("config/db.php");
require_once ("config/conexion.php");
$result = '';
$query = "SELECT * FROM `{$portal_name}_products` WHERE date_added BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
$sql = mysqli_query($conn, $query);
$result .='
<table class="table table-bordered">
<tr>
<th>Customer Name</th>
<th>Product Name</th>
<th>Quantity</th>
<th>Product Price</th>
<th>Total</th>
<th>GST</th>
<th>GST with Total</th>
<th>Date</th>
</tr>';
    if(mysqli_num_rows($sql) > 0)
    {
        while($row = mysqli_fetch_array($sql))
        {
            $result .='
            <tr>
            <td>'.$row["nombre_cliente"].'</td>
            <td>'.$row["nombre_producto"].'</td>
            <td>'.$row["precio_producto"].'</td>
            <td>'.$row["impuesto"].'</td>
            <td>'.$row["total_venta"].'</td>
            <td>'.$row["total_venta"].'</td>
            <td>'.$row["date_added"].'</td>
            </tr>';
        }
    }
    else
    {
        $result .='
        <tr>
        <td colspan="5">No Purchased Item Found</td>
        </tr>';
    }
    $result .='</table>';
    echo $result;
}
?>