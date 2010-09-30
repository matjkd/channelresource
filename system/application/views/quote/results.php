<div id="leftside"><?php 

	
	$attributes = array('id' => 'quoteform');
	$hidden = array('user_id' => $user_id, 'quote_id' => $quote_id);
	echo form_open('quote/results', $attributes, $hidden); 
	
	$this->load->view('admin/table');
	$this->load->view('quote/quote_table');
	$this->table->add_row(form_submit('submit', 'Reset'), form_submit('submit', 'Update'));
	echo $this->table->generate();
	$this->table->clear();
	
	
	
?>
</div>
<div id="rightside" class="ajax_box">

<?php 

foreach($quote_results as $key => $row):


$this->table->set_heading('Results', '');
	$this->table->add_row('Capital Amount', number_format($row['capital'], 2));
	$this->table->add_row('Interest Rate', $row['interest_rate']);
	$this->table->add_row('Rate Per Thousand', $row['rate_per_1000']);
	
	$this->table->add_row('Payment Type', $row['payment_type']);
	$this->table->add_row('Payment Frequency', $row['payment_frequency']);
	$this->table->add_row('Payment Profile', $row['initial']."+".$row['regular']);
	$this->table->add_row('Initial', $row['initial_result']);
	$this->table->add_row('Regular', $row['regular_result']);
	$this->table->add_row('', '');
echo $this->table->generate();
	$this->table->clear();
	$this->table->set_heading('Managed Service Results', '');
	$this->table->add_row('Cost Per Port/User per month', $row['cost_per_port_per_month']);
	echo $this->table->generate();
	$this->table->clear();
	
endforeach;	
	?>

</div>
<div style="clear:both">
		<?php $this->load->view('quote/listentries'); ?>
	</div>