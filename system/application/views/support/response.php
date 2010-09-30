
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
		$(this).next(".toggle_container").load("<?=site_url("/support/reply/".$ticket_id."");?>").slideToggle("fast");
		
		$("a.trigger").slideUp("slow");
		
	});

	




});
</script>


<hr></hr>
<a class="trigger" href="#" id="add_reply_button">Add Reply</a>
<div class='toggle_container'>
	
</div>


