<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
session_start();
unset($_SESSION['login']);
unset($_SESSION['userid']);
unset($_SESSION['jobid']);

header('location: index.php');
exit();
?>