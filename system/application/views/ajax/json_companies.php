<?php 


foreach ($items as $key=>$row) {
	
		?>
		{"value":"<?=$row['company_name']?>","id":<?=$row['company_id']?>},";
<?php 	
}

	
?>