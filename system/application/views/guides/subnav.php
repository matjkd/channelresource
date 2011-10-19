<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});




	function delcat(id) {
		var answer = confirm("are you sure you want to delete category?")
		if (answer){

			window.location = "<?=base_url()?>userguide/delcat/"+ id;
		}
		else{
			alert("nothing deleted!")
		}
	}

	</script>
	<br/>
<div id="tabs" style="width:795px;">
	<ul>
		<?php foreach($categories as $row1):?>
                    <?php if($row1['guide_cat_id'] != '0') { ?>
                        <li>
                             <a href="#tabs<?=$row1['guide_cat_id']?>"><?=$row1['guide_cat']?>  </a>

                            <?php if($this->session->userdata('role') == 1) {?>
                                 <a href="#" onclick="delcat(<?=$row1['guide_cat_id']?>)"> <div style="float:right; margin-left:0px;" class="ui-icon ui-icon-circle-close"></div></a>
                            <?php } ?>
                        </li>

                    <?php } ?>

		<?php endforeach; ?>

                <li>
                    <a href="#downloads-tab">Downloads</a>
                </li>

		<?php if($this->session->userdata('role') == 1) {?>

                <li>
                    <a href="#uncategorised-tab">Uncategorised</a>
                </li>
            
                 <?php } ?>
	</ul>
	
	<?php foreach($categories as $row2):
            if($row2['guide_cat_id'] != '0') { ?>

                <div id="tabs<?=$row2['guide_cat_id']?>">
		
			<?php foreach($all_guides as $row):?>
			<?php if($row['guide_category'] == $row2['guide_cat_id']) { ?>
			<a href="<?=base_url()?>userguide/viewguide/<?=$row['user_guide_id']?>"><?=$row['title']?></a><br/>
			<?php } ?>
			<?php
                        endforeach; ?>
		
		</div>
	<?php } endforeach;  ?>

	<div id="downloads-tab">
	<img src="<?=base_url()?>images/pdf_button.png"/>
	<a href="<?=base_url()?>images/files/normal.user.2.2.pdf" target="_blank">Normal User Guide</a>
	<br/>
	<img src="<?=base_url()?>images/pdf_button.png"/>
	<a href="<?=base_url()?>images/files/main-user.2.2.pdf" target="_blank">Main User Guide</a>
	<br/>
	<img src="<?=base_url()?>images/pdf_button.png"/>
	<a href="<?=base_url()?>images/files/super.user.2.2.pdf" target="_blank">Super User Guide</a>
	</div>

<?php if($this->session->userdata('role') == 1) { ?>
       <div id="uncategorised-tab">
       <?php foreach($all_guides as $row):?>
			<?php if($row['guide_category'] == '0') { ?>
			<a href="<?=base_url()?>userguide/viewguide/<?=$row['user_guide_id']?>"><?=$row['title']?></a><br/>
			<?php } ?>
			<?php endforeach; ?>

       </div>

    <?php } ?>
</div>