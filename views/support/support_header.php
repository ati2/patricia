<html>
<head>
	<title>SGO</title>
	<link rel="apple-touch-icon-precomposed" href="http://theninthbit.us/sgo/src/ios.png" />  
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<script src="http://theninthbit.us/sgo/src/usrFunctions.js"></script>
	<link href="http://theninthbit.us/sgo/src/sgo.css" rel="stylesheet" type="text/css"> 
	<script type="text/javascript" src="http://theninthbit.us/sgo/src/jquery.js"></script>
	<script type="text/javascript">
		var current='';
		var current2='';
		function slide(object){
			if(current==''){current=object;$(object).slideDown(200);}
			if(current==object){return;}
			$(current).slideUp(200,function(){$(current).hide();$(object).slideDown(200);});
			current=object;
		}
		function sfade(object2){
			if(current2==''){current2=object2;$(object2).slideDown(200);}
			if(current2==object2){return;}
			$(current2).slideUp(200,function(){$(current2).hide();$(object2).slideDown(200);});
			current2=object2;
		}
		function recolor(object3){
			$('.stepLink1').css("background","#FFF");
			$(object3).css("background","#8FD8D8");
		}
	</script>

</head>