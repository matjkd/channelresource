<div class="ui-widget">
<?php 
if ($this->session->flashdata('message'))
	{
	echo "
	<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
	<p>
	
	<span class='ui-icon ui-icon-alert' style='float:left; margin-top:3px; margin-right:.3em;'></span>
	<strong>Alert:</strong> ".$this->session->flashdata('message')."
	</p>
	</div>";
	}

	
	
	?>

</div>