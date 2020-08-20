<?php
	session_start();

	require('connect.php');
// Include GitHub API config file
require_once 'gitConfig.php';

// Include and initialize user class
require_once 'User.class.php';
$user = new User();

if (!isset($_SESSION['loggedin'])) {
$isloggedin = 'no';
	$OUT = 'none';
	$NOTICE = 'block';
		$WELCOME = 'Bạn chưa đăng nhập! Hãy đăng nhập để tham gia thảo luận.';
	$PROP = 'none';
	$OUT = 'none';
	$width = '131px';
	//$width = '490px';
		if(isset($accessToken)){
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	$NOTICE = 'none';
	$width = '131px';
	$WELCOME = '';
}
} else {
	$isloggedin = 'yes';
	$NOTICE = 'none';
		$WELCOME = '';
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	$width = '131px';
}
$diendan = 'active';
require "include/header.php";
require "include/navbar.php";
require "include/style.php";
?>
<html>
<head>
	
</head>
<body>
	<style>
	.navtop {
	background-color: #2f3947;
	height: 60px;
	width: 100%;
	border: 0;
}
.navtop div {
	display: flex;
	margin: 0 auto;
	width: 1000px;
	height: 100%;
}
.navtop div h1, .navtop div a {
	display: inline-flex;
	align-items: center;
}
.navtop div h1 {
	flex: 1;
	font-size: 24px;
	padding: 0;
	margin: 0;
	color: #eaebed;
	font-weight: normal;
}
.navtop div a {
	padding: 0 20px;
	text-decoration: none;
	color: #c1c4c8;
	font-weight: bold;
}
.navtop div a i {
	padding: 2px 8px 0 0;
}
.navtop div a:hover {
	color: #eaebed;
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
.content > div {
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
	</style>
	
<div class="content">
	<style>
@media only screen and (max-width: 790px) {
.content {
	width: auto;
	margin: 0 auto;
    padding-left: 25px;
    padding-right: 25px;

}
}
</style>

	<?php 
	if($_GET["id"]){
		
		$query = "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results)){
			while($row=mysqli_fetch_assoc($results)){
				$view=$row['view'];
				$query_u = "SELECT * FROM accounts WHERE username='".$row['topic_creator']."'";
				$results_u = mysqli_query($db, $query_u);
				if( $results ){
				while($row_u=mysqli_fetch_assoc($results_u)){
					$user_idc = $row_u['id'];					
				}
				} else {
				}
				echo "<h1 id='tunna3'>" .$row['topic_name']."</h1>";
				$class = '"fas fa-eye"';
				$class2 = '"far fa-calendar-alt"';
				$class3 = '"fas fa-user"';
				$style = '"
    padding-top: 5px;
    padding-bottom: 5px;
"';
				echo "<h5><i class=$class3></i> Bởi <a href='/profile.php?id=".$user_idc."'>".$row['topic_creator']."</a><br/><i class=$class2 style=$style></i> Vào ngày ".$row['date']."<br><i class=$class></i> Lượt xem: " .$view. "</h5>";
				echo "<hr>";
				echo $row['topic_content'];
				
				
				?>
				<hr>
	<?php
	require "include/footer.php";
	?>
  </div>

  
<?php
			
			}
		}else {
			echo "<h1>404</h1>
			<p>Không tồn tại bài viết này!</p>";
			
			
		 }
		
		/////////////////////////////////////////////////////
		
			include("view.php");
		
		
	}else{
		header("Location: index.php");
	}
	
	?>
	
	</center>
	


</body>
</html>

