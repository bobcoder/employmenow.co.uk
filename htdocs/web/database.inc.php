<?php
  include("miscfunc.inc.php");
  include("config.inc.php");
  include("classes/email_class.php");
  include("classes/dBug.php");
  include("classes/db.class.php");
  mysql_connect($config['server'],$config['username'],$config['password']);
  mysql_select_db($config['database']);
  $result = mysql_query("SELECT * FROM `site_options`");
  while($output = mysql_fetch_row($result)) $config[$output[0]] = $output[1];
?>