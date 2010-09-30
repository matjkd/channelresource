<script>
$(document).ready(function(){
	
	$("#jquerytype").change(onSelectChange);
	$("#jquerytype2").change(onSelectChange2);
});
function onSelectChange(){
	var selected = $("#jquerytype option:selected");		
	var output = "";
	if(selected.val() != 0){
		output = selected.text();
	}
	$("#output").html(output);
}
function onSelectChange2(){
	var selected = $("#jquerytype2 option:selected");		
	var output = "";
	if(selected.val() != 0){
		output = selected.text();
	}
	$("#output2").html(output);
}

</script>

<?php 
$fields = "class='roifield'";
$jquery = "id='jquerytype'";
$jquery2 = "id='jquerytype2'";
$user_id = $this->session->userdata('user_id');


$this->table->set_heading('Payment Details', '', '');

$this->table->add_row('Reference (for your info)', form_input('quote_ref', set_value('quote_ref', $quote_ref), $fields));

$choose2 = array(1 => 'Capital Amount', 2 => 'Periodic Payment');
$this->table->add_row('Capital Type', form_dropdown('capital_type', $choose2, set_value('capital_type', $capital_type), $jquery2));

$this->table->add_row('<span id="output2"></span>', form_input('amount_type', set_value('amount_type', $amount_type), $fields));
	


//$this->table->add_row('Capital Amount', form_input('capital', set_value('capital', $capital), $fields));
//$this->table->add_row('Periodic Repayment', form_input('periodic_payment', set_value('periodic_payment', $periodic_payment), $fields));	
$choose = array(1 => 'Interest Rate', 2 => 'Rate Per 1000');
$this->table->add_row('Calculate By', form_dropdown('interest_type', $choose, set_value('interest_type', $interest_type), $jquery));

$this->table->add_row('<span id="output"></span>', form_input('calculate_by', set_value('calculate_by', $calculate_by), $fields));
	

//time array in hours
	$advance_arrears = array(2 => 'Advance', 1 => 'Arrears');
	$this->table->add_row('Payment Type', form_dropdown('payment_type', $advance_arrears, set_value('payment_type', $payment_type), $fields));
	
	//ratio array
	$frequency = array(12=>'Monthly',4=>'Quarterly',1=>'Annually');
	$this->table->add_row('Payment Frequency', form_dropdown('payment_frequency', $frequency, set_value('payment_frequency', $payment_frequency), $fields));
	$this->table->add_row('Initial', form_input('initial', set_value('initial', $initial), $fields));
	$this->table->add_row('Regular', form_input('regular', set_value('regular', $regular), $fields));
	echo $this->table->generate();
	$this->table->clear();
	
	
	$this->table->set_heading('Managed Service Pricing', '', '');
	$this->table->set_empty("&nbsp;");
	$this->table->add_row('Number of Ports/Users', form_input('number_of_ports', set_value('number_of_ports', $number_of_ports), $fields));
	$this->table->add_row('Annual Support Costs', form_input('annual_support_costs', set_value('annual_support_costs', $annual_support_costs), $fields));
	$this->table->add_row('Other Monthly Costs', form_input('other_monthly_costs', set_value('other_monthly_costs', $other_monthly_costs), $fields));
	
	echo form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'));
	echo form_hidden('user_id', $user_id);
	?>
	
