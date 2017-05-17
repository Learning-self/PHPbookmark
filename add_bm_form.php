<?php 
	require_once('functions.inc.php');

	session_start();

	output_html_header('添加书签');

	check_valid_user();
	display_add_bm_form();

	display_user_menu();

	output_html_footer();

 ?>