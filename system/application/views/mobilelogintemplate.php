<!doctype html>
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
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Home screen icon  Mathias Bynens http://goo.gl/6nVq0 -->
        <!-- For iPhone 4 with high-resolution Retina display: -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/mobile/h/apple-touch-icon.png">

        <!-- For first-generation iPad: -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/mobile/m/apple-touch-icon.png">

        <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
        <link rel="apple-touch-icon-precomposed" href="images/mobile/l/apple-touch-icon-precomposed.png">

   
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />

        <!-- For nokia devices: -->
        <link rel="shortcut icon" href="images/mobile/l/apple-touch-icon.png">


        <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
        <meta http-equiv="cleartype" content="on">

        
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="<?= base_url() ?>css/themes/mobile/mobile.css?v=1">


       <!-- scripts concatenated and minified via ant build script -->
        <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>




    </head>

    <body>
        <div data-role="page"> 
            
            <?php if (SITE == "customer") { ?><img alt="Customer Resource" src="<?= base_url() ?>images/logocustomer.png" width="100%"/>
                <?php
            } else if (SITE == "channel") {
                ?><img alt="Channel Resource" src="<?= base_url() ?>images/logo.png" width="100%"/>
            <?php }
            ?>
            <div data-role="header" data-position="inline">

               <h2 style="white-space: normal; padding-left:10px;"><?= $title ?></h2>
                <?php if (isset($quote_id)) { ?>
                    <a href="<?= base_url() ?>mobile/quote/<?= $quote_id ?>" data-icon="gear" class="ui-btn-right" data-ajax="false">Edit</a>
                <?php } ?>
                      
            </div>
            <div data-role="content">


                Login with your username and password below:<br/>

                <?= $this->load->view('global/themes/mobile/login') ?>

            </div> 
            <div data-role="footer" style="text-align: center;"><p>&copy; Copyright 2011 Lease-Desk Ltd.</p> </div> 
        </div> 









        <footer>

        </footer>
    </div> <!--! end of #container -->


    <!-- JavaScript at the bottom for fast page loading -->


  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
   


    <script>
        // iPhone Scale Bug Fix, read this when using http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
        MBP.scaleFix();
    </script>

  
    <script>

    </script>
 
</body>
</html>