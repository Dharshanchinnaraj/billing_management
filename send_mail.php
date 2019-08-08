<?php
/*
 * Author        :   Naveen
 * Date          :   06-06-2019
 * Modified      :   
 * Modified By   :   
 * Description   :   add category controller page
 */


if(isset($_POST['submit'])){
    //echo"hiii";die();
include 'send_mail_get.php';
}
?>   

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<style>
.tox-notifications-container{
    display:none;
}

    input[type=text], select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
      resize: vertical;
    }
    .tox-statusbar{
    margin-bottom: -18px !important;
    display: none !important;
    }
    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }
  

    #myDiv {
  display: none;
  
    }

    </style>

<?php
$active_invoices="active";
$active_products="";
$active_client="";
$active_users="";	
$title="Editer invoice | virran Invoice";

/* Connect To Database*/
require_once ("config/db.php");
require_once ("config/Connection.php");
$portal_name =  $_SESSION['portal_name'];
if (isset($_GET['id_bill']))
{
$id_bill=intval($_GET['id_bill']);
$campos="`{$portal_name}_client`.id_client, `{$portal_name}_client`.name_client, `{$portal_name}_client`.phone_client, `{$portal_name}_client`.email_client, `{$portal_name}_invoices`.id_salesman, `{$portal_name}_invoices`.date_bill, `{$portal_name}_invoices`.terms, `{$portal_name}_invoices`.state_bill, `{$portal_name}_invoices`.number_bill,`{$portal_name}_invoices`.round_total";
$sql_bill=mysqli_query($con,"select $campos from `{$portal_name}_invoices`, `{$portal_name}_client` where `{$portal_name}_invoices`.id_client=`{$portal_name}_client`.id_client and id_bill='".$id_bill."'");
$count=mysqli_num_rows($sql_bill);
if ($count==1)
{
$rw_bill=mysqli_fetch_array($sql_bill);
$id_client=$rw_bill['id_client'];
$name_client=$rw_bill['name_client'];
$phone_client=$rw_bill['phone_client'];
$email_client=$rw_bill['email_client'];
$id_salesman_db=$rw_bill['id_salesman'];
$date_bill=date("d/m/Y", strtotime($rw_bill['date_bill']));
$terms=$rw_bill['terms'];
$state_bill=$rw_bill['state_bill'];
$number_bill=$rw_bill['number_bill'];
$_SESSION['id_bill']=$id_bill;
$_SESSION['number_bill']=$number_bill;
$from_address ='sales@virrantech.com';
$round_total=$rw_bill['round_total'];
}
else
{
header("location: invoice.php");
exit;	
}
} 
else 
{
header("location: invoice.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php");?>
</head>
<body onload="myFunction()" style="margin-bottom:15px;">
    <div id="loader"></div>
    <div style="display:none;" id="myDiv" >
<main class="app-content">
<div class="col-sm-12">
    <div class="tile">
<div class="tile-body">
<div class="row">

<h4>Mail To <?php echo $name_client;?></h4>
</div>
<div class="panel-body">
<?php 
include("modal/search_products.php");
include("modal/register_clients.php");
include("modal/register_products.php");
?>
<form method="post">

<div class="form-group row">
    <label for="">From</label>
    <input type="text" id="fname" name="from_address" value="<?php echo $from_address; ?>">

    <label for="">Send To</label>
    <input type="text" id="lname" name="to_address" value="<?php echo $email_client;?>">
    <input type="hidden" name="name_client" value="<?php echo $name_client;?>">
    <input type="hidden" name="invoice_date" value="<?php echo $date_bill;?>">
    
    <label for="subject">Subject</label>
    <input type="text" id="lname" name="subject_to" value="Invoice - INV-<?php echo $number_bill;?>">

   <textarea name="total_subject" id="full-featured">
  
    <p style="background-color: #4190f2;padding: 20px 0px;color:#fff;text-align: center;"> Invoice - INV-<?php echo $number_bill;?></p>
    Dear <?php echo $name_client; ?>,<br><br>
  
    <p style="text-align: center;"> Thank you for your business. 
    Your invoice can be viewed, printed and downloaded as PDF from the link below. 
    You can also choose to pay it online. <br><br>

    <b>INVOICE AMOUNT</b>
    <p style="font-size: 20px;color:red;text-align: center;">&#8360;.<?php echo $round_total;?></p>
  
    <table style="width:50%;background-color: #e8deb5;margin-left: 250px;">
    <tr>
    <td>Invoice No </td>
    <td>Invoice-<?php echo $number_bill; ?></td>
    </tr>
    <tr style="background-color: #e8deb5">
    <td>Invoice Date</td>
    <td><?php echo $date_bill; ?></td>
    </tr>
       <tr style="background-color: #e8deb5">
    <td>Current Date</td>
    <td><?php echo date("d/m/Y"); ?></td>
    </tr>
    </table>
        
<!--        <button class="btn btn-primary" style="background-color: green;color:#fff;text-align: center;padding: 10px 15px;"><a href="#"style="color: #fff">PAY NOW</a></button>-->
    </p>
   </textarea><br><br>
    <?php
    $pdf_id = $_GET['id_bill'];
    
    ?>
   <input id="foreign_checkbox" value="" type="checkbox" />Attach Invoice PDF
   <span style='display:none' id="additional_foreign">
       <input type="hidden" name="pdf_url" id="nclient">
       
       <a  href="" style='color:red'>Get PDF</a></span>
      
    <button type="submit" name="submit" class="btn btn-danger" style="float: right;margin: 15px 0px;">Send</button>
</div>
</form>	
    
</div>
</div>
</div> 
</div>

    
   


<hr>
<?php
include("footer.php");
?>
</main>
</div> 
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/editer_bill.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    
   
    $(document).ready(function() {

        $("#foreign_checkbox").click(function() {
            if($('#foreign_checkbox').is(':checked')) { 
                $('#additional_foreign').show();
            $("#nclient").val("<a href=' https://virranproducts.com/PerfectComputersServices/virran_invoice/pdf/document/view_bill.php?id_bill=<?php echo $pdf_id;?>' style='color:red'>Get PDF</a>");
            
            } else {
                $('#additional_foreign').hide();
            }
        });

        $('#additional_foreign').click(function() {
            //alert('This click function works');
        });
    });

$(function() {
$("#name_client").autocomplete({
source: "./ajax/autocomplete/clients.php",
minLength: 2,
select: function(event, ui) {
event.preventDefault();
$('#id_client').val(ui.item.id_client);
$('#name_client').val(ui.item.name_client);
$('#tel1').val(ui.item.phone_client);
$('#mail').val(ui.item.email_client);


}
});


});

$("#name_client" ).on( "keydown", function( event ) {
if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
{
$("#id_client" ).val("");
$("#tel1" ).val("");
$("#mail" ).val("");

}
if (event.keyCode==$.ui.keyCode.DELETE){
$("#name_client" ).val("");
$("#id_client" ).val("");
$("#tel1" ).val("");
$("#mail" ).val("");
}
});	




</script>

<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js"></script>
<script>

var mentionsFetchFunction = function (query, success) {
  var users = [
    "Lauren Gilbert", "Christopher Romero"
  ];

  users = users.map(function (fullName) {
    var userName = fullName.replace(/ /g, '').toLowerCase();

    return {
      id: userName,
      name: userName,
      fullName: fullName
    }
  });

  users = users.filter(function (user) {
    return user.name.indexOf(query.term) === 0
  });

  success(users)
};

tinymce.init({
  selector: 'textarea#full-featured',
  plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount tinymcespellchecker a11ychecker imagetools textpattern help formatpainter permanentpen pageembed tinycomments mentions linkchecker',
  toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
  image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ],
  link_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
    { title: 'Some title 1', description: 'Some desc 1', content: 'My content' },
    { title: 'Some title 2', description: 'Some desc 2', content: '<div class="mceTmpl"><span class="cdate">cdate</span><span class="mdate">mdate</span>My content2</div>' }
  ],
  template_cdate_format: '[CDATE: %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[MDATE: %m/%d/%Y : %H:%M:%S]',
  image_caption: true,
  spellchecker_dialog: true,
  spellchecker_whitelist: ['Ephox', 'Moxiecode'],
  tinycomments_mode: 'embedded',
  mentions_fetch: mentionsFetchFunction,
  content_style: '.mce-annotation { background: #fff0b7; } .tc-active-annotation {background: #ffe168; color: black; }'
 });

</script>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 0009);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
</body>
</html>