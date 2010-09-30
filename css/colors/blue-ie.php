<?php header("Content-type: text/css"); ?>
/*------------------------------------------------------------------------
# JA Nickel for Joomla 1.5.x - Version 1.0 - Licence Owner JA110795
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/
<?php
$template_path = dirname (dirname( dirname( $_SERVER['REQUEST_URI'] ) ) );
function ieversion() {
  ereg('MSIE ([0-9]\.[0-9])',$_SERVER['HTTP_USER_AGENT'],$reg);
  if(!isset($reg[1])) {
    return -1;
  } else {
    return floatval($reg[1]);
  }
}
$iev = ieversion();
?>
<?php /*All IE*/ ?>

<?php
/*IE 6*/
if ($iev == 6) {
?>
h1.logo a {
 	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/blue/logo.png', sizingMethod='image');
 	background-image: none;
}

#ja-cssmenu li ul {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/blue/trans-bg.png', sizingMethod='scale');
 	background-image: none;
}


#ja-cssmenu li ul a:hover, 
#ja-cssmenu li ul a:active, 
#ja-cssmenu li ul a:focus, 
#ja-cssmenu ul li:hover, 
#ja-cssmenu ul li.sfhover, 
#ja-cssmenu ul li.havesubchildsfhover, 
#ja-cssmenu ul li.havesubchild-activesfhover, 
#ja-cssmenu ul ul li:hover, 
#ja-cssmenu ul ul li.sfhover, 
#ja-cssmenu ul ul li.havesubchildsfhover, 
#ja-cssmenu ul ul li.havesubchild-activesfhover {
	background: #106494 !important;
}
<?php
}
?>


<?php
/*IE 7*/
if ($iev == 7) {
?>

<?php
}
?>


<?php
/*IE 8*/
if ($iev == 8) {
?>

<?php
}
?>
