<?php if($guide==NULL)

{
	?>
	<p>Welcome to the Lease-Desk user guide section. Here you will find fully
	 illustrated, interactive step-by-step instructions on how to use Lease-Desk.com
	  within your business and if you are a Super User, how to set up and maintain 
	  Lease-Desk. In addition, you will find full length PDF versions of the user
	   guides, broken down by Role Type along with common F.A.Q's.</p>
 
<p>To access the Interactive Guides, click on any of the areas below to display
 the full menu for that area; then click on the menu item you'd like to explore.</p>
        <p><strong>Please bare with us as we are currently working on the
         interactive guides however all details can be found in
          the PDF versions (under Downloads)</strong></p>
	<?php 
}

?>

<?php  foreach($guide as $key => $row): ?>
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '800',
			'height', '520',
			'src', '<?=base_url()?>images/flash/<?=$row['file_location']?>.swf',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', '1_logging_in',
			'bgcolor', '#666666',
			'name', '1_logging_in',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '<?=base_url()?>images/flash/1_logging_in',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="800" height="520" id="<?=$row['file_location']?>" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="<?=base_url()?>images/flash/<?=$row['file_location']?>.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#666666" />	
	<embed src="<?=base_url()?>images/flash/<?=$row['file_location']?>.swf" quality="high" bgcolor="#666666" width="800" height="520" name="<?=base_url()?>images/flash/1_logging_in" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
<?php endforeach;?>
<?php $this->load->view('guides/links'); ?>