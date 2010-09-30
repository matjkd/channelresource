<?php 
if (isset($duplicate_names))
{
	
	echo "<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
	<p>
	
	<span class='ui-icon ui-icon-alert' style='float:left; margin-top:3px; margin-right:.3em;'></span>
	<strong>Possible Duplicate:</strong> The Following are already in the database - <br/>";
	
	foreach($duplicate_names as $row):
	
	echo $row['customer_name'];
	echo "<br/>";
	
	
	
	endforeach;
	
	echo "<p>If your data duplicates any of the above, please contact Proctor Consulting. 
	Otherwise click submit again to override this check</p></p>
	</div>";
}
?>