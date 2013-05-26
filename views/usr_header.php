<html>
<head>
	<title>SGO</title>
	<link rel="apple-touch-icon-precomposed" href="http://theninthbit.us/sgo/src/ios.png" />  
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<meta charset="utf-8" />
	<script src="http://theninthbit.us/sgo/src/usrFunctions.js"></script>

<?php	
	if($mobile){
		echo '<link href="http://theninthbit.us/sgo/src/mobileSgo.css" rel="stylesheet" type="text/css"> ';
	}else{
		echo '<link href="http://theninthbit.us/sgo/src/sgo.css" rel="stylesheet" type="text/css"> ';
	}

	if($pagetype=="index"){
		echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		echo '<script type="text/javascript" src="http://theninthbit.us/sgo/src/googleapi.js"></script>';
		echo '<script type="text/javascript" src="http://theninthbit.us/sgo/src/jquery.js"></script>';
//		echo '<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />';
		echo '<link rel="stylesheet" href="http://theninthbit.us/sgo/src/calendar.css" />';
		echo '<script src="http://code.jquery.com/jquery-1.9.1.js"></script>';
		echo '<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>';
		echo '<script>$(function() {
				$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd",next:"b",prev:"a"});
				$("#datepicker").val("'.$date.'");
		      });</script>';
	}
	if($pagetype=="settings"){
		echo '<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>';
	}





?>
</head>