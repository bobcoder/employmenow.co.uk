<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
/*
    This is the index file of our simple website.
    It routes requests to the appropriate controllers
*/
session_start();
require_once "includes/main.php";
$_SESSION['login'] = 'false';
//render('debug',array('message'=>$_GET['login']));
try {

	if($_GET['details']){
		$c = new DetailsController();
	}
	else if($_GET['where'] == 'ta'){
		$r = new HomeController();
		$r->ta();
	}
	else if($_GET['where'] == 'ta_apply'){
		$r = new HomeController();
		$r->ta_apply();
	}
	else if($_GET['signup']=='true'){
		$r = new HomeController();
		$r->signup();
	}
	else if($_GET['industry']){
        $c = new IndustryController();
    }
	else if($_SESSION['login'] ==''){
        $c = new LoginController();
    }
    else if(empty($_GET)){
        $c = new HomeController();
    }
    else throw new Exception('Wrong page!');
	if($c){
	    $c->handleRequest();
	}
}
catch(Exception $e) {
    // Display the error page using the "render()" helper function:
    render('error',array('message'=>$e->getMessage()));
}


?>