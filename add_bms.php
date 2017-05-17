<?php
	require_once('functions.inc.php');

	session_start();

	$new_url = $_POST['new_url'];

	output_html_header('正在添加书签...');

	try{
		check_valid_user();
		if (!filled_out($_POST)) {
			throw new Exception("表单填写不完整，请返回重新填写~", 1);
		}
		// 检查URL
		if (strstr($new_url, 'http://') == false) {
			$new_url = 'http://'.$new_url;
		}
		if (!(@fopen($new_url, 'r'))) {
			throw new Exception("无效的URL", 1);
		}
		// 尝试添加书签
		add_bm($new_url);
		echo "书签已添加~";
		// 获取该用户所有书签
		if ($url_array = get_user_urls($_SESSION['username'])) {
			display_user_urls($url_array);
		}
	}catch(Exception $e){
		echo $e->getMessage();
	}

	display_user_menu();

	output_html_footer();

?>