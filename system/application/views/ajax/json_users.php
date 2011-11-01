<?php 


foreach ($items as $key=>$row) {
if($row['currency'] == "&#0128;") {$currency3 = "€";}
if($row['currency'] == "&#163;") {$currency3 = "£";}
if($row['currency'] == NULL) {$currency3 = "£";}
if($row['currency'] == "$") {$currency3 = "$";}
		?>
		{"value":"<?=$row['firstname']?> <?=$row['lastname']?>","id":<?=$row['user_id']?>, "currency":"<?=$currency3?>", "interestrate":"<?=$row['interestrate']?>", "initial":"<?=$row['initial']?>", "regular":"<?=$row['regular']?>"},
<?php 	
}

	
?>