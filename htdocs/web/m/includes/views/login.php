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

<form name="checkuser" id="checkuser" class="ui-body ui-body-d ui-corner-all" data-ajax="false" method="post" >
    <fieldset>
        <div data-role="fieldcontain">
            <label for="username">Email Address:</label>
            <input type="text" value="" name="username" id="username"/>
        </div>
        <div data-role="fieldcontain">
            <label for="password">Password:</label>
            <input type="password" value="" name="password" id="password"/>
        </div>
        <input type="hidden"  name="jobid" value='<?php echo $_GET['jobid']; ?>' />
        <input type="button" data-theme="b" name="submit" id="submit" value="Login">
        <a href="index.php?signup=true" data-ajax="false" data-inline="true" >Sign up for a new account</a>
    </fieldset>
</form>

<?php render('_footer')?>
