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
                    <label class="ui-btn-text" for="basic">Company:</label>
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
                    <label class="ui-btn-text" for="basic">Responsible:</label>

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

                <p class="assign">
                    <label class="ui-btn-text" for="basic">Contact Person:</label>
                    <input type="text" name="assign_name" id='company' value="<?= set_value('assign_name', $assigned_name) ?>"  />

                    <input type="hidden" name="assigned" value="<?php echo $assigned; ?>" id="hiddenIDbox">
                </p>


            <?php } else { ?>


                <p class="assign">
                    <label class="ui-btn-text" for="basic">Contact Person:</label>

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



            <label class="ui-btn-text" for="basic">Subject:</label>
            <input type="text" name="support_subject" id="basic" value="<?= set_value('support_subject', $support_subject) ?>"  />


            <label class="ui-btn-text" for="basic">Telephone:</label>
            <input type="text" name="telephone" id="basic" value="<?= set_value('telephone', $telephone) ?>"  />


            <label class="ui-btn-text" for="basic">Email:</label>
            <input type="text" name="email_address" id="basic" value="<?= set_value('email_address', $email_address) ?>"  />
        </div>
    </fieldset>   

    <fieldset data-role="controlgroup" >


        <label class="ui-btn-text" for="basic">Area:</label>
        <select name="support_type" id="support_type">
            <?php foreach ($areas as $row): ?>
                <option value="<?= $row['status_value'] ?>"><?= $row['status_name'] ?></option>

            <?php endforeach; ?>


        </select>

    </fieldset>   

    <fieldset data-role="controlgroup" >


        <label class="ui-btn-text" for="basic">Type:</label>
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
                <option value="<?= $row['status_value'] ?>"><?= $row['status_name'] ?></option>

            <?php endforeach; ?>


        </select>

    </fieldset> 




    <fieldset data-role="controlgroup" >


        <label class="ui-btn-text" for="support_description">Description:</label><br/>
        <textarea type="text" name="support_description" id="basic" ><?= set_value('support_description', $support_description) ?></textarea>

    </fieldset>   

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
    <?= form_submit('submit', 'Submit') ?>
    <?= form_close() ?>