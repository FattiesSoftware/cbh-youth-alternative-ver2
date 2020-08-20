<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Include GitHub API config file
require_once 'gitConfig.php';

// Include and initialize user class
require_once 'user.class.php';
$user = new User();
// If the user is not logged in redirect to the login page...

if(isset($accessToken)){
	   // Get the user profile info from Github
    $gitUser = $gitClient->apiRequest($accessToken);

    if(!empty($gitUser)){
        // User profile data
        $gitUserData = array();
        $gitUserData['oauth_provider'] = 'github';
        $gitUserData['oauth_uid'] = !empty($gitUser->id)?$gitUser->id:'';
        $gitUserData['name'] = !empty($gitUser->name)?$gitUser->name:'';
        $gitUserData['username'] = !empty($gitUser->login)?$gitUser->login:'';
        $gitUserData['email'] = !empty($gitUser->email)?$gitUser->email:'';
        $gitUserData['location'] = !empty($gitUser->location)?$gitUser->location:'';
        $gitUserData['picture'] = !empty($gitUser->avatar_url)?$gitUser->avatar_url:'';
        $gitUserData['link'] = !empty($gitUser->html_url)?$gitUser->html_url:'';
        
        // Insert or update user data to the database
        $userData = $user->checkUser($gitUserData);
        
        // Put user data into the session
        $_SESSION['userData'] = $userData;
$OUT1 = 'none';

    }else{
		    $OUT1 = 'block';
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
    
	$none = 'none';
$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	}elseif(isset($_GET['code'])){
    // Verify the state matches the stored state
    if(!$_GET['state'] || $_SESSION['state'] != $_GET['state']) {
        header("Location: ".$_SERVER['PHP_SELF']);
    }
    
    // Exchange the auth code for a token
    $accessToken = $gitClient->getAccessToken($_GET['state'], $_GET['code']);
  
    $_SESSION['access_token'] = $accessToken;
  
    header('Location: ./');
}else{
// Generate a random hash and store in the session for security
    $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
    
    // Remove access token from the session
    unset($_SESSION['access_token']);
  
    // Get the URL to authorize
    $loginURL = $gitClient->getAuthorizeURL($_SESSION['state']);
    
    // Render Github login button
    $output2 = '<a type="button" href="'.htmlspecialchars($loginURL).'" class="col-1" style="color: rgb(51, 51, 51);"><i class="fab fa-2x fa-github"></i></a>';
$PROP = 'none';
	$OUT = 'none';
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'members';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$error2 = 1;
if (!isset($_SESSION['loggedin'])) {	
$error = '';

} else {
$error = $_SESSION['id']; // Biến mới tên là Error = id người dùng
	$none = 'none';
$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
}

if ($error2==1) {
	if(isset($accessToken)){
	$error2 = $userData['oauth_uid'];
		$none = 'none';
$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	}
}
if ($error == 11) { // nếu id = 11
		header('Location: admin/index.php'); // chuyển đến trang admin
		
} elseif ($error == 15) { // nếu id = 15
	 // chuyển đến xung kích
	 $nam = $_SESSION['name'];
	 $none = $_SESSION['id'];
} elseif ($error2 == 17230355) {// nếu id = 1
	// chuyển đến xung kích
	$nam = $userData['name'];
} else {
}
	



?>

<!DOCTYPE html>
<html>
<head>
  <?php
require "include/header.php";
require "include/style.php";
$baocao = 'active';
?>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('https://www.w3schools.com/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
</style>
</head>
	<body class="loggedin">
	<style>
	.navtop {
	background-color: #2f3947;
	height: 60px;
	width: 100%;
	border: 0;
}
.navtop div {
	display: flex;
	margin: 0 auto;
	width: 1000px;
	height: 100%;
}
.navtop div h1, .navtop div a {
	display: inline-flex;
	align-items: center;
}
.navtop div h1 {
	flex: 1;
	font-size: 24px;
	padding: 0;
	margin: 0;
	color: #eaebed;
	font-weight: normal;
}
.navtop div a {
	padding: 0 20px;
	text-decoration: none;
	color: #c1c4c8;
	font-weight: bold;
}
.navtop div a i {
	padding: 2px 8px 0 0;
}
.navtop div a:hover {
	color: #eaebed;
}
body.loggedin {
	background-color: #f3f4f7;
}
.content2 {
	width: 1000px;
	margin: 0 auto;
}
.content2 h2 {
	margin: 0;
	padding: 25px 0;
	font-size: 22px;
	border-bottom: 1px solid #e0e0e3;
	color: #4a536e;
}
.content2 > p {
	box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
	margin: 25px 0;
	padding: 25px;
	background-color: #fff;
}

.content2 > p table td, .content2 > div table td {
	padding: 5px;
}
.content2 > p table td:first-child, .content > div table td:first-child {
	font-weight: bold;
	color: #4a536e;
	padding-right: 15px;
}
.content2 > div p {
	padding: 5px;
	margin: 0 0 10px 0;
}
@media only screen and (max-width: 790px) {
.content2 {
	width: auto;
	margin: 0 auto;
    padding-left: 25px;
    padding-right: 25px;

}
.navtop {
	width: 500px;
	margin: 0 auto;


}
}


	</style>
  <?php
require "include/navbar.php";
?>
<div style="margin-left: 50px">		
  <h2>Đã có lỗi xảy ra!</h2>
    <p>Bạn không có quyền truy cập vào trang này</p>
    <button type="button" class="btn btn-info" onclick="window.history.back()"><i class="fas fa-arrow-circle-left"></i> Quay lại</button>
    <button type="button" class="btn btn-danger" onclick="location.href='/lienhe'"><i class="fas fa-headset"></i> Liên hệ trợ giúp</button>
    </div>

	</body>
</html>