<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<?php foreach($quote_results as $key => $row): ?>

<h2>Quote Results</h2>
		<ul data-role="listview" data-inset="true">
                                <li>
                                        <h3>Captial Amount:</h3>

                                        <p class="ui-li-aside"><strong><?=$currency.number_format($row['capital'], 2)?></strong></p>
                                </li>

                                                        <li>
                                                                        <h3>Interest Rate:</h3>

                                                                        <p class="ui-li-aside"><strong><?=$row['interest_rate']?></strong></p>
                                                        </li>

                                                        <li>
                                                                <h3>Rate Per Thousand:</h3>

                                                                <p class="ui-li-aside"><strong><?=$row['rate_per_1000']?></strong></p>
                                                        </li>

                                                        <li>
                                                                <h3>Payment Type:</h3>

                                                                <p class="ui-li-aside"><strong><?=$row['payment_type']?></strong></p>
                                                        </li>
                                                        
                                                        <li>
                                                                <h3>Payment Frequency:</h3>

                                                                <p class="ui-li-aside"><strong><?=$row['payment_frequency']?></strong></p>
                                                        </li>
                                                        
                                                         <li>
                                                                <h3>Payment Profile:</h3>

                                                                <p class="ui-li-aside"><strong><?=$row['initial']."+".$row['regular']?></strong></p>
                                                        </li>
                                                        
                                                        <li>
                                                                <h3>Initial:</h3>

                                                                <p class="ui-li-aside"><strong><?=$currency.$row['initial_result']?></strong></p>
                                                        </li>
                                                        
                                                        
                                                        <li>
                                                                <h3>Regular:</h3>

                                                                <p class="ui-li-aside"><strong><?=$currency.$row['regular_result']?></strong></p>
                                                        </li>
                                                        
                                                        
			
		</ul>
 
    
<?php endforeach; ?>

