<?php
	session_start();
	require('connect.php');
	//include('view.php');
	if ($_SESSION['username']) {
		

?>

<html>
<head>
	<title>Bài viết</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
	
	<?php include("header.php"); 
			
			?>
	<center>
		<a href="post.php"><button>Post topic</button></a>
		<a href="audio.php"><button>Post audio</button></a><br/><br/>
	<?php 
	////// hiển thị
	$id=$_GET['id'];

	if($_GET["id"]){
		$query = "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results)){
			while($row=mysqli_fetch_assoc($results)){
				$view=$row['view'];
				$query_u = "SELECT * FROM users WHERE username='".$row['topic_creator']."'";
				$results_u = mysqli_query($db, $query_u);
				while($row_u=mysqli_fetch_assoc($results_u)){
					$user_idc = $row_u['id'];
					
				}
				echo "<h1>" .$row['topic_name']."</h1>";
				echo "<h5>Bởi <a href='profile.php?id=$user_idc'>".$row['topic_creator']."</a><br/>Ngày ".$row['date']."</h5>";
				echo "<h2>".$row['topic_content']."</h2>";
				
				
				?>
<?php
			
			}
		}else {
			echo "Không tồn tại bài viết này";
			
			
		 }
		
		include("view.php");
		
		
	}else{
		header("Location: index.php");
	}
	if($_GET["id"]){
		$query = "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results)){
	while($row=mysqli_fetch_assoc($results)){
		if($row['topic_creator']==$_SESSION['username']){
			echo "<center></br><a href='change_topic.php?action=edit&&idt=$id'>Chỉnh sửa bài viết</a></br>";
			echo "<a href='change_topic.php?action=del&&idt=$id'>Xóa bài viết </a></center>";
		}
	}}
	}
	
	
	///////
	}
	?>
	
	</center>
	

</body>
</html>

