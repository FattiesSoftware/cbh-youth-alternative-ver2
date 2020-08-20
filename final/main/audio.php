<?php
	session_start();
	require('connect.php');
	if ($_SESSION['username']) {

?>

<html>
<head>
	<meta charset="uft-8">
	<title>Post audio</title>
</head>
<body>
	<?php include("header.php"); ?>
	<form method="post" action="audio.php" enctype="multipart/form-data" >
		<center> <br/><br/><br/>
			Audio name: <br/> <input type="text" name="topic_name" style="width:200px;"><br/>
			<input type="file" name="audioFile"></br>
			<input type="submit" value="Upload Audio" name="save_audio">
		</center>
		
	</form>
	
</body>
</html>
<?php

	if(isset($_POST['save_audio'])){
		$errors=array();
		$topic_name= mysqli_real_escape_string($db, $_POST['topic_name']);
		if(strlen($topic_name)==0){
			$errors[]= 'Maybe you forgot audios name';
		}
		
		$allowed_e=array('wav','WAV');
		$file_name=$_FILES['audioFile']['name'];
		$file_e=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
		if(in_array($file_e, $allowed_e)==false){
			$errors[]='Phần mở rộng của file không hợp lệ';
		}
		if(empty($errors)){
			$date=date("Y-m-d");
			$dir='uploads/';
			$audio_path=$dir.basename($_FILES['audioFile']['name']);
		
			function saveAudio($fileName,$topic_name,$audio_creator,$date){
				$conn=mysqli_connect('localhost:3308','root','','php_forum');
				
				if(!$conn){
					die('Sever not connected');
				}
				
				$query="insert into audios(filename,audio_name,audio_creator,date)values('{$fileName}','$topic_name','$audio_creator','$date')";
		
				mysqli_query($conn,$query);
		
				if(mysqli_affected_rows($conn)>0){
					echo '<center>';
					echo "audio file path saved in database";
					echo '</center>';
				}
				mysqli_close($conn);
			}
		
			if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$audio_path)){
				saveAudio($audio_path,$topic_name,$_SESSION['username'],$date);
			}
			
		}else{
			foreach($errors as $error){
				echo '<center>';
				echo $error,'<br/>';
				echo '</center>';
			}
		}
	}
	}else {
		echo " bạn cần đăng nhập ";
		header('location: login.php');
	}
?>
