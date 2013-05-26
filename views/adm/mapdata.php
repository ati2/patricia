<?php
	header("Content-type: text/xml"); 
	$dom = new DOMDocument("1.0");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node); 
	$days=array("Sundays","Mondays","Tuesdays","Wednesdays","Thursdays","Fridays","Saturdays");

	foreach($groupData as $group){
	//if lat/long has been set
	if($group['lat']!=0){  
		$grpData = ($group['location']!="")?$group['location']:"zzqq0";
		$grpData .= ($group['date']!="")?"<br>".$days[$group['date']]:"";
		$grpData .= ($group['time']!="")?" ".$group['time']:"";
		$grpData .= ($group['gender']!="")?"<br>".$group['gender']." ".$group['age']:"";
		$grpData = str_replace("zzqq0<br>","",$grpData);
		$grpData = str_replace("zzqq0","",$grpData);


		$node = $dom->createElement("marker");  
		$newnode = $parnode->appendChild($node);   
		$newnode->setAttribute("name",$group['leader']."'s Group");

		$newnode->setAttribute("address", $grpData);  

		$newnode->setAttribute("lat", $group['lat']);  
		$newnode->setAttribute("lng", $group['long']);  
	}
	}

	echo $dom->saveXML();


?>