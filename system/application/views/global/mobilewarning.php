



<?php
if ($this->session->flashdata('message'))
{
?>


		
                                                                               <div class="ui-bar ui-bar-e" id="warningbox">
						<h3 style="float:left; margin-top:8px;">Alert. </h3>
						<div style="float:right; margin-top:4px;"><a href="#" data-role="button" data-icon="delete" data-iconpos="notext">Button</a></div>
						<p style="clear:both; font-size:85%; margin-bottom:8px;"><?=$this->session->flashdata('message')?></p>
					</div>

			
		
	
<?php } ?>


<?php
if (isset($message))
{
?>


                                                                               <div class="ui-bar ui-bar-e" id="warningbox">
						<h3 style="float:left; margin-top:8px;">Alert. </h3>
						<div style="float:right; margin-top:4px;"><a href="#" data-role="button" data-icon="delete" data-iconpos="notext">Button</a></div>
						<p style="clear:both; font-size:85%; margin-bottom:8px;"><?=$message?></p>
					</div>
		
		
	
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function() { $('#warningbox').fadeOut(); }, 5000);
});
</script>