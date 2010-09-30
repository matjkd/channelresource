 
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
$auto = "id='list'";
$autohide = "id='hiddenIDbox'";
$user_id = $this->session->userdata('user_id');
$this->table->set_heading('Price Lists and Proposals', '');
$this->table->add_row('Customer/Prospect', form_input('customer_name',set_value('customer_name', $customer_name) ,$auto));
$this->table->add_row('Reference', form_input('pricelist_ref', set_value('pricelist_ref', $pricelist_ref)));
$this->table->add_row('Number of Users', form_input('pricelist_users', set_value('pricelist_users', $pricelist_users)));
$this->table->add_row('Discount (%)', form_input('pricelist_discount', set_value('pricelist_discount', $pricelist_discount)));
$this->table->add_row('Additional Professional Services', form_input('additionalservices', set_value('additionalservices', $additionalservices)));

echo form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'));

?>
<input type="hidden" name="customer_id" value="<?=$customer_id;?>" id="hiddenIDbox">