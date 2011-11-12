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

        <link rel="stylesheet" href="<?= base_url() ?>css/jquery-ui-1.8.custom.css" />

       

        <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
        <meta http-equiv="cleartype" content="on">

        <!-- more tags for your 'head' to consider https://gist.github.com/849231 -->

        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="<?= base_url() ?>css/themes/mobile/mobile.css?v=1">

  

        <link rel="stylesheet" href="<?= base_url() ?>css/themes/mobile/blackberry.css?v=1">


        
    </head>

    <body>





        <div data-role="page" class="type-interior"> 

            <?php if (SITE == "customer") {
                ?><img alt="Customer Resource" src="<?= base_url() ?>images/logocustomer.png" width="100%"/>
            <?php
            } else if (SITE == "channel") {
                ?><img alt="Channel Resource" src="<?= base_url() ?>images/logo.png" width="100%"/>
            <?php }
            ?>
            <div data-role="header" data-position="inline" id="ui-bar">

                <h2><?= $title ?></h2>
                <?php if (isset($quote_id)) { ?>
                    <a href="<?= base_url() ?>mobile/quote/<?= $quote_id ?>" data-icon="gear" class="ui-btn-right" data-ajax="false">Edit</a>
                <?php } ?>
            </div>

            <div data-role="content">

                <?php $this->load->view('global/mobilewarning'); ?>

                <div class="content-primary">	
<br/>
                    Blackberry's are not fully supported for the online quote tool, however we are working on it!     If you have problems <a href="<?= base_url() ?>quote/main" data-ajax="false">View desktop site</a>
                    
                       <?php $this->load->view($main); ?>

                
                </div><!--/content-primary -->

                <div class="content-secondary">

                    <div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">

                        <h3>Tools</h3>

                        <ul data-role="listview" data-theme="c" data-dividertheme="d">

                            <li><a href="<?= base_url() ?>mobile/quote" data-ajax="false">Online Quote Tool</a></li>
                            <li><a href="<?= base_url() ?>mobile/list_quotes" data-ajax="false">List Quotes</a></li>
                        </ul>
                    </div>

                </div>

            </div><!-- /content -->
            <div data-role="footer" style="text-align: center;" id="ui-bar"> <p>&copy; Copyright 2011 Lease-Desk Ltd.<br/>
                    <a href="<?= base_url() ?>quote/main" data-ajax="false">View desktop site</a></p></div> 
        </div> 









        <footer>

        </footer>
    </div> <!--! end of #container -->


    <!-- JavaScript at the bottom for fast page loading -->





    <!-- end concatenated and minified scripts-->





    <script>

    </script>

</body>
</html>