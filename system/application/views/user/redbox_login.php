<div id="login_form">

 <div align="center" style="background:#e14148; color:#ffffff;  height:118px; margin:0 0 10px; padding-top:10px;">
			
	     <?php 

$is_logged_in = $this->session->userdata('is_logged_in');
if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo form_open('user/redbox_login/validate_credentials');
			echo "USERNAME<br/>";
			echo form_input('username', '');?>
			<br/>
			<?php 
			echo "PASSWORD<br/>";
			echo form_password('password', '');?>
			<br/>
			<?php
			echo form_submit('submit', 'Login');
			echo form_close();
	
			
		}	

		else
			{
				echo 'Hello '; 
				echo $this->session->userdata('firstname');
				echo ' '; 
				echo $this->session->userdata('lastname');
				echo ' | ';?>
				 
				 
				<a href='<?=base_url()?>user/redbox_login/logout' style="color:#ffffff">Logout</a>
				
			
				<?php 
			}
?>
	     </div>
	       
</div><!-- end login_form-->
