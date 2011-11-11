 <?php 
$currency = trim($currency);
if($currency == "&#0128;" || $currency == "€") {$currency = "€"; $euro = TRUE;  }
if($currency == "&#163;" || $currency == "£") {$currency = "£"; $pound = TRUE;}
if($currency == NULL) {$currency = "£"; $pound = TRUE;}
if($currency == "$") {$currency = "$"; $dollar=TRUE;}
 
if(!isset($euro)) { $euro = FALSE; }
 if(!isset($pound)) { $pound = FALSE; }
 if(!isset($dollar)) { $dollar = FALSE; }
 
 
 if($capital_type == 1) {$capitalval = TRUE; $periodicval = FALSE; }
  if($capital_type == 2) {$capitalval = FALSE; $periodicval = TRUE; }
   if($capital_type==NULL) {$capitalval = TRUE; $periodicval = FALSE; }
  
   if($interest_type == 1) {$interestval = TRUE; $rateper1000val = FALSE; }
    if($interest_type == 2) {$interestval = FALSE; $rateper1000val = TRUE; }
      if($interest_type==NULL) {$interestval = TRUE; $rateper1000val = FALSE; }
    
       if($payment_type == 2) {$advanceval = TRUE; $arrearsval = FALSE; }
    if($payment_type == 1) {$advanceval = FALSE; $arrearsval = TRUE; }
     if($payment_type==NULL) {$advanceval = FALSE; $arrearsval = TRUE; }
    
     if($payment_frequency == 12) {$monthlyval = TRUE; $quarterlyval = FALSE; $yearlyval = FALSE;}
      if($payment_frequency == 4) {$monthlyval = FALSE; $quarterlyval = TRUE; $yearlyval = FALSE;}
       if($payment_frequency == 1) {$monthlyval = FALSE; $quarterlyval = FALSE; $yearlyval = TRUE;}
        if($payment_frequency==NULL) {$monthlyval = TRUE; $quarterlyval = FALSE; $yearlyval = FALSE;}
 ?>
<script type="text/javascript">
	$(function() {
		var availableTags = [<?php $this->load->view('ajax/json_users');?>];
		$("#company").autocomplete({
			source: availableTags,
			 select: function(event,ui){
			$('#assign_id').val(ui.item.id);
                                                $('#currency' ).val(ui.item.currency);
                                                 $('#interestrate').val(ui.item.interestrate);
                                                  $('#initial').val(ui.item.initial);
                                                   $('#regular').val(ui.item.regular);
                }
		});
	});
	
	
</script>
<?php 
	
	$user_id = $this->session->userdata('user_id');
	
	$attributes = array('id' => 'quoteform');
	$hidden = array('user_id' => $user_id);
	echo form_open('mobile/quote_results', $attributes, $hidden); 
?>

  <input type="hidden" name="assigned_id" id="assign_id" value="<?=set_value('assigned_id')?>"/>

<fieldset data-role="controlgroup" >
  <div data-role="fieldcontain">                   
    <label class="ui-btn-text" for="basic">Assign To User:</label>
    <input type="text" name="assigned_name" id="company" value="<?=set_value('assigned_name', $assigned_name)?>"  />
    
     <label class="ui-btn-text" for="basic">Reference (for your Info):</label>
    <input type="text" name="quote_ref" id="basic" value="<?=set_value('quote_ref', $quote_ref)?>"  />
  </div>
 </fieldset>   
    
          	
<fieldset data-role="controlgroup" class="controlgroup" data-type="horizontal">
	<legend>Currency:</legend>
        
  
  
  <label class="ui-btn-text" for="choice-a">£</label>
     	<input type="radio" name="currency" id="choice-a" class="ui-icon" value="£" <?php echo set_radio('currency', '£', $pound); ?>/>
     	
<label class="ui-btn-text" for="choice-b">€</label>
     	<input type="radio" name="currency" id="choice-b" class="ui-icon" value="€"  <?php echo set_radio('currency', '€', $euro); ?>/>
  
<label class="ui-btn-text" for="choice-c">$</label>
     	<input type="radio" name="currency" id="choice-c" class="ui-icon" value="$"  <?php echo set_radio('currency', '$', $dollar); ?>/>
  
  

        
     
     	
</fieldset>
          
<fieldset data-role="controlgroup" >
	<legend>Capital Type:</legend>
        <label class="ui-btn-text" for="choice-1">Capital Amount</label>
     	<input type="radio" name="capital_type" class="ui-icon"  id="choice-1" value="1" <?php echo set_radio('capital_type', '1', $capitalval); ?>/>
     	
<label class="ui-btn-text" for="choice-2">Periodic Payment</label>
     	<input type="radio" name="capital_type" class="ui-icon"  id="choice-2" value="2"  <?php echo set_radio('capital_type', '2', $periodicval); ?>/>
     	

     	     <input type="number" name="amount_type" id="basic" value="<?=set_value('amount_type', $amount_type)?>"  />	
</fieldset>
    
    
<fieldset data-role="controlgroup" >
	<legend>Calculate By:</legend>
        <label class="ui-btn-text" for="calc-1">Interest Rate</label>
     	<input  class="ui-icon"  type="radio" name="interest_type" id="calc-1" value="1" <?php echo set_radio('interest_type', '1', $interestval); ?> />
     	
<label class="ui-btn-text" for="calc-2">Rate Per 1000</label>
     	<input  class="ui-icon"  type="radio" name="interest_type" id="calc-2" value="2" <?php echo set_radio('interest_type', '2', $rateper1000val); ?> />
     	

     	<input  type="text" name="calculate_by" value="<?=set_value('calculate_by', $calculate_by)?>" id="interestrate" />	
</fieldset>
    
    
<fieldset data-role="controlgroup" >
	<legend>Payment Type:</legend>
        <label class="ui-btn-text" for="payment-1">Advance</label>
     	<input type="radio" name="payment_type" id="payment-1" class="ui-icon"  value="2" <?php echo set_radio('payment_type', '2', $advanceval); ?> />
     	
<label class="ui-btn-text" for="payment-2">Arrears</label>
     	<input type="radio" name="payment_type" id="payment-2"  class="ui-icon" value="1"  <?php echo set_radio('payment_type', '1', $arrearsval); ?> />
     	

     	
</fieldset>

<fieldset data-role="controlgroup" >
	<legend>Payment Frequency:</legend>
        <label class="ui-btn-text" for="frequency-1">Monthly</label>
     	<input type="radio" name="payment_frequency" id="frequency-1" class="ui-icon"  value="12" <?php echo set_radio('payment_frequency', '12', $monthlyval); ?>/>
     	
<label class="ui-btn-text" for="frequency-2">Quarterly</label>
     	<input type="radio" name="payment_frequency" id="frequency-2"  class="ui-icon" value="4" <?php echo set_radio('payment_frequency', '4', $quarterlyval); ?> />
     	
<label class="ui-btn-text" for="frequency-3">Annually</label>
     	<input type="radio" name="payment_frequency" id="frequency-3" class="ui-icon"  value="1"  <?php echo set_radio('payment_frequency', '1', $yearlyval); ?>/>
     	
</fieldset>    
    
<fieldset data-role="controlgroup" >
    
      <div data-role="fieldcontain">                   
    <label for="basic">Initial:</label>
    <input type="number" name="initial" id="initial" value="<?=set_value('initial', $initial)?>"  />
    
     <label for="basic">Regular:</label>
    <input type="number" name="regular" id="regular" value="<?=set_value('regular', $regular)?>"  />
  </div>
    
</fieldset>
  
  
      
<fieldset data-role="controlgroup" >
    <h3>Cost per User/Port Recurring Revenue Pricing</h3>
      <div data-role="fieldcontain">                   
    <label for="basic">Number of Ports/Users:</label>
    <input type="number" name="number_of_ports" id="number_ports" value="<?=set_value('number_of_ports', $number_of_ports)?>"  />
    
     <label for="basic">Annual Support Costs:</label>
    <input type="number" name="annual_support_costs" id="support_costs" value="<?=set_value('annual_support_costs', $annual_support_costs)?>"  />
    
    
    <label for="basic">Other Monthly Costs:</label>
    <input type="number" name="other_monthly_costs" id="monthly_costs" value="<?=set_value('other_monthly_costs', $other_monthly_costs)?>"  />
  </div>
    
</fieldset>
  
<?=form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'))?>
<?=form_hidden('user_id', $user_id)?>
 <?php
 if(isset($quote_id)){
     echo form_hidden('quote_id', $quote_id);
 
     
 }
 
 ?>
  
  
    
   <input type="hidden" name="assigned" value="<?php echo $assigned; ?>" id="hiddenIDbox"> 
 
   <?php if(isset($submit) && $submit == "update"){?>
 
       <?=form_hidden('submitted', 'Update')?>
   
    <?=form_submit('submit', 'Update')?>
  <?php } else  { ?>
 <?=form_hidden('submitted', 'Submit')?>
  <?=form_submit('submit', 'Submit')?>
<?php } ?>
 </form>