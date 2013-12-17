<?php
session_start();
include ("database.inc.php");

$error = "";
if (isset($_POST['submit'])) {
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $result = mysql_query("SELECT `id`,`name`,`active` FROM `employers` WHERE `email`='$email' AND `password`='$password'");
    if (!$result) {
        $error = "<span style=\"color: #FF0000\">Invalid username/password</span>";
    } else {
        if (mysql_num_rows($result) > 0) {
            list($id, $name, $active) = mysql_fetch_array($result);
            if ($active == 0)
                $error = "<span style=\"color: #FF0000\">Account isn't active!</span>";
            else {
                $_SESSION['userid'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['mode'] = "employer";
                if (isset($_GET['ret'])) {
                    header("Location: " . $_GET['ret'] . ".php?id=" . $_GET['cv']);
                } else
                    header("Location: " . $config['siteurl'] . "ehome.php");
            }
        } else {
            $error = "<span style=\"color: #FF0000\">Invalid username/password</span>";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
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
    <body class="eloginpage">
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
        </div>
        <div id="wrapper">
            <div id="page" class="container">
                <div id="content-login">
                    <div class="generalleft-login faded">
                        <h1 class="homeh1">Employer login</h1>
                        <br/>
                        <?php
echo $error;
?>
                        <form name="frmLogin" method="post">
                            <table>
                                <tr>
                                    <td>E-mail address:</td><td>
                                    <input type="text" class="login" name="email">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password:</td><td>
                                    <input type="password" class="login" name="password">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                    <input type="submit" class="searchbutton" name="submit" value="Login">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <p>
                            <strong>Don't have an account?</strong> Register <a href="registere.php">here</a> for free!
                        </p>
                        <a href="<?php echo $config['siteurl']?>eforgot.php">Forgot your password?</a>
                        <!--Forgot your password? <a href="eforgot.php">Click
                        here</a>.-->
                    </div>
                    <div class="generalleft-login faded">
                    	<h1 class="homeh1">Get ahead</h1><br>
                    	<p>Employers list your vacancy on our live jobs board for free.</p>
						<p>We work with other leading jobs boards to ensure maximum exposure for your vacancy.
						Receive applications direct to your chosen email account.</p><p>
						Only pay per CV you wish to unlock, as per the main body of our website.
						Potentially fill your vacancy for just £14.95 (the cost of one CV).</p>
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
