<?php 


foreach ($items as $key=>$row) {
	
		?>
		{"value":"<?=$row['customer_name']?>","id":<?=$row['customer_id']?>},";
<?php 	
}

	
?>