<?php 
	require_once('functions.inc.php');

	$username = addslashes($_POST['username']);
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
	$password2 = addslashes($_POST['password2']);

	session_start();

	try{
		// 表单是否填写完整
		if (!filled_out($_POST)) {
			throw new Exception("表单填写不完整！请返回重新填写~", 1);
		}
		// 检查邮箱地址
		if (valid_email($email)) {
			throw new Exception("邮箱地址不合法，请返回重新填写~", 1);			
		}
		// 检查密码和密码确认是否相同
		if ($password != $password2) {
			throw new Exception("两次所填密码前后不一致，请返回重新填写~", 1);
		}
		// 检查密码长度
		if ((strlen($password) < 6) || (strlen($password) > 16)) {
			throw new Exception("密码长度在6-16位之间，请返回重新填写~", 1);	
		}

		// 尝试注册，如有错误会抛出
		register($username,$password,$email);
		// 创建会话变量
		$_SESSION['username'] = $username;
		// 提示注册成功，并提供个人页面的链接
		output_html_header('恭喜你，注册成功！');
		echo "你已经成功注册，可以到你的个人页面建立属于你自己的书签了！";
		output_html_url('member.php','去往个人页面！');

		output_html_footer();
	}catch(Exception $e){
		output_html_header('错误：');
		echo $e->getMessage();
		output_html_footer();
		exit();
	}

 ?>
