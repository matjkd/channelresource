<?php 


foreach ($source as $key=>$row) {
	
		?>
		{"value":"<?=$row['tag']?>","id":<?=$row['tag_id']?>},
<?php 	
}

	
?>