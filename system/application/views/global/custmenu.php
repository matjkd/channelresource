<!-- Left COLUMN --> 
  		<div id="ja-col1"> 
        <div class="ja-innerpad"> 
            		
	     </div> 
	      <?php $this->load->view('user/login'); ?>
	     <div>
    <a href="<?=base_url()?>userguide"><img src="<?=base_url()?>images/icons/guides.png"></img></a>
    </div>
    <div>
    <a href="<?=base_url()?>quote/main"><img src="<?=base_url()?>images/icons/quotetool.png"></img></a>
    </div>
    <div>
    <a href="<?=base_url()?>support"><img src="<?=base_url()?>images/icons/support.png"></img></a>
    </div>
    <div>
    <a href="<?=base_url()?>news"><img src="<?=base_url()?>images/icons/news.png"></img></a>
    </div>
    <div>
    <a href="<?=base_url()?>welcome/directory"><img src="<?=base_url()?>images/icons/directory.png"></img></a>
    </div>
    <div>
    <a href="http://www.fla.org.uk/business/The_Business_Finance_Code" target="_blank"><img src="<?=base_url()?>images/icons/fla.png"></img></a>
    </div>
     <div>
    <a href="mailto:support@lease-desk.com?subject=Customer Resource Help Required"><img src="<?=base_url()?>images/icons/contact.png"></img></a>
    </div>
     <?php  if(isset($flash))
{
	$this->load->view('global/flashlink');
}
   ?>
    </div> 
    
  	<!-- //Left COLUMN --> 