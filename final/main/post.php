<?php
	session_start();
	require('connect.php');
	if ($_SESSION['username']) {

?>

<html>
<head>
	<meta charset="uft-8">
	<title>Post topic</title>
</head>
<body>
	
	<?php include("header.php"); ?>
	<form action="post.php" method="POST">
		<center> <br/><br/><br/>
			Topic name: <br/> <input type="text" name="topic_name" style="width:400px;"><br/>
			Content:<br/> <textarea style="resize: none;width:400px;height:300px;" name="content" > </textarea><br/>
			<input type="submit" name="submit" value="Post"style="width:400px;">
		</center>


	</form>
</body>
</html>

<?php
	if(isset($_POST['submit'])){
		$topic_name= mysqli_real_escape_string($db, $_POST['topic_name']);
		$content = mysqli_real_escape_string($db, $_POST['content']);
		$date=date("Y-m-d");
		if(isset($_POST['submit'])){
			if($topic_name&&$content)
			{
				if(strlen($topic_name)>=10){
					$query = "INSERT INTO topics (topic_name, topic_content, topic_creator, date) 
								VALUES('$topic_name', '$content', '".$_SESSION['username']."', '$date')";
					mysqli_query($db, $query);
					echo "Đăng bài viết thành công !";
				}else{
					echo "Tiêu đề ngắn quá ! (>10 kí tự)";
				}
			}else{
				echo "Đặt tiêu đề/ nọi dung đi bà nội";
			}
		}
		
		
		
	}
	}else {
		echo " bạn cần đăng nhập ";
		header('location: login.php');
	}
?>