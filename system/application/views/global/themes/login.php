<div class="sidebox">



	     <?php

$is_logged_in = $this->session->userdata('is_logged_in');
if(!isset($is_logged_in) || $is_logged_in != true)
		{?>
	<form method="post" action="<?=base_url()?>user/login/validate_credentials"  target="_blank" >
	<div style="margin-top:7px; width:148px; float:left;">
		 <div id="inputs">
			   <input type="text" id="username" name="username" title="Username" /><br/>


			   <input type="password" id="password" name="password" title="Password" />
		</div>
	</div>

	<div style="width:41px; padding-top:5px; float:left;">

		<input type="image" name="submit" src="<?=base_url()?>images/icons/redbook_icon.png" border="0" />

	</div>

          </form>
    <?php }else
			{
				echo 'Hello ';
				echo $this->session->userdata('firstname');
				echo ' ';
				echo $this->session->userdata('lastname');
				echo ' | ';?>


				<a href='<?=base_url()?>user/login/logout' style="color:#ffffff">Logout</a>


				<?php
			}
?> 
</div>