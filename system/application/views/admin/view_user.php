<?php echo validation_errors('<p class="error">'); ?>
<?php 
foreach ($user_info as $key => $row):?>
<script>
$(document).ready(function() {
	var uid = "<?=$user_id?>";
    $(".edit").editable("<?=site_url('/edit/edit_user')?>", 
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

    $('.editable').editable("<?=site_url('/edit/edit_user')?>", { 
        data   : " {'1':'Super Admin','2':'Admin','3':'Registered', 'selected':'<?=$row['role']?>'}",
        type   : 'select',
        id   : 'elementid',
        submit : 'OK',
        submitdata : function() 
        {
            return {id : uid};
}
    });
    
});
</script>

<div style="width:50%; float:left;">

<table class="profiletable">

<?php 
	$firstname =  "<div class='edit' id='firstname'>".$row['firstname']."</div>";
	$lastname =  "<div class='edit' id='lastname'>".$row['lastname']."</div>";
	$email = "<div class='edit' id='email_address'>".$row['email_address']."</div>";
	$userrole = "<div class='editable' id='role'></div>";
	$username = $row['username'];
	echo "
	<tr>
		<td class='leftcolumn'>
		<strong>Username</strong>
		</td>
		<td>
		 $username
		</td>
	</tr>
	<tr>
		<td class='leftcolumn'>
		<strong>Firstname</strong>
		</td>
		<td>
		 $firstname
		</td>
	</tr>
	<tr>
		<td class='leftcolumn'>
		<strong>Surname</strong>
		</td>
		<td>
		 $lastname
		</td>
	</tr>
	<tr>
		<td class='leftcolumn'>
		<strong>Email</strong>
		</td>
		<td>
		 $email
		</td>
	</tr>";
$role = $this->session->userdata('role');
		if($role == 1)
		{
			echo "<tr>
		<td class='leftcolumn'>
		<strong>Role</strong>
		</td>
		<td>
		 $userrole
		</td>
	</tr>";
                       
		}	
		 
	
	

 	endforeach; 
 	?>
 	</table>
 	</div>
 <div style="width:48%; float:right;">
<strong>Reset user password:</strong>
 <?=form_open('edit/edit_password')?>
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
	
	<?=form_hidden('user_id', $user_id)?>
	<?=form_submit('submit', 'Submit')?>
	<?=form_close()?>
 

 </div>	
 
 <div style="clear:both">

	<?php 
	if(($this->session->userdata('user_id')) == $user_id)
	{
	$this->load->view('admin/tabs'); 
	}
	?>
	</div>
 	