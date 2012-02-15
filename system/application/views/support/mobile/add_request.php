<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain">     

        <label class="ui-btn-text" for="basic">Subject:</label>
        <input type="text" name="support_subject" id="basic" value="<?= set_value('support_subject', $support_subject) ?>"  />
    </div>
</fieldset>   

<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain">     

        <label class="ui-btn-text" for="basic">Telephone:</label>
        <input type="text" name="telephone" id="basic" value="<?= set_value('telephone', $telephone) ?>"  />
    </div>
</fieldset> 

<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain">     

        <label class="ui-btn-text" for="basic">Email:</label>
        <input type="text" name="email_address" id="basic" value="<?= set_value('email_address', $email_address) ?>"  />
    </div>
</fieldset>   

<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain">     

            <label class="ui-btn-text" for="basic">Area:</label>
                <select name="support_type" id="support_type">
            <?php foreach($areas as $row):?>
             <option value="<?=$row['status_value']?>"><?=$row['status_name']?></option>
           
            <?php endforeach; ?>
    
           
        </select>
    </div>
</fieldset>   

<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain">     

            <label class="ui-btn-text" for="basic">Type:</label>
                <select name="support_issue" id="support_issue">
            <?php foreach($type as $row):?>
             <option value="<?=$row['status_value']?>"><?=$row['status_name']?></option>
           
            <?php endforeach; ?>
    
           
        </select>
    </div>
</fieldset>   

<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain">     

            <label class="ui-btn-text" for="basic">Priority:</label>
                <select name="support_priority" id="support_priority">
            <?php foreach($prioritylist as $row):?>
             <option value="<?=$row['status_value']?>"><?=$row['status_name']?></option>
           
            <?php endforeach; ?>
    
           
        </select>
    </div>
</fieldset>  

<fieldset data-role="controlgroup" >
    <div data-role="fieldcontain">     

        <label class="ui-btn-text" for="basic">Description:</label>
        <textarea type="text" name="support_description" id="basic" ><?= set_value('support_description', $support_description) ?></textarea>
    </div>
</fieldset>   