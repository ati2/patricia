<?php $this->load->view('usr_header'); ?>

<body onload="checkAllListColors()">

<div id="contentWrapper">
	<div id="backgroundMenu" class="menu">
		<div id="content">
			<?php $this->load->view('full/menu'); ?>
		</div>
		
	</div>
	
	<div id="sideBar">
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/usr" style="vertical-align:text-bottom;padding:5px;color:#FFF;font-size:2em;"><?php echo $sgoData['leader_uid'][1]; ?>'s group</a>
		</div>
		
		<?php $this->load->view('usr_content_listing'); ?>
	</div>
	

<div id="verticalBarGraph" class="charting">
 <div id="chart_div" style="margin-left:-10%; width: 100%; height: 100%;"></div>


</div>
</div>
<?php $this->load->view('usr_footer'); ?>