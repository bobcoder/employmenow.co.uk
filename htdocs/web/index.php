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
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
        <script type="text/javascript" src="jquery-1.7.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <!--[if IE 6]>
        <link href="default_ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <link rel="stylesheet" href="//releases.flowplayer.org/5.4.3/skin/minimalist.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="//releases.flowplayer.org/5.4.3/flowplayer.min.js"></script>
        <script src="//releases.flowplayer.org/5.4.3/flowplayer.min.js"></script>
        <script type="text/javascript" src="js/detectmobilebrowser.js"></script>
        <!--<script src="js/flowplayer.ipad-3.2.12.min.js"></script>-->
        <script>
            $(document).ready(function() {
            	//var ismobile = jQuery.browser.mobile;
            	//var w = detectmob();
            	//console.log("Detected  : "+window.innerWidth);
				//var full = '<?php echo $_GET['full'];?>';
				//if(ismobile === true || w ===true){
				//	window.location = 'http://employmenow.co.uk/web/m/index.php';
				//}
                $(".player").flowplayer({
                    clip : {
                        url : 'employmenow.mp4',
                        autoPlay : false
                    },
                    swf : "flowplayer.swf"
                });
            });
			function detectmob() {
			    if (sessionStorage.desktop){ // desktop storage
			        return false;
			    }else if (localStorage.mobile){ // mobile storage
			        return true;
				}
				if(window.innerWidth <= 850 ) {
				     return true;
				} else {
				     return false;
				}
				// alternative
			    //mobile = ['kindle','iphone','ipad','android','blackberry','nokia','opera mini','windows mobile','windows phone','iemobile'];
			    //for (var i in mobile) if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;

			    // nothing found.. assume desktop
			    return false;
			}
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
                                <source type="video/mp4" src="employmenow.mp4">
                            </video>
                        </div>
<!--                        <iframe src="<?php echo $config['baseurl']?>rotator/index.html" style="border:0px #FFFFFF none;" name="myiFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="60px" width="468px"></iframe>-->
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
                        <FORM METHOD="LINK" ACTION="<?php echo $config['siteurl']?>ehome.php">
                            <input name="btnHomeSearch" type="submit" class="searchbutton2" value="Find a CV now" />
                        </form>
                    </div>
                    <div id="right3" class="faded">
                        <h1 class="homeh1">Employers Post Your Jobs</h1>
                        <h2 class="homeh2">Post for free</h2>
                        <br/>
                        <FORM METHOD="LINK" ACTION="<?php echo $config['siteurl']?>ejobs.php">
                            <input name="btnHomeSearch" type="submit" class="searchbutton2" value="Post a job now" />
                        </form>
                    </div>
                </div>
                </div>

                <div id="footer">
            <?php include("thefooter.php"); ?>
</div>
<!--
    DEBUG the session variable
                   <?php echo '<pre>';
        print_r($_SESSION);
    echo '</pre>';?>-->

                </div>
                <script type="text/javascript">
                    $(".faded").each(function(i) {
                        $(this).delay(i * 300).fadeIn(800);
                    });
                    $(".faded").hide()
                    $(document).ready(function() {
                        $(".faded2").hide();
                        $(".faded2").slideUp(1).delay(300).slideDown('slow');
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
