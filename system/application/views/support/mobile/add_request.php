<script>
    //reset type=date inputs to text
    $( document ).bind( "mobileinit", function(){
        $.mobile.page.prototype.options.degradeInputs.date = true;
    });	
    
       $(document).ready(function(){
	
     
       $("#datewatch").live('click', convertDate);
         $(".ui-state-default").live('click', convertDate);
       
    });
    
       function convertDate(){
        var oldDate = $("#datewatch").attr('value');	
      
      
            displaydate = $.datepicker.formatDate('DD, MM, d, yy', new Date(oldDate));
            databasedate = $.datepicker.formatDate('yy-mm-dd', new Date(oldDate));
        
        $("[name=completion_date_display]").val(displaydate);
        $("[name=completion_date]").val(databasedate);
    }
    
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
        
        <input type="text" name="completion_date_display" id="displaydate" value=""  />
         <input style="display:none;" type="text" name="completion_date" id="altdatedatepicker" value=""  />
        <input style="display:none;" type="date" name="datewatch" id="datewatch" value=""  />	
      <?php } ?>
    </fieldset>  

    <?= form_hidden('mobile', 1) ?>
    <?= form_hidden('date_added', unix_to_human(now(), TRUE, 'eu')) ?>
    <?= form_hidden('user_id', $user_id) ?>
    <?= form_submit('submit', 'Submit') ?>
    <?= form_close() ?>