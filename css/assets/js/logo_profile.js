
 $("#form").on('submit',(function(e) {
     

     //alert("hi");
     var user_id= $('#get_user_id').val();
    // alert(user_id);

     var set_url="application/controller/logo_profile.php?user_id="+user_id;
    // alert(set_url);
     var image_path="http://localhost/virranbrand/RcNatarajan/";
     
 e.preventDefault();
  $.ajax({
    url: set_url,
   type: "POST",
   //data:{user_id:user_id},
   data:new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   success: function(response)
      {
 //alert(response);
if( response != 0)
{
    
    $('#img').attr('src',image_path +response);
    $('#img1').attr('src',image_path +response);
   
}
else
{
    alert ("file not uploaded");
}

       location.reload();
    }
    
    
  

    });
 
            
 }));
 
 

 $(document).ready(function(){

    var set_user_session = $('#get_user_id_comman').val();
   // alert(set_user_session);
      var set_url="application/controller/logo_profile.php";
    // alert(set_url);
var image_path="http://localhost/virranbrand/RcNatarajan/";
var logo_path="http://localhost/virranbrand/RcNatarajan/assets/img/logo.jpg";

   $.ajax({
   url: set_url,
   type: 'POST',
   data: {set_user_session: set_user_session},
   dataType: "json",
   datatype: 'json',
   async: false,
    success: function (response) {
  // alert(JSON.stringify(response));
     $.each(response, function(i, item) {
         //alert(item.logo_image);
       //$('#image').val(item.logo_image);
if(item.logo_image == '')
{
              
         $('#img1').attr('src',logo_path);
           $('#company_name').val(item.company_name);
     }
     else
     {
         
           $('#img').attr('src',image_path +item.logo_image);
        $('#img1').attr('src',image_path +item.logo_image);
        $('#company_name').val(item.company_name);
   }
       });
    },

    
   });


});
 
 
 
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
            var image_path = "http://localhost/virranbrand/RcNatarajan/";
                reader.onload = function (e) {
                    $('#img').attr('src',e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }