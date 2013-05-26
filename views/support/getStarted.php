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
		<div id="titlepane" class="spane" style="border:none;border-bottom:thin solid #DDD;font-size:2em;">Get Started </div>
		<div id="pane1" class="spane">
			<a onclick="slide('#sub1');sfade('#step1');recolor('#stepLink1');"><span>Setup a group</span></a><br>
			<div id="sub1" class="subMsg">
				<a id="stepLink1" class="stepLink1" onclick="recolor('#stepLink1');sfade('#step1');">Step 1</a>
				<a id="stepLink2" class="stepLink1" onclick="recolor('#stepLink2');sfade('#step2');">Step 2</a>
				<a id="stepLink3" class="stepLink1" onclick="recolor('#stepLink3');sfade('#step3');">Step 3</a><br>
				<div id="menubuffer" style="clear:both;position:relative"></div>				

				<div id="step1" class="step">1. When starting, head to the <b>Settings Page</b> to fill out your information. The menu bar at the top links you there.
				<img src="http://theninthbit.us/sgo/img/menu.jpg" style="padding-left:10px" width=100%><br></div>
				<div id="step2" class="step">2. Here, a new list of options appears in the side column. <br>
			<div id="" style="display:inline-block;position:relative;margin:0px auto;">
				<img src="http://theninthbit.us/sgo/img/settingstitle.jpg" style="float:left;clear:left;width:300px;">&lt Your group Id number<br>
				<img src="http://theninthbit.us/sgo/img/settingsleaders.jpg" style="float:left;clear:left;width:300px;">&lt Text about how this feature works and what you should do about it and how to maintain it a little bit with a general encouragement.<br>
				<img src="http://theninthbit.us/sgo/img/settingsdays.jpg" style="float:left;clear:left;width:300px;">&lt Pretty explanatory bit about the days we meet<br>
				<img src="http://theninthbit.us/sgo/img/settingslocation.jpg" style="float:left;clear:left;width:300px;">&lt A text description of your location in two or three words.<br>
				<img src="http://theninthbit.us/sgo/img/settingsage.jpg" style="float:left;clear:left;width:300px;">&lt Describe your target age group. <br>
				<img src="http://theninthbit.us/sgo/img/settingsgender.jpg" style="float:left;clear:left;width:300px;">&lt The target gender; M F Coed<br>
				<img src="http://theninthbit.us/sgo/img/settingssubmit.jpg" style="float:left;clear:left;width:300px;">&lt Make sure you save the form once its completed<br>
			</div></div>
			</div>
		</div>
		<div id="pane2" class="spane">
			<a onclick="slide('#sub2');"><span>Add people</span></a><br>
			<div id="sub2" class="subMsg" >
				<div style="display:inline-block">
				<img src="http://theninthbit.us/sgo/img/supportadd.jpg" style="float:left;clear:left;width:300px;">
				<img src="http://theninthbit.us/sgo/img/supportaddnew.jpg" style="float:left;clear:left;width:300px;">
				You'll need to add people to submit your first count. Type a name into the search bar. People already on record will also show information from the last small group they attended. Click their name to add them to your list. <br><br>If no results are found, add them in using their first and last name. Thats about it! Now you're cookin'
			</div></div>
		</div>
		<div id="pane3" class="spane">
			<a onclick="slide('#sub3');"><span>Share your counts</span></a><br>
			<div id="sub3" class="subMsg">Check the names of the people there and hit send. Easy Breezy</div>
		</div>
		<div id="pane4" class="spane">
			<a onclick="slide('#sub4');"><span>Get Help</span></a><br>
			<div id="sub4" class="subMsg">you don't need help</div>
		</div>

	</div>
</div>


<?php $this->load->view('support/support_footer'); ?>