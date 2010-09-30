<script src="<?=base_url()?>js/tiny_mce/tiny_mce.js" type="text/javascript"></script>				
<script type="text/javascript">
tinyMCE.init({
	mode : "textareas"
});
</script>
<div>
	
<?php echo validation_errors('<p class="error">'); ?>	
	
<?php 
$this->load->view('admin/table');
$user_id = $this->session->userdata('user_id');
	
	$attributes = array('id' => 'prospectform');
	$hidden = array('user_id' => $user_id);
	echo form_open('support/create_ticket', $attributes, $hidden); 


	$this->load->view('support/support_request');
	
	echo form_reset('reset', 'Reset');
	echo form_submit('submit', 'Submit');
	
	

?>
<?=form_close()?>
</div>


	
	

<div style="clear:both">
<h2>Current Requests:</h2>
	<?php //$this->load->view('prospect/listcustomers'); ?>
	<?php $this->load->view('support/ticketlist'); ?>
	</div>