<?php 
	/*连接到MySQL数据库*/
	function db_connect(){
		$result = new mysqli('localhost','root','','bookmarks');
		if (!$result) {
			throw new Exception("连接数据库失败，请重试~", 1);
		}else{
			return $result;
		}
	}
 ?>