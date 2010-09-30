<script src="<?=base_url()?>js/tiny_mce/tiny_mce.js" type="text/javascript"></script>				
<script type="text/javascript">
tinyMCE.init({
	mode : "textareas"
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	
	  var loadlist = "/ajax/get_companies/";

	  $("#list").autocomplete(loadlist, {
			width: 150,
			selectFirst: false
		});

	  $("#list").result(function(event, data, formatted) {
			if (data)
				$("#hiddenIDbox").val(data[1]);
		});

	  });


	
	</script>
<?php 
$auto = "id='list'";
$autohide = "id='hiddenIDbox'";
$user_id = $this->session->userdata('user_id');
echo "<div style='float:left; width:48%;'><table>";
$role = $this->session->userdata('role');
echo "<tr><td>Support ID:</td><td><strong> $ticket_id</strong></td></tr>";

echo "<tr><td>Company:</td><td><strong>$channel_partner_name</strong></td></tr>";	
echo "<tr><td>Subject</td><td>".form_input('support_subject', set_value('support_subject', $support_subject))."</td></tr>";
echo "<tr><td>Telephone</td><td>".form_input('telephone', set_value('telephone', $telephone))."</td></tr>";
echo "<tr><td>Email</td><td>".form_input('email_address', set_value('email_address', $email_address))."</td></tr>";
echo "</table></div>";

echo "<div style='float:left; width:48%;'>";
echo "<table width=90%>";
$segment = $this->uri->segment(2);
if ($segment == 'results')
{
$statusarray = array(1 => 'Submitted', 2=> 'Assigned', 3 => 'CLOSED');
echo "<tr><td>Status:</td><td>".form_dropdown('support_status', $statusarray, set_value('support_status', $support_status))."</td></tr> ";
}
else
{
echo "<tr><td>Status:</td><td>".$support_status."</td></tr> ";
}
echo "</table></div>";

echo "<div style='clear:both;'><br/><hr/>";
echo "<div style='float:left; width:250px;'>";
echo "<strong>Support Type</strong><br/><table width=90%>";
$supportarray = array(1 => 'Lease-Desk', 2=> 'Channel-Resource', 3 => 'Customer-Resource', 4 => 'Training', 5=> 'Account Review');
echo "<tr><td>Choose one:</td><td>".form_dropdown('support_type', $supportarray, set_value('support_type', $support_type))."</td></tr> ";
echo "</table></div>";

echo "<div style='float:left; width:250px;'>";
echo "<strong>Issue</strong><br/><table width=90%>";
$issuearray = array(1 => 'Data Error', 2=> 'System Error', 3 => 'System Crash', 4 => 'Slow Response', 5=> 'Other');
echo "<tr><td>Choose one:</td><td>".form_dropdown('support_issue', $issuearray, set_value('support_issue', $support_issue))."</td></tr> ";
echo "</table></div>";

echo "<div style='float:left; width:250px;'>";
echo "<strong>Priority</strong><br/><table width=90%>";

$priorityarray = array(4 => 'Low', 3=> 'Medium', 2 => 'High', 1 => 'Urgent');
echo "<tr><td>Choose one:</td><td>".form_dropdown('support_priority', $priorityarray, set_value('support_priority', $support_priority))."</td></tr> ";
echo "</table></div>";


echo "<div style='clear:both;'><br/><hr/>";
echo "<strong>Description</strong><br/><textarea name='support_description' cols='155' rows='12' >$support_description</textarea>";
echo "</div>";
echo form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'));
echo form_hidden('user_id', $user_id);

?>
<input type="hidden" name="channel_partner" value="<?php echo $channel_partner_name; ?>" id="hiddenIDbox">