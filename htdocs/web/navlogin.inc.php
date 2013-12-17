        <div id="login">
        <?php
          $cpage = "login.php";
          $ctext = "candidate login";
          $epage = "elogin.php";
          $etext = "employer login";                    
          if($_SESSION['mode'] == "employer") {
            $epage = "ehome.php";
            $etext = "account home";
            $cpage = "logout.php";
            $ctext = "logout";
          }
          if($_SESSION['mode'] == "user") {
            $cpage = "account.php";
            $ctext = "account home";
            $epage = "logout.php";
            $etext = "logout";            
          }

          echo "<a href=\"$cpage\" title=\"\">$ctext</a> | <a href=\"$epage\"  title=\"\">$etext</a>";
        ?>
        </div>

