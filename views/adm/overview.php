<?php $this->load->view('adm/adm_header'); ?>

<body>
<div id="contentWrapper">
	<div id="backgroundMenu" class="menu">
		<div id="content">
		</div>
		
	</div>
	
	<div id="sideBar">
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/adm" style="vertical-align:text-bottom;padding:5px;color:#FFF;font-size:2em;">SGO Overview</a>
		</div>
		<?php $this->load->view('adm/content_menu'); ?>
	</div>
	<div id="centerContent">
		<div id="pane1" class="pane">
			<span>People</span><br>
		<?php
 			function plural($count){
				$output=($count==1)?' person':' people';
				return $output;
			}
			echo '<a href="http://theninthbit.us/sgo/adm/usrList/attendance" class="admlink">'
				.$attendance
				.plural($attendance)
				.'</a> attended this week <br>';
			echo '<a href="http://theninthbit.us/sgo/adm/usrList/new" class="admlink">'
				.$newCount
				.' new'
				.plural($newCount)
				.'</a> checked it out <br>';
			echo '<a href="http://theninthbit.us/sgo/adm/usrList/consistent" class="admlink">'
				.$consistent
				.' consistent'
				.plural($consistent)
				.'</a> did not go <br>';
			echo '<a href="http://theninthbit.us/sgo/adm/usrList/former" class="admlink">'
				.$former
				.plural($former)
				.'</a> have returned recently<br>';
			echo '<a href="http://theninthbit.us/sgo/adm/usrList/missing" class="admlink">'
				.$missing
				.plural($missing)
				.'</a> have stopped coming<br>';


		?>

		</div>
		<div id="pane1" class="pane">
			<span>Groups</span><br>
		<?php
			function pluralG($count){
				$output=($count==1)?' group has':' groups have';
				return $output;
			}
			echo $haveMet
				.pluralG($haveMet)
				.' met this week <br>';
			echo $late
				.pluralG($late)
				.' not submitted counts <br>';
			echo 'x groups had an event <br>';
			
			echo $updated
				.pluralG($updated)
				.' changed info';
		?>

		</div>
		<div id="pane1" class="pane">
			<span>Summary</span><br>
			you have x messages waiting 
		</div>

	</div>
</div>


<?php $this->load->view('adm/adm_footer'); ?>