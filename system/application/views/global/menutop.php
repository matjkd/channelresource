<!-- HEADER --> 
<div class="logotop">
  <div class="grid_19">
  
  	  	<div id="logo">
  		
  		<?php if(SITE=="customer"){
	?><a href="<?=base_url()?>" title="customer resource"><img width="250px" src="<?=base_url()?>images/ccappscustomer.png"></img></a>
<?php }
else if(SITE=="channel"){
	?><a href="<?=base_url()?>" title="channel resource"><img width="250px" src="<?=base_url()?>images/ccappschannel.png"></img></a>
<?php }

?>
  		
  		
  		 
  				
  		
  	</div>
      
  	
  	      </div>
     <div class="grid_5" id="contact_details">
		<h3>tel: +44(0)1302 245 310</h3>
		<?=$this->load->view('global/themes/social_links')?>
		</div>
</div> 
<!-- //HEADER --> 
