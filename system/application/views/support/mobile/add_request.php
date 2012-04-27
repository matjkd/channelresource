<script>
    //reset type=date inputs to text
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
/*
 * 
 * 
 */

if ($completion_date != NULL && $completion_date != "0000-00-00") {
    $humandate = new DateTime($completion_date);
    $humandate = date_format($humandate, 'D, d M Y');
} else {
    $humandate = "N/A";
}

$datepicker = "id='datepicker'";
$altdatepicker = "id='altdatepicker'";

$user_id = $this->session->userdata('user_id');
$role = $this->session->userdata('role');
?>


<form action="<?= base_url() ?>support/create_ticket" method="post" data-ajax="false">


    <input type="hidden" name="assigned_id" id="assign_id" value="<?= $assigned_id ?>"/>




    <fieldset data-role="controlgroup" >
        <div data-role="fieldcontain">     

            <?php if ($this->session->userdata('company_id') < 3) { ?>






                <p class="assign">
                    <label class="ui-btn-text" for="company_owner">Company:</label>
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
                </p>



                <p class="assign">
                    <label class="ui-btn-text" for="responsible">Responsible:</label>

                    <select name="responsible" id="company_owner">
                        <?php foreach ($responsibleusers as $row): ?>
                            <?php
                            if (isset($responsible) && $row['user_id'] == $responsible) {
                                $selectedid = "selected='selected'";
                            } else {
                                $selectedid = "";
                            }
                            ?>
                            <option value="<?= $row['user_id'] ?>" <?= $selectedid ?>><?= $row['firstname'] ?> <?= $row['lastname'] ?></option>
                            <?php $selectedid = ""; ?>
                        <?php endforeach; ?>


                    </select>
  
                </p>

                   <p class="assign" style="display:none;">
                    
                      
                    
                    <label class="ui-btn-text" for="assign_name">test:</label>
                   
                  <input type="text" name="test" id='test' value="test"  />
                  
                </p>
                <p class="assign">
                    
                      <input type="text" name="test" id='test' value="test" style="display:none;" />
                    
                    <label class="ui-btn-text" for="assign_name">Contact Person:</label>
                   
                    <input type="text" name="assign_name" id='company' value="<?= set_value('assign_name', $assigned_name) ?>"  />
<input type="hidden" name="assigned" value="<?php echo $assigned; ?>" id="hiddenIDbox">
                  
                </p>


            <?php } else { ?>


                <p class="assign">
                    <label class="ui-btn-text" for="company_owner">Contact Person:</label>

                    <select name="assigned_id" id="company_owner">
                        <?php foreach ($items as $row): ?>
                            <?php
                            if (isset($assigned) && $row['user_id'] == $assigned) {
                                $selectedid = "selected='selected'";
                            } else {
                                $selectedid = "";
                            }
                            ?>
                            <option value="<?= $row['user_id'] ?>" <?= $selectedid ?>><?= $row['firstname'] ?> <?= $row['lastname'] ?></option>
                            <?php $selectedid = ""; ?>
                        <?php endforeach; ?>


                    </select>

                </p>



            <?php } ?>
        </div>
    </fieldset>   

    <fieldset data-role="controlgroup" >

        <p>
            <label class="ui-btn-text" for="support_subject">Subject:</label>
            <input type="text" name="support_subject" id="support_subject" value="<?= set_value('support_subject', $support_subject) ?>"  />
        </p>
        
        <p>
            <label class="ui-btn-text" for="telephone">Telephone:</label>
            <input type="text" name="telephone" id="telephone" value="<?= set_value('telephone', $telephone) ?>"  />
        </p>



        <p>
            <label class="ui-btn-text" for="email_address">Email:</label>
            <input type="text" name="email_address" id="email_address" value="<?= set_value('email_address', $email_address) ?>"  />
        </p>

    </fieldset>   



    <fieldset data-role="controlgroup" >


        <label class="ui-btn-text" for="support_type">Area:</label>
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

    </fieldset>   

    <fieldset data-role="controlgroup" >


        <label class="ui-btn-text" for="support_issue">Type:</label>
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

    </fieldset>  




    <fieldset data-role="controlgroup" >


        <label class="ui-btn-text" for="support_priority">Priority:</label>
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

    </fieldset> 




    <fieldset data-role="controlgroup" >


        <label class="ui-btn-text" for="support_description">Description:</label><br/>
        <textarea type="text" name="support_description" id="basic" ><?= set_value('support_description', $support_description) ?></textarea>

    </fieldset>   

    <?php if ($resultsview == 1) { ?>

        <fieldset data-role="controlgroup" >


            <label class="ui-btn-text" for="support_status">Status:</label>
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

        </fieldset> 

    <?php } ?>

    <fieldset data-role="controlgroup" > 

        <label for="date">Estimated Completion Date:</label>
        <?php if (!isset($role) || $role != 1) { ?>

            <?= $humandate ?>

        <?php } else { ?>
            <?= form_input('completion_datehuman', set_value('completion_datehuman', $humandate), $datepicker) ?>
            <span style="display:none;">   <?= form_input('completion_date', set_value('completion_date', $completion_date), $altdatepicker) ?></span>
        <?php } ?>
    </fieldset>  

    <?= form_hidden('mobile', 1) ?>
    <?= form_hidden('date_added', unix_to_human(now(), TRUE, 'eu')) ?>
    <?= form_hidden('user_id', $user_id) ?>

    <?php if ($resultsview == 1) { ?>

        <?php $role = $this->session->userdata('role');
        if ($role == 1) { ?>
            <input id="supportcheckbox" type="checkbox" name="email_changes" value="email" checked="yes">Check this box to email changes

        <?php } else { ?>

            <input id="supportcheckbox" type="checkbox" name="email_changes" value="email" checked="yes" style="display:none;">
        <?php } ?>

        <input type="hidden" name="ticket_id" id="ticket_id" value="<?= $ticket_id ?>"/>
        <input type="submit" name="submit" value="Update">
    <?php } else { ?>
        <?= form_submit('submit', 'Submit') ?>
    <?php } ?>
    <?= form_close() ?>