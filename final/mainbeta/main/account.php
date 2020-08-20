<?php
	session_start();
	require('connect.php');
	if ($_SESSION['username']) {

?>

<html>
<head>
	<title>Tài Khoản</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link href="images/default_pic.jpg" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600,600i,700" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
	<?php include("header.php"); 
	$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
	$results = mysqli_query($db, $query);
	$rows= mysqli_num_rows($results);
	while($row = mysqli_fetch_assoc($results)){
		$id= $row["id"];
		$username=$row["username"];
		$email= $row["email"];
		$score= $row["score"];
		$date= $row["date"];
		$prof_pic=$row["profile_pic"];
	}
	?>
	<!--<center><br/><br/><br/><?php echo "<img src='$prof_pic' width ='70' height='70' >";?><br/>
	Tài khoản: <?php echo $username ?> <br/>
	ID: <?php echo $id ?> <br/>
	Email: <?php echo $email ?> <br/>
	Ngày tham gia: <?php echo $date ?> <br/>
	Score: <?php echo $score ?> <br/>
	<a href='?action=cp'>Thay đổi mật khẩu </a><br/>
	<a href='?action=ci'>Thay đổi ảnh đại diện </a></center>-->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<div class="home-five-style">
		<section class="hero-section">
			<div class="container-fluid text-center">
				<?php echo "<img src='$prof_pic' alt='' style='object-fit: cover;width:320px;height:320px;'>";?>
				<div class="hero-text">
					<h2><?php echo $username ?></h2>
					<p>I’m a digital designer in love with photography, painting and<br>discovering new worlds and cultures.</p>
					<center><a href='?action=cp'>Thay đổi mật khẩu </a><br/>
					<a href='?action=ci'>Thay đổi ảnh đại diện </a></center>
					<a href ="index.php?action=logout">Đăng xuất</a>
				</div>
				<div class="social-links">
					<a href=""><i class="fab fa-twitter-square"></i></a>
					<a href=""><i class="fab fa-facebook-square"></i></a>
				</div>
			</div>
		</section>
	<footer class="footer-section">
		<div class="container text-center">
			<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fas fa-heart"></i> by <a href="https://facebook.com/hoang.phat.handsome" target="_blank">HoangPhat</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
		</div>
	</footer>
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>

<?php
	if(@$_GET['action']=="logout")
	{
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
	
	if(@$_GET['action']=="ci"){
		echo "<form action='account.php?action=ci' method='POST' enctype='multipart/form-data' ><center>
		<br/> 
		Chỉ có thể tải được ảnh dạng <b> .PNG .JPG .JPEG </b><br/>
		<input type ='file' name ='image'><br/>
		<input type ='submit' name ='change_pic' value='change'><br/>
		";
		if(isset($_POST['change_pic'])){
			$errors=array();
			$allowed_e=array('png','jpg','jpeg');
			$file_name=$_FILES['image']['name'];
			$file_e=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
			$file_s= $_FILES['image']['size'];
			$file_tmp=$_FILES['image']['tmp_name'];
			
			if(in_array($file_e, $allowed_e)==false){
				$errors[]='Phần mở rộng của file không hợp lệ';
			}
			if($file_s>2097152){
				$errors[]='File này nặng vl (>2mb)';
			}
			if(empty($errors)){
				move_uploaded_file($file_tmp,'images/'.$file_name);
				$image_up='images/'.$file_name;
				$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
				$results = mysqli_query($db, $query);
				$rows= mysqli_num_rows($results);
				while($row = mysqli_fetch_assoc($results)){
				$db_image=$row['profile_pic'];
				}	
				$upd = "UPDATE users SET profile_pic='".$image_up." 'WHERE username='".$_SESSION['username']."'";
				$check = mysqli_query($db, $upd);
				echo "Đổi ảnh đại diện thành cmn công";
			}else{
				foreach($errors as $error){
					echo $error,'<br/>';
				}
			}
		}
		echo "</form></center>";
	}
	
	if(@$_GET['action']=="cp"){
		echo "<form action='account.php?action=cp' method='POST'><center>";
		echo "
		Mật khẩu cũ: <input type='password' name='pass' ><br/>
		Mật khẩu mới: <input type='password' name='newpass'><br/>
		Nhập lại mật khẩu: <input type='password' name='repass'><br/>
			<button type='submit' name='change_pass' value='change' >Đổi mật khẩu</button>
	";
		
		if(isset($_POST['change_pass'])){
			$pass = mysqli_real_escape_string($db, $_POST['pass']);
			$newpass = mysqli_real_escape_string($db, $_POST['newpass']);
			$repass = mysqli_real_escape_string($db, $_POST['repass']);
			$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
			$results = mysqli_query($db, $query);
			$rows= mysqli_num_rows($results);
			while($row = mysqli_fetch_assoc($results)){
				$get_pass=$row['password'];
			}
			
			if($get_pass==sha1($pass)){
				if(strlen($newpass)>=5){
					if($newpass==$repass){
						$upd = "UPDATE users SET password='".sha1($newpass)."' WHERE username='".$_SESSION['username']."'";
						$check = mysqli_query($db, $upd);
						echo "Đổi mật khẩu thành công !";
				}else{
					echo "Mật khẩu nhập lại không khớp";
				}
				}else{
					echo "Mật khẩu cần dài hơn 6 kí tự ";
				}
			}else{
				echo "Mật khẩu hiện tại không đúng";
			}
		} 
	echo "</center></form>";
	}
	
	}else {
		echo " bạn cần đăng nhập ";
		header('location: login.php');
	}
?>