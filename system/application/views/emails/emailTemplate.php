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
        
        <p>

<br/>
<br/>
<img width="150px" src="http://www.lease-desk.com/images/logos/leasedesk_logosmall.png"/>
<br/>

<span style="font-family: arial,sans-serif; font-size:9.0pt;color:#943634"><strong>Switchboard:</strong> 01302 245310</span>
<br/>


<span style="font-family: arial,sans-serif; font-size:9.0pt;color:#943634"><strong>E:</strong> <a href="mailto:support@lease-desk.com">support@lease-desk.com</a></span>
<br/>

<span style="font-family: arial,sans-serif; font-size:9.0pt;color:#943634"><strong>W:</strong> <a href="http://www.lease-desk.com">www.lease-desk.com</a></span>
<br/>

<span style="font-family: arial,sans-serif; font-size:9.0pt;color:#943634"><strong><a href="http://www.lease-desk.com/blog/item">Visit our blog here</a></strong></span>
<br/>






<a href="https://plus.google.com/109487596314269941740?prsrc=3" style="text-decoration: none;"><img src="http://www.lease-desk.com/images/icons/social/gplus-32.png" width="32" height="32" style="border: 0;"/></a>

<a href="http://www.facebook.com/pages/Lease-Deskcom/126786210725401"><img  src="http://www.lease-desk.com/images/icons/social/facebook_32.png"/></a>

<a href="https://twitter.com/#!/LeaseDeskdotCom"><img  src="http://www.lease-desk.com/images/icons/social/twitter_32.png"/></a>

<a href="http://www.linkedin.com/company/proctor-consulting-uk?goback=.cps_1297253692838_1&trk=co_search_results"><img  src="http://www.lease-desk.com/images/icons/social/linkedin_32.png"/></a>

<a href="http://www.youtube.com/user/LeaseDeskdotCom?feature=mhum"><img  src="http://www.lease-desk.com/images/icons/social/youtube_32.png"/></a>

<br/>
<br/>
<a href="http://www.lease-deskbrochure.co.uk/"><img  src="http://www.lease-desk.com/images/icons/eBrochureIcon.png"/></a>
<br/>
<img  src="https://s3-eu-west-1.amazonaws.com/lease-desk-blog/europa2small.png" style="border:0; padding-right:5px;"/>

<img  src="https://s3-eu-west-1.amazonaws.com/lease-desk-blog/europa1small.png" style="border:0; "/>
            
        </p>
        
    </body>
    
</html>
