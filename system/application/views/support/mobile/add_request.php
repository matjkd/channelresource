<?php
/*
 * 
 * 
 */

$user_id = $this->session->userdata('user_id');
$role = $this->session->userdata('role');
?>


<form action="<?= base_url() ?>support/create_ticket" method="post" data-ajax="false">
    <fieldset data-role="controlgroup" >
        <div data-role="fieldcontain">     

            <label class="ui-btn-text" for="basic">Subject:</label>
            <input type="text" name="support_subject" id="basic" value="<?= set_value('support_subject') ?>"  />
        

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
                    <option value="<?= $row['status_value'] ?>"><?= $row['status_name'] ?></option>

                <?php endforeach; ?>


            </select>
       
    </fieldset>   

    <fieldset data-role="controlgroup" >
      

            <label class="ui-btn-text" for="basic">Priority:</label>
            <select name="support_priority" id="support_priority">
                <?php foreach ($prioritylist as $row): ?>
                    <option value="<?= $row['status_value'] ?>"><?= $row['status_name'] ?></option>

                <?php endforeach; ?>


            </select>
       
    </fieldset>  

    <fieldset data-role="controlgroup" >
        <div data-role="fieldcontain">     

            <label class="ui-btn-text" for="basic">Description:</label>
            <textarea type="text" name="support_description" id="basic" ><?= set_value('support_description', $support_description) ?></textarea>
        </div>
    </fieldset>   

    <?= form_hidden('mobile', 1) ?>
    <?= form_hidden('date_added', unix_to_human(now(), TRUE, 'eu')) ?>
    <?= form_hidden('user_id', $user_id) ?>
    <?= form_submit('submit', 'Submit') ?>
    <?= form_close() ?>