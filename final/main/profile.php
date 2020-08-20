<?php
	session_start();
	require('connect.php');
	
	if ($_SESSION['username']) {

?>

<html>
<head>
	<title>Trang chủ</title>
</head>
<body>
	<?php include("header.php"); 
		if(@$_GET['id']){
			echo "<center><br/><br/><br/>";
			$query = "SELECT * FROM users WHERE id='".$_GET['id']."'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) !=0) {
				while($row = mysqli_fetch_assoc($results)){
					echo "<h1>".$row["username"]."</h1><img src='".$row["profile_pic"]."' width='50' height='50'><br/>";
					echo "Ngày tham gia : ".$row["date"]."<br/>";
					echo "Emai : ". $row["email"]."<br/>";
					echo "Điểm : ". $row["score"]."<br/>";
				}
			}else{
					echo "ID không phù hợp";
			}
		
			}else{
			header("Location:index.php");
		}
	echo "</center>";
	?>
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