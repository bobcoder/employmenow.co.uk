<?php
session_start();
include ("database.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Employmenow Pricing</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <script type="text/javascript" src="jquery-1.7.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <!--[if IE 6]>
        <link href="default_ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
    </head>
    <body class="pricingpage">
        <div id="header-wrapper">
            <div id="header" class="container">
                <div id="logo">
                    <img src="images/logo.png" />
                </div>
                <?php
                include ("navlogin.inc.php");
                ?>
                <?php
                include ("themenu.php");
                ?>
            </div>
            <!--<div id="socialfooter"></div>-->
        </div>
        <div id="wrapper">
            <div id="page" class="container">
                <div id="content-home">
                    <!--<?php
                    $result = mysql_query("SELECT `content` FROM `cms_pages`
                    WHERE `pagename`='pricing'");
                    list($content) = mysql_fetch_array($result);
                    echo $content;
                    ?>-->
               <div class="prices">
                    <div id="price1" class="faded">
                        <h2 class="pricetitle">Package 1</h2>
                        Just starting out, ideal to test our service <h3 class="pricing">1 CV = £14.95</h3>
                        <br/>
                        <br/>
                        <FORM METHOD="LINK" ACTION="<?php echo $config['siteurl']?>elogin.php">
                            <input name="btnHomeSearch" type="submit" class="searchbuttonprice" value="Buy now" />
                        </form>
                        <br/>
                        <a href="<?php echo $config['siteurl']?>register.php">Remember its free to add your CV</a>
                    </div>
                    <div id="price1" class="faded">
                        <h2 class="pricetitle">Package 2</h2>
                        Looking to hire a couple of people? <h3 class="pricing">5 CV's = £59.80 </h3>
                        (1 free CV)
                        <br/>
                        <br/>
                        <FORM METHOD="LINK" ACTION="<?php echo $config['siteurl']?>elogin.php">
                            <input name="btnHomeSearch" type="submit" class="searchbuttonprice" value="Buy now" />
                        </form>
                        <br/>
                        <a href="<?php echo $config['siteurl']?>register.php">Remember its free to add your CV</a>
                    </div>
                    <div class="clear-both"></div>
                  </div>
                </div>
            </div>
            <div id="footer">
                <?php
                include ("thefooter.php");
                ?>
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
    </body>
</html>
