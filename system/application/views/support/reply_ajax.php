<!doctype html>
<?= $this->load->view('global/themes/header') ?>
<script>
    (function() {
        $("button, #linkbutton, .buttonstyle").button();


    });
</script>

<body>
    <?= form_open('support/add_reply/' . $ticket_id . '') ?>

    <textarea style="width:100%;" rows='3'  name='comment' ></textarea>
    <br/>
<?php

        $role = $this->session->userdata('role');
        if ($role == 1) { ?>
    
        <input id="supportcheckbox" type="checkbox" name="email_changes" value="email" checked="yes">Check this box to email changes<br/>
    
    <?php } else { ?>
        
        <input id="supportcheckbox" type="checkbox" name="email_changes" value="email" checked="yes" style="display:none;">Check this box to email changes<br/>
        <?php } ?>
    
    <input type="submit" name="submit" value="Submit" class="buttonstyle">

    <?= form_close() ?>
</body>
</html>


