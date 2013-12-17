<?php
ob_start();
include_once ("../config.inc.php");
include_once ("incs/database.inc.php");
require_once("header.php");
session_start();
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}else{
	//$eid = mysql_real_escape_string($_GET['id']);
	if($_GET['id'] != ''){
		$eid = $_GET['id'];
		$select_query = "SELECT * FROM employers AS e
						INNER JOIN credits AS c
						ON e.id = c.employerid
						WHERE e.id =$eid";
		$select_result = mysql_query($select_query) or die("SQL Error 1: " . mysql_error());
		$row = mysql_fetch_assoc($select_result);
	}
}
?>
<h3 id='categories'>Update Employer</h3>
<form id="employers" name="employers" method="post" class="cmxform">
    <div id='new_employers'>
        <label for="ctitle"> <span>Company Name *</span>
            <BR>
            <input maxlength="255" size="80" id="companyname" name="companyname" type="text" value="<?php echo $row['companyname'];?>"/>
        </label>
        <br>
        <label> <span>Contact Name *</span>
            <BR>
            <input maxlength="255" size="80" name="contactname" id="contactname" type="text" value="<?php echo $row['name'];?>" >
        </label>
        <br>
        <label> <span>Email *</span>
            <BR>
            <input maxlength="255" size="70" name="email" type="text" id="email" value="<?php echo $row['email'];?>">
        </label>
        <br>
        <label> <span>Password *</span>
            <BR>
            <input maxlength="255" size="50" name="password" type="password" id="password" value="<?php echo $row['password'];?>">
        </label>
        <br>
        <label> <span>Telephone *</span>
            <BR>
            <input maxlength="255" size="50" name="telephone" type="text" id="telephone" value="<?php echo $row['telephone'];?>">
        </label>
        <br>
        <label> <span>Active</span>
            <br>
            <input <?php if($row['active'] ==1){echo  "checked=checked";}?> form="employers" value="1" name="active" type="checkbox">
            <br>
        </label>
        <label> <span>Approved</span>
            <br>
            <input <?php if($row['approved'] ==1){echo  "checked=checked";}?> form="employers" value="1" name="approved" type="checkbox">
            <br>
        </label>
        <br>
        <label> <span>Terms and Conditions</span>
            <br>
            <input <?php if($row['termsandconditions'] ==1){echo  "checked=checked";}?> form="employers" value="1" name="tandc" type="checkbox">
            <br>
        </label>
        <br>
        <label> <span>CV Credits </span>
            <BR>
            <input maxlength="6" size="10" name="credits" type="text" id="credits" value="<?php echo $row['credits'];?>">
        </label>
        <br>
        <input form="employers" value="Update Employer" id="newemployer" name="submit" type="submit">
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
                url : 'employer_add_db.php?action=update&id=<?php echo $eid;?>',
                type : 'post',
                dataType : 'text',
                data : $('form#employers').serialize(),
                success : function(data) {
                    window.location = 'employers.php';
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                },
            });
        }
    });
});
</script>