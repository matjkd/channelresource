<div id="leftside" >
<?php 
	$this->load->view('admin/table');
	$user_id = $this->session->userdata('user_id');
	$attributes = array('id' => 'pricelistform');
	$hidden = array('user_id' => $user_id);
	echo form_open('pricelist/results', $attributes, $hidden); 
	
	
	$this->load->view('pricelists/pricelist_table');
	echo form_hidden('user_id', $user_id);	
	$this->table->add_row(form_reset('reset', 'Reset'), form_submit('submit', 'Submit'));
		
	echo $this->table->generate();
	$this->table->clear();
?>	

	

</div>

<div id="rightside" class="ajax_box">
	<?php echo validation_errors('<p class="error">'); ?>
	</div>
	<div style="clear:both;">
</div>
<div style="clear:both">
	<?php $this->load->view('pricelists/listentries'); ?>
	</div>