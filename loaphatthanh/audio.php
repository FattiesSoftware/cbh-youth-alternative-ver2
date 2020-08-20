<?php
	session_start();
	require('connect.php');
	require_once 'gitConfig.php';

// Include and initialize user class
require_once 'user.class.php';
$user = new User();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	$WELCOME = 'Bạn chưa đăng nhập! Hãy đăng nhập để tham gia thảo luận.';
	$PROP = 'none';
	$OUT = 'none';

header('location: /baocao/index.php');


} else {
	$WELCOME = '';
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';

// Create connection

    //$servername = 'sql102.epizy.com';
    //$username = 'epiz_25309528';
    //$password = 'FwYnaoyKsmQeVo';
    //$dbname = 'epiz_25309528_fattiesSoftware';
	$servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'members';
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, 'UTF8');
// Check connection

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

$sql_n = "Select name from accounts where username ='".$_SESSION['username']."'";

$result_n =  $conn->query($sql_n);

        if ($result_n ->num_rows >0) {
            $row_n= $result_n->fetch_assoc();
            $_SESSION["name"]= $row_n["name"];
        }
        else {
            echo "<font color='red'>The name is not found!</font><br/ > 
            <a href = '/baocao/index.php'>Click here to go back to login...</font></a>";
        }


    $conn->close(); 



	$nam = $_SESSION['name'];
}
if(isset($accessToken)){
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
    }
if(isset($accessToken)){
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	$nam = $userData['name'];
}
require "include/header.php";
$loa = 'active';
require "include/navbar.php";
require "include/style.php";


?>

<html>
<head>
	<meta charset="uft-8">
	<title>Post audio</title>
</head>
<body>
<style type="text/css">
	
input[type=submit] {

    color: #fff;

    background-color: green;

    border-color: #2e6da4;

	display: inline-block;

    margin-bottom: 0;

    font-weight: 400;

    text-align: center;

    white-space: nowrap;

    vertical-align: middle;

    -ms-touch-action: manipulation;

    touch-action: manipulation;

    cursor: pointer;

    background-image: none;

    border: 1px solid transparent;

    padding: 6px 12px;

    font-size: 14px;

    line-height: 1.42857143;

    border-radius: 4px;

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;

}
</style>
	<form method="post" action="audio.php" enctype="multipart/form-data" >
		<center> <br/>
			<h4>Tên ghi âm:</h4> <input type="text" id="text" name="topic_name" style="width: 300px" class="form-control form-control-lg"><br/>
			<input type="file" name="audioFile"></br>
			<input type="submit" value="Tải lên ghi âm" name="save_audio">
		</center>
		
	</form>
	
</body>
</html>
<?php

	if(isset($_POST['save_audio'])){
		$errors=array();
		$topic_name= mysqli_real_escape_string($db, $_POST['topic_name']);
		if(strlen($topic_name)==0){
			$errors[]= 'Có lẽ bạn đã quên nhập tên ghi âm';
		}
		
		$allowed_e=array('wav','WAV','mp3','ogg');
		$file_name=$_FILES['audioFile']['name'];
		$file_e=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
		if(in_array($file_e, $allowed_e)==false){
			$errors[]='Phần mở rộng của file không hợp lệ';
		}
		if(empty($errors)){
			date_default_timezone_set('Asia/Ho_Chi_Minh');
				$date=date("Y-m-d H:i:s");
			$dir='uploads/';
			$audio_path=$dir.basename($_FILES['audioFile']['name']);
		
			function saveAudio($fileName,$topic_name,$audio_creator,$date){
				$conn=mysqli_connect('localhost','root','','members');
				
				if(!$conn){
					die('Server chưa được kết nối');
				}
				
				$query="insert into audios(filename,audio_name,audio_creator,date)values('{$fileName}','$topic_name','$audio_creator','$date')";
		
				mysqli_query($conn,$query);
		
				if(mysqli_affected_rows($conn)>0){
					echo '<center>';
					echo "Tải lên tập tin âm thanh thành công~~!";
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


?>
<center>
	<br>
<p> — hoặc — </p>
<button type="button" id="start" class="btn btn-danger" style="
    margin-top: 10px;
"><i class="fas fa-microphone"></i> Tạo bản ghi âm mới</button>
<button type="button" id="stop" class="btn btn-secondary" style="
    margin-top: 10px;
"><i class="fas fa-stop-circle"></i> Dừng ghi âm</button>

<div>
	<br>

	<audio id="recorder" muted hidden></audio>

	</div>
	
	<audio id="player" controls></audio>
</div>
<br>
<a data-toggle="modal" data-target="#exampleModalCenter">Cách tải về và tải lên file ghi âm</a>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle" style="display:inline;">Cách tải về và tải lên file ghi âm</h4>
        <button type="button" class="close" style="display:inline;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="images/1.png">
<img src="images/2.png">
<img src="images/3.png" style="width: 480px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

</center>
<script>

	class VoiceRecorder {
	constructor() {
		if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
			console.log("getUserMedia supported")
		} else {
			console.log("getUserMedia is not supported on your browser!")
		}

		this.mediaRecorder
		this.stream
		this.chunks = []
		this.isRecording = false

		this.recorderRef = document.querySelector("#recorder")
		this.playerRef = document.querySelector("#player")
		this.startRef = document.querySelector("#start")
		this.stopRef = document.querySelector("#stop")
		
		this.startRef.onclick = this.startRecording.bind(this)
		this.stopRef.onclick = this.stopRecording.bind(this)

		this.constraints = {
			audio: true,
			video: false
		}
		
	}

	handleSuccess(stream) {
		this.stream = stream
		this.stream.oninactive = () => {
			console.log("Stream ended!")
		};
		this.recorderRef.srcObject = this.stream
		this.mediaRecorder = new MediaRecorder(this.stream)
		console.log(this.mediaRecorder)
		this.mediaRecorder.ondataavailable = this.onMediaRecorderDataAvailable.bind(this)
		this.mediaRecorder.onstop = this.onMediaRecorderStop.bind(this)
		this.recorderRef.play()
		this.mediaRecorder.start()
	}

	handleError(error) {
		console.log("navigator.getUserMedia error: ", error)
	}
	
	onMediaRecorderDataAvailable(e) { this.chunks.push(e.data) }
	
	onMediaRecorderStop(e) { 
			var blob = new Blob(this.chunks, { 'type': 'audio/ogg; codecs=opus' })
			const audioURL = window.URL.createObjectURL(blob)
			this.playerRef.src = audioURL
			this.chunks = []
			this.stream.getAudioTracks().forEach(track => track.stop())
			this.stream = null
	}

	startRecording() {
		if (this.isRecording) return
		this.isRecording = true
		this.startRef.innerHTML = 'Đang ghi âm...'
		this.playerRef.src = ''
		navigator.mediaDevices
			.getUserMedia(this.constraints)
			.then(this.handleSuccess.bind(this))
			.catch(this.handleError.bind(this))
	}
	
	stopRecording() {
		if (!this.isRecording) return
		this.isRecording = false
		this.startRef.innerHTML = '<i class="fas fa-microphone"></i> Tạo bản ghi âm mới'
		this.recorderRef.pause()
		this.mediaRecorder.stop()
	}
	
}

window.voiceRecorder = new VoiceRecorder()

 

  

</script>
<br>
<hr style="
    margin-left: 50px;
    margin-right: 50px;
">
<footer class="footer" style="
    margin-left: 50px;

">

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