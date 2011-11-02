<ul data-role="listview" data-split-icon="gear" data-split-theme="d" data-filter="true">

<?php foreach($quote_list as $key => $row):
   
		
		$old_date_added = strtotime($row['date_added']);
		$new_date_added = date('l jS \of F Y h:i:s A', $old_date_added);
    
    ?>



<li><a href="<?=base_url()?>mobile/view_quote_results/<?=$row['quote_id']?>">
                                                                <p><strong>Ref:</strong> <?=$row['quote_ref']?></p>
				<p><strong>Assigned to:</strong> <?=$row['fname']?> <?=$row['lname']?></p>
				<p><strong>Added By:</strong><?=$row['firstname']?> <?=$row['lastname']?></p>
<p><?=$new_date_added?></p>
				</a></li>





<?php endforeach; ?>
</ul>