<?php 
	/*获取用户书签的函数*/
	function get_user_urls($username){
		$conn = db_connect();

		$result = $conn->query("SELECT bm_url FROM bookmark WHERE username = '".$username."'");

		if (!$result) {
			throw new Exception("无法检索该用户书签！", 1);
		}
		if ($result->num_rows > 0) {
			$url_array = array();
			for ($count=0; $row = $result->fetch_row(); $count++) { 
				$url_array[$count] = $row[0];
			}
			return $url_array;
		}else{
			return false;
		}
	}

	/*添加书签到数据库*/
	function add_bm($url){
		$conn = db_connect();

		$result = $conn->query("INSERT INTO bookmark VALUES('".$_SESSION['username']."','".$url."')");

		if (!$result) {
			throw new Exception("添加书签执行失败~", 1);
		}
	}
 ?>