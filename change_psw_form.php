<?php
	require_once('functions.inc.php');

	session_start();
	
	output_html_header('修改密码');

	check_valid_user();

	display_change_psw_form();

	display_user_menu();

	output_html_footer();

?>