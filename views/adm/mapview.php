<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(21.306248,-157.858257),
        zoom: 12,
        mapTypeId: 'roadmap',
        disableDefaultUI: true
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on input
<?php
	$mapDataUrl='http://theninthbit.us/sgo/adm/plottest/'.$ageInput.'/'.$genderInput.'/'.$dayInput;
?>
      downloadUrl("<?php echo $mapDataUrl; ?>", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
	<title>SGO</title>
	<link rel="apple-touch-icon-precomposed" href="http://theninthbit.us/sgo/src/ios.png" />  
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<script src="http://theninthbit.us/sgo/src/usrFunctions.js"></script>
	<link href="http://theninthbit.us/sgo/src/sgo.css" rel="stylesheet" type="text/css"> 
  </head>

<body onload="load()">
<div id="contentWrapper">
	<div id="backgroundMenu" class="menu" style="z-index:2">
		<div id="content">
		</div>
		
	</div>
	
	<div id="sideBar" style="z-index:3";>
		<div id="headerMenu" class="menu"><a href="http://theninthbit.us/sgo/adm" style="vertical-align:text-bottom;padding:5px;color:#FFF;font-size:2em;">SG Ohana</a>
		</div>
		<div id="listing" style="font-size:.8em;padding:10px;"><br>
			<form action="http://theninthbit.us/sgo/adm/plot/" method="POST" >
			<select name="dayInput" style="width:100%;padding:3px;background:#FFF;border:thin solid #AAA;">
				<option value="1">Day</option>
				<?php
					foreach($days as $day){
						$selected=($day==$dayInput)?"selected":"";
						echo "<option value=".$day." ".$selected.">".$day."</option>";
					}
				?>
			</select><br>
			<select name="ageInput" style="width:75%;padding:3px;background:#FFF;border:thin solid #AAA;">
				<option value="1">Age</option>
				<?php
					foreach($ages as $age){
						$selected=(str_replace(' ','_',$age)==$ageInput)?"selected":"";
						echo "<option value=".str_replace(' ','_',$age)." ".$selected.">".ucwords(strtolower($age))."</option>";
					}
				?>
			</select>
			<select name="genderInput" style="width:20%;padding:3px;position:absolute;right:10px;background:#FFF;border:thin solid #AAA;">
				<option value="1">Type</option>
				<?php
					foreach($genders as $gender){
						$selected=($gender==$genderInput)?"selected":"";
						echo "<option value=".$gender." ".$selected.">".ucwords(strtolower($gender))."</option>";
					}
				?>
			</select><br>
			<input type="submit" style="background:#FFF;border:thin solid #AAA;">
			</form>
		</div>
	</div>
		<div id="map" style="width:100%; height:100%;z-index:1"></div>
</div>


<?php $this->load->view('adm/adm_footer'); ?>