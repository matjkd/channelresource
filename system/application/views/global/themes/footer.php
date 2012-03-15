<!-- FOOTER --> 

<div class="container_24">
    <div  class="grid_19">
        &copy; Copyright 2011 Proctor Consulting Ltd. Website Developed by <a href="http://www.redstudio.co.uk">Redstudio Design Limited</a>
        <br/>
       
        <?php 
		$role = $this->session->userdata('role');		
        if(!isset($role) || $role != 1)
					{
						
					}
					else
					{
					?>
					 
    
<div id="bottom_menu">
    		<ul>
    		 	
    		<li>  <a href="<?=base_url()?>quote/main">Quoting Tool</a></li>
    		<li><a href="<?=base_url()?>support">Support Request</a></li>
    		<li> <a href="<?=base_url()?>news">News</a></li>
    		<li> <a href="<?=base_url()?>welcome/directory">Directory</a></li>
    		 <li> <a href="<?=base_url()?>pricelist">Pricelists</a> </li>
                <li> <a href="<?=base_url()?>roi/main">ROI Calculator</a> </li>
                <li><a href="<?=base_url()?>prospect">Prospect Registration</a> </li>
                <li> <a href="<?=base_url()?>welcome/presentations">Presentations</a> </li>
                
                
             
    		</ul>
</div>


  
    
   
						
					<?php 	
						
					}
						
					?>
        
        
   </div> 
   <div class="grid_5"><a href="http://www.lease-desk.com" target="_blank"><img width="200px" src="<?=base_url()?>images/proctor/logo.png"></img></a></div>
</div>
<!-- //FOOTER --> 
 
