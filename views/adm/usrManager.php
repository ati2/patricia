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
	<div id="centerContent">
		<div id="pane1" class="pane" style="width:45%">
			<form>
			<input type="text"  value="<?php echo $usr['fname']; ?>">
			<input type="text"  value="<?php echo $usr['lname']; ?>">
			<input type="submit" value="Save" style="width:10%;background:#DDD;border:#DDD;">
				<?php 
					echo "<br>".$usr['fname']." leads in ";
					$output=(($leaderData)=="")?"no groups at this time":$leaderData[0][2]."'s group."; //if 0, say none, else assume 1
					if(count($leaderData)>=2){ 
						$output=""; 	//if >=2, overwrite output.
						$last=array_pop($leaderData); 
						foreach($leaderData AS $group){
							$output.=$group[2]."'s group"; 
							$output.=($group[3]==1)?"(".$group[0]."),":", ";
						}

						$output.="and ".$last[2]."'s group";
						$output.=($last[3]==1)?"(".$last[0].").":". ";
					}
					echo $output;
				?>
				<br>


			</form>
		</div>
		<div id="pane2" class="pane" style="width:45%">
		<?php
			foreach($history as $row){
				print_r($row);
				echo "<br>";
			}
		?>
		</div>

	</div>
</div>


<?php $this->load->view('adm/adm_footer'); ?>