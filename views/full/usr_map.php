<html>
<head>


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