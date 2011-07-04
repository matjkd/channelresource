<?php if($this->session->userdata('role') == 1) {?>

<a alt="add new guide" href="<?=base_url()?>userguide/createguide"><img width="16px" height="16px" alt="edit" src="<?=base_url()?>images/icons/social/add_16.png"/></a>
Add New guide



<div id="accordion" style="width:800px;">
	<h3><a href="#">Edit</a></h3>
	<div>
		
			<?php  foreach($guide as $key => $admin): ?>
			
			
			<?php  $id = $admin['user_guide_id'];?>
			
		<div id="contact_form">
			<?=form_open("userguide/editguide/$id")?>

                    <p>
			<?=form_label('Title')?> <?=form_input('title', $admin['title'])?>
                    </p>
                    <p>
			<?=form_label('Filename')?> <input type="text" name="filename" id="filename" value="<?=$admin['filename']?>"><br/>
                    </p>
			      <div class="ui-widget">

                            <label for="category">Category</label>
                            <input  type="text" name="category" id="guide_category" value="<?=$guide_category?>"/>

                        </div>
			
			<textarea cols=75 rows=20 name="description" id="description" class='wymeditor'><?=$admin['description']?></textarea><br/>
			
			
			<input type="submit" class="wymupdate" />
			<?=form_close()?>
                </div>
			<?php endforeach;?>
			
			
	</div>
	<h3><a href="#">Add Tags</a></h3>
	<div>
		<p>
		<?=$this->load->view('guides/tags')?>
		</p>
	</div>

        <h3><a href="#">Categories Admin</a></h3>
	<div>
		<p>
		<?=$this->load->view('guides/cats')?>
		</p>
	</div>

</div>
	<?php }?>