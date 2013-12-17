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
<h3 id='categories'>CV Details</h3>
<div id="tabs">
    <ul>
        <li>
            <a href="#tabs-1">Contact Details</a>
        </li>
        <li>
            <a href="#tabs-2">Requirements</a>
        </li>
        <li>
            <a href="#tabs-3">Build your CV</a>
        </li>
    </ul>
    <form id="update_cv" method="post">
        <div id="tabs-1">
            <table width="439">
                <tr>
                    <td width="101"><strong>Name:</strong></td><td width="246" id="nameCell">
                    <input type="text" name="name" id="name" value="">
                    </td>
                </tr>
                <tr>
                    <td><strong>E-mail:</strong></td><td id="emailCell">
                    <input type="text" name="email" id="email" value="">
                    </td>
                </tr>
                <tr>
                    <td><strong>Password:</strong></td><td id="passwordCell">
                    <input type="password" name="password" value="">
                    </td>
                </tr>
                <tr>
                    <td><strong>Date of birth:</strong></td><td id="dobCell">
                        <input type="text" name="dob" id="dob" value="">
                    </td>
                </tr>
                <tr>
                    <td><strong>Town:</strong></td><td id="townCell">
                    <input type="text" name="town" id="town" value="<?php echo $user['town']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><strong>County:</strong></td><td id="countyCell"><?php dumpCounties($user['county']); ?></td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td><td id="phoneCell">
                    <input type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><strong>Mobile:</strong></td><td id="mobileCell">
                    <input type="text" name="mobile" id="mobile" value="<?php echo $user['mobile']; ?>">
                    </td>
                </tr>
            </table>
        </div>
        <div id="tabs-2">
            <div id="inner-left">
                <div class="formrow">
                    <label class="inputtext" for="txt_CurrentJobTitle" id="CurrentJobTitle-ariaLabel">Current Job Title</label>
                    <input id="txt_CurrentJobTitle" name="txt_CurrentJobTitle" type="text" aria-labelledby="CurrentJobTitle-ariaLabel" />
                </div>
                <div class="formrow">
                    <div class="subtitle">Status:</div>
                    <input id="chk_Employed" name="chk_Employed" type="checkbox" aria-labelledby="Employed-ariaLabel" />
                    <span><label for="chk_Employed" id="Employed-ariaLabel">Employed</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">&nbsp;</div>
                    <input id="chk_Self_Employed" name="chk_Self_Employed" type="checkbox" aria-labelledby="Self_Employed-ariaLabel" />
                    <span><label for="chk_Self_Employed" id="Self_Employed-ariaLabel">Self Employed</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">&nbsp;</div>
                    <input id="chk_Unemployed" name="chk_Unemployed" type="checkbox" aria-labelledby="Unemployed-ariaLabel" />
                    <span><label for="chk_Unemployed" id="Unemployed-ariaLabel">Unemployed</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">&nbsp;</div>
                    <input id="chk_Education" name="chk_Education" type="checkbox" aria-labelledby="Education-ariaLabel" />
                    <span><label for="chk_Education" id="Education-ariaLabel">Education</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">Job Type:</div>
                    <input id="chk_Permanent" name="chk_Permanent" type="checkbox" aria-labelledby="Permanent-ariaLabel" />
                    <span><label for="chk_Permanent" id="Permanent-ariaLabel">Permanent</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">&nbsp;</div>
                    <input id="chk_Temporary" name="chk_Temporary" type="checkbox" aria-labelledby="Temporary-ariaLabel" />
                    <span><label for="chk_Temporary" id="Temporary-ariaLabel">Temporary</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">&nbsp;</div>
                    <input id="chk_Contract" name="chk_Contract" type="checkbox" aria-labelledby="Contract-ariaLabel" />
                    <span><label for="chk_Contract" id="Contract-ariaLabel">Contract</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">&nbsp;</div>
                    <input id="chk_PartTime" name="chk_PartTime" type="checkbox" aria-labelledby="PartTime-ariaLabel" />
                    <span><label for="chk_PartTime" id="PartTime-ariaLabel">Part Time</label></span>
                </div>
                <div class="formrow">
                    <div class="subtitle">Are you Willing
                        <br>To Relocate?</div>
                    <fieldset>
                        <span><input value="Yes" id="rad_Areyouwillingtorelocate?_1" name="rad_Areyouwillingtorelocate?" type="radio" aria-labelledby="Areyouwillingtorelocate?-ariaLabel" />
                            <label for="rad_Areyouwillingtorelocate?_1" id="Areyouwillingtorelocate?-ariaLabel">Yes</label></span>
                        <span><input value="No" id="rad_Areyouwillingtorelocate?_2" name="rad_Areyouwillingtorelocate?" type="radio" aria-labelledby="Areyouwillingtorelocate?-ariaLabel" />
                            <label for="rad_Areyouwillingtorelocate?_2" id="Areyouwillingtorelocate?-ariaLabel">No</label></span>
                    </fieldset>
                </div>
            </div>
            <div id="inner-right">Right</div>
            <div class="clearfix"></div>
        </div>
        <div id="tabs-3">
            <P><STRONG>Well Done for coming this far! </STRONG>Are you now prepared to go that one step further? Take a few minutes and complete your CV and profile yourself to many potential employers.
            <STRONG>What are you waiting for?</STRONG></P>
            <p><strong>Cheats tip - you can copy  and paste from your current CV in the sections below</strong></p>
            <table>
                <tr>
                    <td>&nbsp;</td><td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Profile headline:</strong></td>
                    <td colspan="4"><input title="This is your first contact with an employer, make it stand out and catchy, do not enter your name in this field" type="text" name="headline" id="headline" style="width: 700px;"/>
                        <br /><span id="countdown_headline"></span></td>
                </tr>
                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top"><p><strong>Personal statement:</strong></p>
                    <p class="tip">&nbsp;</p></td>
                    <td colspan="4"><textarea title="A brief description about yourself e.g. Graduate, Mature. What you have to offer and your career aims" name="bio" id="bio" style="width: 700px; height: 200px">
                    </textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top"><p><strong>Interests and Hobbies:</strong></p>
                    <p class="tip">&nbsp;</p></td>
                    <td colspan="4">
                        <textarea title="What you enjoy doing outside of work. This gives employers a better understanding about the candidate they are considering for employment" name="achievements" id="achievements" style="width: 700px; height: 200px" >
                        </textarea></td>
                </tr>
                <tr>
                    <td valign="top"><strong>Work Experience / History</strong></td>
                    <td colspan="4">
                    <textarea class="tinymce" name="workexperience_text"></textarea>
                    <p class="tip">If you are using a modern browser you will be able to extend the box above by stretching the bottom right corner</p>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top"><strong>Education:</strong></td>
                    <td colspan="4">
                    <textarea class="tinymce" name="education_text">
                    </textarea>
                    <p class="tip">If you are using a modern browser you will be able to extend the box above by stretching the bottom right corner</p>
                    </td>
                </tr>
</table>
        </div>
</div>
<input type="submit" value="Update CV" id="update_cv_button"/>
</form><!--END Form -->
<!--FOOTER----------------------------------------->
<?php
include ("footer.php");
?>
<script>
    $(function() {
$("#tabs").tabs();
var data = "tbl=cvs_by_id&update=true&id=<?php echo $id; ?>
    ";
    $.ajax({// Ajax call to get data
        type: "POST",
        dataType : 'json',
        url : 'incs/cv_detail.php',
        cache : false,
        data : data,
        success : function(data, status, xhr) {
            populate_form(data[0]);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });//ENd ajax call to get data

    $('#update_cv_button').click(function(event){
        event.preventDefault();
        console.log("clicked");

    });
    function populate_form(data){
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#password').val(data.password);
        var dob = $.format.date(data.dob + " 00:00:50.546", "dd/MM/yyyy");
        $('#dob').val(dob);
        $('#town').val(data.town);
        $("#county option:contains(" + data.county + ")").attr('selected', 'selected');
        $('#phone').val(data.phone);
        $('#mobile').val(data.mobile);
        $('#headline').val(data.headline);
        $('#bio').val(data.bio);
        $('#quirky_dinner').val(data.quirky_dinner);
        $('#quirky_movie').val(data.quirky_movie);
        $('#quirky_quote').val(data.quirky_quote);
        $('#achievements').val(data.achievements);

        $('#workexperience_text').val(data.workexperience_text);
        $('#education_text').val(stripslashes(data.education_text));

    }
    });
    //ENd document ready function
</script>