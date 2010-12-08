<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
	<br/>
<div id="tabs" style="width:795px;">
	<ul>
		<li><a href="#tabs-1">Normal User Guides</a></li>
		<li><a href="#tabs-2">Main User guides</a></li>
		<li><a href="#tabs-3">Super User Guides</a></li>
		<li><a href="#tabs-4">Downloads</a></li>
	</ul>
	



<div id="tabs-1">

<?php foreach($normal_guides as $normal):?>

<a href="<?=base_url()?>userguide/viewguide/<?=$normal['user_guide_id']?>"><?=$normal['title']?></a><br/>

<?php endforeach; ?>

</div>

<div  id="tabs-2">
<?php foreach($main_guides as $main):?>

<a href="<?=base_url()?>userguide/viewguide/<?=$main['user_guide_id']?>"><?=$main['title']?></a><br/>

<?php endforeach; ?>
</div>

<div id="tabs-3">
<?php foreach($super_guides as $super):?>

<a href="<?=base_url()?>userguide/viewguide/<?=$super['user_guide_id']?>"><?=$super['title']?></a><br/>

<?php endforeach; ?>


</div>
<div id="tabs-4">
<img src="<?=base_url()?>images/pdf_button.png"></img>
<a href="<?=base_url()?>images/files/normal.user.2.1.pdf" target="_blank">Normal User Guide</a>
<br/>
<img src="<?=base_url()?>images/pdf_button.png"></img>
<a href="<?=base_url()?>images/files/main-user.2.1.pdf" target="_blank">Main User Guide</a>
<br/>
<img src="<?=base_url()?>images/pdf_button.png"></img>
<a href="<?=base_url()?>images/files/super.user.2.1.pdf" target="_blank">Super User Guide</a>
</div>
</div>