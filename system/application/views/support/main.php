
<div>

    <?php echo validation_errors('<p class="error">'); ?>	

    <?php
    $this->load->view('admin/table');
    $user_id = $this->session->userdata('user_id');

    $attributes = array('id' => 'prospectform');
    $hidden = array('user_id' => $user_id);
    echo form_open_multipart('support/create_ticket', $attributes, $hidden);


    $this->load->view('support/support_request');?>

    <input type="reset" name="reset" value="Reset" class="buttonstyle">
    <input type="submit" name="submit" value="Submit" class="buttonstyle">
    
    <?= form_close() ?>
</div>

  <div style="position:absolute; top:10px; right:4px; display:block;" id="top_controls" >

     
        <a id="linkbutton" href="<?= base_url() ?>support">New Support Request</a>
      

 
    </div>



<div style="clear:both">

<?php //$this->load->view('prospect/listcustomers');  ?>
<?php $this->load->view('support/ticketlist'); ?>
</div>