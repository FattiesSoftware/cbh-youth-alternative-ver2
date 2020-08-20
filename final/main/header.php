<?php
	require('connect.php');
	if(@$_SESSION['username']){
		
?>

	<br/><br/><center><ul><a href ="index.php">Trang chủ</a>| <a href ="loaphatthanh.php">Loa phát thanh</a> | <a href ="ghiam.php">Ghi âm</a>  |<a href ="account.php">Tài khoản</a> | <a href ="members.php">Thành viên</a> | <a href ="baocao.php">Báo cáo</a> | <a href ="rank.php">Rank</a> | 
	<a href ="index.php?action=logout">Đăng xuất</a><br/></ul>

<?php
	}else
	{
		header("Location: Login.php");
	}		
?>