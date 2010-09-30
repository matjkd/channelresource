<!-- Left COLUMN --> 
  		<div id="ja-col1"> 
        <div class="ja-innerpad"> 
            		
	     </div> 
	     <?php $this->load->view('user/login'); ?>
	     
	     <div>
    <a href="<?=base_url()?>guides"><img src="<?=base_url()?>images/icons/guides.png"></img></a>
    </div>
    <div>
    <a href="<?=base_url()?>roi/main"><img src="<?=base_url()?>images/icons/roi.png"></img></a>
    </div>
    <div>
    <a href="<?=base_url()?>pricelist"><img src="<?=base_url()?>images/icons/pricelists.png"></img></a>
    </div>
    
    <?php $role = $this->session->userdata('role');
				if(!isset($role)|| $role > 0)
					{	
	?>
	<div>
    <a href="https://lease-desk.webex.com" target="_blank"><img src="<?=base_url()?>images/icons/conference.png"></img></a>
    </div>
    <?php  }
    else
    {
    ?>
    <div>
    <a href="<?=base_url()?>welcome/conference" target="_blank"><img src="<?=base_url()?>images/icons/conference.png"></img></a>
    </div>
    <?php }?>
    
    <div>
    <a href="<?=base_url()?>prospect"><img src="<?=base_url()?>images/icons/prospect.png"></img></a>
    </div>
    <div>
    <a href="<?=base_url()?>welcome/presentations"><img src="<?=base_url()?>images/icons/presentations.png"></img></a>
    </div>
    <div>
    <a href="mailto:support@lease-desk.com?subject=Channel Resource Help Required"><img src="<?=base_url()?>images/icons/contact.png"></img></a>
    </div>
   
  <?php  if(isset($flash))
{
	$this->load->view('global/flashlink');
}
   ?>
    </div> 
    
  	<!-- //Left COLUMN --> 