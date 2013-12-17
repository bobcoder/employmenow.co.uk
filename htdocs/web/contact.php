<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Get in touch</title>
	<link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="../css/template.css" type="text/css"/>
    <script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<script src="../js/jquery-1.8.2.min.js" type="text/javascript">
	</script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>
</head>
<body class="contactpage">

<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<img src="images/logo.png" />
		</div>
<?php include("navlogin.inc.php"); ?>
		    <?php include("themenu.php"); ?>

	</div>
</div>

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
        
            <div class="generalleft">
            
            <h1 class="homeh1">Contact us</h1>
            
            <p>Feel free to get in touch with any questions or comments you may have</p>


	<form id="formID" class="formular" method="post" action="cf.php">
	<fieldset>
		
			<label>
				<span>Your Name </span>
				<input value="" class="validate[required] text-input" type="text" name="name" id="req" />
			</label>
		
				<label>
				<span>Your Email </span>
				<input value="" class="validate[required] text-input" type="text" name="email" id="req" />
			</label>
				<label>
                
				<span>Your Comments </span>
				<textarea name="message" class="validate[required] text-input" id="message"></textarea>
		    </label>
			
			
            
            
            
		  <br/>
		</fieldset>
<input class="submit button" type="submit"  value="Get in touch"/><hr/>
	</form>
    
    
    
    
</div>
</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
