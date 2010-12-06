<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">

<?php $this->load->view('global/header'); ?>


<body id="bd" class="  fs3"> 
<a name="Top" id="Top"></a>

		
        <div id="top_menu">
        <!-- HEADER --> 
						<div  class="wrap"> 
						  <div class="main clearfix"> 
						  
						  	  	<div class="logo-text" style="float:left"> 
						  		<h1>
						  		<a href="<?=base_url()?>" title="Red Box"><img src="<?=base_url()?>images/redbox/logo.jpg"></img></a>
						
						  	  		 
						  				
						  		</h1> 
						  	</div> 
						  	
						  	      </div> 
						</div> 
		<!-- //HEADER --> 
        
        
        
		</div>
  


    <!-- MAIN NAVIGATION --> 
<div id="ja-mainnav" class="wrap">  	
  <div class="main clearfix"> 
  				
 </div> 
</div> 
<!-- //MAIN NAVIGATION --> 

	

	
  	<div id="ja-container-fr" class="wrap"> 
  	<div class="main clearfix">
 		<?php 
	$this->load->view('global/redboxmenu');


?>
       
 		
  	
  	
  	<!-- CONTENT -->  
  	<div id="ja-content" style="min-height:220px;"> 
  	
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