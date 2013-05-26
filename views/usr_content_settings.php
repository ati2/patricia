
<div class="settingsWrapper" style="margin-top:10px;">
<form action="submitSetting" method="POST">
Group <?php echo $sgoData['sgo_id']; ?><br>

<select class="textbox" name="leader">
<?php
	if($sgoData['leader_uid']=='none'){
	}else{
		echo '<option value="'.$sgoData['leader_uid'][0].'">'.$sgoData['leader_uid'][1].'</option>';
	}
	echo '<option value="0">none</option>';

	foreach($users as $user){
		if($sgoData['leader_uid']!='none'&&$user[0]==$sgoData['leader_uid'][0]){
		}else{
			echo '<option value='.$user[0].'>'.$user[1].'</option>';
		}
	}
?>
</select>
<br><span>leader</span><br>

<select class="textbox" name="apprentice">
<?php
	if($sgoData['apr_uid']=='none'){
	}else{
		echo '<option value="'.$sgoData['apr_uid'][0].'">'.$sgoData['apr_uid'][1].'</option>';
	}
	echo '<option value="0">none</option>';

	foreach($users as $user){
		if($sgoData['apr_uid']!='none'&&$user[0]==$sgoData['apr_uid'][0]){
		}else{
			echo '<option value='.$user[0].'>'.$user[1].'</option>';
		}
	}
?>
</select>
<br><span>apprentice</span><br>

<select class="textbox" name="assist">
<?php
	if($sgoData['assist_uid']=='none'){
	}else{
		echo '<option value="'.$sgoData['assist_uid'][0].'">'.$sgoData['assist_uid'][1].'</option>';
	}
	echo '<option value="0">none</option>';

	foreach($users as $user){
		if($sgoData['assist_uid']!='none'&&$user[0]==$sgoData['assist_uid'][0]){
		}else{
			echo '<option value='.$user[0].'>'.$user[1].'</option>';
		}
	}
?>
</select>
<br><span>assistant</span><br>


<br>
<?php
for($i=0;$i<7;$i++){
	$days=array('S','M','T','W','R','F','S');
	$checkValue = ($i==$sgoData['date']? 'checked':'');
	echo '<div id="day'.$i.'" onclick="changeDay('.$i.')" class="weekday" ><input type="radio" id="radio'.$i.'" value="'.$i.'" name="date" '.$checkValue.'><label for="radio'.$i.'">'.$days[$i].'</label></div>';
}
?>

<br>
<span> meeting day</span>

<br>
<input type="text" class="textbox" name="location" value="<?php echo $sgoData['location']; ?>"> <br><span>location</span><br>
<input type="text" class="textbox" name="time" value="<?php echo $sgoData['time']; ?>"> <br><span>time</span><br>
<input type="text" class="textbox"  name="age" value="<?php echo $sgoData['age']; ?>"><br><span> age group</span><br>
<input type="text" class="textbox"  name="gender" value="<?php echo $sgoData['gender']; ?>"><br><span> gender</span><br>


<br>
<button class="msgBtn">Save</button>
</form>
</div>