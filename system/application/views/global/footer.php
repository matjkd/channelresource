<!-- PATHWAY --> 
<div id="ja-pathway" class="wrap"> 
  <div class="main"> 
  	<div class="ja-pathway-text"> 
    <!-- <strong>You are here:</strong> -->
    </div> 
  </div> 
</div> 
<!-- //PATHWAY --> 
		<!-- FOOTER --> 
		
<div id="ja-footer" class="wrap"> 
<div class="main clearfix"> 
	
    <div class="ja-info"> 
        &copy; Copyright 2009 Proctor Consulting. Website Developed by <a href="http://www.redstudio.co.uk">Redstudio Design Limited</a>
        <br/>
       
        <?php 
		$role = $this->session->userdata('role');		
        if(!isset($role) || $role != 1)
					{
						
					}
					else
					{
					?>
					 
    <a href="<?=base_url()?>quote/main">Quoting Tool</a> |
    
    <a href="<?=base_url()?>support">Support Request</a> |
    
    <a href="<?=base_url()?>welcome/news">News</a> |
    
    <a href="<?=base_url()?>welcome/directory">Directory</a> |
    
    <a href="<?=base_url()?>pricelist">Pricelists</a> |
    
    <a href="<?=base_url()?>roi/main">ROI Calculator</a> |
    
    <a href="<?=base_url()?>prospect">Prospect Registration</a> |
    
    <a href="<?=base_url()?>welcome/presentations">Presentations</a> |
    
   
						
					<?php 	
						
					}
						
					?>
        
        
   </div> 
   <span style="float:right;"><a href="http://www.proctorconsulting.co.uk" target="_blank"><img src="<?=base_url()?>images/proctor/logo.png"></img></a></span>
</div> 
</div>
<link  href="http://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet" type="text/css" >


<!-- //FOOTER --> 
 
