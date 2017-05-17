<?php
	require_once('functions.inc.php');

	output_html_header('正在重置密码...');

	$username = $_POST['username'];

	try{
		$password = reset_psw($username);

		notify_psw($username,$password);

		echo '你的新密码已经发送至你的邮箱~';
	}catch(Exception $e){
		echo $e->getMessage();
	}

	output_html_url('login.php','登录');

	output_html_footer();

?>