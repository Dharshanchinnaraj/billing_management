<?php 
/*
 * Author        :   BARATHI/KARPAGAM
 * Date          :   03-07-2019
 * Modified      :   
 * Modified By   :   
 * Description   :  
 */
?>
<main>
<p style="text-align: center;"><br>Rights Reserved By @ 2019
     <a href="https://www.virrantech.com" target="_blank" style="color: #000">Virrantech.com</a>
</p>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
   <script>
   $(".app-sidebar__toggle").click(function(){

   $( ".sidebar-mini" ).addClass( "sidenav-toggled" );
   $(".app-sidebar__toggle1").css("display", "block");
   $(".app-sidebar__toggle").hide();
}); 
   $(".app-sidebar__toggle1").click(function(){
   $( ".sidebar-mini" ).removeClass( "sidenav-toggled" );
   $(".app-sidebar__toggle").show();
   $(".app-sidebar__toggle1").css("display", "none");
   }); 
   </script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script>
$(window).on('load', function() { // makes sure the whole site is loaded
  $('#status').fadeOut(); // will first fade out the loading animation
  $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
  $('body').delay(350).css({'overflow':'visible'});
})
</script> 	
	
	
	