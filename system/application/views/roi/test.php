<div id="leftside"><?php 

	
	$attributes = array('id' => 'roiform');
	$hidden = array('user_id' => $user_id, 'roi_id' => $roi_id);
	echo form_open('roi/results', $attributes, $hidden); 
	
	$this->load->view('admin/table');
	$this->load->view('roi/roi_table');
	
	$this->table->add_row('', form_submit('submit', 'update'));
	
	
	echo $this->table->generate();
	$this->table->clear();
?>
</div>
<div id="rightside" class="ajax_box">

<?php 

foreach($roi_results as $key => $row):


$this->table->set_heading('Results', '');
	$this->table->add_row('Size of Portfolio', number_format($row['portfolio_size'], 2));
	$this->table->add_row('Number of Leases', $row['number_of_leases']);
	$this->table->add_row('Average Payment', $row['average_payment']);
	$this->table->add_row("RBO available".$row['term_years']." years", number_format($row['rbo_available'], 2));
	$this->table->add_row('----', '----');
	$this->table->add_row('Cost Per Appointment', number_format($row['cost_per_appt'], 2));
	$this->table->add_row('Lease Desk Cost per sales per Month', number_format($row['leasedesk_sales_cost'], 2));
	$this->table->add_row('Average Number of agreements per Sales', number_format($row['average_agreement_per_sales'], 1));
	$this->table->add_row('RBO Available per Sales', number_format($row['rbo_available_per_sales'], 2));
	$this->table->add_row('Additional Churn per month per sales', number_format($row['additional_churn_per_sales'], 2));
	$this->table->add_row('Additional Churn per month total', number_format($row['additional_churn_total'], 2));
	$this->table->add_row('Total cost of Lease Desk Per Month', number_format($row['total_cost_per_month'], 2));
echo $this->table->generate();
	$this->table->clear();

endforeach;	
	?>

</div>
<div style="clear:both">
	<?php $this->load->view('roi/listentries'); ?>
	</div>