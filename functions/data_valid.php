<?php 
	/*检查表单是否填写完整*/
	function filled_out($form_vars){
		foreach ($form_vars as $key => $value) {
			if ((!isset($key)) || (!isset($value))) {
				return false;
			}
		}
		return true;
	}

	/*检查邮箱地址是否有效*/
	function valid_email($address){
		if (preg_match('/[a-zA-Z0-9_\-\.]@[a-zA-Z0-9\-]\.[a-zA-Z0-9\-\.]/', $address)) {
			return true;
			echo "匹配";
		}else{
			return false;
		}

	}
 ?>