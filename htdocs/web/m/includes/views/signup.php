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
<form name="signup" id="signup" class="ui-body ui-body-d ui-corner-all" data-ajax="false" method="post" >
    <fieldset>
        <div data-role="none">
            <label for="name" id="lblname">Name:</label>
            <input type="text" value="" name="name" id="name" class="required"/>
        </div>
        <div data-role="none">
            <label for="name" id="lblemail">Email:</label>
            <input type="text" value="" name="email" id="email" class="required"/>
        </div>
        <div data-role="none">
            <label for="password" id="lblpassword">Password:</label>
            <input type="password" value="" name="password" id="password" class="required"/>
        </div>
    </fieldset>
    <hr>
	<div data-role="fieldcontain" data-type="horizontal">
	<fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Date of Birth:</legend>

			<select name="day" class="day" data-mini="true"><?php dumpDays(-1); ?></select>

			<select name="month" class="month" data-mini="true"><?php dumpMonths(-1); ?></select>

			<select name="year" class="year" data-mini="true"><?php dumpYears(70,date('Y')); ?></select>
	</fieldset>
	</div>
    <hr>
    <fieldset>
        <div data-role="none">
            <label for="town" id="lbltown">Town:</label>
            <input type="text" value="" name="town" id="town"/>
        </div>
        <div data-role="none">
            <label for="county">County:</label>
            <?php dumpCounties(""); ?>
        </div>
        <div data-role="none">
            <label for="phone">Phone:</label>
            <input type="text" value="" name="phone" id="phone"/>
        </div>
        <div data-role="none">
            <label for="mobile">Mobile:</label>
            <input type="text" value="" name="mobile" id="mobile"/>
        </div>
        <div data-role="none">
            <label for="how">How did you hear about us:</label>
            <?php dumpHow(""); ?>
        </div>
        <div data-role="none">
            <label for="terms">Termas and conditions:</label>
            <input type="checkbox" name="terms" id="terms" class="custom" data-mini="true" />
        </div>
        <div data-role="none">
            <label for="eligible">Eligible to work in the UK:</label>
            <input type="checkbox" name="eligible" id="eligible" class="custom" data-mini="true" />
        </div>
        <input type="hidden"  name="jobid" value='<?php echo $_GET['jobid']; ?>' />
        <input type="button" data-theme="b" name="signupbtn" id="signupbtn" value="Sign up">
    </fieldset>
</form>
<?php render('_footer')?>