<?php
if ($this->session->flashdata('message'))
{
?>

<div id="warningbox" class="ui-widget" style="padding-bottom:10px; width:370px;">
	<div class='ui-state-highlight ui-corner-all' style='padding: 0 .7em;'>
		<p>
			<span class='ui-icon ui-icon-alert' style='float:left; margin-top:0px; margin-right:.3em;'></span>
			<?=$this -> session -> flashdata('message') ?>

			<a href='#' onclick='javascript:this.parentNode.parentNode.parentNode.style.display="none"; return false;'> <span class='ui-icon ui-icon-circle-close' style='float:right; margin-top:0px; margin-right:.3em;'></span> </a>
		</p>
	</div>
</div>

<?php } ?>

<?php
if ($this->session->flashdata('popup'))
{
?>

<style>
	#popupbox {
		position: relative;
		margin: 0 auto;
		top: 50%;
		width: 300px;
		height: 100px;
		background: #fff;
		border: solid 5px #bd0d00;
		-moz-border-radius: 12px;
		-webkit-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 4px 5px 19px #212121;
		-webkit-box-shadow: 4px 5px 19px #212121;
		box-shadow: 4px 5px 19px #212121;
	}

</style>

<div style="z-index:100000; text-align:center; width:1040px; top:300px; position:fixed;">
	<div id="popupbox">
		<div >
			<a href='#' onclick='javascript:this.parentNode.parentNode.parentNode.style.display="none"; return false;'> <span class='ui-icon ui-icon-circle-close' style='float:right; margin-top:0px; margin-right:10px;'></span> </a>
			<div>
				<p>
					<br/>

					<?=$this -> session -> flashdata('popup') ?>

				</p>
			</div>
		</div>
	</div>

</div>

<?php } ?>

<?php
if (isset($message))
{
?>

<div id="warningbox" class="ui-widget" style="padding-bottom:10px; width:370px;">
	<div class='ui-state-highlight ui-corner-all' style='padding: 0 .7em;'>
		<p>
			<span class='ui-icon ui-icon-alert' style='float:left; margin-top:0px; margin-right:.3em;'></span>
			<?=$message ?>

			<a href='#' onclick='javascript:this.parentNode.parentNode.parentNode.style.display="none"; return false;'> <span class='ui-icon ui-icon-circle-close' style='float:right; margin-top:0px; margin-right:.3em;'></span> </a>
		</p>
	</div>
</div>

<?php } ?>

<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function() {
			$('#warningbox').fadeOut();
		}, 5000);

		setTimeout(function() {
			$('#popupbox').fadeOut();
		}, 10000);
	}); 
</script>
