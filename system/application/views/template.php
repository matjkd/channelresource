<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">

<?php $this->load->view('global/header'); ?>

<body id="bd" class="  fs3"> 
<a name="Top" id="Top"></a>

		
        <div id="top_menu"><?php $this->load->view('global/menutop'); ?>	
		</div>
  


        <?php $this->load->view('global/main_menu'); ?>

	

	
  	<div id="ja-container-fr" class="wrap"> 
  	<div class="main clearfix">
 		<?php if(SITE=="customer"){
	$this->load->view('global/custmenu');
}
else if(SITE=="channel"){
	$this->load->view('global/channelmenu');
}

?>
       
 		
  	
  	
  	<!-- CONTENT -->  
  	<div id="ja-content" style="min-height:420px;"> 
  	
    	<div class="main clearfix"> 
            
                        <div id="ja-current-content" class="clearfix"> 
                 
	<?php 
	if(isset($title))
	{
		echo "<h1 class='componentheading'>$title</h1>";
	}
	?>
	
	<?php $this->load->view('global/warning'); ?> 
	<?php $this->load->view($main); ?>

 
            </div> 
                    </div> 
  	<!-- //CONTENT --> 
		
     </div></div></div>
  
  

<?php $this->load->view('global/footer'); ?>

</body>
</html>