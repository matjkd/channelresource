<!doctype html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->


<?=$this->load->view('global/themes/header')?>



<body>

<!--[if lt IE 7]>
  <div style='border: 1px solid #F7941D; background: #FEEFDA; text-align: center; clear: both; height: 75px; position: relative;'>
    <div style='position: absolute; right: 3px; top: 3px; font-family: courier new; font-weight: bold;'><a href='#' onclick='javascript:this.parentNode.parentNode.style.display="none"; return false;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-cornerx.jpg' style='border: none;' alt='Close this notice'/></a></div>
    <div style='width: 640px; margin: 0 auto; text-align: left; padding: 0; overflow: hidden; color: black;'>
      <div style='width: 75px; float: left;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-warning.jpg' alt='Warning!'/></div>
      <div style='width: 275px; float: left; font-family: Arial, sans-serif;'>
        <div style='font-size: 14px; font-weight: bold; margin-top: 12px;'>You are using an outdated browser</div>
        <div style='font-size: 12px; margin-top: 6px; line-height: 12px;'>For a better experience using this site, please upgrade to a modern web browser.</div>
      </div>
      <div style='width: 75px; float: left;'><a href='http://www.firefox.com' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-firefox.jpg' style='border: none;' alt='Get Firefox 3.5'/></a></div>
      <div style='width: 75px; float: left;'><a href='http://www.browserforthebetter.com/download.html' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-ie8.jpg' style='border: none;' alt='Get Internet Explorer 8'/></a></div>
      <div style='width: 73px; float: left;'><a href='http://www.apple.com/safari/download/' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-safari.jpg' style='border: none;' alt='Get Safari 4'/></a></div>
      <div style='float: left;'><a href='http://www.google.com/chrome' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-chrome.jpg' style='border: none;' alt='Get Google Chrome'/></a></div>
    </div>
  </div>
<![endif]-->
<div class="container">
         <div class="container_24">
                    <?php $this->load->view('global/menutop'); ?>

            
	</div>

	<div class="menu_container">
	    		<div class="container_24"><?=$this->load->view('global/themes/top_menu')?></div> 
	 </div>

<div class="main_content container_24">
  	<!-- CONTENT -->
  	
       
          
      
    

         <div class="grid_19"> 


	<?php 
        if(isset($slideshow))
	{
		 $this->load->view($slideshow); 
	}


	if(isset($title))
	{
		echo "<h1 class='componentheading'>$title</h1>";
	}
	?> 

	<?php $this->load->view('global/warning'); ?>
	<?php $this->load->view($main); ?>


         </div>

         <div class="grid_5">

           	<?php if(SITE=="customer"){
                    $this->load->view('global/themes/custmenu');
            }
            else if(SITE=="channel"){
                    $this->load->view('global/themes/channelmenu');
            }

?>

        </div>
</div>
        <div class="clear"></div>


   
      <!-- //CONTENT -->
</div>
   <div class="footer2">
	<div class="top_shadow"></div>
	<div class="container_24">


		<div class="grid_19">
				<?php $this->load->view('global/themes/footer'); ?>
		</div>

		<div class="grid_5">

		</div>

	</div>
</div>

</body>
</html>