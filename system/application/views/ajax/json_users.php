<?php 


foreach ($items as $key=>$row) {
if($row['currency'] == "&#0128;") {$currency = "€";}
if($row['currency'] == "&#163;") {$currency = "£";}
if($row['currency'] == NULL) {$currency = "£";}
if($row['currency'] == "$") {$currency = "$";}
		?>
		{"value":"<?=$row['firstname']?> <?=$row['lastname']?>","id":<?=$row['user_id']?>, "currency":"<?=$currency?>", "interestrate":"<?=$row['interestrate']?>", "initial":"<?=$row['initial']?>", "regular":"<?=$row['regular']?>"},
<?php 	
}

	
?>