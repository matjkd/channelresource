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
	$hidden = array('user_id' => $user_id, 'ticket_id' => $ticket_id);
	echo form_open('support/create_ticket', $attributes, $hidden); 


	$this->load->view('support/support_request');
	echo "Check to Email Changes";
	echo form_checkbox('email_changes', 'email', FALSE);
	echo "<br />";
	echo form_submit('submit', 'Reset');
	echo form_submit('submit', 'Update');
	
	

?>
<?=form_close()?>
</div>


	
	

<div style="clear:both">
<?php $this->load->view('support/response'); ?>
<?php $this->load->view('support/list_replies'); ?>
	
	<?php $this->load->view('support/ticketlist'); ?>
	</div>