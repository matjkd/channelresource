
<?php

foreach($categories as $row):
	$id = $row['guide_cat_id'];
	$cat = $row['guide_cat'];
        $category[$id] = $cat;
endforeach;
?>



	<h2>Add Guide</h2>
	<div id="contact_form">

			


			<?=form_open("userguide/addguide/")?>

                        <p>
			<?=form_label('Title')?> <?=form_input('title')?>
                        </p>

                        <p>
			<?=form_label('Filename')?> <?=form_input('filename')?>
                        </p>

                         <p>
			<?=form_label('Category')?> <?=form_dropdown('category', $category)?>
                         </p>
                         
                        <p>
                        <?=form_label('Description')?><br/>
			<textarea cols=75 rows=20 name="description" id="description" class='wymeditor'></textarea><br/>
                        </p>

			<input type="submit" class="wymupdate" />
			<?=form_close()?>
		


	</div>



