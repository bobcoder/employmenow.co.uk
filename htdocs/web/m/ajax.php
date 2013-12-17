<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
require_once "includes/main.php";
 $c = new RegisterItController();

 //$c->handleRequest();
//$result = $r->signup();
    // Lets say everything is in order
    $output = array('status' => true, 'massage' => 'Welcome!', 'Logged In'=>$_SESSION['login'], 'jobid'=>$_SESSION['jobid'], 'debug'=>$result);
    echo json_encode($output);



?>