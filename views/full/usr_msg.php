<?php $this->load->view('usr_header'); ?>
<body>

<div id="contentWrapper">
<?php $this->load->view('usr_menu'); ?>
	<div id="backgroundMenu" class="menu">
		<div id="content">
			<?php $this->load->view('full/menu'); ?>
		</div>
		
	</div>

	<div id="sideBar">
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/usr" style="padding:5px;color:#FFF;font-size:2em;"><?php echo $sgoData['leader_uid'][1]; ?>'s group</a>
		</div>
		<br><br><br><br>
		<div style="padding:5px;">
		Let us know whats going on. When planning events, working through issues, or needing support, let us know how we can help. With other issues regarding this site or your counts, or if have cool ideas of what we can do, send us a Bug or Suggestion memo.
		</div>
	</div>

<div id="subContentWrapper">
<?php $this->load->view('usr_content_msg'); ?>
</div>


<?php $this->load->view('usr_footer'); ?>