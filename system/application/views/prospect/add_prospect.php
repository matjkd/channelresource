<script type="text/javascript">
	$(function() {
		$("button, input:submit, a", ".demo").button();
		
		$("a", "#datatable").click(function() { return false; });
	});
	</script>
<script type="text/javascript">
$(document).ready(function(){
	
	  var loadlist = "/ajax/get_companies/";

	  $("#list").autocomplete(loadlist, {
			width: 150,
			selectFirst: false
		});

	  $("#list").result(function(event, data, formatted) {
			if (data)
				$("#hiddenIDbox").val(data[1]);
		});

	  });


	$(function() {
		$("#datepicker").datepicker({showOtherMonths: true, selectOtherMonths: true, dateFormat: 'D, dd M yy' });
	});
	$(function() {
		$("#datepicker2").datepicker({showOtherMonths: true, selectOtherMonths: true, dateFormat: 'D, dd M yy'});
	});
	$(function() {
		$("#datepicker3").datepicker({changeMonth: true, changeYear: true, dateFormat: 'D, dd M yy'});
	});
	</script>

<?php 




$datepicker = "id='datepicker'";
$datepicker2 = "id='datepicker2'";
$datepicker3 = "id='datepicker3'";
$auto = "id='list'";
$autohide = "id='hiddenIDbox'";
$user_id = $this->session->userdata('user_id');
$this->table->set_heading('Add Prospect', '', '');
//edit the channel partner if you are admin
$role = $this->session->userdata('role');
if(!isset($role) || $role != 1)
					{
					$this->table->add_row('Channel Partner',$channel_partner_name);	
					}
					else
					{
					$this->table->add_row('Channel Partner', form_input('channel_partner_name', set_value('channel_partner_name', $channel_partner_name), $auto));
									
					}
						
					

//end of channel partner edit


$this->table->add_row('Company Name', form_input('customer_name', set_value('customer_name', $customer_name)));
$this->table->add_row('Telephone', form_input('customer_tel', set_value('customer_tel', $customer_tel)));

$status = array(1=>'Prospect',2=>'Customer');
$this->table->add_row('Status', form_dropdown('customer_status', $status, set_value('customer_status', $customer_status)));

if($customer_registration_date=='')
	{
		 $this->table->add_row('Registration Date', form_input('customer_registration_date', set_value('customer_registration_date', $customer_registration_date), $datepicker));
		
		
	}
	else
	{
		if($role == 1)
		{
			$this->table->add_row('Registration Date', form_input('customer_registration_date', set_value('customer_registration_date', $customer_registration_date), $datepicker));
		
		}
		else
		{
			$this->table->add_row('Registration Date',$customer_registration_date);	
		}
		 
	}			



$this->table->add_row('Subscription Date', form_input('customer_subscription_date', set_value('customer_subscription_date', $customer_subscription_date), $datepicker2));

$subscription_type = array(1=>'Annual', 2=>'5 Year');
$this->table->add_row('Subscription Type', form_dropdown('customer_subscription_type', $subscription_type,  set_value('customer_subscription_type', $customer_subscription_type)));
$this->table->add_row('Subscription Price', form_input('customer_subscription_price', set_value('customer_subscription_price', $customer_subscription_price)));
$this->table->add_row('Professional Services', form_input('customer_prof_services', set_value('customer_prof_services', $customer_prof_services)));
$this->table->add_row('Annual Support', form_input('customer_annual_support', set_value('customer_annual_support', $customer_annual_support)));
$this->table->add_row('Next Renewal', form_input('customer_next_renewal', set_value('customer_next_renewal', $customer_next_renewal), $datepicker3));

$renewal_type = array(1=>'Annual Subscription', 2=>'Annual Support', 3=>'5 Year Subscription');
$this->table->add_row('Renewal Type', form_dropdown('customer_renewal_type', $renewal_type, set_value('customer_renewal_type', $customer_renewal_type)));

echo form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'));
echo form_hidden('user_id', $user_id);

if (isset($duplicate_names))
{
?>
<input type="hidden" name="duplicate_overide" value="yes">
<?php 
}

?>
<input type="hidden" name="channel_partner" value="<?php echo $channel_partner; ?>" id="hiddenIDbox">