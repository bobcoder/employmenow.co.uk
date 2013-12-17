<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
 class LoginController{
    public function handleRequest(){

        // $industries and $jobs are both arrays with objects
        render('login',array(
            'title'			=> 'Login'
        ));

    }
}
?>