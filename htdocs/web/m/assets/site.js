/**
 * @author Robert E Broomfield
 */
    $(document).on('pageinit', function(){
        //Add some global vars
        jobid_fav = '';
        $('.favs').click(function(e){
            jobid_fav = $(this).parent().attr('data-name');
            $('#addtofav').popup("open");
        });
        //Add the job ID to the user favourite list
        $('#yesfav').click(function(e){
        	var uid = $('#userid').val();
        	if(uid){
        		addToFavourites(jobid_fav, uid);
        	}else{
        		//Send user to login
        		$.mobile.changePage( "login.php", { transition: "slideup"} );
        	}
                $('#addtofav').popup("close");
        });
        //Bail out
        $('#nofav').click(function(e){
        	//$('a [data-name='+ jobid_fav + ']').attr("data-theme", "e");
            $('#addtofav').popup("close");
        });

        $('#signupbtn').click( function(event) { // catch the form's submit event
            $('#lblname').removeClass('missing');
            $('#lblemail').removeClass('missing');
            $('#lblpassword').removeClass('missing');
            $('#lblmobile').removeClass('missing');
            var err = false;
            if($('#name').val()==''){
                $('#lblname').addClass('missing');
                err = true;
             }
             if($('#email').val()==''){
                $('#lblemail').addClass('missing');
                err = true;
             }
             if($('#password').val()==''){
                $('#lblpassword').addClass('missing');
                err = true;
             }
             if($('#mobile').val()==''){
                $('#lblmobile').addClass('missing');
                err = true;
             }
             if($('#town').val()==''){
                $('#lbltown').addClass('missing');
                err = true;
             }
             if(err==true){
                 alert("Please fillout all required fields");
             }else{
            $.ajax({
                url: 'signup.php',
                data: $('form#signup').serialize(),
                type: 'post',
                async: 'true',
                dataType: 'json',
                beforeSend: function() {
                    // This callback function will trigger before data is sent
                    $.mobile.showPageLoadingMsg(true); // This will show ajax spinner
                },
                complete: function() {
                    // This callback function will trigger on data sent/received complete
                    $.mobile.hidePageLoadingMsg(); // This will hide ajax spinner
                },
                success: function (result) {
                    if(result.status) {
                        console.log(result);//Debugging
                        if(result.reg){
                            //window.location.href='index.php?details=' + result.jobid;
                        }else{
                            //window.location.href='index.php';
                        }
                    } else {
                        alert('Sign up unsuccessful!');
                    }
                },
                error: function (request,error) {
                    // This callback function will trigger on unsuccessful action
                    alert('Network error has occurred please try again! ' + 'Actual error:' + error);
                }

            });
            }//End error checking validation
        });
        $('#submit').click( function(event) { // catch the form's submit event
            if($('#username').val().length > 0 && $('#password').val().length > 0){
                // Send data to server through the ajax call
                // action is functionality we want to call and outputJSON is our data
                    $.ajax({
                        url: 'check.php',
                        data: $('form#checkuser').serialize(),
                        type: 'post',
                        async: 'true',
                        dataType: 'json',
                        beforeSend: function() {
                            // This callback function will trigger before data is sent
                            $.mobile.showPageLoadingMsg(true); // This will show ajax spinner
                        },
                        complete: function() {
                            // This callback function will trigger on data sent/received complete
                            $.mobile.hidePageLoadingMsg(); // This will hide ajax spinner
                        },
                        success: function (result) {
                            if(result.status) {
                                console.log(result);//Debugging
                                if(result.jobid){
                                    window.location.href='index.php?details=' + result.jobid;
                                }else{
                                    window.location.href='index.php';
                                }
                            } else {
                                alert('Logon unsuccessful!');
                            }
                        },
                        error: function (request,error) {
                            // This callback function will trigger on unsuccessful action
                            alert('Network error has occurred please try again! ' + 'Actual error:' + error);
                        }
                    });
            } else {
                alert('Please fill all necessary fields');
            }
            return false; // cancel original event to prevent form submitting
        });
    $("#applynow").click( function(event){
                     $.ajax({
                        url: 'm_job_apply.php',
                        //data: {
                        //    action : 'login',
                        //    formData : $('#checkuser').serialize()},
                        data: {jobId: $('#jobs_id').html()},
                        type: 'post',
                        async: 'true',
                        dataType: 'json',
                        beforeSend: function() {
                            // This callback function will trigger before data is sent
                            $.mobile.showPageLoadingMsg(true); // This will show ajax spinner
                        },
                        complete: function() {
                            // This callback function will trigger on data sent/received complete
                            $.mobile.hidePageLoadingMsg(); // This will hide ajax spinner
                        },
                        success: function (result) {
                            //console.log(result);//Debugging
                            if(result.userId){
                                window.location.href='index.php?where=ta_apply';//Send to welcome
                            }else{
                                window.location.href='login.php?jobid=' + result.jobid;
                            }
                        },
                        error: function (request,error) {
                            // This callback function will trigger on unsuccessful action
                            alert('Network error has occurred please try again! ' + 'Actual error: ' + error);
                        }
                    });
        return false;
    });

});
$( document ).bind( "mobileinit", function(){
    $.mobile.page.prototype.options.degradeInputs.date = true;
});
function addToFavourites(job_id, uid){
    console.log('Adding '+job_id+' to favourites of user ' + uid);
	     $.ajax({
	        url: 'm_addtofavs.php',
	        data: {jobid: job_id, userid: uid},
	        type: 'post',
	        async: 'true',
	        dataType: 'json',
	        beforeSend: function() {
	            // This callback function will trigger before data is sent
	            $.mobile.showPageLoadingMsg(true); // This will show ajax spinner
	        },
	        complete: function() {
	            // This callback function will trigger on data sent/received complete
	            $.mobile.hidePageLoadingMsg(); // This will hide ajax spinner
	        },
	        success: function (result) {
	        	alert('Favorite Added');
	            //console.log(result);//Debugging
	/*
	                            if(result.userId){
	                                window.location.href='index.php?where=ta';//Send to welcome
	                            }else{
	                                window.location.href='login.php?jobid=' + result.jobid;
	                            }*/
	        },
	        error: function (request,error) {
	            // This callback function will trigger on unsuccessful action
	            alert('Network error has occurred please try again! ' + 'Actual error: ' + error);
	        }
	    });
}
