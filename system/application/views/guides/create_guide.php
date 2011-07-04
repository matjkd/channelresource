guide admin (only visible if you have admin rights)

<?php

foreach($categories as $row):
	$id = $row['guide_cat_id'];
	$cat = $row['guide_cat'];
$category[$id] = $cat;
endforeach;
?>



	<h3><a href="#">Add</a></h3>
	<div>

			<?php  foreach($guide as $key => $admin): ?>


			<?php  $id = $admin['user_guide_id'];?>


			<?=form_open("userguide/addguide/")?>
			Title: <?=form_input('title', $admin['title'])?>
			<br/>
			Filename: <input type="text" name="filename" id="filename" value="<?=$admin['filename']?>"><br/>

			Category: <?=form_dropdown('category', $category, $admin['guide_category'])?> <br/>

			<textarea cols=75 rows=20 name="description" id="description" class='wymeditor'><?=$admin['description'];?></textarea><br/>


			<input type="submit" class="wymupdate" />
			<?=form_close()?>
			<?php endforeach;?>


	</div>



