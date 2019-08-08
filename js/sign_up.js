/*
 * Author        :   DHARSHAN
 * Date          :   27-12-2018
 * Modified      :   
 * Modified By   :   
 * Description   :  sign up page js
 */
 
    $(document).ready(function(){
        
    GetData();
    
    });
  

   function GetData(){
        var get_url = $('#get_url').val();
   //alert(get_url);
   $.ajax({
   url: get_url +"common.php?Get_226824=226824",
   type: 'GET',
   dataType: "json",
   datatype: 'json',
   async: false,
    success: function (response) {
     // alert(JSON.stringify(response));
       //alert(response[0].value);
       $('#get_date').val(response[0].value);
        $('#mt_rand').val(response[0].mt_rand);
    }
   });
   }

//function StoreUserInfo(){
//var email = $('#email').val();
//var password = $('#password').val();
//var get_date = $('#get_date').val();
//var mt_rand = $('#mt_rand').val();
//var get_url = $('#get_url').val();
//var submit = "submit";
//alert(post_url);
//$.ajax({
//type: 'POST',
//url: get_url +'sign_up.php',
//data:{email: email,password: password,get_date: get_date,mt_rand: mt_rand,submit: submit} // getting filed value in serialize form
//})
//.done(function(data){ // if getting done then call.
//// show the response
//alert(data);
//})
//.fail(function() { // if fail then getting message
//// just in case posting your form failed
//alert( "Posting failed." );
//});
//
//// to prevent refreshing the whole page page
//return false;
//
//}
    