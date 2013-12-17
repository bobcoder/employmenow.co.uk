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
<h3 id='categories'>Add Job</h3>
<div class="successbox" >
    Jobs added
</div>
<div class="warningbox" >
    Warning something went wrong
</div>
<div class="errormsgbox" >
    Database connection error
</div>
<form id="jobs" name="jobs" method="post" class="cmxform">
    <div id='new_jobs'>
        <label for="ctitle"> <span>Title *</span>
            <BR>
            <input maxlength="255" size="80" id="ctitle" name="title" type="text"/>
        </label>
        <br>
        <label> <span>Reference Number *</span>
            <BR>
            <input maxlength="255" size="30" name="ref" type="text" >
        </label>
        <br>
        <label> <span>Salary</span>
            <BR>
            <select name='salary'>
                <option value='0-15000'>&pound;0 to &pound;15000</option>
                <option value='15001-20000'>&pound;15001 to &pound;20000</option>
                <option value='20001-25000'>&pound;20001 to &pound;25000</option>
                <option value='25001-30000'>&pound;25001 to &pound;30000</option>
                <option value='30001-35000'>&pound;30001 to &pound;35000</option>
                <option value='35001-40000'>&pound;35001 to &pound;40000</option>
                <option value='40001-50000'>&pound;40001 to &pound;50000</option>
                <option value='50001-60000'>&pound;50001 to &pound;60000</option>
                <option value='60001-70000'>&pound;60001 to &pound;70000</option>
                <option value='70001-10000000'>&pound;70001 and above</option>
            </select> </label>
        <br>
        <label><span>Description *</span>
            <br>
            <textarea class="tinymce" name="description" id="description"></textarea></label>
        <br>
        <label> <span>Job Type</span>
            <BR>
            <select name='job_type'>
                <option value=''> Select </option>
                <option value='Full Time'> Full Time </option>
                <option value='Part Time'> Part Time </option>
                <option value='Temporary'> Temporary </option>
                <option value='Permanent'> Permanent </option>
                <option value='Contract'> Contract </option>
            </select> </label>
        <br>
        <label> <span>Linked to Employer</span>
            <br>
            <div id="employer"></div> </label>
        <br>
        <label> <span>Industry</span>
            <br>
            <div id="industry"></div> </label>
        <br>
        <label> <span>Region/County</span>
            <br>
            <?php dumpCounties(""); ?>
        </label>
        <br>
        <label> <span>Town/City *</span>
            <BR>
            <input maxlength="255" size="30" name="town" type="text" >
        </label><br>
        <label> <span>Expires Date</span>
            <BR>
            <input name="date_expires" type="text" id="date_expires" value="<?php echo date("d-m-Y");?>" />
        </label><br>
        <label> <span>Active</span>
            <br>
            <input checked="checked" form="jobs" value="1" name="active" type="checkbox">
            <br>
        </label>
        <br>
        <input form="jobs" value="Submit" id="newjob" name="submit" type="submit">
        <br>
    </div>
</form>
<?php
    include ("footer.php");
?>
<script>

    $(document).ready(function() {

        //Populate the dropdown
        var data = "type=employers&update=true&";
        var industry = "type=industry&update=true&";
        $.ajax({
            dataType : 'json',
            url : 'incs/db.inc.php',
            cache : false,
            data : data,
            success : function(data, status, xhr) {
                var select = '<select id="employer_id" name="employer_id">';
                var option = '';
                $.each(data, function(index, value) {
                    option += '<option value=' + value.id + '>' + value.companyname + '</option>';
                });
                select = select + option + '</select>';
                $('#employer').html(select);
            },
            error : function(jqXHR, textStatus, errorThrown) {
                $(".errormsgbox").fadeIn(2000);
                console.log(textStatus);
            }
        });
        $.ajax({
            dataType : 'json',
            url : 'incs/db.inc.php',
            cache : false,
            data : industry,
            success : function(data, status, xhr) {
                var select = '<select id="industry_id" name="industry_id">';
                var option = '';
                $.each(data, function(index, value) {
                    option += '<option value=' + value.id + '>' + value.name + '</option>';
                });
                select = select + option + '</select>';
                $('#industry').html(select);
            },
            error : function(jqXHR, textStatus, errorThrown) {
                $(".errormsgbox").fadeIn(2000);
                console.log(textStatus);
            }
        });

    $('#jobs').validate({ // initialize the plugin
        rules: {
            title: {
                required: true
            },
            ref: {
                required: true
            },
            description: {
                required: true
            },
            town: {
                required: true
            },
            job_type: {
                required: true
            }
        },
        submitHandler: function (form) { // for demo
            event.preventDefault();
            tinyMCE.get("description").save();
            $.ajax({
                url : 'job_add_db.php?action=addjob',
                type : 'post',
                dataType : 'text',
                data : $('form#jobs').serialize(),
                success : function(data) {
                    $(".successbox").fadeIn(2000);
                    //window.location = 'jobs.php';
                    console.log(data);
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    $(".errormsgbox").fadeIn(2000);
                    console.log(textStatus);
                },
            });
        }
    });

        $('.successbox').hide();
        //Hide the div
        $('.warningbox').hide();
        $('.errormsgbox').hide();
        $( "#date_expires" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: -0,
            defaultDate: +7,
        });

    });
</script>
