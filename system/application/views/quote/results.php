<div id="leftside"><?php
$attributes = array('id' => 'quoteform');
$hidden = array('user_id' => $user_id, 'quote_id' => $quote_id);
echo form_open('quote/results', $attributes, $hidden);

$this->load->view('admin/table');
$this->load->view('quote/quote_table');
$this->table->add_row(form_submit('submit', 'Reset'), form_submit('submit', 'Update'));
echo $this->table->generate();
$this->table->clear();

if ($currency == NULL) {
    $currency = "&pound;";
}
?>
    
    
    <!--    buttons at top right of quote results-->
    <div style="position:absolute; top:10px; right:4px; display:block;" id="top_controls" class="<?=$quote_id?>">

        <button type="button" id="email-pdf" >Email PDF</button>
        
        <a href="<?= base_url() ?>quote/results/<?= $quote_id ?>/pdf"><button type="button">PDF</button></a> 
        <button type="submit" value="Reset" name="submit">Reset</button>
        <button type="submit" value="Update" name="submit">Update</button>  
        
        
    </div>
</div>
<div id="rightside" class="ajax_box">

<?php
foreach ($quote_results as $key => $row):


    $this->table->set_heading('Results', '');
    $this->table->add_row('Capital Amount', $currency . number_format($row['capital'], 2));
    $this->table->add_row('Interest Rate', $row['interest_rate']);
    $this->table->add_row('Rate Per Thousand', $row['rate_per_1000']);

    $this->table->add_row('Payment Type', $row['payment_type']);
    $this->table->add_row('Payment Frequency', $row['payment_frequency']);
    $this->table->add_row('Payment Profile', $row['initial'] . "+" . $row['regular']);
    $this->table->add_row('Initial', $currency . $row['initial_result']);
    $this->table->add_row('Regular', $currency . $row['regular_result']);
    $this->table->add_row('', '');
    $this->table->add_row('', '');
    $this->table->add_row('', '');
    echo $this->table->generate();
    $this->table->clear();
    $this->table->set_heading('Cost per User/Unit Pricing', '');
    $this->table->add_row('<strong>Product cost per port/user</strong>', $currency . $row['product_cost_per_port']);
    $this->table->add_row('<strong>Service cost per port/user</strong>', $currency . $row['service_cost_per_port']);
    $this->table->add_row('<hr>', '<hr>');
    $this->table->add_row('<strong>Total Cost Per Port/User per month</strong>', $currency . $row['cost_per_port_per_month']);
    echo $this->table->generate();
    $this->table->clear();

endforeach;
?>

</div>
<div style="clear:both">
    <?php $this->load->view('quote/listentries'); ?>
</div>


<div id="dialog-form" title="Email PDF">
	<p class="validateTips">All form fields are required.</p>

	<form>
	<fieldset>
		
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
		
	</fieldset>
	</form>
</div>