<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <!-- This is a simple template for email -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="<?=$title?>" />
        
        <title><?=$title?></title>
		<?=$this->load->view('/emails/templateCSS')?>
	</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	
        <?=$this->load->view($emailType)?>
        
    </body>
</html>
