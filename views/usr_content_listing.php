<div id='listing'><form name="info" method='POST' action='http://theninthbit.us/sgo/usr/submitCount'>
<br>
<div class="option">
Hello.<br>


<input type="text" id="datepicker" name="sgodate">

</div>
<?php 
foreach($users as $value){
$checkValue = ($value[3]==1?'checked':'');
	echo '<div class="option" id="div'.$value[0].'" onclick="checkListings('.$value[0].')">';
	echo '<input id="check'.$value[0].'" type="checkbox" onclick="checkListings('.$value[0].')" name="users[]" value="'.$value[0].'" '.$checkValue.'>';
	echo $value[1].' '.$value[2].'<br>';
	echo '</div>';
}
?>
<input type="submit" name="submitbtn" class="option optsubmitbtn" value="send" >
<a class="option optaddbtn" href="http://theninthbit.us/sgo/usr/add">add</a>
</form></div>