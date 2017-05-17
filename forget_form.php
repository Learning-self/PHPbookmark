<?php
	require_once('functions.inc.php');

	session_start();

	output_html_header('忘记密码？');

	display_forget_psw_form();

	output_html_footer();
?>