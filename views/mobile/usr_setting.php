<?php $this->load->view('usr_header'); ?>

<body onload="checkWeekdays()">
<div id="contentWrapper">
<?php $this->load->view('usr_menu'); ?>
<div id="subContentWrapper">

<?php $this->load->view('usr_content_settings'); ?>

</div>
</div>
<?php $this->load->view('usr_footer'); ?>