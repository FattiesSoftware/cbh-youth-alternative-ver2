<?php
$user = new User();

if (!isset($_SESSION['loggedin'])) {
$isloggedin = 'no';
	$OUT = 'none';
	$NOTICE = 'block';
		$WELCOME = 'Bạn chưa đăng nhập! Hãy đăng nhập để tham gia thảo luận.';
	$PROP = 'none';
	$OUT = 'none';
	$width = '131px';
	$usen = 'guest';
	//$width = '490px';
		if(isset($accessToken)){
			$isloggedin = 'yes';
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	$NOTICE = 'none';
	$width = '131px';
	$WELCOME = '';
	$usen = $userData['username'];
}
} else {
	$isloggedin = 'yes';
	$NOTICE = 'none';
		$WELCOME = '';
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	$width = '131px';
	$usen = $_SESSION['username'];
}
?>