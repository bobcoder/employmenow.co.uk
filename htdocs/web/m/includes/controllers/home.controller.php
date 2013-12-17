<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
/* This controller renders the home page */

class HomeController{
    public function handleRequest(){
        // Select all the industries:
        $content = Industry::find();
        render('home',array(
            'title'		=> 'Welcome',
            'content'	=> $content
        ));
    }
	public function ta(){
		render('thankyou',array(
            'title'		=> 'Thank you!'
        ));
	}
	public function ta_apply(){
		render('thankyou_apply',array(
            'title'		=> 'Good Luck!'
        ));
	}
	public function signup(){
		render('signup',array(
            'title'		=> 'Sign up'
        ));
	}
}
?>