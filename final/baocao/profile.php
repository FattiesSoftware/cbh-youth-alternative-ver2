<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
header('Location: /profile.php'); // chuyển đến profile
//$DATABASE_HOST = 'sql303.unaux.com';
//$DATABASE_USER = 'unaux_24697656';
//$DATABASE_PASS = 'tunganh2003';
//$DATABASE_NAME = 'unaux_24697656_doantruong';

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'members';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT name, password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($name, $password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Trang cá nhân</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><a href="home.php">Đoàn trường THPT Chuyên Biên Hoà</a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Trang cá nhân</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
			</div>
		</nav>
		<div class="content">
			<h2>Trang cá nhân</h2>
			<div>
				<p>Dưới đây là một số thông tin của bạn:</p>
				<table>
					<tr>
						<td>Họ và tên:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Tên đăng nhập:</td>
						<td><?=$_SESSION['username']?></td>
					</tr>
					<tr>
						<td>Mật khẩu:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>