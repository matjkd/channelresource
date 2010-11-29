guide admin

<?php  foreach($guide as $key => $admin): ?>


<?php  $id = $admin['user_guide_id'];?>


<?=form_open("admin/edit_guides/$id")?> 
Title: <?=form_input('title', $admin['title'])?>
<br/>
Filename: <input type="text" name="filename" id="filename" value="<?=$admin['filename']?>"><br/>
<textarea cols=75 rows=20 name="description" id="description" class='wymeditor'><?=$admin['description'];?></textarea>

<input type="submit" class="wymupdate" />
<?=form_close()?> 
<?php endforeach;?>