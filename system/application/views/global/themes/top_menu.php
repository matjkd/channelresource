
<div id="top_menu">
    		<ul>
                 <?php $is_logged_in = $this->session->userdata('is_logged_in');

                   if(!isset($is_logged_in) || $is_logged_in == true)
                    {
                 ?>
		                  
                    <li><a href="<?=base_url()?>" >HOME</a></li>
                    <?php
                    }
                    ?>




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
                                        
                                        <li><a href="<?=base_url()?>userguide/guidelist">GUIDES ADMIN</a></li>

					<?php

					}

					?>
		</ul>
 </div> 