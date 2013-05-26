
<br><div class="searchResult">
Search for a person.
<form action="add" name="search" method="POST">
	<input type="text" class="textbox" name="inputs">
	<input type="image" style="height:1.5em;padding-top:10px;" src="http://theninthbit.us/sgo/img/search.png">
<br><span>
Search for a name. <br> eg. 'Just', 'Justin', or 'Justin Kong'
</span>

</form>
</div>

<?php
if(!$search){
	if(strlen($term)>0){
		echo '<div class="searchResult">Sorry, I have not seen the person you are looking for.<br><span>Try a less specific search or add the person below.</span></div>';
	}
}else{
	//output [search result] [0]fname [1]lname [2]leader [3]location [4]age [5]gender
	foreach($search as $key2=>$value2){
		echo '<a href="submitAdd/'.$key2.'">';
		echo '<div class="searchResult">'.$value2[0].' '.$value2[1];
		
		//last group went to
		if(strlen($value2[2])>0){
			echo '<br><span> last attended '.$value2[2].'s group';
			if(strlen($value2[3])>0){
				echo ' at '.$value2[3];
			}
			echo '</span>';
		}

		//assumed data
		if(strlen($value2[4])>0&&strlen($value2[5])>0){
			echo '<br><span>';
			echo $value2[5].' '.$value2[4];
			echo '</span>';
		}
		echo'</div></a>';
	}

}



if($error!=""){

	echo '<div style="color:red;" class="option">Try enter a full name with letters </div>';
}
?>

<div class="searchResult">
	Add a new person.<br>
	<?php if($notValidName){ echo "<div>Please include a full first and last name </div><br>"; } ?>
	<form action='http://theninthbit.us/sgo/usr/submitNewUsr' method='POST'><br>
		<input type="text" class="textbox" name="fname"> <br><span>first name</span><br>
		<input type="text" class="textbox" name="lname"> <br><span>last name</span><br>
		<button type="submit" class="newUsrBtn">Create</button>
	</form>
</div>