<?php 


foreach ($items as $key=>$row) {
	
		echo "{c:[{name:'".$row['customer_name']."'},{id:'".$row['customer_id']."'}]},";
	
}

	
?>