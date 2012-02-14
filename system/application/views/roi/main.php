
<div id="leftside">

    <?php
    $user_id = $this->session->userdata('user_id');

    $attributes = array('id' => 'roiform');
    $hidden = array('user_id' => $user_id);
    echo form_open('roi/results', $attributes, $hidden);
    ?>
    <?php
// ROI calculator form
    $this->load->view('admin/table');
    $this->load->view('roi/roi_table');


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
    <?php $this->load->view('roi/listentries'); ?>
</div>