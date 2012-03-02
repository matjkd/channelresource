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

    $(function() {
        var availableTags = [<?php $this->load->view('ajax/json_users'); ?>];
        $("#company").autocomplete({
            source: availableTags,
            select: function(event,ui){
                $('#assign_id').val(ui.item.id);
                $('#currency' ).val(ui.item.currency);
               
            }
        });
    });
	
	
</script>
<?php
if ($completion_date != NULL && $completion_date != "0000-00-00") {
    $humandate = new DateTime($completion_date);
    $humandate = date_format($humandate, 'D, d M Y');
} else {
    $humandate = "N/A";
}

$user_id = $this->session->userdata('user_id');
$role = $this->session->userdata('role');
$datepicker = "id='datepicker'";
$altdatepicker = "id='altdatepicker'";
$auto = "id='company'";
?>


<input type="hidden" name="assigned_id" id="assign_id" value="<?= $assigned_id ?>"/>

<div id="contact_form" class="support_form">

    <p class="Company">
        <?= form_label('Company') ?><br/>
<?php   if ($this->session->userdata('company_id') < 3) { ?>
    
   

       <select name="company_owner" id="company_owner">
            <?php foreach ($companies as $row): ?>
                <?php
                if ($row['company_id'] == $company_id) {
                    $selectedcompany = "selected='selected'";
                } else {
                    $selectedcompany = "";
                }
                ?>
                <option value="<?= $row['company_id'] ?>" <?= $selectedcompany ?>><?= $row['company_name'] ?></option>
                <?php $selectedcompany = ""; ?>
            <?php endforeach; ?>


        </select>
   
    
    
<?php } else { ?>
        <strong><?= $channel_partner_name ?></strong>
<?php } ?>
    </p>

</div>
<div id="contact_form" class="support_form">
    <p class="Support_ID">
        <?= form_label('Support ID') ?><br/>
        <strong> <?= $ticket_id ?></strong>

    </p>
</div>
<div style="clear:both"></div>
<hr/>

<div id="contact_form" class="support_form">
    
 <?php   if ($this->session->userdata('company_id') < 3) { ?>
    
     <p class="assign">
        <?= form_label('Assign to User') ?><br/>

        <?= form_input('assign_name', set_value('assigned_name', $assigned_name), $auto) ?>
<input type="hidden" name="assigned" value="<?php echo $assigned; ?>" id="hiddenIDbox">
    </p>
    
    
<?php }?>
    
    
    <p class="Subject">
        <?= form_label('Subject') ?><br/>

        <?= form_input('support_subject', set_value('support_subject', $support_subject)) ?>

    </p>

    <p class="Telephone">
        <?= form_label('Telephone') ?><br/>

        <?= form_input('telephone', set_value('telephone', $telephone)) ?>

    </p>


    <p class="Email">
        <?= form_label('Email') ?><br/>

        <?= form_input('email_address', set_value('email_address', $email_address)) ?>

    </p>



    <p class="Attachment">
        <?= form_label('Attachment') ?><br/>

        <?= form_upload('file') ?>
    </p>


</div>


<div id="contact_form" class="support_form">
    <p>


        <?= form_label('Area') ?><br/>




        <select name="support_type" id="support_type">
            <?php foreach ($areas as $row): ?>
                <?php
                if ($row['status_value'] == $support_type) {
                    $selectedarea = "selected='selected'";
                } else {
                    $selectedarea = "";
                }
                ?>
                <option value="<?= $row['status_value'] ?>" <?= $selectedarea ?>><?= $row['status_name'] ?></option>
                <?php $selectedarea = ""; ?>
            <?php endforeach; ?>


        </select>


    </p>

    <p>


        <?= form_label('Type') ?><br/>


        <select name="support_issue" id="support_issue">
            <?php foreach ($type as $row): ?>
                <?php
                if ($row['status_value'] == $support_issue) {
                    $selectedtype = "selected='selected'";
                } else {
                    $selectedtype = "";
                }
                ?>
                <option value="<?= $row['status_value'] ?>" <?= $selectedtype ?>><?= $row['status_name'] ?></option>
                <?php $selectedtype = ""; ?>
            <?php endforeach; ?>


        </select>


    </p>


    <p>

        <?= form_label('Priority') ?><br/>


        <select name="support_priority" id="support_priority">
            <?php foreach ($prioritylist as $row): ?>
                <?php
                if ($row['status_value'] == $support_priority) {
                    $selectedpriority = "selected='selected'";
                } else {
                    $selectedpriority = "";
                }
                ?>
                <option value="<?= $row['status_value'] ?>" <?= $selectedpriority ?>><?= $row['status_name'] ?></option>
                <?php $selectedpriority = ""; ?>
            <?php endforeach; ?>


        </select>

    </p>


    <p>
        <?php if ($this->uri->segment(2) != "results") { ?>

        <?php } else { ?>  



        <?php } ?>
        <?= form_label('Estimated Completion Date') ?><br/>

        <?php if (!isset($role) || $role != 1) { ?>

            <?= $humandate ?>

        <?php } else { ?>

            <?= form_input('completion_datehuman', set_value('completion_datehuman', $humandate), $datepicker) ?>
            <span style="display:none;">   <?= form_input('completion_date', set_value('completion_date', $completion_date), $altdatepicker) ?></span>

        <?php } ?>



    </p>

    <p class="Status">

        <?php
        $segment = $this->uri->segment(2);
        if ($segment == 'results') {
         ?>
         <?= form_label('Status') ?><br/>
          <select name="support_status" id="support_status">
            <?php foreach ($statuslist as $row): ?>
                <?php
                if ($row['status_value'] == $support_status) {
                    $selectedstatus = "selected='selected'";
                } else {
                    $selectedstatus = "";
                }
                ?>
                <option value="<?= $row['status_value'] ?>" <?= $selectedstatus ?>><?= $row['status_name'] ?></option>
                <?php $selectedstatus = ""; ?>
            <?php endforeach; ?>


        </select>
        
        
        <?php
        } else {
            
        }
        ?>
    </p>

</div>
<div style='clear:both;'></div>
<div>
    <br/>
    <hr/>
    <strong>Description</strong>
    <br/>

    <?php if ($this->uri->segment(2) == "results") { ?>
        <div id="descriptionFixed"><?= $support_description ?></div>
        <?= form_hidden('support_description', $support_description) ?>
    <? } else { ?>
        <textarea  name='support_description' cols='155' rows='5' style="width:100%;"></textarea>
    <? } ?>
</div>
<?= form_hidden('mobile', 0) ?>
<?= form_hidden('date_added', unix_to_human(now(), TRUE, 'eu')) ?>
<?= form_hidden('user_id', $user_id) ?>


<input type="hidden" name="channel_partner" value="<?php echo $channel_partner_name; ?>" id="hiddenIDbox"/>