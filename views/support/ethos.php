<?php $this->load->view('support/support_header'); ?>

<body>

<div id="contentWrapper">
	<div id="backgroundMenu" class="menu">
		<div id="content">
		</div>
		
	</div>
	
	<div id="sideBar">
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/support" style="vertical-align:text-bottom;padding:5px;color:#FFF;font-size:2em;">Support</a>
		</div>
		<?php $this->load->view('support/content_menu'); ?>
	</div>
	<div id="centerContent">
		<div id="titlepane" class="spane" style="border:none;border-bottom:thin solid #DDD;font-size:2em;">Run A Group</div>
		<div id="pane1" class="spane">
			<a onclick="slide('#sub1');"><span>Using the small group guide</span></a><br>
			<div id="sub1" class="subMsg">
			</div>
		</div>
		<div id="pane2" class="spane">
			<a onclick="slide('#sub2');"><span>Joining the ohana</span></a><br>
			<div id="sub2" class="subMsg">a longerish segment<br>with more<br>and cool things</div>
		</div>
		<div id="pane3" class="spane">
			<a onclick="slide('#sub3');"><span>Resources</span></a><br>
			<div id="sub3" class="subMsg">asdfkfkfkee</div>
		</div>
		<div id="pane4" class="spane">
			<a onclick="slide('#sub4');"><span>Oft posed enquiries</span></a><br>
			<div id="sub4" class="subMsg">asdfkfkfkee</div>
		</div>

	</div>
</div>


<?php $this->load->view('support/support_footer'); ?>