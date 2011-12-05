<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
foreach ($quote_numbers as $row1):
    $firstname = $row1['firstname'];
    $lastname = $row1['lastname'];
endforeach;

?>
<?php foreach ($quote_results as $key => $row): ?>
<div class="ui-bar ui-bar-b">
   
	<a href="<?=base_url()?>mobile/print_quote/<?=$quote_id?>" data-transition="pop" >Email PDF</a>

        
        
</div>

    <ul data-role="listview" data-inset="true">

        <li data-role="list-divider">
            Details
            
              

        </li>
        
     <?php if ($this->session->userdata('user_id') < 3) { ?>      
        <li>
            Assigned to:

            <p class="ui-li-aside"><strong><?= $assigned_name ?></strong></p>
        </li>
        <?php } ?>

        <li>
            Quote Ref:

            <p class="ui-li-aside"><strong><?= $quote_ref ?></strong></p>
        </li>

        <li>
            Added by:

            <p class="ui-li-aside"><strong><?= $firstname ?> <?= $lastname ?></strong></p>
        </li>

        <li data-role="list-divider">
            Results

        </li>
        <li>
            Captial Amount:

            <p class="ui-li-aside"><strong><?= $currency . number_format($row['capital'], 2) ?></strong></p>
        </li>

        <li>
            Interest Rate:

            <p class="ui-li-aside"><strong><?= $row['interest_rate'] ?></strong></p>
        </li>

        <li>
            Rate Per Thousand:

            <p class="ui-li-aside"><strong><?= $row['rate_per_1000'] ?></strong></p>
        </li>

        <li>
            Payment Type:

            <p class="ui-li-aside"><strong><?= $row['payment_type'] ?></strong></p>
        </li>

        <li>
            Payment Frequency:

            <p class="ui-li-aside"><strong><?= $row['payment_frequency'] ?></strong></p>
        </li>

        <li>
            Payment Profile:

            <p class="ui-li-aside"><strong><?= $row['initial'] . "+" . $row['regular'] ?></strong></p>
        </li>

        <li>
            Initial:

            <p class="ui-li-aside"><strong><?= $currency . $row['initial_result'] ?></strong></p>
        </li>


        <li>
            Regular:

            <p class="ui-li-aside"><strong><?= $currency . $row['regular_result'] ?></strong></p>
        </li>
        <li data-role="list-divider">
            Cost per User/Unit Pricing

        </li>

        <li>
            Product cost per port/user:

            <p class="ui-li-aside"><strong><?= $currency . $row['product_cost_per_port'] ?></strong></p>
        </li>

        <li>
            Service cost per port/user:

            <p class="ui-li-aside"><strong><?= $currency . $row['service_cost_per_port'] ?></strong></p>
        </li>
        <li>
            Total Cost Per Port/User per month:

            <p class="ui-li-aside"><strong><?= $currency . $row['cost_per_port_per_month'] ?></strong></p>
        </li>







    </ul>


<?php endforeach; ?>



