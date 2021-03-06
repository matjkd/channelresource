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
        <link rel="stylesheet" href="<?= base_url() ?>css/mobile/jquery.ui.datepicker.mobile.css" /> 
       
        <script src="<?= base_url() ?>js/mobile/jquery.ui.datepicker.mobile.js"></script>




    </head>

    <body>

        <div data-role="page" class="type-interior" id="one"> 

            <?php if (isset($dialog) && $dialog == "yes") {
                
            } else { ?>



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
                        
                         <?php if (isset($ticket_id) && $ticket_id != "") { ?>
                        <a href="<?= base_url() ?>mobilesupport/edit_request/<?= $ticket_id ?>" data-icon="gear" class="ui-btn-right" data-ajax="false">Edit</a>
                    <?php } ?>

                    <a href="<?= base_url() ?>mobile/logout" data-icon="gear" class="ui-btn-left" data-ajax="false">Logout</a>
                </div>
                <?php
            }
            ?>

            <div data-role="content">

                <?php $this->load->view('global/mobilewarning'); ?>



                <div class="content-primary">	

                    <?php $this->load->view($main); ?>




                </div>

                <!--/content-primary -->
                <?php if (isset($dialog) && $dialog == "yes") {
                    
                } else { ?>
                    <div class="content-secondary">

                        <div data-role="collapsible" data-collapsed="true" data-theme="b" data-content-theme="d">

                            <h3>Tools</h3>
                            <p>
                            <ul data-role="listview" data-theme="c" data-dividertheme="d" data-inset="true">

                                <li>
                                    <a href="<?= base_url() ?>mobile/quote" data-ajax="false">
                                        <img width="16px" height="16px" class="ui-li-icon" src="<?= base_url() ?>images/icons/mobile/161-calculator.png"/>
                                        Online Quote Tool
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>mobile/list_quotes" data-ajax="false">
                                        <img width="16px" height="16px" class="ui-li-icon" src="<?= base_url() ?>images/icons/mobile/33-cabinet.png"/>
                                        List Quotes
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>mobilesupport" data-ajax="false">
                                        <img width="16px" height="16px" class="ui-li-icon" src="<?= base_url() ?>images/icons/mobile/44-shoebox.png"/>
                                        Support Requests
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>mobilesupport/add_request" data-ajax="false">
                                        <img width="16px" height="16px" class="ui-li-icon" src="<?= base_url() ?>images/icons/mobile/40-inbox.png"/>
                                        Add Support Request
                                    </a>
                                </li>
                            </ul>
                            </p>
                        </div>

                    </div>
                    <br/>
                   

                </div><!-- /content -->

                <div data-role="footer" style="text-align: center;"> 


                    <p>&copy; Copyright 2011 Proctor Consulting UK Ltd.<br/>
                        <?php
                        if (!isset($desktop)) {
                            $desktop = "quote/main";
                        }
                        ?>
                        <a href="<?= base_url() ?><?= $desktop ?>" data-ajax="false">View desktop site</a>
                    </p></div> 

                <?php
            }
            ?>
        </div> 







        <footer>

        </footer>
    </div> <!--! end of #container -->





    <!-- JavaScript at the bottom for fast page loading -->
    <!-- Place this render call where appropriate -->
    <script type="text/javascript">
        window.___gcfg = {lang: 'en-GB'};

        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>


    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>


    <!-- end concatenated and minified scripts-->

    <script>
        // iPhone Scale Bug Fix, read this when using http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
        MBP.scaleFix();
    </script>



</body>
</html>