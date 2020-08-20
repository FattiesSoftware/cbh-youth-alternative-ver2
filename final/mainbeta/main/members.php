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
		echo "<center>";
		$servername = "localhost:3308";
		$username = "root";
		$password = "";
		$dbname = "php_forum";
// tạo connection
		$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm connection
		if ($conn->connect_error) {
			die("kết nối thất bại " . $conn->connect_error);
		} 
 
		$sql = "SELECT id, username FROM users";
		$result = $conn->query($sql);
 
		if ($result->num_rows > 0) {
		// output dữ liệu trên trang
		while($row = $result->fetch_assoc()) {
		$id=$row["id"];

		echo "<center><ul><tr>";
		echo "<td ><span>Thành viên   </span></td>";
		echo "<td style='text-align:center;'><a href='profile.php?id=$id'>".$row['username']."</a></td>";
		echo "</tr></center>";

    }
} else {
    echo "0 thành viên";
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