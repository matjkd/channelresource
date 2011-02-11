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
<?php

foreach($categories as $row):
	$id = $row['guide_cat_id'];
	$cat = $row['guide_cat'];
$category[$id] = $cat;
endforeach;
?>


<div id="accordion" style="width:800px;">
	<h3><a href="#">Edit</a></h3>
	<div>
		
			<?php  foreach($guide as $key => $admin): ?>
			
			
			<?php  $id = $admin['user_guide_id'];?>
			
			
			<?=form_open("userguide/editguide/$id")?> 
			Title: <?=form_input('title', $admin['title'])?>
			<br/>
			Filename: <input type="text" name="filename" id="filename" value="<?=$admin['filename']?>"><br/>
			
			Category: <?=form_dropdown('category', $category, $admin['guide_category'])?> <br/>
			
			<textarea cols=75 rows=20 name="description" id="description" class='wymeditor'><?=$admin['description'];?></textarea><br/>
			
			
			<input type="submit" class="wymupdate" />
			<?=form_close()?> 
			<?php endforeach;?>
			
			
	</div>
	<h3><a href="#">Add Tags</a></h3>
	<div>
		<p>
		<?=$this->load->view('guides/tags')?>
		</p>
	</div>

</div>
