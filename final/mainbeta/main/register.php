<?php 
	require('connect.php');
	if(isset($_POST['gender'])){
		$xungkich=$_POST['gender'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php //include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		
		<label for="">Bạn là xung kích ?</label></br>
		<input type="radio" name="gender" value="1" id="1">
		<label for="1">Có</label>
		<input type="radio" name="gender" value="0" checked="checked" id="0">
		<label for="0">Không</label>
		
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="repassword">
		</div>
		<div class="input-group">
			<button type="submit" name="submit" value="Register" >Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Login</a>
		</p>
	</form>
</body>
</html>

<?php
	if(isset($_POST['submit']))
	{
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$repassword = mysqli_real_escape_string($db, $_POST['repassword']);
	$date= date("y-m-d");
	$pass=sha1("$password");
	}
	if(isset($_POST['submit'])){
		if($username&&$password&&$repassword&&$email)
		{
			if(strlen($username)>=5&& strlen($username)<25 && strlen($password)>=6)
			{
				if($repassword==$password)
				{
					$query = "INSERT INTO users (username, email, password, date, xungkich,profile_pic) 
								VALUES('$username', '$email', '$pass', '$date', '$xungkich','images/default_pic.jpg')";
					mysqli_query($db, $query);
					echo "Đăng kí thành công. Nhấn vào <a href='login.php'> đây </a> để đăng nhập";
				}else{
					echo " Mật khẩu nhập lại sai";
				}
			}else{
				if(strlen($username)<5 || strlen($username)>25)
				{
					echo "Tên tài khoản cần dài hơn 5 và ngắn hơn 25 kí tự";
				}
				if(strlen($password)<6)
				{
					echo "Mật khảu cần dàu hơn 6 kí tự";
				}
			}
		}else{
			echo" Bạn điền thiếu ";
		}
	}
?>