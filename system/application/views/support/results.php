

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
    <?= form_fieldset() ?>
   <input id="supportcheckbox" type="checkbox" name="email_changes" value="email">Check this box to email changes
   
    <?= form_fieldset_close() ?>
    <?= form_fieldset() ?>
    <?= form_submit('submit', 'Reset') ?>
    <?= form_submit('submit', 'Update') ?>
    <?= form_fieldset_close() ?>

<?= form_close() ?>
</div>
<?php $this->load->view('support/response'); ?>

<?php $this->load->view('support/list_replies'); ?>
<div style="padding-top:30px;"></div>
<?php $this->load->view('support/listattachments'); ?>



<div style="clear:both; padding-top:30px;">



<?php $this->load->view('support/ticketlist'); ?>
</div>