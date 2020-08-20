<?php
	session_start();
	require('connect.php');
	if ($_SESSION['username']) {
		include('server3.php');
?>

<html>
<head>
	<title>Loa phát thanh</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php include("header.php"); ?>
	<center><br/><br/><br/>
		<a href="post.php"><button>Post topic</button></a>
		<a href="audio.php"><button>Post audio</button></a><br/><br/>
	<?php
		$conn=mysqli_connect('localhost','root','','php_forum');
		if($_GET["name"]){
			
			$query = "SELECT * FROM audios WHERE filename='".$_GET['name']."'";
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results)){
				while($row=mysqli_fetch_assoc($results)){
					$view=$row['view'];
					$id=$row['audio_id'];
					$query_u = "SELECT * FROM users WHERE username='".$row['audio_creator']."'";
					$results_u = mysqli_query($db, $query_u);
					while($row_u=mysqli_fetch_assoc($results_u)){
						$user_idc = $row_u['id'];
					}
					echo "<h1>" .$row['audio_name']."</h1>";
					echo "<h5>Bởi <a href='profile.php?id=$user_idc'>".$row['audio_creator']."</a><br/>Ngày ".$row['date']."</h5>";
				
		?>
		<audio controls>
			<source src="<?php echo $_GET['name']; ?> " type='audio/mpeg'>
			</source>
		</audio>
		<br/><br/>
		<div class="audios-wrapper">
   	<div class="audio">
      <div class="audio-info">
	   
      	<i <?php if (userLiked($id)): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $id ?>"></i>
      	<span class="likes"><?php echo getLikes($id); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	 
      	<i 
      	  <?php if (userDisliked($id)): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $id ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($id); ?></span>
      </div>
   	</div>
  </div>
  <script src="scripts2.js"></script>
	<?php
				}
			}else {
				echo "Không tồn tại bài viết này";
			}
			
			include("views.php");
			
		}else {
			header("Location: index.php");
		}
		if($id){
					$query = "SELECT * FROM audios WHERE audio_id='$id'";
					$results = mysqli_query($db, $query);
					if (mysqli_num_rows($results)){
						while($row=mysqli_fetch_assoc($results)){
							if($row['audio_creator']==$_SESSION['username']){
								echo "<center></br><a href='change_audio.php?action=edit&&idt=$id'>Chỉnh sửa</a></br>";
								echo "<a href='change_audio.php?action=del&&idt=$id'>Xóa bản ghi </a></center>";
							}
						}		
					}
				}
	?>
	
	</center>
</body>
</html>
<?php
	}else {
		echo " bạn cần đăng nhập ";
		header('location: login.php');
	}
	
?>