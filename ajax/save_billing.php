<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../config/db.php");
require_once ("../config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
$session_id= session_id();
include("../funcions.php");


if (isset($_POST['id'])){
   $id=$_POST['id'];
    
}
if (isset($_POST['quantity'])){$quantity=$_POST['quantity'];}
if (isset($_POST['sale_price'])){$sale_price=$_POST['sale_price'];}


if (isset($_POST['name_product'])){
   $name=$_POST['name_product'];
    
}
if (isset($_POST['description_product'])){
   $description=$_POST['description_product'];
    
}

if (isset($_POST['sale_price_total'])){
   $sale_price_total=$_POST['sale_price_total'];
    
}
    $update=mysqli_query($con,"update `{$portal_name}_billing_detail` set quantity='$quantity',sale_price='$sale_price', name_product='$name',description_product='$description',price_total_r='$sale_price_total' where id_detail='$id'"); 

if ($update == 1)
{
$response[] = array("sucsess");
} else
{
$response[] = array("failure");
}
 json_encode($response);   

 

