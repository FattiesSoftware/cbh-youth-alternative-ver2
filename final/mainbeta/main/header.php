<?php
	require('connect.php');
	if(@$_SESSION['username']){
		
?>

	<!--<br/><br/><center><ul><a href ="index.php">Trang chủ</a>| <a href ="loaphatthanh.php">Loa phát thanh</a> | <a href ="ghiam.php">Ghi âm</a>  |<a href ="account.php">Tài khoản</a> | <a href ="members.php">Thành viên</a> | <a href ="baocao.php">Báo cáo</a> | <a href ="rank.php">Rank</a> | 
	<a href ="index.php?action=logout">Đăng xuất</a><br/></ul>-->
	<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Đoàn Trường</title>
	<!-- Import Boostrap css, js, font awesome here -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="./style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-branch" href="gioithieu.php">
			<img src="./images/logo.png" height="60">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" 
			data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active" href="index.php">Trang chủ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="loaphatthanh.php">Loa phát thanh</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="rank.php">Rank</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="account.php">Tài khoản</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="baocao.php">Báo cáo</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gioithieu.php">Giới thiệu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Liên hệ</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
</body>
<?php
	}else
	{
		header("Location: Login.php");
	}		
?>