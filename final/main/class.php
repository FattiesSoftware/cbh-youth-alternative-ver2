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
	<br/><br/><br/>
	<?php include("header.php"); 
		if(@$_GET['id']){
			echo "<center>";
			$query = "SELECT * FROM class WHERE class_id='".$_GET['id']."'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) !=0) {
				while($row = mysqli_fetch_assoc($results)){
					echo "<h1> Lớp ".$row["classname"]." :</h1> </br>";
					echo "Tổng điểm : ". $row["tong"]."<br/>";
					$Monday= unserialize($row["Monday"]);
					echo "Lỗi vi phạm thứ hai : ";
					$i2=0;
					foreach( $Monday as $value )
					{
						echo $value;
						echo "</br>";
						$i1=$i2+1;
					}
					if($i2==0) echo "Không có";
					echo "<br/>";
					
					$Tuesday= unserialize($row["Tuesday"]);
					echo "Lỗi vi phạm thứ ba : ";
					$i3=0;
					foreach( $Tuesday as $value )
					{
						echo $value;
						echo "</br>";
						$i3=$i3+1;
					}
					if($i3==0) echo "Không có";
					echo "<br/>";
					
					$Wednesday= unserialize($row["Wednesday"]);
					echo "Lỗi vi phạm thứ tư : ";
					$i4=0;
					foreach( $Wednesday as $value )
					{
						echo $value.", ";
						$i4=$i4+1;
					}
					if($i4==0) echo "Không có";
					echo "<br/>";
					
					$Thursday= unserialize($row["Thursday"]);
					echo "Lỗi vi phạm thứ năm : ";
					$i5=0;
					foreach( $Thursday as $value )
					{
						echo $value;
						echo "</br>";
						$i5=$i5+1;
					}
					if($i5==0) echo "Không có";
					echo "<br/>";
					
					$Friday= unserialize($row["Friday"]);
					echo "Lỗi vi phạm thứ sáu : ";
					$i6=0;
					foreach( $Friday as $value )
					{
						echo $value;
						echo "</br>";
						$i6=$i6+1;
					}
					if($i6==0) echo "Không có";
					echo "<br/>";
					
					$Saturday= unserialize($row["Saturday"]);
					echo "Lỗi vi phạm thứ bảy : ";
					$i7=0;
					foreach( $Saturday as $value )
					{
						echo $value;
						echo "</br>";
						$i7=$i7+1;
					}
					if($i7==0) echo "Không có";
					echo "<br/>";
					
					echo "</br>";
					
					$userbaocao=$row["userbaocao"];
					$query_u = "SELECT * FROM users WHERE username='$userbaocao'";
					$results_u = mysqli_query($db, $query_u);
					if (mysqli_num_rows($results_u) !=0) {
					while($row_u = mysqli_fetch_assoc($results_u)){
							$user_id=$row_u['id'];
						}
					}
					
					echo "Xung kích trực <a href='profile.php?id=$user_id'>". $userbaocao." </a>";
				}
			}else{
					echo "fail";
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