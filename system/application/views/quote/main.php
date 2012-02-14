<?php $this->load->view('quote/assign'); ?>
<div id="leftside">

    <?php
        if ($currency == NULL) {
    $currency = "&pound;";
}
    
    $user_id = $this->session->userdata('user_id');

    $attributes = array('id' => 'quoteform');
    $hidden = array('user_id' => $user_id);
    echo form_open('quote/results', $attributes, $hidden);
    ?>

    <?php
// quote calculator form
    $this->load->view('admin/table');
    $this->load->view('quote/quote_table');

   
    echo $this->table->generate();
    $this->table->clear();
    ?>
    <input type="reset" name="reset" value="Reset" class="buttonstyle">
    <input type="submit" name="submit" value="Submit" class="buttonstyle">
    

    <?= form_close() ?>
</div>	
<div id="rightside" class="ajax_box">
    <?php echo validation_errors('<p class="error">'); ?>
</div>
<div style="clear:both;">
</div>
<div style="clear:both">

    <?php $this->load->view('quote/listentries'); ?>
</div>