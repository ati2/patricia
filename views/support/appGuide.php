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
		<div id="titlepane" class="spane" style="border:none;border-bottom:thin solid #DDD;font-size:2em;">Use The App </div>
		<div id="pane1" class="spane">
			<a onclick="slide('#sub1');"><span>Late counts</span></a><br>
			<div id="sub1" class="subMsg"><div  style="display:inline-block;">We know you haven't submitted your counts milliseconds after your group's meeting and we'll be happily signing you up for welcome table and parking duties. The more important issue however, is knowing whats going on. Even when its late. So find redemption and holiness by submitting counts for missed dates.
<br>
<br>
<img src="http://theninthbit.us/sgo/img/supportdatepicker.jpg" style="width:300px;float:left;">
<br> 
Click the date bar to choose the date you want to turn in a count, list who was there, and send it over our way! The dark blue square marks the currently set date. The light blue square shows the current date.<br><br>Resubmissions of a date will overwrite the old information with the newer count. 
			</div>
		</div></div>
		<div id="pane2" class="spane">
			<a onclick="slide('#sub2');"><span>Your attendance list</span></a><br>
			<div id="sub2" class="subMsg">This list is populated by all people that have attended your group in the past month. There is no delete or add. People used and disused will naturally create your list. The pool of candidate leaders, apprentices, and assistants comes from the list of currently active users. </div>
		</div>
		<div id="pane3" class="spane">
			<a onclick="slide('#sub3');"><span>Multiple groups</span></a><br>
			<div id="sub3" class="subMsg">If you lead more than one group, the important bit is to remember your pin number. Unfortunately, there is no web support for account switching. You will need to logout and login for each group. However, the app for android/iphone uses an account manager that both remembers pins and passwords, and simplifies account switching to a button press. Download it here. Do it.  </div>
		</div>
		<div id="pane4" class="spane">
			<a onclick="slide('#sub4');"><span>Account info</span></a><br>
			<div id="sub4" class="subMsg">Each account is managed by an account pin and password. </div>
		</div>
		<div id="pane5" class="spane">
			<a onclick="slide('#sub5');"><span>Have an event</span></a><br>
			<div id="sub5" class="subMsg">Events are all the rage and reach out to friends and communities. To keep from being signed up for bigger <a title="pronounced dooties">duties</a>, submit your count! If you are having an event that <b>replaces your small group</b>, just click the "Events" link on the bottom, provide a brief description of the activity and send that to us. This tells the system to ignore that weeks counts while keeping track of the groups activities. </div>
		</div>

	</div>
</div>


<?php $this->load->view('support/support_footer'); ?>