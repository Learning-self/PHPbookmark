<?php
	require_once('functions.inc.php');

	session_start();

	output_html_header('正在修改密码');

	$old_psw = $_POST['old_psw'];
	$new_psw = $_POST['new_psw'];
	$conf_psw = $_POST['confirm_psw'];

	try{
		check_valid_user();
		if (!filled_out($_POST)) {
			throw new Exception("表单未填写完整~", 1);
		}
		if ($new_psw != $conf_psw) {
			throw new Exception("两次输入的密码不一致~", 1);
		}
		if ((strlen($new_psw) >16) || (strlen($new_psw) < 6)) {
			throw new Exception("密码长度需要在6-16位之间~", 1);
		}

		change_psw($_SESSION['username'],$old_psw,$new_psw);
		echo '密码已经修改';
	}catch(Exception $e){
		echo $e->getMessage();
	}

	display_user_menu();

	output_html_footer();

?>