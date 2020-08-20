<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Include GitHub API config file
require_once 'gitConfig.php';
$lienhe = 'active';
// Include and initialize user class
require_once 'User.class.php';
$user = new User();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
$none = 'block';
$logi = 'none';
$usern = 'none';
$OUT1 = 'none';
} else {
  $none = 'none';
  $logi = $_SESSION['loggedin'];
  $usern = $_SESSION['username'];
  $OUT1 = 'none';
}
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
$stmt = $con->prepare('SELECT name, password, email, date FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($name, $password, $email, $date);
$stmt->fetch();
$stmt->close();


if (!isset($_SESSION['loggedin'])) {
  $PROP = 'none';
  $OUT = 'none';
  
} else {
  $PROP = 'block';
  $IN = 'none';
  $OUT = 'block'; 
}
if(isset($accessToken)){
  $PROP = 'block';
  $IN = 'none';
  $OUT = 'block';
}

$id = $_SESSION['id'];
// read data from collumn profile_pic from accounts table only at id=11
$sql = "SELECT profile_pic FROM accounts WHERE id='$id'";
$result = $con->query($sql);
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $prof_pic = $row["profile_pic"];
    }

?>
  <!-- Trang web được lập trình bởi Dương Tùng Anh - C4K60 Chuyên Hà Nam -->
<!-- Mọi thông tin chi tiết xin liên hệ https://facebook.com/tunnaduong/ -->
	<!DOCTYPE html>
<html dir='ltr' xmlns='http://www.w3.org/1999/xhtml' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr'>
<head>
<?php
require "include/header.php";
require "include/style.php";
?>
</head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">
   <?php
require "include/navbar.php";
?>



<div class="container" style="margin-right: 15px;margin-left: 15px;">
        <h1><b>Liên hệ</b></h1>
<p><big><b>ĐOÀN TRƯỜNG</b></big><br />
<button type="button" style="     padding-top: 6px;     margin-top: 10px; " class="btn btn-info" onclick="location.href='https://www.facebook.com/Đoàn-Trường-THPT-Chuyên-Biên-Hòa-1318791134932333/';">
   <i class="fab fa-facebook-square"></i>
Facebook</button>
<button type="button" style="     padding-top: 6px;     margin-top: 10px; " class="btn btn-info" onclick="location.href='mailto:hoaiduong281983@gmail.com';">
   <i class="fas fa-envelope"></i>
Email</button><br />
</p>
<div class="col-md-4">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image" style="float:left">
                  <img class="img-circle elevation-2" src="tunganh.jpg" style="
    width: 60px;
    padding-top: 0px;
    margin-top: 17px;
    margin-left: 15px;
"  style="
    width: 60px;
" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
				<div style="float:right">
                <h3 class="widget-user-username"  style="margin-bottom: 0px">Dương Tùng Anh</h3>
                <h5 class="widget-user-desc"  >Lead Developer</h5>
				</div>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="
    margin-bottom: 4px;
    margin-top: 103px;
">
                    </a>
                  </li>
				  <li><button type="button" class="btn btn-info" onclick="location.href='https://www.facebook.com/tunnaduong/';">
   <i class="fab fa-facebook-square"></i>
</button>
<button type="button" class="btn btn-info" onclick="location.href='mailto:tunnaduong@gmail.com';">
   <i class="fas fa-envelope"></i>
</button></li>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>


<div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <div class="widget-user-image" style="float:left">
                  <img class="img-circle elevation-2" src="hoangphat.jpg" style="
    width: 60px;
    padding-top: 0px;
    margin-top: 17px;
    margin-left: 15px;
"  style="
    width: 60px;
" alt="User Avatar">
                </div>
				<div style="float:right">
                              <h3 class="widget-user-username"  style="margin-bottom: 0px">Hoàng Phát</h3>
                <h5 class="widget-user-desc" >CEO, Founder</h5>
				</div>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="
    margin-bottom: 4px;
    margin-top: 103px;
">
                    </a>
                  </li>
		  
		  

<p><button type="button" class="btn btn-info" onclick="location.href='https://www.facebook.com/hoang.phat.handsome';">
   <i class="fab fa-facebook-square"></i>
</button>
<button type="button" class="btn btn-info" onclick="location.href='mailto:hoangphata1k60@gmail.com';">
   <i class="fas fa-envelope"></i>
</button></p>

</div>
      <?php
require "include/footer.php";
?>
      <!-- Bootstrap nhân JavaScript
    ================================================== -->
    <!-- Đặt ở cuối mã trang web để trang tải nhanh hơn -->
    <!-- IE10 viewport hack cho Surface/bug máy tính bàn Windows 8 -->
    <script src="https://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="//code.tidio.co/xk9nqvz3a3dzutblmspl6ct5spdbueji.js"> </script>
  </body>
</html>
