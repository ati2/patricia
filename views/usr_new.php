<?php $this->load->view('usr_header'); ?>

<body>
<div id="contentWrapper">
<?php $this->load->view('usr_menu'); ?>
<div id="subContentWrapper">


<form action='http://theninthbit.us/sgo/usr/submitNewUsr' method='POST'><br>
	<input type="text" name="fname"> fname<br>
	<input type="text" name="lname"> lname<br>
	<input type="submit">
</form>

</div>
</div>

<?php $this->load->view('usr_footer'); ?>