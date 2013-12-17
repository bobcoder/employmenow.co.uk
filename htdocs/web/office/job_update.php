<?php
require_once ("header.php");
if ($_SESSION['username'] == '') {
    header('location: login.php');
    $logout = "Log In";
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
            <input maxlength="255" size="30" id="ref" name="ref" type="text" >
        </label>
        <br>
        <label> <span>Salary Notes </span>
            <BR>
            <input maxlength="255" size="30" id="salary_notes" name="salary_notes" type="text" title="Your own salary notes for this vacancy. Competitive salary, negotiable on experience, etc">
        </label>
        <br>
        <label> <span>Salary</span>
            <BR>
            <select name='salary' id='salary'>
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
            <textarea class="tinymce" id="description" name="description">
        </textarea> </label><br>
	        <label><span>Job Type</span>
	            <BR>
	            <div id="wrap">
				  <div class="group1">
				      <input class="radio" type="radio" id="jobgroup1" name="jobgroup1" value="Temp" checked/>Temp<br>
				      <input class="radio" type="radio" id="jobgroup1" name="jobgroup1" value="Perm"  />Perm<br>
				      <input class="radio" type="radio" id="jobgroup1" name="jobgroup1" value="Contract" />Contract
				   </div>
				   <div class="group2">
				      <input class="radio" type="radio" id="jobgroup2" name="jobgroup2" value="Part Time" checked/>Part Time<br>
				      <input class="radio" type="radio" id="jobgroup2" name="jobgroup2" value="Full Time" />Full Time<br>
				   </div>
				</div>
				 </label>
	        <br>
        <label> <span>Linked to Employer</span>
            <br>
            <div id="employer"></div></label>
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
	    <label> <span>Town/City <span class="req">*</span></span>
	        <BR>
	        <input maxlength="255" size="30" id="town" name="town" type="text" >
	    </label><br>
        <label> <span>Expires Date</span>
            <BR>
            <input name="date_expires" type="text" id="date_expires" />
        </label><br>

        <label> <span>Active</span>
            <br>
            <input checked="checked" form="jobs" value="1" name="active" id="active" type="checkbox">
            <br>
        </label>
        <br>
        <input type="hidden" id="id" name="id">
        <input form="jobs" value="Submit" id="newjob" name="submit" type="submit">
        <br>
    </div>
</form>
<?php
    include ("footer.php");
?>
<script>

    $(document).ready(function() {
    var jobid = GetURLParameter('id');
    var jobsdata;
    var jobsdatastr = "type=jobsById&id=" + jobid;
            $.ajax({
                type: 'get',
                dataType : 'json',
                url : 'incs/db.inc.php',
                cache : false,
                data : jobsdatastr,
                success : function(jobsdata, status, xhr) {
                    populateFields(jobsdata[0]);
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    $(".errormsgbox").fadeIn(2000);
                }
        });
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
                    option += '<option value="' + value.id + '">' + value.companyname + '</option>';
                });
                select = select + option + '</select>';
                $('#employer').html(select);
            },
            complete: function(){
                $("#employer_id").val(localStorage.getItem('employer_id'));
                window.localStorage.setItem("employer_id","");
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
                    option += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                select = select + option + '</select>';
                $('#industry').html(select);
            },
            complete: function(){
                $("#industry_id").val(localStorage.getItem('industry_id'));
                window.localStorage.setItem("industry_id", "");
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
            }
        },
        submitHandler: function (form) {
            event.preventDefault();
tinymce.get("description").save();
            $.ajax({
                url : 'job_update_db.php?action=updatejob',
                type : 'post',
                dataType : 'text',
                data : $('form#jobs').serialize(),
                success : function(data) {
                    $(".successbox").fadeIn(2000);
                    window.location = 'jobs.php';
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
            dateFormat: 'dd-mm-yy'
        });
        function populateFields(data){
        	//Read in the job type vals and split them in to array
        	var jobtype = data.job_type;
			var lines = jobtype.split(',');

        	tinymce.activeEditor.selection.setContent(data.description);
        	$("#id").val(data.jobs_id);
            $('#ctitle').val(data.title);
            $('#ref').val(data.ref);
            $('#salary_notes').val(data.salary_notes);
            $("#salary").val(data.salary);
			//Populate radio buttons
            var $radios1 = $('input:radio[name=jobgroup1]');
            $radios1.filter('[value="' + lines[0] + '"]').prop('checked', true);
            $("#jobgroup2").val(lines[1]);
            var $radios2 = $('input:radio[name=jobgroup2]');
            $radios2.filter('[value="' + lines[1] + '"]').prop('checked', true);
            //Bung vals into local; storage to make them global
            window.localStorage.setItem("employer_id",data.employer_id);
            window.localStorage.setItem("industry_id",data.industry_id);
            $('#county').val(data.region);
            $('#town').val(data.town);
            var exp_date = $.format.date(data.date_expires, "dd-MM-yyyy");
            $('#date_expires').val(exp_date);
            $('#active').val(data.active);
        }
    });
</script>
