<?php if($guide==NULL)

{
	?>
	<p>Welcome to the Lease-Desk user guide section. Here you will find fully
	 illustrated, interactive step-by-step instructions on how to use Lease-Desk.com
	  within your business and if you are a Super User, how to set up and maintain 
	  Lease-Desk. In addition, you will find full length PDF versions of the user
	   guides, broken down by Role Type along with common F.A.Q's.</p>
 
<p>To access the Interactive Guides, click on any of the areas below to display
 the full menu for that area; then click on the menu item you'd like to explore.</p>
        <p><strong>Please bare with us as we are currently working on the
         interactive guides however all details can be found in
          the PDF versions (under Downloads)</strong></p>
	<?php 
}

?>


<?php  foreach($guide as $key => $row): ?>

<div id="guide_container">
<div id="guide_title"><h2><?=$row['title']?></h2></div>

<div class="clr"></div>
	<div id="guide_desc">
	
	<?=$row['description']?>
	</div>
	
	<div id="guide_video">
	<object width="480" height="385">
	<param name="movie" value="http://www.youtube-nocookie.com/v/<?=$row['filename']?>?fs=1&amp;hl=en_GB&amp;rel=0&amp;color1=0x2b405b&amp;color2=0x6b8ab6">
	</param>
	<param name="allowFullScreen" value="true">
	</param>
	<param name="allowscriptaccess" value="always">
	</param>
	<embed src="http://www.youtube-nocookie.com/v/<?=$row['filename']?>?fs=1&amp;hl=en_GB&amp;rel=0&amp;color1=0x2b405b&amp;color2=0x6b8ab6" 
	type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed>
	</object>
	</div>
	<div class="clr"></div>
	
	<div id="guide_nav">
		Navigation
	</div>
</div>
<?php endforeach;?>
<?php $this->load->view('guides/links'); ?>
