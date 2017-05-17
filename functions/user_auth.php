<?php 
	/*注册函数，将信息提交到数据库*/
	function register($username,$password,$email){
		// 连接数据库
		$conn = db_connect();
		// 检查用户名是否唯一
		$result = $conn->query("SELECT * FROM user WHERE username = '".$username."'");
		if (!$result) {
			throw new Exception("执行query语句失败", 1);
		}
		if ($result->num_rows > 0) {
			throw new Exception("用户名已存在，请返回重新填写~", 1);
		}

		// 写入数据库
		$result = $conn->query("INSERT INTO user (username,password,email) VALUES('".$username."',sha1('".$password."'),'".$email."')");

		if (!$result) {
			throw new Exception("无法注册。请稍后重试~".$conn->error, 1);
		}
	}

	/*登录函数*/
	function login($username,$password){
		// 将用户名和密码与数据库进行验证
		$conn = db_connect();
		$result = $conn->query("SELECT * FROM user WHERE username = '".$username."' AND password = sha1('".$password."')");
		if (!$result) {
			throw new Exception("无法登录你的账户！", 1);
		}
		if ($result->num_rows > 0) {
			return true;
		}else{
			throw new Exception("无法登录你的账户！", 1);
		}
	}

	/*检查该用户是否已经登录*/
	function check_valid_user(){
		if (isset($_SESSION['username'])) {
			echo "欢迎你, [ ".$_SESSION['username']." ] !<br />";
		}else{
			// 用户未登录
			output_html_header('未登录：');
			echo '你还没有登录，请登录后再进行操作~';
			output_html_url('login.php','去登录');
			output_html_footer();
			exit();
		}

	}

	/*修改用户密码*/
	function change_psw($username,$old_psw,$new_psw){
		// 这里使用尝试登录来验证旧密码是否正确！
		login($username,$old_psw);

		$conn = db_connect();

		$result = query("UPDATE user SET password = shal('".$new_psw."') WHERE username = '".$username."'");

		if (!$result) {
			throw new Exception("密码无法修改~", 1);
		}else{
			return true;
		}
	}

	/*重置密码*/
	function reset_psw($username){
		$new_psw = get_random_word(6,13);

		if ($new_psw == false) {
			throw new Exception("无法重置密码~", 1);
		}

		$rand_num = rand(0,999);
		$new_psw .= $rand_num;

		$conn = db_connect();

		$result = $conn->query("UPDATE user SET password = shal('".$new_psw."') WHERE username = '".$username."'");

		if (!$result) {
			throw new Exception("无法重置密码~", 1);
		}else{
			return $new_psw;
		}
	}

	/*该函数通过从字典中获取随机单词来生成一个随机密码*/
	function get_random_word($min_length,$max_length){
		// 随机单词
		$word = '';
		// 词典
		$dictionary = '../wordlist.txt';
		// 读取词典
		$fp = fopen($dictionary, 'r');
		if(!$fp){
			return false;
		}
		$size = filesize($dictionary);
		// 选取一个随机截取位置
		$rand_location = rand(0,$size);
		fseek($fp, $rand_location);

		while((strlen($word) < $min_length) || (strlen($word) > $max_length) || (strstr($word, "'"))){
			// 如果到文件结尾，则返回到文件开头
			if (feof($fp)) {
				fseek($fp, 0);
			}
			// 跳过开始的随机行，避免获取一个单词的一部分
			$word = fgets($fp,80);
			$word = fgets($fp,80);
		}

		$word = trim($word);
		return $word;
	}

	/*将新密码以电子邮件的方式发送至用户*/
	function notify_psw($username,$password){
		$conn = db_connect();

		$result = $conn->query("SELECT email FROM user WHERE username = '".$username."'");

		if (!$result) {
			throw new Exception("无法找到用户邮箱~", 1);
		}else if($result->num_rows == 0){
			throw new Exception("无法找到用户邮箱~", 1);
		}else{
			$row = $result->fetch_object();
			$email = $row->email;
			$from = "From:413169349@qq.com\r\n";
			$mes = "你的密码已经重置为：".$password."\r\n"."请下次登陆后自行修改~";
		
			if (mail($email, "PHPBookmark login information", $mes,$from)) {
				return true;
			}else{
				throw new Exception("无法发送邮件~", 1);
			}
		}
	}
 ?>