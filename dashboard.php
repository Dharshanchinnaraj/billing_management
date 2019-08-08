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
	
if(isset($_SESSION['user_fill_id'])) 
?>
<?php
/* Connect To Database*/
require_once ("config/db.php");
require_once ("config/Connection.php");
$active_dashboard="active";
$active_invoices="";
$active_products="";
$active_client="";
$active_users="";	
$title="Dashboard | Virran Invoice";
?>

<html lang="en">
<head>
    <?php include("head.php");?>
</head>
<body style="margin: 0px;">
<main class="app-content">
      <div class="app-title">
        <div>
             <h1 style="color:#333;" ><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
    
    <?php
$query_empresa=mysqli_query($con,"select * from `{$portal_name}_profile` where id_profile=1");
$row=mysqli_fetch_array($query_empresa);
$product_type=$row["product_type"];
?>
    
      <div class="row">
         <div class="col-sm-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
              <h5>Total Sale</h5>
             <?php
				   $sql = "SELECT count(*) as invoice from `{$portal_name}_invoices` where goods_service_id = $product_type";
                        $result = $con->query($sql);
                          if ($result->num_rows > 0) {
                       while($row = $result->fetch_assoc()) {
                ?>
              <p><b><?php echo  $row["invoice"]; ?></b></p>
		<?php	    }
                } 
                ?>
            </div>

          </div>
        </div>
          
        <div class="col-sm-3 ">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-copy fa-3x"></i>
            <div class="info">
              <h5>Total Product</h5>
			     <?php
				   $sql = "SELECT count(*) as product from `{$portal_name}_products` where goods_service = $product_type";
                        $result = $con->query($sql);
                          if ($result->num_rows > 0) {
                       while($row = $result->fetch_assoc()) {
                        ?>            
              <p><b><?php echo  $row["product"]; ?></b></p>
			<?php	}
                        } 
                        ?>
            </div>
          </div>
        </div>
      
        <div class="col-sm-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h5>Total Client</h5>
             <?php
				   $sql = "SELECT count(*) as client from `{$portal_name}_client`";
                        $result = $con->query($sql);
                          if ($result->num_rows > 0) {
                       while($row = $result->fetch_assoc()) {
             ?>
              <p><b><?php echo  $row["client"]; ?></b></p>
            <?php	    }
             } 
             ?>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h5>Monthly Sale</h5>
                    <?php
                    $sql = "SELECT count(*) as invoice  FROM `{$portal_name}_invoices` WHERE MONTH(date_bill) = MONTH(CURRENT_DATE()) AND state_bill=1";
                        $result = $con->query($sql);
                          if ($result->num_rows > 0) {
                       while($row = $result->fetch_assoc()) {
                     ?>
              <p><b><?php echo  $row["invoice"]; ?></b></p>
                      <?php	    }
                      } 
                    $con->close();
                    ?>	  
            </div>
          </div>
        </div>
      </div>
    <div class="row" >  
    <div class="col-sm-12">
    <div class="tile">
    <div class="panel-body">
        <form class="form-horizontal" role="form" id="datos_cotizacion">
            <div class="form-group row">
                <div class="col-md-5">
                        <input type="hidden" class="form-control" id="q" placeholder="Client name or invoice " onkeyup='load(1);' style="width: 55%;">
                </div>
            </div>
        </form>
        <div id="resultados"></div><!-- Carga los datos ajax -->
        <div class='outer_div'></div><!-- Carga los datos ajax -->
    </div>
    </div>	
    </div>
    </div>      
   <br>
	<hr>
</main>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/invoices.js"></script>
        
        <script>
            function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('headerTable'); // id of table
var dataexcelrow = tab.rows.length;

    for(j = 0 ; j < dataexcelrow ; j++) 
    {     
       
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
            </script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>

  
  
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
   
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="js/sign_up.js"></script>
    <script>
        $(document).ready(function(){
            $(".dashboardactive").addClass('active');
        });
    </script>
	</body>
	</html>
	
	

