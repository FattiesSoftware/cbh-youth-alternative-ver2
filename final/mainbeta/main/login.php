<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
</head>
<body>
	<div class="header">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="login.php">

		<div class="input-group">
			<label>Tài khoản</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Mật khẩu</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" name="submit" value="Register" >Login</button>
		</div>
		<p>
			Nếu bạn chưa có tài khoản, hãy <a href="register.php">đăng kí</a>
		</p>
	</form>
</body>
</html>
<?php 
	session_start();
		require('connect.php');
		if(isset($_POST['submit']))
		{
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$password = mysqli_real_escape_string($db, $_POST['password']);
			$pass=sha1("$password");
			if($username&&$password)
			{
				$query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
				$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) !=0) {
					echo" Đăng nhập thành công ";
					$_SESSION['username'] = $username;
					header('location: index.php');
				}else{
					echo "Tài khoản/Mật khẩu không chính xác";
				}
			}else{
				echo " Đề nghị bạn điền đầy đủ thông tin";
			}
		}

?>