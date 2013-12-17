<?php
session_start();
include ("database.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Recruitment and Jobs | Employmenow</title>
        <meta name="keywords" content="" />
        <meta name="description" content="EmployMeNow is a different way of doing things. We cut out the middle-man, and make it easier for everyone." />
        <script type="text/javascript" src="jquery-1.7.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
        <link href="default.css" rel="stylesheet" type="text/css" media="all" />
        <!--[if IE 6]>
        <link href="default_ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <link rel="stylesheet" href="//releases.flowplayer.org/5.4.3/skin/minimalist.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="//releases.flowplayer.org/5.4.3/flowplayer.min.js"></script>
        <script>
            $(document).ready(function() {
                // install flowplayer to an element with CSS class "player"
                $(".player").flowplayer({
                    clip : {
                        url : 'employmenow.flv',
                        autoPlay : false
                    },
                    swf : "flowplayer.swf"
                });
            });
        </script>
        <style>
            .player {
                width: 468px;
                height: 290px;
                /*margin-top: 25px;*/
            }
        </style>
        <!-- Begin Cookie Consent plugin by Silktide -
        http://silktide.com/cookieconsent -->
        <link rel="stylesheet" type="text/css" href="http://assets.cookieconsent.silktide.com/current/style.min.css"/>
        <script type="text/javascript" src="http://assets.cookieconsent.silktide.com/current/plugin.min.js"></script>
        <script type="text/javascript">
            // <![CDATA[
            cc.initialise({
                cookies : {
                    analytics : {},
                    social : {},
                    necessary : {}
                },
                settings : {
                    consenttype : "implicit",
                    bannerPosition : "bottom",
                    onlyshowbanneronce : true
                },
                strings : {
                    notificationTitle : 'We use cookies....'
                }
            });
            // ]]>
        </script>
        <!-- End Cookie Consent plugin -->
    </head>
    <body class="home">
        <div id="header-wrapper">
            <div id="header" class="container">
                <div id="logo"><img src="images/logo.png" />
                </div>
                <?php
                    include ("navlogin.inc.php");
 ?>
                <?php
                    include ("themenuhome.php");
 ?>
            </div>
        </div>
        <div id="wrapper">
            <div id="page" class="container">
                <div id="content-home">
                    <div class="generalleft5 faded2">
                        <h1 class="homeh1">What We Do......</h1>
                        <br/>
                        <div class="player" data-engine="flash">
                            <video width="468" height="290">
                                <source type="video/flv" src="employmenow.flv">
                            </video>
                        </div>
                        <!--<iframe width="468" height="300"
                        src="//www.youtube.com/embed/Rt_4DmrzAVo?rel=0"
                        frameborder="0" allowfullscreen></iframe>-->
                        <iframe src="<?php echo $config['baseurl']?>rotator/index.html" style="border:0px #FFFFFF none;" name="myiFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="60px" width="468px"></iframe>
                    </div>
                    <div id="right1" class="faded">
                        <h1 class="homeh1">Candidates! upload your CV <STRONG>free</STRONG></h1>
                        <h2 class="homeh2">We have employers waiting to meet you!</h2>
                        <br/>
                        <FORM METHOD="LINK" ACTION="<?php echo $config['siteurl']?>register.php">
                            <input name="btnHomeSearch" type="submit" class="searchbutton2" value="Create your profile" />
                        </form>
                    </div>
                    <div id="right2" class="faded">
                        <h1 class="homeh1">Employers, find a candidate</h1>
                        <h2 class="homeh2">Browse for free</h2>
                        <br/>
                        <FORM METHOD="LINK" ACTION="<?php echo $config['siteurl']?>employers.php">
                            <input name="btnHomeSearch" type="submit" class="searchbutton2" value="Find a CV now" />
                        </form>
                    </div>
                </div>
                </div>
<!--
<div id="footerb">
<p><a href="http://test-webzite.co.uk/contact-us/">Contact Us</a>  -  <a href="http://test-webzite.co.uk/privacy/">Privacy</a>  -  <a href="http://test-webzite.co.uk/terms-and-conditions/">Terms and Conditions</a> -  <a href="http://test-webzite.co.uk/frequently-asked-questions/">FAQ's</a> - </p>

<div id="social"><a href="https://www.facebook.com/Employmenow.co.uk?ref=stream" TARGET='_blank'><img src="http://test-webzite.co.uk/wp-content/uploads/2013/08/Empoly-me-now-on-facebook.fw_1.png"></a> <a href="http://www.linkedin.com/groups/EmployMeNowcouk-5002249" TARGET='_blank'><img src="http://test-webzite.co.uk/wp-content/uploads/2013/08/Empoly-me-now-on-linkedin.fw_.png"></a> <a href="https://twitter.com/employmenowcouk" TARGET='_blank'><img src="http://test-webzite.co.uk/wp-content/uploads/2013/08/Empoly-me-now-on-twitter.fw_1.png"></a> <a href="https://plus.google.com/100062210612432065856/posts" TARGET='_blank'><img src="http://test-webzite.co.uk/wp-content/uploads/2013/08/Empoly-me-now-on-google.fw_.png"></a> <a href="http://www.youtube.com/channel/UCYCsiGgxhHVWlo75kH_M5kg?feature=watch" TARGET='_blank'><img src="http://test-webzite.co.uk/wp-content/uploads/2013/08/Empoly-me-now-on-Youtube.fw_.png"></a></div>

</div>
-->
    <div id="footer">
        <?php include("thefooternew.php"); ?>
    </div>
                </div>
                <script type="text/javascript">
                    $(".faded").each(function(i) {
                        $(this).delay(i * 500).fadeIn(1000);
                    });
                    $(".faded").hide()
                    $(document).ready(function() {
                        $(".faded2").hide();
                        $(".faded2").slideUp(1).delay(500).slideDown('slow');
                    });
                </script>
                <script type="text/javascript">
                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', 'UA-40700436-1']);
                    _gaq.push(['_trackPageview']);
                    (function() {
                        var ga = document.createElement('script');
                        ga.type = 'text/javascript';
                        ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(ga, s);
                    })();
                </script>
    </body>
</html>
