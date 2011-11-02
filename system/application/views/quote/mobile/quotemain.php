 <?php 
$currency = trim($currency);
if($currency == "&#0128;" || $currency == "€") {$currency2 = "€";}
if($currency == "&#163;" || $currency == "£") {$currency2 = "£";}
if($currency == NULL) {$currency = "£";}
if($currency == "$") {$currency = "$";}
 
 
 
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

  <input type="hidden" name="assigned_id" id="assign_id" value="<?=$assigned_id?>"/>


  <div data-role="fieldcontain">                   
    <label for="basic">Assign To User:</label>
    <input type="text" name="assigned_name" id="company" value=""  />
    
     <label for="basic">Reference (for your Info):</label>
    <input type="text" name="quote_ref" id="basic" value=""  />
  </div>
    
          	
<fieldset data-role="controlgroup" data-type="horizontal" >
	<legend>Currency:</legend>
     	<select name="currency" id="currency" >
     	<option value="£" >£</option>
               <option value="€">€</option>
               <option value="$" >$</option>
        </select>

     	
</fieldset>
          
<fieldset data-role="controlgroup" >
	<legend>Capital Type:</legend>
        
     	<input type="radio" name="capital_type" id="choice-1" value="1" checked="checked" />
     	<label for="choice-1">Capital Amount</label>

     	<input type="radio" name="capital_type" id="choice-2" value="2"  />
     	<label for="choice-2">Periodic Payment</label>

     	     <input type="number" name="amount_type" id="basic" value=""  />	
</fieldset>
    
    
<fieldset data-role="controlgroup" >
	<legend>Calculate By:</legend>
        
     	<input type="radio" name="interest_type" id="calc-1" value="1" checked="checked" />
     	<label for="calc-1">Interest Rate</label>

     	<input type="radio" name="interest_type" id="calc-2" value="2"  />
     	<label for="calc-2">Rate Per 1000</label>

     	<input type="text" name="calculate_by" value="" id="interestrate"" />	
</fieldset>
    
    
<fieldset data-role="controlgroup" >
	<legend>Payment Type:</legend>
        
     	<input type="radio" name="payment_type" id="payment-1" value="2" checked="checked" />
     	<label for="payment-1">Advance</label>

     	<input type="radio" name="payment_type" id="payment-2" value="1"  />
     	<label for="payment-2">Arrears</label>

     	
</fieldset>

<fieldset data-role="controlgroup" >
	<legend>Payment Frequency:</legend>
        
     	<input type="radio" name="payment_frequency" id="frequency-1" value="12" checked="checked" />
     	<label for="frequency-1">Monthly</label>

     	<input type="radio" name="payment_frequency" id="frequency-2" value="4"  />
     	<label for="frequency-2">Quarterly</label>

     	<input type="radio" name="payment_frequency" id="frequency-3" value="1"  />
     	<label for="frequency-3">Annually</label>
</fieldset>    
    
    
      <div data-role="fieldcontain">                   
    <label for="basic">Initial:</label>
    <input type="number" name="initial" id="initial" value=""  />
    
     <label for="basic">Regular:</label>
    <input type="number" name="regular" id="regular" value=""  />
  </div>
  
<?=form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'))?>
<?=form_hidden('user_id', $user_id)?>
    
   <input type="hidden" name="assigned" value="<?php echo $assigned; ?>" id="hiddenIDbox"> 
<input type="submit" name="submit" value="Submit"  />
	

 </form>