{<?php $x=0; 
foreach($items as $key=>$row):
$x = $x + 1;
if($x ==1)
{
$selected_employee = $row['user_id'];
}
?>'<?php echo $row['user_id'];?>':'<?php echo $row['firstname'];?>&nbsp;<?php echo $row['lastname'];?>',<?php endforeach; ?>'selected':'<?=$selected_employee?>'}