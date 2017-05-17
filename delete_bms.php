<?php
	require_once('functions.inc.php');

	session_start();

	$del_bm = $_POST['del_bm'];

	$username = $_SESSION['username'];

	output_html_header('正在删除标签...');
	check_valid_user();

	if (!filled_out($_POST)) {
		echo '你没有选择需要删除的书签~';
		display_user_menu();
		output_html_footer();
		exit();
	}else{
		if (count($del_bm) > 0) {
			foreach ($del_bm as $key => $value) {
				if (delete_bm($username,$value) {
					echo '删除：'.htmlspecialchars($value).'<br />';
				}else{
					echo '无法删除该书签：'.htmlspecialchars($value).'<br />';
				}
			}
		}else{
			echo '没有书签需要删除~';
		}
	}

	if ($url_array = get_user_urls($username)) {
		display_user_urls($url_array);
	}

	display_user_menu();
	output_html_footer();

?>