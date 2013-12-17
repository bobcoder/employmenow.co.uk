<?php
ob_start();
require_once("header.php");
session_start();
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}else{
    //Do summat
}
?>
<h3 id='categories'>New Employer</h3>
<form id="employers" name="employers" method="post" class="cmxform">
    <div id='new_employer'>
        <label for="ctitle"> <span>Company Name *</span>
            <BR>
            <input maxlength="255" size="80" id="companyname" name="companyname" type="text"/>
        </label>
        <br>
        <label> <span>Contact Name *</span>
            <BR>
            <input maxlength="255" size="80" name="contactname" id="contactname" type="text" >
        </label>
        <br>
        <label> <span>Email *</span>
            <BR>
            <input maxlength="255" size="70" name="email" type="text" id="email">
        </label>
        <br>
        <label> <span>Password *</span>
            <BR>
            <input maxlength="255" size="50" name="password" type="password" id="password">
        </label>
        <br>
        <label> <span>Telephone *</span>
            <BR>
            <input maxlength="255" size="50" name="telephone" type="text" id="telephone">
        </label>
        <br>
        <label> <span>Active</span>
            <br>
            <input checked="checked" form="employers" value="1" name="active" type="checkbox">
            <br>
        </label>
        <br>
        <label> <span>Approved</span>
            <br>
            <input checked="checked" form="employers" value="1" name="approved" type="checkbox">
            <br>
        </label>
        <br>
        <label> <span>Terms and Conditions</span>
            <br>
            <input checked="checked" form="employers" value="1" name="tandc" type="checkbox">
            <br>
        </label>
        <br>
        <label> <span>CV Credits </span>
            <BR>
            <input maxlength="6" size="10" name="credits" type="text" id="credits">
        </label>
        <br>
        <input form="employers" value="Add Employer" id="newemployer" name="submit" type="submit">
        <br>
    </div>
</form>
<?php include("footer.php");?>
<script>
$(document).ready(function() {
	    $('#employers').validate({ // initialize the plugin
        rules: {
            companyname: {
                required: true
            },
            contactname: {
                required: true
            },
            email: {
                required: true,
      			email: true
            },
            password: {
                required: true
            },
            telephone: {
                required: true
            }
        },
        submitHandler: function (form) { // for demo
            event.preventDefault();
            $.ajax({
                url : 'employer_add_db.php?action=add',
                type : 'post',
                dataType : 'text',
                data : $('form#employers').serialize(),
                success : function(data) {
                    //$(".successbox").fadeIn(2000);
                    window.location = 'employers.php';
                    //console.log(data);
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //$(".errormsgbox").fadeIn(2000);
                    console.log(textStatus);
                },
            });
        }
    });
});
</script>
