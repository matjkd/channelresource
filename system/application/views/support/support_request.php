<script type="text/javascript">

	$(function() {
		$("#datepicker").datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'D, dd M yy',
                altField: "#altdatepicker",
                altFormat: "yy-mm-dd"}
                );
	});
</script>
<?php 

$humandate = new DateTime($completion_date);
$humandate = date_format($humandate, 'D, d M Y');


$user_id = $this->session->userdata('user_id');
$role = $this->session->userdata('role');
$datepicker = "id='datepicker'";
$altdatepicker = "id='altdatepicker'";
?>

<div>
     <table>

        <tr>
            <td>Support ID:</td>
            <td><strong> <?=$ticket_id?></strong></td>
        </tr>

        <tr>
            <td>Company:</td>
            <td><strong><?=$channel_partner_name?></strong></td>
        </tr>
        <tr>
            <td>Subject</td>
            <td><?=form_input('support_subject', set_value('support_subject', $support_subject))?></td>
        </tr>
        <tr>
            <td>Telephone</td>
            <td><?=form_input('telephone', set_value('telephone', $telephone))?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?=form_input('email_address', set_value('email_address', $email_address))?></td>
        </tr>


          <tr>
            <td>Attachment</td>
            <td><?=form_upload( 'file' )?></td>
        </tr>
     </table>

</div>

<div>
    <table>
    <?php $segment = $this->uri->segment(2);
    if ($segment == 'results')
    {
    $statusarray = array(1 => 'Submitted', 2=> 'Assigned', 3 => 'CLOSED');
    echo "<tr><td>Status:</td><td>".form_dropdown('support_status', $statusarray, set_value('support_status', $support_status))."</td></tr> ";
    }
    else
    {
    echo "<tr><td>Status:</td><td>".$support_status."</td></tr> ";
    }
    ?>
    </table>
</div>

<div style='clear:both;'></div>
    <br/>
    <hr/>
<div style='float:left; width:200px;'>
<strong>Area</strong><br/>
    <table width=90%>
    <?php $supportarray = array(1 => 'Lease-Desk', 2=> 'Channel-Resource', 3 => 'Customer-Resource', 4 => 'Training', 5=> 'Account Review'); ?>
        <tr>
          
            <td><?=form_dropdown('support_type', $supportarray, set_value('support_type', $support_type))?></td>
        </tr>
    </table>
</div>

<div style='float:left; width:200px;'>
<strong>Type</strong>
<br/>
    <table width=90%>
        <?php $issuearray = array(1 => 'Data Error', 2=> 'System Error', 3 => 'System Crash', 4 => 'Slow Response', 6=> 'Development', 5=> 'Other');?>
        <tr>
           
            <td>
                <?=form_dropdown('support_issue', $issuearray, set_value('support_issue', $support_issue))?>
            </td>
        </tr>
    </table>
</div>

<div style='float:left; width:200px;'>
<strong>Priority</strong>
<br/>
    <table width=90%>

        <?php $priorityarray = array(4 => 'Low', 3=> 'Medium', 2 => 'High', 1 => 'Urgent'); ?>
        <tr>
           
            <td>
                <?=form_dropdown('support_priority', $priorityarray, set_value('support_priority', $support_priority))?>
            </td>
        </tr>
    </table>
</div>

    <div style='float:left; width:200px;'>
<strong>Date to be Completed</strong>
<br/>
    <table width=90%>

        <tr>
           
            <td>
                <?=form_input('completion_datehuman', set_value('completion_datehuman', $humandate), $datepicker)?>
             <span style="display:none;">   <?=form_input('completion_date', set_value('completion_date', $completion_date), $altdatepicker)?></span>
            </td>
        </tr>
    </table>
</div>


<div style='clear:both;'>
    <br/>
    <hr/>
        <strong>Description</strong>
    <br/>
 <textarea name='support_description' cols='155' rows='12' style="width:100%;">
<?=$support_description?>
</textarea>
</div>
<?=form_hidden('date_added', unix_to_human(now(), TRUE, 'eu'))?>
<?=form_hidden('user_id', $user_id)?>


<input type="hidden" name="channel_partner" value="<?php echo $channel_partner_name; ?>" id="hiddenIDbox"/>