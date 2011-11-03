<?php
  // Copyright 2010 Google Inc. All Rights Reserved.

  $GA_ACCOUNT = "MO-19623681-11";
  $GA_PIXEL = "/ga.php";

  function googleAnalyticsGetImageUrl() {
    global $GA_ACCOUNT, $GA_PIXEL;
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);
    $referer = $_SERVER["HTTP_REFERER"];
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];
    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);
    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }
    $url .= "&guid=ON";
    return str_replace("&", "&amp;", $url);
  }
?><!doctype html>
<!-- Conditional comment for mobile ie7 http://blogs.msdn.com/b/iemobile/ -->
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->

<head>
  <meta charset="utf-8">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimization http://goo.gl/b9SaQ -->
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Home screen icon  Mathias Bynens http://goo.gl/6nVq0 -->
  <!-- For iPhone 4 with high-resolution Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/mobile/h/apple-touch-icon.png">
  <!-- For first-generation iPad: -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/mobile/m/apple-touch-icon.png">
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon-precomposed" href="images/mobile/l/apple-touch-icon-precomposed.png">
 
    <link rel="stylesheet" href="<?=base_url()?>css/jquery-ui-1.8.custom.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />

  <!-- For nokia devices: -->
  <link rel="shortcut icon" href="images/mobile/l/apple-touch-icon.png">

  <!--iOS web app, deletable if not needed -->
  <!--the script prevents links from opening in mobile safari. https://gist.github.com/1042026
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
  <link rel="apple-touch-startup-image" href="img/l/splash.png">-->

  <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
  <meta http-equiv="cleartype" content="on">

  <!-- more tags for your 'head' to consider https://gist.github.com/849231 -->

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?=base_url()?>css/themes/mobile/mobile.css?v=1">

  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="js/mobile/libs/modernizr-custom.js"></script>
  <!-- Media Queries Polyfill https://github.com/shichuan/mobile-html5-boilerplate/wiki/Media-Queries-Polyfill -->
  <script>Modernizr.mq('(min-width:0)') || document.write('<script src="js/mobile/libs/respond.min.js">\x3C/script>')</script>
  
  <!-- scripts concatenated and minified via ant build script -->
  <script src="js/mobile/mylibs/helper.js"></script>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <?php if(isset($blackberry) && $blackberry == "yes") 
    { ?>
        <link rel="stylesheet" href="<?=base_url()?>css/themes/mobile/blackberry.css?v=1">
   <?php  }
    else
    {
        ?>
    
 <script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
<?php } ?>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>

</head>

<body>
<div data-role="page" class="type-interior"> 
	<div data-role="header">
                    <?php if(SITE=="customer"){
                            ?><h1>Customer Resource</h1>
                    <?php }
                    else if(SITE=="channel"){
                        ?><h1>Channel Resource</h1>
                    <?php }

                    ?>
                        <a href="../../" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
        </div> 
	<div data-role="content">
            
         <div class="content-primary">	
             <h2><?=$title?></h2>
        <?php $this->load->view($main); ?>
         </div><!--/content-primary -->
            
            <div class="content-secondary">

					<div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">

							<h3>Tools</h3>
                                                        
                                                        <ul data-role="listview" data-theme="d" data-dividertheme="d">
                                                                                                                            
								<li><a href="<?=base_url()?>mobile/quote" data-ajax="false">Online Quote Tool</a></li>
                                                                                                                                <li><a href="<?=base_url()?>mobile/list_quotes" data-ajax="false">List Quotes</a></li>
                                                        </ul>
                                        </div>
                
            </div>
            
       </div><!-- /content -->
	<div data-role="footer" style="text-align: center;"> <p>&copy; Copyright 2011 Lease-Desk Ltd.</p></div> 
</div> 
  
 


    
    
    


    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->



 

  <!-- end concatenated and minified scripts-->

  <script>
    // iPhone Scale Bug Fix, read this when using http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
    MBP.scaleFix();
  </script>

  <!-- Debugger - remove for production -->
  <!-- <script src="https://getfirebug.com/firebug-lite.js"></script> -->

  <!-- mathiasbynens.be/notes/async-analytics-snippet Change UA-XXXXX-X to be your site's ID -->
  <script>

  </script>
<?php
  $googleAnalyticsImageUrl = googleAnalyticsGetImageUrl();
  echo '<img src="' . $googleAnalyticsImageUrl . '" />';?>
</body>
</html>