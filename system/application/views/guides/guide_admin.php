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