

<div id="top_menu">
    		<ul>
			<li>
			<a href="<?=base_url()?>" class="menu-item0 active first-item" id="menu1" title="Home">
			<span class="menu-title"><img src="<?=base_url()?>images/home_icon.png" style="padding:2px;"></span></a>

			</li>
			<?php $role = $this->session->userdata('role');
				if(!isset($role)|| $role > 0)
					{
						?>
						<li>
			<a href="<?=base_url()?>profile/view_user" class="menu-item0 active first-item" id="menu1" title="Profile">
			USER PROFILE</a>

			</li> <?php
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
					<li>
						<a href="<?=base_url()?>admin" class="menu-item0 active first-item" id="menu1" title="admin">
						COMPANIES</a>

						</li>

					<?php

					}

					?>


		</ul>
 </div> 