<script type="text/javascript">


	function deletefeature(id) {
		var answer = confirm("are you sure you want to delete category?")
		if (answer){

			window.location = "<?=base_url()?>userguide/delete_category/"+ id;
		}
		else{
			alert("nothing deleted!")
		}
	}
</script>

<div id='cats' style="padding-top:10px;">

<ul id='sortable'>
<?php foreach($categories as $key => $row):?>
   <?php if($row['guide_cat_id'] != '0') { ?>
<li class="ui-state-default">
<span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?=$row['guide_cat']?><a href="<?=base_url()?>userguide/delete_cat/<?=$row['guide_cat_id']?>" ><div style="float:right; margin-left:5px;" class="ui-icon ui-icon-circle-close"></div></a>
</li>
<?php } ?>
<?php endforeach;?>
</ul>
</div>