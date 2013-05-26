<html>
<head>
	<title>SGO</title>
	<link rel="apple-touch-icon-precomposed" href="http://theninthbit.us/sgo/src/ios.png" />  
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<script src="http://theninthbit.us/sgo/src/sizeCheck.js"></script>
	<link href="http://theninthbit.us/sgo/src/login.css" rel="stylesheet" type="text/css"> 
</head>
<body bgcolor="#DDD" onload="document.loginForm.username.focus();getSize()">


<div id="loginMain">
<div id="loginImg"><img width="100%" src="http://theninthbit.us/sgo/img/gracelogo.jpg"></div>
<form action="http://theninthbit.us/sgo/login/submit" method="post" name="loginForm">
  <p><span class="txt">Username: </span><br><input type="text" name="username" value="" />
  <p><span class="txt">Password: </span><br><input type="password" name="password" value="" />

<input type="hidden" name="width" value="400">
<input type="hidden" name="height" value="600">

  <p><input type="submit" class="option" name="submit" value="Login"  />
</form>
</div>

</body>
</html>