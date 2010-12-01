guide admin (only visible if you have admin rights)
<script type="text/javascript"> 
 
/* Here we replace each element with class 'wymeditor'
 * (typically textareas) by a WYMeditor instance.
 * 
 * We could use the 'html' option, to initialize the editor's content.
 * If this option isn't set, the content is retrieved from
 * the element being replaced.
 */
 
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
 
</script> 

<div id="accordion">
	<h3><a href="#">Edit</a></h3>
	<div>
		
			<?php  foreach($guide as $key => $admin): ?>
			
			
			<?php  $id = $admin['user_guide_id'];?>
			
			
			<?=form_open("userguide/editguide/$id")?> 
			Title: <?=form_input('title', $admin['title'])?>
			<br/>
			Filename: <input type="text" name="filename" id="filename" value="<?=$admin['filename']?>"><br/>
			<textarea cols=75 rows=20 name="description" id="description" class='wymeditor'><?=$admin['description'];?></textarea><br/>
			
			
			<input type="submit" class="wymupdate" />
			<?=form_close()?> 
			<?php endforeach;?>
			
			
	</div>
	<h3><a href="#">Add Taggs</a></h3>
	<div>
		<p>
		Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
		purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
		velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
		suscipit faucibus urna.
		</p>
	</div>

</div>
