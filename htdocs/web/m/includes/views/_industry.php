<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */

?>
 <li <?php echo ($active == $industry->id ? 'data-theme="a"' : '') ?>>
<a href="?industry=<?php echo $industry->id?>" data-transition="fade">
    <?php echo $industry->name ?>
    <span class="ui-li-count"><?php echo $industry->industry_count; ?></span></a>
</li>