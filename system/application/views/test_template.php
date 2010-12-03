<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="SHORTCUT ICON" href="http://www.channel-resource.com/favicon.ico">
 <link rel="shortcut icon" href="http://www.channel-resource.com/favicon.png" >
<link rel='stylesheet' href='<?=base_url()?>css/system.css' type='text/css' />
<link rel='stylesheet' href='<?=base_url()?>css/general.css' type='text/css' />
<link rel='stylesheet' href='<?=base_url()?>css/typo.css' type='text/css' />
<link rel='stylesheet' href='<?=base_url()?>css/autocomplete.css' type='text/css' />
<link rel='stylesheet' href='<?=base_url()?>css/jquery-ui-1.8.custom.css' type='text/css' />


<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script src="<?=base_url()?>js/Jquery.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jeditable.js" type="text/javascript"></script>


<script src="<?=base_url()?>js/jquery.dataTables.min.js" type="text/javascript"></script>
<link rel='stylesheet' href='<?=base_url()?>css/demo_table_jui.css' type='text/css' />



<script src="<?=base_url()?>js/jquery-ui-dev.js" type="text/javascript"></script>

<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="<?=base_url()?>js/AC_RunActiveContent.js" language="javascript"></script>
<link rel='stylesheet' href='<?=base_url()?>css/js.css' type='text/css' />
<!-- Menu head --> 
<link rel='stylesheet' href='<?=base_url()?>css/ja_menus/ja_cssmenu/ja.cssmenu.css' type='text/css' />

<link rel='stylesheet' href='<?=base_url()?>css/addons.css' type='text/css' />
			<script src="<?=base_url()?>css/ja_menus/ja_cssmenu/ja.cssmenu.js" type="text/javascript"></script>
			<link rel='stylesheet' href='<?=base_url()?>css/template.css' type='text/css' />
	
 
<script type="text/javascript"> 
	//<![CDATA[
	document.write('<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/css3.css" media="all" \/>');
	//]]>
</script> 



<link rel='stylesheet' href='<?=base_url()?>css/colors/default.css' type='text/css' />
<title>
<?php if(SITE=="customer"){
	?>Lease-Desk Customer Resource
<?php }
else if(SITE=="channel"){
	?>Lease-Desk Channel Resource
<?php }

?>
</title>
</head>



<body id="bd" class="  fs3"> 
<a name="Top" id="Top"></a>

		
        <div id="top_menu"><?php $this->load->view('global/menutop'); ?>	
		</div>
  


        <?php $this->load->view('global/main_menu'); ?>

	

	
  	<div id="ja-container-fr" class="wrap"> 
  	<div class="main clearfix">
 		<?php if(SITE=="customer"){
	$this->load->view('global/custmenu');
}
else if(SITE=="channel"){
	$this->load->view('global/channelmenu');
}

?>
       
 		
  	
  	
  	<!-- CONTENT -->  
  	<div id="ja-content" style="min-height:420px;"> 
  	
    	<div class="main clearfix"> 
            
                        <div id="ja-current-content" class="clearfix"> 
                 
	<?php 
	if(isset($title))
	{
		echo "<h1 class='componentheading'>TEST PAGE</h1>";
	}
	?>
	
	<?php $this->load->view('global/warning'); ?> 
	<?php $this->load->view($main); ?>

 
            </div> 
                    </div> 
  	<!-- //CONTENT --> 
		
     </div></div></div>
  
  

<?php $this->load->view('global/footer'); ?>

</body>
</html>