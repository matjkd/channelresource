 
 <script type="text/javascript">
  $(document).ready(function(){
  var id = "<?php echo $this->session->userdata('company_id'); ?>";
  var loadlist = "/ajax/get_customers/"+id;

  $("#list").autocomplete(loadlist, {
		width: 150,
		selectFirst: false
	});

  $("#list").result(function(event, data, formatted) {
		if (data)
			$("#hiddenIDbox").val(data[1]);
	});

  });
 </script>
 
<?php 
$fields = "class='roifield'";
$auto = "id='list'";
$autohide = "id='hiddenIDbox'";
$user_id = $this->session->userdata('user_id');


$this->table->set_heading('Data', '');

$this->table->add_row('Reference (for your info)', form_input('roi_ref', set_value('roi_ref', $roi_ref), $fields));
$this->table->add_row('Customer/Prospect', form_input('customer_name',set_value('customer_name', $customer_name) ,$auto));
$this->table->add_row('Number of Sales People', form_input('number_of_salespeople', set_value('number_of_salespeople', $number_of_salespeople), $fields));
	$this->table->add_row('Appointments Per Month (per Sales)', form_input('appts_per_month', set_value('appts_per_month', $appts_per_month), $fields));
	
	//time array in hours
	$time = array(1 => '1 hour', 2 => '2 hours', 3 => '3 hours', 4 => '4 hours', 5 => '5 hours', 6 => '6 hours',);
	$this->table->add_row('Average Time Per Appointment (hours)', form_dropdown('hours_per_appt', $time, set_value('hours_per_appt', $hours_per_appt), $fields));
	
	//ratio array
	$ratio = array(2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9',10=>'10',
	11=>'11',12=>'12',13=>'13',14=>'14',15=>'15',16=>'16',17=>'17',18=>'18',19=>'19',20=>'20');
	$this->table->add_row('Appointment to Sale Ratio', form_dropdown('appt_sale_ratio', $ratio, set_value('appt_sale_ratio', $appt_sale_ratio), $fields));
	$this->table->add_row('Average Salary', form_input('average_salary', set_value('average_salary', $average_salary), $fields));
	$this->table->add_row('Average Deal Size', form_input('average_deal', set_value('average_deal', $average_deal), $fields));
	
	//petentration array 
	$penetration = array(10=>'10',20=>'20',30=>'30',40=>'40',50=>'50',60=>'60',70=>'70',80=>'80',90=>'90',100=>'100');
	$this->table->add_row('Lease Penetration (%)', form_dropdown('lease_penetration', $penetration,  set_value('lease_penetration', $lease_penetration), $fields));
	
	//acceptance array
	$acceptance = array(40=>'40',50=>'50',60=>'60',70=>'70',80=>'80',90=>'90',100=>'100');
	$this->table->add_row('Acceptance Ratio (%)', form_dropdown('acceptance_ratio', $acceptance, set_value('acceptance_ratio', $acceptance_ratio), $fields));
	
	$term = array(36=>'36', 48=>'48', 60=>'60');
	$this->table->add_row('Average Lease Term', form_dropdown('average_term', $term, set_value('average_term', $average_term), $fields));
	$this->table->add_row('Annual Subscription to Lease Desk', form_input('subscription', set_value('subscription', $subscription), $fields));
	echo form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'));
	echo form_hidden('user_id', $user_id);
	//echo form_input('customer_id', set_value('customer_id', $customer_id), $autohide);
	
	?>
	<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" id="hiddenIDbox">