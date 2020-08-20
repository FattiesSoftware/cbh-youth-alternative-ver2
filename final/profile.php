<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Include GitHub API config file
require_once 'gitConfig.php';

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
require "include/header.php";
?>

	<body class="loggedin">
	<style>
	* {
font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
}
body {
  	background-color: #435165;

}
.register {
  	width: 400px;
  	background-color: #ffffff;
  	box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
  	margin: 100px auto;
}
.register h1 {
  	text-align: center;
  	color: #5b6574;
  	font-size: 24px;
  	padding: 20px 0 20px 0;
  	border-bottom: 1px solid #dee0e4;
}
.register form {
  	display: flex;
  	flex-wrap: wrap;
  	justify-content: center;
  	padding-top: 20px;
}
.register form label {
  	display: flex;
  	justify-content: center;
  	align-items: center;
  	width: 50px;
 	height: 50px;
  	background-color: #3274d6;
  	color: #ffffff;
}
.register form input[type="password"], .register form input[type="text"], .register form input[type="email"] {
  	width: 310px;
  	height: 50px;
  	border: 1px solid #dee0e4;
  	margin-bottom: 20px;
  	padding: 0 15px;
}
.register form input[type="submit"] {
  	width: 100%;
  	padding: 15px;
  	margin-top: 20px;
  	background-color: #3274d6;
 	border: 0;
  	cursor: pointer;
  	font-weight: bold;
  	color: #ffffff;
  	transition: background-color 0.2s;
}
.register form input[type="submit"]:hover {
	background-color: #2868c7;
  	transition: background-color 0.2s;
}	


body.loggedin {
	background-color: #f3f4f7;
}
.content {
	width: 1000px;
	margin: 0 auto;
}
.content h2 {
	margin: 0;
	padding: 25px 0;
	font-size: 22px;
	border-bottom: 1px solid #e0e0e3;
	color: #4a536e;
}
.content > p, .content > div {
	box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
	margin: 25px 0;
	padding: 25px;
	background-color: #fff;
}
.content > p table td, .content > div table td {
	padding: 5px;
}
.content > p table td:first-child, .content > div table td:first-child {
	font-weight: bold;
	color: #4a536e;
	padding-right: 15px;
}
.content > div p {
	padding: 5px;
	margin: 0 0 10px 0;
}
@media only screen and (max-width: 790px) {
.content {
	width: 720px;
	margin: 0 auto;
    padding-left: 25px;
    padding-right: 25px;

}
}
	</style>
<?php
$trangcanhan = 'active';
require "include/navbar.php";
?>

		<div class="content">
			<h2>Trang cá nhân</h2>
			<div>

  <div>
  <div class="wrapper" style='display:<?=$OUT1?>'><?php echo $output; ?></div></div>



				<table>

<?php 
if(isset($accessToken)){
	$usern = 'none';
} elseif ($logi) {
	
$query = "SELECT * FROM accounts WHERE username='".$usern."'";
			$results = mysqli_query($con, $query);
			if (mysqli_num_rows($results) !=0) {
				while($row = mysqli_fetch_assoc($results)){
					$login = 'block';
					if(@$_GET['id']){
						$login = 'none';	
					}
					echo "<div style='display:$login'>";
					echo "<div><img src='".$row["profile_pic"]."' width ='150' height='150' style='margin-bottom: 15px;float: left;   border-radius: 50%; margin-right: 25px'></div>";
					echo "<h1 style='
    margin-top: 0px;
'>".$row["username"]."</h1>";
					
					echo "<tr style='display:$login'><td>Họ và tên :</td> <td>".$row["name"]."</td>";
					echo "<tr style='display:$login'><td>Ngày tham gia :</td> <td>".$row["date"]."</td>";
					echo "<tr style='display:$login'><td>ID : </td><td>".$row["id"]."</td>";
					echo "<tr style='display:$login'><td>Email : </td><td>". $row["email"]."</td>";
					//echo "Điểm : ". $row["score"]."<br/>";
					//echo "Số câu trả lời : ". $row["replies"]."<br/>";
					//echo "Số lượng bài viết : ". $row["topics"]."<br/>";
echo "</div>";
				}
			}
} 
if(isset($accessToken)){
        // Render Github profile data
$login = 'block';
$tunna = 1;
if(@$_GET['id']){
						$login = 'none';	
						$tunna = 0;
						$OUT = 'none';
					}
					
		if($tunna == 1){
		echo "<div style='display:$login'><div><img src='".$userData["profile_pic"]."' width ='150' height='150' style='margin-bottom: 15px;float: left;   border-radius: 50%; margin-right: 25px'></div>";
        echo "<h1 style='margin-top: 0px;'>".$userData["username"]."</h1>";
        echo "<table><tr><td style=''>Họ và tên :</td> <td>".$userData['name'].'</td>';
		echo "<tr><td>ID : </td><td>".$userData['oauth_uid'].'</td>';
		echo "<tr><td>Email : </td><td>".$userData['email'].'</td>';
        echo "<tr><td>Địa chỉ : </td><td>".$userData['location'].'</td>';
        echo '<tr><td>Profile Link :  </td><td><a href="'.$userData['link'].'" target="_blank">Click để mở GitHub</a></td>';
        echo '</table></div>'; 
		}
}


		if(@$_GET['id']){
			$login = 'none';	
			$OUT = 'none';
			$query = "SELECT * FROM accounts WHERE id='".$_GET['id']."'";
			$results = mysqli_query($con, $query);
			if (mysqli_num_rows($results) !=0) {
				while($row = mysqli_fetch_assoc($results)){
					
					echo "<div><img src='".$row["profile_pic"]."' width ='150' height='150' style='margin-bottom: 15px;float: left;   border-radius: 50%; margin-right: 25px'></div>";
					echo "<h1 style='
    margin-top: 0px;
'>".$row["username"]."</h1>";
					
					echo "<tr><td>Họ và tên :</td> <td>".$row["name"]."</td>";
					echo "<tr><td>Ngày tham gia :</td> <td>".$row["date"]."</td>";
					echo "<tr><td>ID : </td><td>".$row["id"]."</td>";
					echo "<tr><td>Email : </td><td>". $row["email"]."</td>";
					//echo "Điểm : ". $row["score"]."<br/>";
					//echo "Số câu trả lời : ". $row["replies"]."<br/>";
					//echo "Số lượng bài viết : ". $row["topics"]."<br/>";
					
					
				}
			}else{
					echo "Không tìm thấy thông tin của ID này!";
			}
		}else {
		echo "<p style='display:$none'>Bạn chưa đăng nhập!</p>";
		}
		if ($logi) {
			$login = 'block';
		}
	?>
					<div style="float:right;display:<?=$OUT?>">
				<a href='profile.php?action=cp'><i class="fas fa-key"></i> Thay đổi mật khẩu </a><br/>
	<a href='profile.php?action=ca'><i class="fas fa-user"></i> Thay đổi ảnh đại diện </a>
	</div>
				</table>
				
				<br>
				
	<?php
		if(@$_GET['action']=="cp"){
		echo "<form action='profile.php?action=cp' method='POST'><center>";
		echo "<div style='width: 30%;'>
		Mật khẩu cũ: <input type='password' class='form-control form-control-sm' name='pass' ><br/>
		Mật khẩu mới: <input type='password' class='form-control form-control-sm' name='newpass'><br/>
		Nhập lại mật khẩu: <input type='password' class='form-control form-control-sm' name='repass'><br/>
			<button type='submit' name='change_pass' class='btn btn-primary' value='change' >Đổi mật khẩu</button>
	</div>
	";
	// See the password_hash() example to see where this came from.
	$query = "SELECT password FROM accounts WHERE username='".$_SESSION['username']."'";
			$results = mysqli_query($con, $query);
	if( $results ){
			while($row = mysqli_fetch_assoc($results)){
$hash = $row['password'];
			}
	}

		
		if(isset($_POST['change_pass'])){
			$pass = mysqli_real_escape_string($con, $_POST['pass']);
			$newpass = mysqli_real_escape_string($con, $_POST['newpass']);
			$repass = mysqli_real_escape_string($con, $_POST['repass']);
			$query = "SELECT * FROM accounts WHERE username='".$_SESSION['username']."'";
			$results = mysqli_query($con, $query);
			if (password_verify($pass, $hash)) {
    if($newpass==$repass){
		$upd = "UPDATE accounts SET password='".password_hash($newpass, PASSWORD_DEFAULT)."' WHERE username='".$_SESSION['username']."'";
		mysqli_query($con, $upd);
		echo "Thay đổi mật khẩu mới thành công!";
	} else {
	echo 'Mật khẩu nhập lại không khớp';
	}
} else {
    echo 'Mật khẩu hiện tại không chính xác';
}

		}
		}
		
	echo "</center></form>";
	
	
		if(@$_GET['action']=="ca"){
		echo "<form action='profile.php?action=ca' method='POST' enctype='multipart/form-data' ><center>
		<br/> 
		Chỉ có thể tải được ảnh dạng <b> .PNG .JPG .JPEG </b><br/>
		<input type ='file' name ='image'><br/>
		<input type ='submit' class='btn btn-primary'  name ='change_pic' value='Tải lên'><br/>
		";
		if(isset($_POST['change_pic'])){
			$errors=array();
			$allowed_e=array('png','jpg','jpeg');
			$file_name=$_FILES['image']['name'];
			$file_e=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
			$file_s= $_FILES['image']['size'];
			$file_tmp=$_FILES['image']['tmp_name'];
			
			if(in_array($file_e, $allowed_e)==false){
				$errors[]='Phần mở rộng của ảnh không hợp lệ';
			}
			if($file_s>5097152){
				$errors[]='Chỉ có thể upload ảnh <5MB';
			}
			if(empty($errors)){
				move_uploaded_file($file_tmp,'images/'.$file_name);
				$image_up='images/'.$file_name;
				$query = "SELECT * FROM accounts WHERE username='".$_SESSION['username']."'";
				$results = mysqli_query($con, $query);
				$rows= mysqli_num_rows($results);
				while($row = mysqli_fetch_assoc($results)){
				$db_image=$row['profile_pic'];
				}	
				$upd = "UPDATE accounts SET profile_pic='".$image_up." 'WHERE username='".$_SESSION['username']."'";
				mysqli_query($con, $upd);
				echo "Đổi ảnh đại diện thành công";
			}else{
				foreach($errors as $error){
					echo $error,'<br/>';
				}
			}
		}
		echo "</form></center>";
	}
	
	
?>
			</div>
		</div>

	</body>
</html>