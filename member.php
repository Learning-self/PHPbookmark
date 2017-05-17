<?php
	// 包含函数文件
	require_once('functions.inc.php');
	// 开启会话
	session_start();

	/*个人页面*/
	// 先判断是否通过登录页面进行登录
	if (isset($_POST['username'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		try{
			login($username,$password);
			$_SESSION['username'] = $username;
		}catch(Exception $e){
			// 登录验证失败
			output_html_header('登录失败：');
			echo '登录失败，请稍后再进行登录~';
			output_html_url('login.php','再次登录');
			output_html_footer();
			exit();
		}
	}
	// 个人页面展示
	output_html_header('Home');
	// 判断是否已经登录
	check_valid_user();
	if ($url_array = get_user_urls($_SESSION['username'])) {
		display_user_urls($url_array);
	}else{
		echo '<em>还没有添加任何书签！</em>';
	}

	// 输出菜单栏
	display_user_menu();

	output_html_footer();

?>