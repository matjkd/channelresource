<style type="text/css">
	.ui-autocomplete {
		max-height: 200px;
		overflow-y: auto;
	}
	/* IE 6 doesn't support max-height
	 * we use height instead, but this forces the menu to always be this tall
	 */
	* html .ui-autocomplete {
		height: 200px;
	}
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 600px; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; float:left; }
	#sortable li span { position: absolute; margin-left: -1.3em; }
	</style>
	
<script type="text/javascript">
	$(function() {
		var availableTags = [<?php $this->load->view('guides/ajax_tags');?>];
		$("#tags").autocomplete({
			source: availableTags
		});
	});
	$(function() {
		$("#sortable").sortable();
		$("#sortable").disableSelection();
		
	});

	function deletefeature(id) {
		var answer = confirm("are you sure you want to delete tag?")
		if (answer){
			
			window.location = "<?=base_url()?>userguide/delete_tag/"+ id;
		}
		else{
			alert("nothing deleted!")
		}
	}
</script>
These tags are for helping with search. They won't be visible to users, but will be used when searching, so keep them relevant. 
<?php echo form_open('/userguide/add_tag/'.$guide_id.'');?>
<input type="text" name="newtag" id="tags" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Tag');  ?>
<?php echo form_close();?>
<div id='tags' style="padding-top:10px;">

<ul id='sortable'>
<?php foreach($assigned_tags as $key => $tagrow):?>
<li class="ui-state-default">
<span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?=$tagrow['tag']?><a href="<?=base_url()?>admin/userguide/delete_tag/<?=$tagrow['tag_id']?>" ><div style="float:right; margin-left:5px;" class="ui-icon ui-icon-circle-close"></div></a>
</li>
<?php endforeach;?>
</ul>
</div>