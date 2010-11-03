{<?php $x=0; 
foreach($items as $key=>$row):
$x = $x + 1;
if($x ==1)
{
$selected_employee = $row['customer_id'];
}
?>'<?php echo $row['customer_id'];?>':'<?php echo $row['customer_name'];?>',<?php endforeach; ?>'selected':'<?=$selected_employee?>'}