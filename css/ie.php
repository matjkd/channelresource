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

$template_path = dirname( dirname( $_SERVER['REQUEST_URI'] ) );
global $color;
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


#ja-container, #ja-container-fr, #ja-container-fl, #ja-container-f {
	width: 100%;
}

#ja-header {
	position: relative;
	z-index: 3;
}

#ja-mainnav {
	position: relative;
	z-index: 2;
}
<?php
/*IE 6*/
if ($iev == 6) {
?>

#ja-colwrap .ja-innerpad {
	padding-left: 0;
}

div.column1 .contentpaneopen,
div.column2 .contentpaneopen,
div.column3 .contentpaneopen {
	padding: 0;
}

.img_caption.left {
	padding: 0;
    margin: 0;
}

#ja-topsl {
  zoom: 1;
}

h1.logo a {
 	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/logo.png', sizingMethod='image');
 	background-image: none;
}


p.stickynote {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/icon-sticky.png', sizingMethod='crop');
 	background-image: none;
	width: 89%;
}

p.download {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/icon-download.png', sizingMethod='crop');
 	background-image: none;
	width: 89%;
}

#ja-cssmenu li ul {
 	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/trans-bg.png', sizingMethod='scale');
 	background-image: none;
}

#ja-cssmenu li li{
  background: url(<?php echo $template_path;?>/images/blank.png)!important;
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
	color: #FFFFFF !important;
    background: #202020 !important;
}

#ja-cssmenu li ul a {
	width: 185px !important;
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
#ja-wrapper, #ja-topslwrap, #ja-topsl {
	width: 100%;
}
<?php
}
?>
