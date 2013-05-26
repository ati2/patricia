<?php 	$this->load->view('adm/adm_header'); ?>
<body>
<div id="contentWrapper">
	<div id="backgroundMenu" class="menu">
		<div id="content">
		</div>
		
	</div>
	
	<div id="sideBar">
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/adm" style="vertical-align:text-bottom;padding:5px;color:#FFF;font-size:2em;">People Manager</a>
		</div>
		<?php $this->load->view('adm/content_menu'); ?>
	</div>
	<div id="centerContent"> This page will show a lot more data for each user, in addition to filtering and sorting tools<br><br>
		<div id="listings" >
		<?php
			if(!($listing)==""){
				echo '<ul>';
				foreach($listing as $row){
					echo '<li><a href="http://theninthbit.us/sgo/adm/usrData/'.$row[0].'">'.$row[1].' '.$row[2].'</a></li>';
				} echo '</ul>';
			}else{
				echo 'no data available';
			}

		?>

		</div>
	</div>
</div>

<?php $this->load->view('adm/adm_footer'); ?>
