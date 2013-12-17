<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
/*
    This is the main include file.
    It is only used in index.php and keeps it much cleaner.
*/

require_once "includes/config.php";
require_once "includes/connect.php";
require_once "includes/helpers.php";
require_once "includes/miscfunc.inc.php";
require_once "includes/models/jobs.model.php";
require_once "includes/models/industry.model.php";
require_once "includes/models/details.model.php";
require_once "includes/models/login.model.php";
require_once "includes/models/register.model.php";
require_once "includes/controllers/home.controller.php";
require_once "includes/controllers/industry.controller.php";
require_once "includes/controllers/details.controller.php";
require_once "includes/controllers/jobs.controller.php";
require_once "includes/controllers/login.controller.php";
require_once "includes/controllers/register.controller.php";

// This will allow the browser to cache the pages of the store.

header('Cache-Control: max-age=3, public');
header('Pragma: cache');
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time())." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s",time()+3)." GMT");
?>