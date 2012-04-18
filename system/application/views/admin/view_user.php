<?php echo validation_errors('<p class="error">'); ?>
<?php
foreach ($user_info as $key => $row):
    if ($row['user_currency'] == NULL) {
        $defaultcurrency = 'Select Default Currency';
    } else {
        $defaultcurrency = $row['user_currency'];
    }
    ?>
    <script>
        $(document).ready(function() {
            var uid = "<?= $user_id ?>";
            $(".edit").editable("<?= site_url('/edit/edit_user') ?>", 
            {
                indicator : 'Saving...',
                id   : 'elementid',
                submit : 'OK',
                tooltip   : 'Click to edit...',
                submitdata : function() 
                {
                    return {id : uid};
                }
                
                    	        
            });
                
            $(".editUsername").editable("<?= site_url('/edit/edit_username') ?>", 
            {
                indicator : 'Saving...',
                id   : 'elementid',
                submit : 'OK',
                tooltip   : 'Click to edit...',
                submitdata : function() 
                {
                    return {id : uid};
                }
                
                    	        
            });

            $('.editable').editable("<?= site_url('/edit/edit_user') ?>", { 
                data   : " {'1':'Super Admin','2':'Admin','3':'Registered', 'selected':'<?= $row['role'] ?>'}",
                type   : 'select',
                id   : 'elementid',
                submit : 'OK',
                submitdata : function() 
                {
                    return {id : uid};
                }
            });
                
            $('.editablecurrency').editable("<?= site_url('/edit/edit_user') ?>", { 
                data   : " {'&#163;':'&pound;','&#0128;':'&euro;','$':'$', 'selected':'<?= $row['user_currency'] ?>'}",
                type   : 'select',
                id   : 'elementid',
                placeholder: '<?= $defaultcurrency ?>',
                submit : 'OK',
                submitdata : function() 
                {
                    return {id : uid};
                }
            });
                
        });
    </script>

    <div style="width:50%; float:left; padding-top:15px;">

        <table class="profiletable">

            <?php
            $username = $row['username'];
            $usernameEdit = "<div class='editUsername' id='username'>" . $username . "</div>";
            $firstname = "<div class='edit' id='firstname'>" . $row['firstname'] . "</div>";
            $lastname = "<div class='edit' id='lastname'>" . $row['lastname'] . "</div>";
            $email = "<div class='edit' id='email_address'>" . $row['email_address'] . "</div>";
            $userrole = "<div class='editable' id='role'></div>";
            ?>
            <tr>

                <td class='leftcolumn'>
                    <strong>Company</strong>
                </td>
                <td>
    <?= $row['company_name'] ?>
                </td>
            </tr>	

            <tr>

                <td class='leftcolumn'>
                    <strong>Username:</strong>
                </td>
                <td>
    <?= $usernameEdit ?>
                </td>
            </tr>
            <tr>
                <td class='leftcolumn'>
                    <strong>Firstname</strong>
                </td>
                <td>
    <?= $firstname ?>
                </td>
            </tr>
            <tr>
                <td class='leftcolumn'>
                    <strong>Surname</strong>
                </td>
                <td>
    <?= $lastname ?>
                </td>
            </tr>
            <tr>
                <td class='leftcolumn'>
                    <strong>Email</strong>
                </td>
                <td>
    <?= $email ?>
                </td>
            </tr>
    <?php
    $role = $this->session->userdata('role');
    if ($role == 1) {
        ?>
                <tr>
                    <td class='leftcolumn'>
                        <strong>Role</strong>
                    </td>
                    <td>
                        <?= $userrole ?>
                    </td>
                </tr>
            <?php } ?>



            <?php
        endforeach;
        ?>
    </table>
</div>
<div style="width:48%; float:right; padding-top:15px;">
    <strong>Reset user password:</strong>
    <?= form_open('edit/edit_password') ?>
    <table class="profiletable">	
        <tr>
            <td class='leftcolumn'>
                <strong>Password</strong>
            </td>
            <td>
                <?php echo form_password('password'); ?>
            </td>
        </tr>
        <tr>
            <td class='leftcolumn'>
                <strong>Re-Type Password</strong>
            </td>
            <td>
                <?php echo form_password('password2'); ?>
            </td>
        </tr>


    </table>

    <?= form_hidden('user_id', $user_id) ?>
    <?= form_submit('submit', 'Submit') ?>
    <?= form_close() ?>


</div>
<div style="clear:both;"></div>

<hr/>
<h1>Defaults</h1>
<table class="profiletable">	
    <tr>
        <td class='leftcolumn'>
            <strong>Currency</strong>
        </td>
        <td>
            <div class='editablecurrency' id='user_currency' style="width:200px; margin-left:10px;"></div>
        </td>
    </tr>
    <tr>
        <td class='leftcolumn'>
            <strong>Interest Rate</strong>
        </td>
        <td>
            <div class='edit' id='user_interestrate' style="width:200px; margin-left:10px;"><?= $row['user_interestrate'] ?></div>
        </td>
    </tr>
    <tr>
        <td class='leftcolumn'>
            <strong>Initial</strong>
        </td>
        <td>
            <div class='edit' id='user_initial' style="width:200px; margin-left:10px;"><?= $row['user_initial'] ?></div>
        </td>
    </tr>
    <tr>
        <td class='leftcolumn'>
            <strong>Regular</strong>
        </td>
        <td>
            <div class='edit' id='user_regular' style="width:200px; margin-left:10px;"><?= $row['user_regular'] ?></div>
        </td>
    </tr>

</table>



<div style="clear:both">

    <?php
    if (($this->session->userdata('user_id')) == $user_id) {
        $this->load->view('admin/tabs');
    }
    ?>
</div>
