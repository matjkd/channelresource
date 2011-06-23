
<div id="top_menu">
    		<ul>
			<li><a href="<?=base_url()?>" >HOME</a></li>

			<?php $role = $this->session->userdata('role');
				if(!isset($role)|| $role > 0)
					{
					?>
                                        <li><a href="<?=base_url()?>profile/view_user" >USER PROFILE</a></li>

                         <?php
					}
					else
					{

					}
					?>
			<?php
				if(!isset($role) || $role != 1)
					{

					}
					else
					{
					?>
					<li><a href="<?=base_url()?>admin">COMPANIES</a></li>

					<?php

					}

					?>
		</ul>
 </div> 