<script type="text/javascript">
	$(function() {
		$("#accordion").accordion({
			collapsible: true,
			autoHeight: false,
			navigation: true
		});
	});
	</script>

Register prospects and customers here.<br/><br/>


<div id="leftside" >
	
	
	
<?php 

$this->load->view('admin/table');
$user_id = $this->session->userdata('user_id');
	
	$attributes = array('id' => 'prospectform');
	$hidden = array('user_id' => $user_id, 'customer_id' => $customer_id);
	
	echo form_open('prospect/create_customer', $attributes, $hidden); 


	$this->load->view('prospect/add_prospect');

	$this->table->add_row(form_submit('submit', 'Reset'), form_submit('submit', 'Update'));
	
	echo $this->table->generate();
	$this->table->clear();

?>
<?=form_close()?>
</div>

<div id="rightside" class="ajax_box">
	<?php echo validation_errors('<p class="error">'); ?>
	
	<div id="accordion">
	<h3><a href="#">ROI Calculations for <?=$customer_name?></a></h3>
	<div><?php $this->load->view('prospect/rois'); ?></div>
	
	<h3><a href="#">Pricelists for <?=$customer_name?></a></h3>
	<div><?php $this->load->view('prospect/pricelists'); ?></div>
	</div>
</div>
<div style="clear:both;">
</div>
<div style="clear:both">
	<?php //$this->load->view('prospect/listcustomers'); ?>
	<?php $this->load->view('prospect/listcustomers'); ?>
	</div>