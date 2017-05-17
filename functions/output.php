<?php 
	/*输出header*/
	function output_html_header($title){
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title><?php echo $title; ?></title>
		<style type="text/css">
			body{
				font-family: Arial,Helvetica,sans-serif;
				font-size: 13px;
				width: 600px;
				margin: 10px auto;
			}
			li,td{
				font-family: Arial,Helvetica,sans-serif;
				font-size: 13px;
			}
			hr#header{
				color: #ccc;
				width: 520px;
			}
			hr#footer{
				color: #ccc;
				width: 600px;
			}
			a{
				color: #000;
			}
			div.content{
				width: 300px;
				margin: 10px auto;
			}
			table{
				background: #eee;
			}
			table tr td{
				width: 120px;
				line-height: 20px;
			}
			div.footer{
				text-align: center;
			}
		</style>
	</head>
	<body>
		<img src="bookmark.gif" alt="PHPbookmark logo" border="0" align="left" valign="bottom" height="55" width="57" >
		<h1><?php echo $title; ?></h1>
		<hr id="header" />
	
<?php
	}

	/*display_site_info()*/
	function display_site_info(){		
?>	
		<ul>
			<li>在线存储你的书签信息！</li>
			<li>看一看其他人都在做些什么？</li>
			<li>与其他人分享你的最爱！</li>
		</ul>		

<?php
	}

	/*display_login_form()*/
	function display_login_form(){
?>
		<div class="content">
			<h3><a href="register_form.php">立即注册</a></h3>
			<form method="post" action="member.php">
				<table>
					<tr>
						<td colspan="2">请填写您的登录信息</td>
					</tr>
					<tr>
						<td>用户名:</td>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td>密码:</td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="登录"></td>
					</tr>
				</table>
			</form>
			<h3><a href="forget_form.php">忘记密码？</a></h3>
		</div>
<?php
	}
	/*do_html_footer()*/
	function output_html_footer(){
?>
		<hr / id="footer">
		<div class="footer">
			<h4>CopyRight&copy;Gary</h4>
			<h4>版权所有 侵权必究</h4>
			<h4>413169349@qq.com---2017/05/04</h4>
		</div>

		</body>
		</html>
<?php
	}
	/*输出注册表单*/
	function display_register_form(){
?>
		<div class="content">
			<form action="register_new.php" method="post">
				<table>
					<tr>
						<td colspan="2">请填写您的注册信息</td>
					</tr>
					<tr>
						<td>用户名:</td>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td>密码:</td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td>确认密码:</td>
						<td><input type="password" name="password2"></td>
					</tr>
					<tr>
						<td>邮箱:</td>
						<td><input type="text" name="email"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="注册"></td>
					</tr>
				</table>
	
		</form>
		</div>
<?php
	}
	/*输出跳转页面链接*/
	function output_html_url($url,$mes){
?>
		<a href="<?php echo $url; ?>"><?php echo $mes; ?></a>
<?php
	}
	/*以表格的形式将用户书签输出在浏览器中*/
	function display_user_urls($arr){
?>		<form method="post" action="delete_bms.php" id="submitform">
		<table>
			<tr><th>书签</th><th>删除？</th></tr>
			<?php
				foreach ($arr as $key => $value) {
			?>
					<tr><td><a href="<?php echo $value; ?>"><?php echo htmlspecialchars($value); ?></a></td><td style="text-align:center;"><input type="checkbox" name="del_bm[]" value="<?php echo $value ?>"></td></tr>
			<?php
				}
			?>
		</table>
		<input type="submit" value="删除书签"  style="display:none;" />
		</form>
<?php
	}
	/*输出用户菜单栏*/
	function display_user_menu(){
?>
		<ul id="menu">
			<li><a href="member.php">主页</a></li>
			<li><a href="add_bm_form.php">添加书签</a></li>
			<li><a href="javascript:document.getElementById('submitform').submit();">删除书签</a></li>
			<li><a href="change_psw_form.php">修改密码</a></li>
			<li><a href="member.php">书签推荐</a></li>
			<li><a href="logout.php">退出登录</a></li>
		</ul>
<?php
	}
	/*添加书签表单*/
	function display_add_bm_form(){
?>
		<form method="post" action="add_bms.php">
			新增书签：<input type="text" placeholder="http://" name="new_url">
			<input type="submit" value="添加书签">
		</form>

<?php
	}
	/*修改密码表单*/
	function display_change_psw_form(){
?>
		<form method="post" action="change_psw.php">
			<table>
				<tr><td>旧密码：</td><td><input type="password" name="old_psw"></td></tr>
				<tr><td>新密码：</td><td><input type="password" name="new_psw"></td></tr>
				<tr><td>确认密码：</td><td><input type="password" name="confirm_psw"></td></tr>
				<tr><td colspan="2"><input type="submit" value="修改密码"></td></tr>
			</table>
		</form>
<?php
	}
	/*忘记密码表单*/
	function display_forget_psw_form(){
?>
		<form method="post" action="forget_psw.php">
			<table>
				<tr><td>用户名：</td><td><input type="text" name="username"></td></tr>
				<tr><td colspan="2"><input type="submit" value="重置密码"></td></tr>
			</table>
		</form>

<?php
	}
?>
