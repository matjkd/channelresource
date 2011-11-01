<?php 


foreach ($items as $key=>$row) {
	
		?>
		{"value":"<?=$row['firstname']?> <?=$row['lastname']?>","id":<?=$row['user_id']?>, "currency":"<?=$row['currency']?>", "interestrate":"<?=$row['interestrate']?>", "initial":"<?=$row['initial']?>", "regular":"<?=$row['regular']?>"},
<?php 	
}

	
?>