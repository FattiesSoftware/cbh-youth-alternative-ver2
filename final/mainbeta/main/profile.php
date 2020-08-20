<?php
	session_start();
	require('connect.php');
	
	if ($_SESSION['username']) {

?>

<html>
<head>
	<title>Profile</title>
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
		if(@$_GET['id']){
			echo "<center>";
			$query = "SELECT * FROM users WHERE id='".$_GET['id']."'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) !=0) {
				while($row = mysqli_fetch_assoc($results)){
					$username=$row["username"];
					$email= $row["email"];
					$score= $row["score"];
					$date= $row["date"];
					$prof_pic=$row["profile_pic"];
				}
			}else{
					echo "ID không phù hợp";
			}
		
			}else{
			header("Location:index.php");
		}
	echo "</center>";
	?>
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
	}else {
		echo " bạn cần đăng nhập ";
		header('location: login.php');
	}
?>