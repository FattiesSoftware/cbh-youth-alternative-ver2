<!-- Project name: CBH Youth Online (Đoàn trường THPT Chuyên Biên Hoà Online)
     Project link: https://youth.fattiesoftware.com/
     Created by Fatties Software 2020
     Team members:
     - Duong Tung Anh (CEO/Founder - C4K60 Bien Hoa Gifted High School) | https://fb.me/tunnaduong
     - Hoang Phat (Co-Founder/Lead Developer - A1K60 Bien Hoa Gifted High School) | https://fb.me/hoangphathandsome
     All rights reserved 
-->
<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Include GitHub API config file
require_once 'require/githubConfig.php';

// Include and initialize user class
require_once 'require/github.user.class.php';
$user = new User();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	
	$PROP = 'none';
	$OUT = 'none';
} else {
	header('Location: /baocao/');
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';

}
if(isset($accessToken)){
	header('Location: /baocao/');
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
?>
<!DOCTYPE html>
<html>
  <!-- Trang web được lập trình bởi Dương Tùng Anh - C4K60 Chuyên Hà Nam -->
<!-- Mọi thông tin chi tiết xin liên hệ https://facebook.com/tunnaduong/ -->
	<!DOCTYPE html>
<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="style.css">
<!--===============================================================================================-->
<!-- Latest compiled JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<link crossorigin='anonymous' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' rel='stylesheet'/>
</head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class='navbar navbar-inverse '>
<div class='container-fluid'>
<div class="navbar-header" style="float: left;">
<a class="navbar-brand" href="/"><img src="/images/cbh.png" style="width: 40px;height: 40px;margin-top: 0px;margin-right: 10px;" alt=""> Đoàn trường CBH | <p class="ta" style="display: inline;">Đăng nhập</p></a>
</div>
<center>
<a href="/"><i class="fas fa-arrow-left"></i> Quay lại trang chủ</a>
<center>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
</button>
</nav>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="padding-top: 60px;">
				<form class="login100-form validate-form" action="authenticate.php" method="POST">
					<span class="login100-form-title p-b-26">
						Login to  <br> continue
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Tên đăng nhập"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass" onclick="myFunction2()">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" id="myInput">
						<span class="focus-input100" data-placeholder="Mật khẩu"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
                            
							<button class="login100-form-btn">
								Đăng nhập
							</button>
						</div>
					</div>
					<div class="text-center p-t-20">
                        hoặc đăng nhập bằng...
                    </div>
<div class="text-center p-t-10"><div class="row" style="text-align: center;margin-left: 0px;margin-right: 30px;"><div class="col-12"><a type="button" href="#" class="col-1" style="color: rgb(221, 75, 57);"><i class="fab fa-2x fa-google-plus"></i></a> <a type="button" href="#" class="col-1" style="color: rgb(59, 89, 152);"><i class="fab fa-2x fa-facebook"></i></a>  <?php echo $output2; ?></div></div></div>
					<script>
					function myFunction2() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
					</script>
				</form>
				<center style="padding-top:20px;"><a href="/register/register.html">Không có tài khoản? Đăng ký tại đây...</a></center>
			</div>
		</div>
	</div>
        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
</div>
      <footer class="footer">
		<hr>
		<div class="main-content" style="
    margin-right: 15px;
    margin-left: 15px;
">
    <div class="column">
        <p>&copy; Đoàn trường Chuyên Biên Hoà</p>
    </div>

    <div class="column">
        <p id="demo"></p>
    </div>

     <div class="column">
        <p> Designed and developed with <i class="fas fa-heart"></i> by <a href="https://facebook.com/tunnaduong/">Fatties Software</a></p>
    </div>
</div>
<style>
.column {    
    display: inline-block;
}
</style>
</div>
<script>
function myFunction() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("demo").innerHTML = n + ".";
}
myFunction()
</script>
      </footer>
<script src="//code.tidio.co/xk9nqvz3a3dzutblmspl6ct5spdbueji.js"> </script>
  </body>
</html>
