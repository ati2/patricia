<html>
<head>
	<title>SGO</title>
	<link rel="apple-touch-icon-precomposed" href="http://theninthbit.us/sgo/src/ios.png" />  
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<script src="http://theninthbit.us/sgo/src/usrFunctions.js"></script>

<?php	
	if($mobile){
		echo '<link href="http://theninthbit.us/sgo/src/mobileSgo.css" rel="stylesheet" type="text/css"> ';
	}else{
		echo '<link href="http://theninthbit.us/sgo/src/sgo.css" rel="stylesheet" type="text/css"> ';
	}

?>
		<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://theninthbit.us/sgo/src/jquery.js"></script>
		<script src="http://theninthbit.us/sgo/src/gmapsUserFunctions.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#map_canvas').jqPinMyLocation({
					serverUrl	: 'submitLatLong',//Server url 
					requestType	: 'post', // Type of request that we will send to server
					additionalData	: {//Additional data that will be send to server after user drag the cursor
						id	: <?php echo $sgoData['sgo_id']; ?>
					},
					address : <?php echo ($sgoData['lat']!=0?"'".$sgoData['lat'].", ".$sgoData['long']."'":"'honolulu, Hawaii'"); ?>
				});
			});
		</script>

</head>


<body onload="checkWeekdays()">

<div id="contentWrapper">
	<div id="backgroundMenu" class="menu" style="z-index:2">
		<div id="content">
			<?php $this->load->view('full/menu'); ?>
		</div>
		
	</div>
	<div id="sideBar" style="z-index:3;">
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/usr" style="padding:5px;color:#FFF;font-size:2em;"><?php echo $sgoData['leader_uid'][1]; ?>'s group</a>
		</div>
		<br><br><br>
		<?php $this->load->view('usr_content_settings'); ?>
	</div>

<div id="subContentWrapper">
<div id="map_canvas" style="width: 100%; height: 100%;z-index:1"></div>
</div>
</div>


<?php $this->load->view('usr_footer'); ?>