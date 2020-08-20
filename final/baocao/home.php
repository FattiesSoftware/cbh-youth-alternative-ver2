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
	 header('Location: error.php');
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
		<div class="content2">
			<h2>Hệ thống báo cáo dành cho xung kích</h2>
			<p>Chào mừng, <?=$nam?>!<br>
				
			<?php
			
function rebuild_date( $format, $time = 0 )
{
    if ( ! $time ) $time = time();

	$lang = array();
	$lang['sun'] = 'CN';
	$lang['mon'] = 'T2';
	$lang['tue'] = 'T3';
	$lang['wed'] = 'T4';
	$lang['thu'] = 'T5';
	$lang['fri'] = 'T6';
	$lang['sat'] = 'T7';
	$lang['sunday'] = 'Chủ nhật';
	$lang['monday'] = 'Thứ hai';
	$lang['tuesday'] = 'Thứ ba';
	$lang['wednesday'] = 'Thứ tư';
	$lang['thursday'] = 'Thứ năm';
	$lang['friday'] = 'Thứ sáu';
	$lang['saturday'] = 'Thứ bảy';
	$lang['january'] = 'Tháng Một';
	$lang['february'] = 'Tháng Hai';
	$lang['march'] = 'Tháng Ba';
	$lang['april'] = 'Tháng Tư';
	$lang['may'] = 'Tháng Năm';
	$lang['june'] = 'Tháng Sáu';
	$lang['july'] = 'Tháng Bảy';
	$lang['august'] = 'Tháng Tám';
	$lang['september'] = 'Tháng Chín';
	$lang['october'] = 'Tháng Mười';
	$lang['november'] = 'Tháng M. một';
	$lang['december'] = 'Tháng M. hai';
	$lang['jan'] = 'T01';
	$lang['feb'] = 'T02';
	$lang['mar'] = 'T03';
	$lang['apr'] = 'T04';
	$lang['may2'] = 'T05';
	$lang['jun'] = 'T06';
	$lang['jul'] = 'T07';
	$lang['aug'] = 'T08';
	$lang['sep'] = 'T09';
	$lang['oct'] = 'T10';
	$lang['nov'] = 'T11';
	$lang['dec'] = 'T12';

    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
    $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );
    $return = date( $format, $time );

    $replaces = array(
        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
        '/Monday(\W|$)/' => $lang['monday'] . "$1",
        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
        '/Friday(\W|$)/' => $lang['friday'] . "$1",
        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
        '/January(\W|$)/' => $lang['january'] . "$1",
        '/February(\W|$)/' => $lang['february'] . "$1",
        '/March(\W|$)/' => $lang['march'] . "$1",
        '/April(\W|$)/' => $lang['april'] . "$1",
        '/May(\W|$)/' => $lang['may'] . "$1",
        '/June(\W|$)/' => $lang['june'] . "$1",
        '/July(\W|$)/' => $lang['july'] . "$1",
        '/August(\W|$)/' => $lang['august'] . "$1",
        '/September(\W|$)/' => $lang['september'] . "$1",
        '/October(\W|$)/' => $lang['october'] . "$1",
        '/November(\W|$)/' => $lang['november'] . "$1",
        '/December(\W|$)/' => $lang['december'] . "$1" );

    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
$contents = 'Bây giờ là: ' . rebuild_date('H:i l, d/m/Y' ) . '<br />';
 echo $contents;
?>

<style>
/* Center the loader */
.sk-chase {
  width: 40px;
  height: 40px;
  position: relative;
  animation: sk-chase 2.5s infinite linear both;
}

.sk-chase-dot {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0; 
  animation: sk-chase-dot 2.0s infinite ease-in-out both; 
}

.sk-chase-dot:before {
  content: '';
  display: block;
  width: 25%;
  height: 25%;
  background-color: #6495ED;
  border-radius: 100%;
  animation: sk-chase-dot-before 2.0s infinite ease-in-out both; 
}

.sk-chase-dot:nth-child(1) { animation-delay: -1.1s; }
.sk-chase-dot:nth-child(2) { animation-delay: -1.0s; }
.sk-chase-dot:nth-child(3) { animation-delay: -0.9s; }
.sk-chase-dot:nth-child(4) { animation-delay: -0.8s; }
.sk-chase-dot:nth-child(5) { animation-delay: -0.7s; }
.sk-chase-dot:nth-child(6) { animation-delay: -0.6s; }
.sk-chase-dot:nth-child(1):before { animation-delay: -1.1s; }
.sk-chase-dot:nth-child(2):before { animation-delay: -1.0s; }
.sk-chase-dot:nth-child(3):before { animation-delay: -0.9s; }
.sk-chase-dot:nth-child(4):before { animation-delay: -0.8s; }
.sk-chase-dot:nth-child(5):before { animation-delay: -0.7s; }
.sk-chase-dot:nth-child(6):before { animation-delay: -0.6s; }

@keyframes sk-chase {
  100% { transform: rotate(360deg); } 
}

@keyframes sk-chase-dot {
  80%, 100% { transform: rotate(360deg); } 
}

@keyframes sk-chase-dot-before {
  50% {
    transform: scale(0.4); 
  } 100%, 0% {
    transform: scale(1.0); 
  } 
}
/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}
 .Center { 
            width:80px; 
            height:80px; 
            position: fixed; 
            top: 60%; 
            left: 55%; 
            margin-top: -100px; 
            margin-left: -100px; 
        } 
		.ml12 {
  font-weight: 200;
  font-size: 1.8em;
  text-transform: uppercase;
  letter-spacing: 0.5em;
}

.ml12 .letter {
  display: inline-block;
  line-height: 1em;
}
input[type=button] {padding:5px 15px; background:#ccc; border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; }

</style>
</head>
<body onload="myFunction()" style="margin:0;">
<center>
<div id="loader2">
<h1 class="ml12">Đang tải báo cáo</h1>
</div>
</center>
<div id="loader" class="sk-chase center" style="display:none">

  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
</div>

<div class="card card-warning animate-bottom" id="main2" style="display:none">
    <h3>Báo cáo hằng ngày</h3>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" action="confirm.php" method="GET">
                  
				  

				  
                      <!-- text input -->
                      <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Tên lớp</label>
                        <select class="selectpicker form-control" data-live-search="true" name="lop">

				  <optgroup label="Khối 12">
						<option>12 Toán</option>
						<option>12 Lý</option>
						<option>12 Hoá</option>
						<option>12 Sinh</option>
						<option>12 Tin</option>
						<option>12 Văn</option>
						<option>12 Sử - Địa</option>
						<option>12 Anh</option>
						<option>12 Nga</option>
				  </optgroup>
				  <optgroup label="Khối 11">
						<option>11 Toán</option>
						<option>11 Lý</option>
						<option>11 Hoá</option>
						<option>11 Sinh</option>
						<option>11 Tin</option>
						<option>11 Văn</option>
						<option>11 Sử - Địa</option>
						<option>11 Anh</option>
						<option>11 Nga</option>
				  </optgroup>
				  <optgroup label="Khối 10">
						<option>10 Toán</option>
						<option>10 Lý</option>
						<option>10 Hoá</option>
						<option>10 Sinh</option>
						<option>10 Tin</option>
						<option>10 Văn</option>
						<option>10 Sử - Địa</option>
						<option>10 Anh</option>
						<option>10 Nga</option>
				  </optgroup>

				  <optgroup label="THCS">
						<option>9A1</option>
						<option>9A2</option>
						<option>8A1</option>
						<option>8A2</option>
						<option>7A1</option>
						<option>7A2</option>
						<option>6A1</option>
						<option>6A2</option>
				  </optgroup>
				  </select>
                      </div>


                    
                      <!-- datearea -->
<div class="form-group">
<label><i class="fas fa-clock"></i> Thời gian báo cáo</label>
<input class="form-control" id="disabledInput" name="date" type="text" placeholder="<?=rebuild_date('H:i l, d/m/Y' )?>" disabled>
   </div>
            
                      <div class="form-group">
                        <label><i class="fas fa-users"></i> Vắng</label>
                        <input type="text" name="vang" class="form-control" placeholder="Để trống nếu đủ" value="">
                      </div>


                  <!-- input states -->
                  <div class="form-group">
                    <label class="col-form-label" for="inputError"><i class="fas fa-quidditch"></i> Vệ sinh</label>
                    <select class="form-control" name="vesinh">
                          <option>Sạch</option>
                          <option>Bẩn</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="inputError"><i class="fas fa-tshirt"></i> Đồng phục</label>
                    <select class="form-control" name="dongphuc">
                          <option>Đủ</option>
                          <option>Thiếu</option>
                        </select>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Số lỗi vi phạm</label>
                    <select class="form-control" name="soloi" id="selectBox" onchange="changeFunc();">
                          <option>1</option>
                          <option>2</option>
						  <option>3</option>
						  <option>4</option>
						  <option>5</option>
                        </select>
                  </div>
				<div id="error_fileds">
                  <div class="form-group">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Lỗi vi phạm 1</label>
					<input type="text" name="loivipham1" class="form-control is-invalid inputError tagsinput" id="inputError" value="" data-role="tagsinput" placeholder="Nhập lỗi ..."/>
				  </div>
				  <div class="form-group example2" style="display:none">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Lỗi vi phạm 2</label>
					<input type="text" name="loivipham2" class="form-control is-invalid inputError tagsinput" id="inputError" value="" data-role="tagsinput" placeholder="Nhập lỗi ..."/>
				  </div>
				  <div class="form-group example3" style="display:none">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Lỗi vi phạm 3</label>
					<input type="text" name="loivipham3" class="form-control is-invalid inputError tagsinput" id="inputError" value="" data-role="tagsinput" placeholder="Nhập lỗi ..."/>
				  </div>
				  <div class="form-group example4" style="display:none">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Lỗi vi phạm 4</label>
					<input type="text" name="loivipham4" class="form-control is-invalid inputError tagsinput" id="inputError" value="" data-role="tagsinput" placeholder="Nhập lỗi ..."/>
				  </div>
				  <div class="form-group example5" style="display:none">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Lỗi vi phạm 5</label>
					<input type="text" name="loivipham5" class="form-control is-invalid inputError tagsinput" id="inputError" value="" data-role="tagsinput" placeholder="Nhập lỗi ..."/>
				  </div>
				  <a  data-toggle="modal" data-target="#exampleModal">Xem danh sách đầy đủ các lỗi vi phạm...</a>
				</div>

				
<!-- Modal1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tra cứu lỗi vi phạm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<p>1. Đi muộn (Trừ 1 điểm)<br />
2. Đi muộn (bỏ chạy) (-10 điểm)<br />
3. Đi muộn sau 7 giờ (-15 điểm)<br />
4. Đi muộn trèo tường (-10 điểm)<br />
5. Vắng mặt không lí do giờ truy bài (-2 điểm)<br />
6. Ra ngoài giờ truy bài (bỏ chạy) (-10 điểm)<br />
7. Không đúng trang phục: áo,phù hiệu,giày (-1 điểm)<br />
8. Tập trung muộn (-5 điểm)<br />
9. Nghỉ không phép, làm việc riêng trong giờ tập trung (-1 điểm)<br />
10. Tập trung muộn, sau 10 phút xếp hàng chưa ngay ngắn (-10 điểm)<br />
11. Mất trật tự trong buổi tập trung (-5 điểm)<br />
12. Không cất ghế sau giờ tập trung (-1 điểm)<br />
13. Nói bậy (-2 điểm)<br />
14. Ăn quà không đúng nơi quy định (-2 điểm)<br />
15. Hút thuốc lá trong trường (-5 điểm)<br />
16. Không dừng xe ở cổng trường (-5 điểm)<br />
17. Không dừng xe ở cổng trường khi đã nhắc nhở (-10 điểm)<br />
18. Không đội mũ bảo hiểm (-10 điểm)<br />
19. Vô lễ với cán bộ giáo viên (-50 điểm)<br />
20. Xả, đổ rác không đúng nơi quy định (-2 điểm)<br />
21. Trực nhật muộn, đổ rác muộn (-1 điểm)<br />
22. Không lấy sổ đầu bài sáng thứ 2 (-5 điểm)<br />
23. Trực nhật bẩn, không trực khu vực (-2 điểm)<br />
24. Để xe không đúng nơi quy định (-2 điểm)<br />
25. Khu vực để xe lộn xộn, không ngăn nắp (-5 điểm)<br />
26. Không đóng cửa tắt điện sau giờ học (-2 điểm)<br />
27. Sử dụng nhà vệ sinh không đúng cách (-2 điểm)<br />
28. Làm vỡ cửa kính (-5 điểm)<br />
29. Đá bóng không đúng nơi quy định (-2 điểm)<br />
30. Sử dụng không đúng khu vực vệ sinh cho phép (-5 điểm)<br />
31. Đánh nhau (-50 điểm)<br />
32. Đánh nhau không khai báo thành khẩn (-80 điểm)<br />
33. Vi phạm ATGT (có báo cáo về trường) (-20 điểm)<br />
34. Vi phạm quy chế thi (-10 điểm)<br />
35. Giờ tự quản ồn, học sinh ra ngoài, ảnh hưởng đến lớp khác (-10 điểm)<br />
36. Cán bộ lớp, BCH chi đoàn đến họp muộn (-3 điểm)<br />
37. Cán bộ lớp, BCH chi đoàn vắng mặt không lí do (-5 điểm)<br />
38. Cán bộ lớp, BCH chi đoàn không hoàn thành nhiệm vụ (-10 điểm)<br />
39. Xung kích không thực hiện nhiệm vụ (-1 điểm)<br />
40. Đội văn nghệ không thực hiện nhiệm vụ (-2 điểm)<br />
41. Lớp trực tuần bỏ buổi trực (-10 điểm)<br />
42. Lớp trực tuần xuống trực cổng muộn (-5 điểm)<br />
43. Lớp trực tuần chuẩn bị không tốt cho buổi tập trung (-10 điểm)<br />
44. Đội mũ bảo hiểm không cài quai (-5 điểm)<br />
</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>


<script>
var error = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: 'js/cacloi.json'
});
error.initialize();

$('.tagsinput').tagsinput({
	maxTags: 1,
itemValue: 'value',
  itemText: 'text',
  typeaheadjs: {
    name: 'error',
    displayKey: 'text',
    source: error.ttAdapter()
  }
});
function changeFunc() {
    var selectBox = document.getElementById("selectBox");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    if (selectedValue == 1){
		document.querySelector(".example2").style.display = "none";
		document.querySelector(".example3").style.display = "none";
		document.querySelector(".example4").style.display = "none";
		document.querySelector(".example5").style.display = "none";
	}
	if (selectedValue == 2){
		document.querySelector(".example2").style.display = "block";
		document.querySelector(".example3").style.display = "none";
		document.querySelector(".example4").style.display = "none";
		document.querySelector(".example5").style.display = "none";
	}
	if (selectedValue == 3){
		document.querySelector(".example2").style.display = "block";
		document.querySelector(".example3").style.display = "block";
		document.querySelector(".example4").style.display = "none";
		document.querySelector(".example5").style.display = "none";
	}
	if (selectedValue == 4){
		document.querySelector(".example2").style.display = "block";
		document.querySelector(".example3").style.display = "block";
		document.querySelector(".example4").style.display = "block";
		document.querySelector(".example5").style.display = "none";
	}
	if (selectedValue == 5){
		document.querySelector(".example2").style.display = "block";
		document.querySelector(".example3").style.display = "block";
		document.querySelector(".example4").style.display = "block";
		document.querySelector(".example5").style.display = "block";
	}
   }
</script>
                  <div class="row">
                    <div class="col-sm-6" style="
    left: 18px;
">
                    </div>
                  </div>
                  </div>
				  <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal2""><i class="fas fa-paper-plane"></i> Gửi báo cáo</button>
				</form>
                
				<button style="float:right" type="button" class="btn btn-danger" onClick="window.location.reload();"><i class="fas fa-redo-alt"></i> Tải lại</button>
			  </div>
<script>

var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3300);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("loader2").style.display = "none";
  document.getElementById("main2").style.display = "block";
}
// Wrap every letter in a span
var textWrapper = document.querySelector('.ml12');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml12 .letter',
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 500,
    delay: (el, i) => 50 + 30 * i
  }).add({
    targets: '.ml12 .letter',
    translateX: [0,-30],
    opacity: [1,0],
    easing: "easeInExpo",
    duration: 500,
    delay: (el, i) => 50 + 30 * i
  });
</script>
<br>

	</body>
</html>