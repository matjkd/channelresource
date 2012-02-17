<!doctype html>
<?= $this->load->view('global/themes/header') ?>
<script>
    (function() {
        $("button, #linkbutton, .buttonstyle").button();


    });
</script>

<body>
    <?= form_open('support/add_reply/' . $ticket_id . '') ?>

    <textarea cols='155' rows='3'  name='comment' ></textarea>
    <br/>

    <input id="supportcheckbox" type="checkbox" name="email_changes" value="email">Check this box to email changes<br/>
    <input type="submit" name="submit" value="Submit" class="buttonstyle">

    <?= form_close() ?>
</body>
</html>


