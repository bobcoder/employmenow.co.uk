<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
?>
<?php render('_header',array('title'=>$title))?>

<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
    <li data-role="list-divider">Choose an Industry</li>
    <?php render($content);
    ?>
</ul>
<a href="logout.php" data-role="button" data-icon="delete" data-iconpos="notext" data-ajax="false" data-inline="true" >Log out</a>
<?php render('_footer')?>
