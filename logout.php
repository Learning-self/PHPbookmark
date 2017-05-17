<?php
	require_once('functions.inc.php');

	session_start();

	// 存储是为了检测之前是否已经登录 
	$old_user = $_SESSION['username'];

	unset($_SESSION['username']); //释放变量
	$result_dest = session_destroy(); //关闭会话

	output_html_header('退出登录');

	if (!empty($old_user)) { //已登录
		if ($result_dest) {
			echo '退出登录';
			output_html_url('login.php','登录');
		}else{
			echo '无法退出登录';
		}
	}else{ //未登录
		echo '未登录，无法退出！';
		output_html_url('login.php','登录');
	}	

	output_html_footer();
?>