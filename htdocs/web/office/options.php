<?php
ob_start();
session_start();
require_once("header.php");
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}else{
    //Do summat
}
?>
<div id="content">
    <h3>Edit site options</h3>
    <form name="frmOptions" method="post">
        <table>
            <tbody>
                <tr>
                    <td>salaryMin</td><td>
                    <input type="text" name="salaryMin" value="5000">
                    </td>
                </tr>
                <tr>
                    <td>salaryMax</td><td>
                    <input type="text" name="salaryMax" value="150000">
                    </td>
                </tr>
                <tr>
                    <td>salaryStep</td><td>
                    <input type="text" name="salaryStep" value="5000">
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" name="btnSubmit" value="Save">
    </form>
</div>
<!--FOOTER----------------------------------------->
<?php
include ("footer.php");
?>