<!-- MAIN NAVIGATION --> 
<div id="ja-mainnav" class="wrap">  	
  <div class="main clearfix"> 
  	<ul class="no-display"> 
  		<li><a href="/~channel/index.php#ja-content" title="Skip to content">Skip to content</a></li> 
  	</ul> 
  
		<ul id="ja-cssmenu" class="clearfix"> 
			<li>
			<a href="<?=base_url()?>" class="menu-item0 active first-item" id="menu1" title="Home">
			<span class="menu-title">Home</span></a>
			
			</li> 
			<?php $role = $this->session->userdata('role');
				if(!isset($role)|| $role > 0)
					{
						?>
						<li>
			<a href="<?=base_url()?>profile/view_user" class="menu-item0 active first-item" id="menu1" title="Profile">
			<span class="menu-title">User Profile</span></a>
			
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
						<span class="menu-title">Companies</span></a>
						
						</li> 
						
					<?php 	
						
					}
						
					?>
		
			
		</ul>			
 </div> 
</div> 
<!-- //MAIN NAVIGATION --> 
