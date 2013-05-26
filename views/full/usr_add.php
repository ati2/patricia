<?php $this->load->view('usr_header'); ?>

<body onload="document.search.inputs.focus();">

<div id="contentWrapper">
	<div id="backgroundMenu" class="menu">
			<?php $this->load->view('full/menu'); ?>
		
	</div>
	<div id="sideBar">
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/usr" style="padding:5px;color:#FFF;font-size:2em;"><?php echo $sgoData['leader_uid'][1]; ?>'s group</a>
		</div>
		<br><br><br>
		<?php $this->load->view('usr_content_add'); ?>
	</div>

	

<div id="subContentWrapper">

</div>
</div>

<?php $this->load->view('usr_footer'); ?>