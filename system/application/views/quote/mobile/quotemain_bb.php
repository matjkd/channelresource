<?php
$currency = trim($currency);
if ($currency == "&#0128;" || $currency == "€") {
    $currency = "€";
    $euro = TRUE;
}
if ($currency == "&#163;" || $currency == "£") {
    $currency = "£";
    $pound = TRUE;
}
if ($currency == NULL) {
    $currency = "£";
    $pound = TRUE;
}
if ($currency == "$") {
    $currency = "$";
    $dollar = TRUE;
}

if (!isset($euro)) {
    $euro = FALSE;
}
if (!isset($pound)) {
    $pound = FALSE;
}
if (!isset($dollar)) {
    $dollar = FALSE;
}


if ($capital_type == 1) {
    $capitalval = TRUE;
    $periodicval = FALSE;
}
if ($capital_type == 2) {
    $capitalval = FALSE;
    $periodicval = TRUE;
}
if ($capital_type == NULL) {
    $capitalval = TRUE;
    $periodicval = FALSE;
}

if ($interest_type == 1) {
    $interestval = TRUE;
    $rateper1000val = FALSE;
}
if ($interest_type == 2) {
    $interestval = FALSE;
    $rateper1000val = TRUE;
}
if ($interest_type == NULL) {
    $interestval = TRUE;
    $rateper1000val = FALSE;
}

if ($payment_type == 2) {
    $advanceval = TRUE;
    $arrearsval = FALSE;
}
if ($payment_type == 1) {
    $advanceval = FALSE;
    $arrearsval = TRUE;
}
if ($payment_type == NULL) {
    $advanceval = FALSE;
    $arrearsval = TRUE;
}

if ($payment_frequency == 12) {
    $monthlyval = TRUE;
    $quarterlyval = FALSE;
    $yearlyval = FALSE;
}
if ($payment_frequency == 4) {
    $monthlyval = FALSE;
    $quarterlyval = TRUE;
    $yearlyval = FALSE;
}
if ($payment_frequency == 1) {
    $monthlyval = FALSE;
    $quarterlyval = FALSE;
    $yearlyval = TRUE;
}
if ($payment_frequency == NULL) {
    $monthlyval = TRUE;
    $quarterlyval = FALSE;
    $yearlyval = FALSE;
}
?>
<script type="text/javascript">
    $(function() {
        var availableTags = [<?php $this->load->view('ajax/json_users'); ?>];
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

<input type="hidden" name="assigned_id" id="assign_id" value="<?= set_value('assigned_id') ?>"/>

<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">                   
        <label class="ui-btn-text ui-input-text" for="basic">Assign To User:</label>
        <input type="text" name="assigned_name" id="company" value="<?= set_value('assigned_name', $assigned_name) ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAOZJREFUeNrEkzEKhDAQRWfWCOIhRLDT1sLazuva23gADyDYWKuFoogIs05AcNXVLBabJpDkzX9MEiQieDJe8HSwgYpFHMdUFAX1fU9bTqiEMOx5HnRdB+M48sxFkPduCyRJQrZtS7iua1gM5Lrruvc94OQ9XJYlGIZx38St9hb2fR8cx8H1nFDVZpi1gyDAy2v8Bi+pEIYh7s9/GAzDIK8oz/OD9j75YDBNk4SFEDLtSvvUYJ5nME0T2ULTNLAsC3RdP9U+NUjTFKqqorVY0zQQRRH+8pQpyzJq25bWXqhw+Pff+BZgAD/OvI9PFUHuAAAAAElFTkSuQmCC); background-position: 100% 0%; background-repeat: no-repeat no-repeat; ">

        <label class="ui-btn-text ui-input-text" for="basic">Reference (for your Info):</label>
        <input type="text" name="quote_ref" id="basic" value="<?= set_value('quote_ref', $quote_ref) ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
    </div>
</fieldset>



<fieldset data-role="controlgroup" ><div role="heading" class="ui-controlgroup-label">Currency:</div><div class="ui-controlgroup-controls">

        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-top " for="choice-a" data-theme="c">
                <span class="ui-btn-inner ui-corner-top" aria-hidden="true">
                    <span class="ui-btn-text">£</span>
                    <span class=""></span></span>
            </label>

            <input type="radio" name="currency" id="choice-a" class="ui-icon" value="£" <?php echo set_radio('currency', '£', $pound); ?>/>
        </div>


        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left " for="choice-b" data-theme="c">
                <span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last" aria-hidden="true">
                    <span class="ui-btn-text">€</span><span class="">

                    </span>

                </span>
            </label>
            <input type="radio" name="currency" id="choice-b" class="ui-icon" value="€"  <?php echo set_radio('currency', '€', $euro); ?>/>
        </div>

        
        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-bottom" for="choice-c" data-theme="c">
                <span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last" aria-hidden="true">
                    <span class="ui-btn-text">$</span><span class="">

                    </span>

                </span>
            </label>
           <input type="radio" name="currency" id="choice-c" class="ui-icon" value="$"  <?php echo set_radio('currency', '$', $dollar); ?>/>
        </div>


        <input type="number" name="amount_type" id="basic" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">	
    </div>
</fieldset>



<fieldset data-role="controlgroup" ><div role="heading" class="ui-controlgroup-label">Capital Type:</div><div class="ui-controlgroup-controls">

        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-top " for="choice-1" data-theme="c">
                <span class="ui-btn-inner ui-corner-top" aria-hidden="true">
                    <span class="ui-btn-text">Capital Amount</span>
                    <span class=""></span></span>
            </label>

            <input type="radio" name="capital_type" class="ui-icon"  id="choice-1" value="1" <?php echo set_radio('capital_type', '1', $capitalval); ?>/>
        </div>


        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-bottom" for="choice-2" data-theme="c">
                <span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last" aria-hidden="true">
                    <span class="ui-btn-text">Periodic Payment</span><span class="">

                    </span>

                </span>
            </label>
            <input type="radio" name="capital_type" class="ui-icon"  id="choice-2" value="2"  <?php echo set_radio('capital_type', '2', $periodicval); ?>/>
        </div>



        <input type="number" name="amount_type" id="basic" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">	
    </div>
</fieldset>




<fieldset data-role="controlgroup" ><div role="heading" class="ui-controlgroup-label">Calculate By:</div><div class="ui-controlgroup-controls">

        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-top " for="calc-1" data-theme="c">
                <span class="ui-btn-inner ui-corner-top" aria-hidden="true">
                    <span class="ui-btn-text">Interest Rate</span>
                    <span class=""></span></span>
            </label>

              <input  class="ui-icon"  type="radio" name="interest_type" id="calc-1" value="1" <?php echo set_radio('interest_type', '1', $interestval); ?> />
        </div>


        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-bottom" for="calc-2" data-theme="c">
                <span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last" aria-hidden="true">
                    <span class="ui-btn-text">Rate Per Thousand</span><span class="">

                    </span>

                </span>
            </label>
              <input  class="ui-icon"  type="radio" name="interest_type" id="calc-2" value="2" <?php echo set_radio('interest_type', '2', $rateper1000val); ?> />
        </div>



        <input  type="text" name="calculate_by" value="<?= set_value('calculate_by', $calculate_by) ?>" id="interestrate" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"/>		
    </div>
</fieldset>


<fieldset data-role="controlgroup" ><div role="heading" class="ui-controlgroup-label">Payment Type:</div><div class="ui-controlgroup-controls">

        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-top " for="payment-1" data-theme="c">
                <span class="ui-btn-inner ui-corner-top" aria-hidden="true">
                    <span class="ui-btn-text">Advance</span>
                    <span class=""></span></span>
            </label>

              <input type="radio" name="payment_type" id="payment-1" class="ui-icon"  value="2" <?php echo set_radio('payment_type', '2', $advanceval); ?> />
        </div>


        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-bottom" for="payment-2" data-theme="c">
                <span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last" aria-hidden="true">
                    <span class="ui-btn-text">Arrears</span><span class="">

                    </span>

                </span>
            </label>
               <input type="radio" name="payment_type" id="payment-2"  class="ui-icon" value="1"  <?php echo set_radio('payment_type', '1', $arrearsval); ?> />
        </div>



       	
    </div>
</fieldset>



<fieldset data-role="controlgroup"><div role="heading" class="ui-controlgroup-label">Payment Frequency:</div><div class="ui-controlgroup-controls">

        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-top " for="frequency-1" data-theme="c">
                <span class="ui-btn-inner ui-corner-top" aria-hidden="true">
                    <span class="ui-btn-text">Monthly</span>
                    <span class=""></span></span>
            </label>

             <input type="radio" name="payment_frequency" id="frequency-1" class="ui-icon"  value="12" <?php echo set_radio('payment_frequency', '12', $monthlyval); ?>/>
        </div>


        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left " for="frequency-2" data-theme="c">
                <span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last" aria-hidden="true">
                    <span class="ui-btn-text">Quarterly</span><span class="">

                    </span>

                </span>
            </label>
          <input type="radio" name="payment_frequency" id="frequency-2"  class="ui-icon" value="4" <?php echo set_radio('payment_frequency', '4', $quarterlyval); ?> />
        </div>

        
        <div class="ui-radio">
            <label class="ui-btn-text ui-btn ui-btn-icon-left ui-corner-bottom" for="frequency-3" data-theme="c">
                <span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last" aria-hidden="true">
                    <span class="ui-btn-text">Yearly</span><span class="">

                    </span>

                </span>
            </label>
           <input type="radio" name="payment_frequency" id="frequency-3" class="ui-icon"  value="1"  <?php echo set_radio('payment_frequency', '1', $yearlyval); ?>/>
        </div>


        <input type="number" name="amount_type" id="basic" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">	
    </div>
</fieldset>

<hr/>  

<fieldset data-role="controlgroup" >

    <div data-role="fieldcontain">                   
        <label for="basic">Initial:</label>
        <input type="number" name="initial" id="initial" value="<?= set_value('initial', $initial) ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" />

        <label for="basic">Regular:</label>
        <input type="number" name="regular" id="regular" value="<?= set_value('regular', $regular) ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" />
    </div>

</fieldset>



<fieldset data-role="controlgroup" >
    <h3>Cost per User/Port Recurring Revenue Pricing</h3>
    <div data-role="fieldcontain">                   
        <label class="ui-btn-text ui-input-text" for="basic">Number of Ports/Users:</label>
        <input type="number" name="number_of_ports" id="number_ports" value="<?= set_value('number_of_ports', $number_of_ports) ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" />

        <label class="ui-btn-text ui-input-text" for="basic">Annual Support Costs:</label>
        <input type="number" name="annual_support_costs" id="support_costs" value="<?= set_value('annual_support_costs', $annual_support_costs) ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" />


        <label class="ui-btn-text ui-input-text" for="basic">Other Monthly Costs:</label>
        <input type="number" name="other_monthly_costs" id="monthly_costs" value="<?= set_value('other_monthly_costs', $other_monthly_costs) ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" />
    </div>

</fieldset>

<?= form_hidden('date_added', unix_to_human(now(), TRUE, 'eu')) ?>
<?= form_hidden('user_id', $user_id) ?>
<?php
if (isset($quote_id)) {
    echo form_hidden('quote_id', $quote_id);
}
?>



<input type="hidden" name="assigned" value="<?php echo $assigned; ?>" id="hiddenIDbox"> 

<?php if (isset($submit) && $submit == "update") { ?>

    <?= form_hidden('submitted', 'Update') ?>

    <?= form_submit('submit', 'Update') ?>
<?php } else { ?>
    <?= form_hidden('submitted', 'Submit') ?>
    <?= form_submit('submit', 'Submit') ?>
<?php } ?>
</form>