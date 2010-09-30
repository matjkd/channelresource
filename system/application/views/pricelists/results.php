<div id="leftside" >
<?php 
	$this->load->view('admin/table');
	$user_id = $this->session->userdata('user_id');
	$attributes = array('id' => 'pricelistform');
	$hidden = array('user_id' => $user_id, 'pricelist_id' => $pricelist_id);
	echo form_open('pricelist/results', $attributes, $hidden); 
	
	
	$this->load->view('pricelists/pricelist_table');
	echo form_hidden('user_id', $user_id);	
	$this->table->add_row(form_submit('submit', 'Reset'), form_submit('submit', 'Update'));
		
	echo $this->table->generate();
	$this->table->clear();
?>	

	

</div>

<div id="rightside" class="ajax_box">
	<?php echo validation_errors('<p class="error">'); 
	
	$subscription_5_year = number_format($subscription_5_year, 2);
	$services_5_year = number_format($services_5_year, 2);
	$annual_support_5_year = number_format($annual_support_5_year, 2);
	$subscription_1_year = number_format($subscription_1_year, 2);


$this->table->set_heading('Results', '');
	$this->table->add_row('Maximum Users', $maximum_users);
	$this->table->add_row('Maximum Storage', $maximum_storage);
	$this->table->add_row('5 Year Subscription', "&#163;".$subscription_5_year."");
	$this->table->add_row('5 Year Services', "&#163;".$services_5_year."");
	$this->table->add_row('5 Year Annual Support', "&#163;".$annual_support_5_year."");
	$this->table->add_row('1 Year Subscription', "&#163;".$subscription_1_year."");
	echo $this->table->generate();
	$this->table->clear();


	?>
	</div>
	<div style="clear:both;">
</div>
<div style="clear:both">
	<?php $this->load->view('pricelists/listentries'); ?>
	</div>