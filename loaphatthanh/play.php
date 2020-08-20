<?php
error_reporting(0);
ini_set('display_errors', 0);
	require('require/serverconnect.php');
session_start();



	// Include GitHub API config file

require_once 'require/githubConfig.php';



// Include and initialize user class

require_once 'require/github.user.class.php';

$user = new User();



if (!isset($_SESSION['loggedin'])) {

	   // Get the user profile info from Github

    $gitUser = $gitClient->apiRequest($accessToken);



    if(!empty($gitUser)){

        // User profile data

        $gitUserData = array();

        $gitUserData['oauth_provider'] = 'github';

        $gitUserData['oauth_uid'] = !empty($gitUser->id)?$gitUser->id:'';

        $gitUserData['name'] = !empty($gitUser->name)?$gitUser->name:'';

        $gitUserData['username'] = !empty($gitUser->login)?$gitUser->login:'';

        $gitUserData['email'] = !empty($gitUser->email)?$gitUser->email:'';

        $gitUserData['location'] = !empty($gitUser->location)?$gitUser->location:'';

        $gitUserData['picture'] = !empty($gitUser->avatar_url)?$gitUser->avatar_url:'';

        $gitUserData['link'] = !empty($gitUser->html_url)?$gitUser->html_url:'';

        

        // Insert or update user data to the database

        $userData = $user->checkUser($gitUserData);

        

        // Put user data into the session

        $_SESSION['userData'] = $userData;

$OUT1 = 'none';

}

	$OUT = 'none';

	$NOTICE = 'block';

		$WELCOME = 'Bạn chưa đăng nhập! Hãy đăng nhập để tham gia thảo luận.';

	$PROP = 'none';

	$OUT = 'none';

	if(isset($accessToken)){

	$NOTICE = 'none';

		$WELCOME = '';

	$PROP = 'block';

	$IN = 'none';

	$OUT = 'block';

	$usen = $userData['username'];

} 

} else {

	$usen = $_SESSION['username'];

	$NOTICE = 'none';

		$WELCOME = '';

	$PROP = 'block';

	$IN = 'none';

	$OUT = 'block';

}
$loa = 'active';
		require('include/header.php');
		require('include/navbar.php');
		require('include/style.php');
?>

<html>
<head>
	
</head>
<body>
<style type="text/css">
	
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
@media only screen and (max-width: 790px) {
.content {
	width: auto;
	margin: 0 auto;
    padding-left: 25px;
    padding-right: 25px;

}
}
</style>
	<div class="content">

	<?php
		$conn=mysqli_connect('localhost','root','','members');
		if($_GET["name"]){
			
			$query = "SELECT * FROM audios WHERE filename='".$_GET['name']."'";
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results)){
				while($row=mysqli_fetch_assoc($results)){
					$view=$row['view'];
					$id=$row['audio_id'];
					$query_u = "SELECT * FROM accounts WHERE username='".$row['audio_creator']."'";
					$results_u = mysqli_query($conn, $query_u);
					while($row_u=mysqli_fetch_assoc($results_u)){
						$user_id = $row_u['id'];
					}
					echo "<h1>" .$row['audio_name']."</h1>";
					$class = '"fas fa-eye"';
				$class2 = '"far fa-calendar-alt"';
				$class3 = '"fas fa-user"';
				$style = '"
    padding-top: 5px;
    padding-bottom: 5px;
"';

				echo "<h5><i class=$class3></i> Bởi <a href='/profile.php?id=$user_id'>".$row['audio_creator']."</a><br/><i class=$class2 style=$style></i> Vào ngày ".$row['date']."<br><i class=$class></i> Lượt xem: " .$view. "</h5>";
				echo "<hr>";
					
				
		?>
		<audio controls>
			<source src="<?php echo $_GET['name']; ?> " type='audio/mpeg'>
			</source>
		</audio>
		<br/><br/>


	<?php
				}
			}else {
				echo "Không tồn tại bài viết này";
			}
			
			include("views.php");
			
		}else {
			header("Location: index.php");
		}
		

	?>
	<hr>
<footer class="footer">

    <div class="column">
        <p>&copy; Đoàn trường Chuyên Biên Hoà</p>
    </div>

    <div class="column">
        <p id="demo"></p>
    </div>

     <div class="column">
        <p> Designed and developed with <i class="fas fa-heart"></i> by <a href="https://facebook.com/tunnaduong/">Fatties Software</a></p>

<style>
.column {    
    display: inline-block;
}
</style>
</div>
<script>

function myFunction() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("demo").innerHTML = n + ".";
}
myFunction()
</script>
      
      </footer>
	</div>
</body>
</html>

