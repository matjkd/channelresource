{<?php $x=0; 
foreach($items as $key=>$row):
$x = $x + 1;
if($x ==1)
{
$selected_employee = $row['company_id'];
}
?>'<?php echo $row['company_id'];?>':'<?php echo $row['company_name'];?>',<?php endforeach; ?>'selected':'<?=$selected_employee?>'}