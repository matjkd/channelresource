<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
	<br/>
<div id="tabs" style="width:795px;">
	<ul>
		<?php foreach($categories as $row1):?>
            <?php if($row1['guide_cat_id'] != '0') { ?>
		<li><a href="#tabs<?=$row1['guide_cat_id']?>"><?=$row1['guide_cat']?></a></li>
                <?php } ?>
		<?php endforeach; ?>
                <li><a href="#downloads-tab">Downloads</a></li>
		<?php if($this->session->userdata('role') == 1) {?>
                <li><a href="#uncategorised-tab">Uncategorised</a></li>
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
	<a href="<?=base_url()?>images/files/normal.user.2.1.pdf" target="_blank">Normal User Guide</a>
	<br/>
	<img src="<?=base_url()?>images/pdf_button.png"/>
	<a href="<?=base_url()?>images/files/main-user.2.1.pdf" target="_blank">Main User Guide</a>
	<br/>
	<img src="<?=base_url()?>images/pdf_button.png"/>
	<a href="<?=base_url()?>images/files/super.user.2.1.pdf" target="_blank">Super User Guide</a>
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