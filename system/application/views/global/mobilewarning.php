



<?php
if ($this->session->flashdata('message'))
{
?>


		
                                                                               <div class="ui-bar ui-bar-e" id="warningbox">
						<div style="float:left; font-size:85%; margin-top:6px;"><?=$this->session->flashdata('message')?></div>
						<div style="float:right; margin-top:4px;"><a href="#" data-role="button" data-icon="delete" data-iconpos="notext">Button</a></div>
						
					</div>

			
		
	
<?php } ?>


<?php
if (isset($message))
{
?>


                                                                               <div class="ui-bar ui-bar-e" id="warningbox">
						<div style="float:left; font-size:85%; margin-top:6px;"><?=$message?></div>
						<div style="float:right; margin-top:4px;"><a href="#" data-role="button" data-icon="delete" data-iconpos="notext">Button</a></div>
						
					</div>
		
		
	
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function() { $('#warningbox').fadeOut(); }, 5000);
});
</script>