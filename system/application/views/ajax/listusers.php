<?php 


foreach ($items as $key=>$row) {
	
		?>
		{"value":"<?=$row['firstname']?> <?=$row['lastname']?>","id":<?=$row['user_id']?>},";
<?php 	
}

	
?>