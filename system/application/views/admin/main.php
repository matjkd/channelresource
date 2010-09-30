<script type="text/javascript">

$(document).ready(function(){

	//Hide (Collapse) the toggle containers on load
	$(".toggle_container").hide(); 

	//Switch the "Open" and "Close" state per click
	$("a.trigger").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});

	//Slide up and down on click
	$("a.trigger").click(function(){
		$(this).next(".toggle_container").load("<?=site_url("/admin/create_company");?>").slideToggle("fast");
		
	});

	$("a.trigger2").click(function(){
		
		var request=$(this).attr('id');
		
		$(".ajax_box").load("<?=site_url("/admin/view_company");?>", {limit: request});
	});




});


</script>
<script type="text/javascript">
	$(function() {
		$("button, input:submit, a", ".demo").button();
		
		$("a", ".demo").click(function() { return false; });
	});
	</script>


<div id="leftside">

<?=$this->load->view('admin/view_companies')?>
<br/>
<div class="demo">
<a class="trigger" href="#">Create Company</a>

<div class='toggle_container'>
	<div class='block'>
	loading...
	</div>
</div>
</div>
</div>

<div id="rightside" class="ajax_box">
<div class='block'>
	
	<?php
	
	$segment_active = $this->uri->segment(3);
		if($segment_active!=NULL)
		{
		echo $this->load->view('admin/view_company');
		}
	?>
	</div>
</div>
<div style="clear:both;">
</div>