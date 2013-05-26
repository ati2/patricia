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
		<div id="titlepane" class="spane" style="border-bottom:thin solid #DDD;font-size:2em;">Hello. </div>
		<div id="pane1" class="spane">
			<span>Be Cool</span><br>
			Small Groups are the epitomy of style and haute couture. Get in on this action today!
		</div>
		<div id="pane1" class="spane">
			<span>Don't Panic</span><br>
			This guide aims to cover any questions you have. If something stops working, just let us know and we'll stop the late counts system from signing you up for the welcome table. 
		</div>

	</div>
</div>


<?php $this->load->view('support/support_footer'); ?>