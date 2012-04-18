

<div>

    <?php echo validation_errors('<p class="error">'); ?>	

    <?php
    $this->load->view('admin/table');
    $user_id = $this->session->userdata('user_id');

    $attributes = array('id' => 'prospectform');
    $hidden = array('user_id' => $user_id, 'ticket_id' => $ticket_id);
    echo form_open_multipart('support/create_ticket', $attributes, $hidden);


    $this->load->view('support/support_request');
    ?>
    <hr/>
    <?= form_fieldset() ?>
    
    <?php

        $role = $this->session->userdata('role');
        if ($role == 1) { ?>
   <input id="supportcheckbox" type="checkbox" name="email_changes" value="email" checked="yes">Check this box to email changes
   
   <?php } else { ?>
        
        <input id="supportcheckbox" type="checkbox" name="email_changes" value="email" checked="yes" style="display:none;">Check this box to email changes
        <?php } ?>
   
    <?= form_fieldset_close() ?>
    <?= form_fieldset() ?>
    <input type="submit" name="submit" value="Reset" class="buttonstyle">
   <input type="submit" name="submit" value="Update" class="buttonstyle">
    <?= form_fieldset_close() ?>

<?= form_close() ?>
</div>
 <div style="position:absolute; top:10px; right:4px; display:block;" id="top_controls" >

     
        <a id="linkbutton" href="<?= base_url() ?>support">New Support Request</a>
      

 
    </div>



<?php $this->load->view('support/response'); ?>

<?php $this->load->view('support/list_replies'); ?>
<div style="padding-top:30px;"></div>
<?php $this->load->view('support/listattachments'); ?>



<div style="clear:both; padding-top:30px;">



<?php $this->load->view('support/ticketlist'); ?>
</div>