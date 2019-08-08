
/*
 * Author        :   DHARSHAN
 * Date          :   27-12-2018
 * Modified      :   
 * Modified By   :   
 * Description   :  sign up page js
 */

    $(document).ready(function(){
        
    
    
    });
    
function Get_Company_Master(){
 var get_url = $('#get_utl_ctrl').val();
 var get_sesstion = $('#get_sesstion').val();
   //alert(get_url);
   
   $.ajax({
   url: get_url +"company_master.php?company_id="+get_sesstion,
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