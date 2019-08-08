 <?php 
   $portal_name =  $_SESSION['portal_name'];
if(isset($_SESSION['user_fill_id'])) 
?>
<style>
    #preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #fff;
  /* change if the mask should have another color then white */
  z-index: 99;
  /* makes sure it stays on top */
}

#status {
  width: 200px;
  height: 200px;
  position: absolute;
  left: 50%;
  /* centers the loading animation horizontally one the screen */
  top: 50%;
  /* centers the loading animation vertically one the screen */
  background-image: url(img/css-fun-Little-loader.gif);
  /* path to your loading animation */
  background-repeat: no-repeat;
  background-position: center;
  margin: -100px 0 0 -100px;
  /* is width and height divided by two */
}
</style>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>
	
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel=icon href='img/vlogo.png' sizes="32x32" type="image/png">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/style_pricing.css">
		<link rel="stylesheet" href="css/main2.css">

		
      <?php 
            if(isset($_GET['id_bill'])){ 
          $s ="app-menu__item invoiceactive active";
          }
      
       
          ?>		
    <?php
		if (isset($title))
		{
	?>
<!-- Navbar-->
 <body class="app sidebar-mini rtl pace-done <?php if($_GET['p'] != 'dashboard'){ echo "sidenav-toggled";} ?>"> 
     <div id="preloader">
    <div id="status">&nbsp;</div>
    </div>   
     <header class="app-header"><a class="app-header__logo" href="#"><h3 style="color:red;  font-family: Arial, Helvetica, sans-serif;margin-top: 15px;">V I R R A N</h3></a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
	  <a class="app-sidebar__toggle1" href="#" style="display:none;" data-toggle="sidebar" aria-label="Hide Sidebar"><img style="height: 38px;padding: 15px 11px 0px;" src="https://sitejerk.com/images/battlerite-steam-charts-5.png"></a>

 <?php
?>
          
        <h3  style="margin-top: 10px; margin-left: 5%;color:#FFF;"> <?php echo   $_SESSION['company_name']; ?></h3>
      <ul class="app-nav">
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href=""><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>  
   </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
	<ul class="app-menu">
          <li><a class="app-menu__item dashboardactive" href="dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i> &nbsp;<span class="app-menu__label">Dashboard</span></a></li>
          <li><a class="app-menu__item settingactive" href="profile.php"><i class="glyphicon glyphicon-cog"></i> &nbsp; <span class="app-menu__label">Settings</span></a></li>
          <li><a class="app-menu__item clientactive" href="Clients.php"><i class="glyphicon glyphicon-user"></i> &nbsp; <span class="app-menu__label"> Clients </span></a></li>
          <li><a class="app-menu__item productactive" href="products.php"><i class="glyphicon glyphicon-barcode"></i> &nbsp; <span class="app-menu__label"> Products </span></a></li>
         
           <li><a class="<?php if($s) {echo $s; }?> app-menu__item invoiceactive" href="Invoices.php"><i class="glyphicon glyphicon-list-alt"></i> &nbsp; <span class="app-menu__label"> Invoices </span></a></li>
     
        </ul>
    </aside> 	
<?php
		}
	?>
     
