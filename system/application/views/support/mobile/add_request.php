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