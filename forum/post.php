<!-- Project name: CBH Youth Online (Đoàn trường THPT Chuyên Biên Hoà Online)
   Project link: https://youth.fattiesoftware.com/
   Created by Fatties Software 2020
   Team members:
   - Duong Tung Anh (CEO/Founder - C4K60 Bien Hoa Gifted High School) | https://fb.me/tunnaduong
   - Hoang Phat (Co-Founder/Lead Developer - A1K60 Bien Hoa Gifted High School) | https://fb.me/hoangphathandsome
   All rights reserved 
-->
<?php

	session_start();
/////////////////////////////////////////////
// Include GitHub API config file
require_once 'require/githubConfig.php';

// Include and initialize user class
require_once 'require/github.user.class.php';
	require('require/serverconnect.php');
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

} else {

header('location: /login');

}

} else {

	$usen = $_SESSION['username'];

	$NOTICE = 'none';

		$WELCOME = '';

	$PROP = 'block';

	$IN = 'none';

	$OUT = 'block';

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


@media only screen and (max-width: 790px) {


.content {

	width: auto;

	margin: 0 auto;

    padding-left: 25px;

    padding-right: 25px;



}

}

</style>

	<style>

body.loggedin {

	background-color: #f3f4f7;

}

.content h2 {

	margin: 0;

	padding: 25px 0;

	font-size: 22px;

	border-bottom: 1px solid #e0e0e3;

	color: #4a536e;
    padding-left: 25px;

    padding-right: 25px;
}

.content {
	width: auto;

	margin: 0 auto;
	padding-left: 25px;

    padding-right: 25px;
}







input[type=submit] {

    color: #fff;

    background-color: red;

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


<div class="content" onkeyup="myFunction()">

	<form action="post.php" method="POST" id="form1">



			<div class="form-group">

    <label for="exampleFormControlInput1">Tiêu đề bài viết</label>

    <input type="text" id="text" name="topic_name" class="form-control form-control-lg" onkeyup="myFunction()">

  </div>
<div class="form-group">
                        <label>Chuyên mục</label>
                        <div class="dropdown bootstrap-select form-control bs3"><select class="selectpicker form-control" data-live-search="true" name="chuyenmuc" tabindex="-98">

          <optgroup label="Học tập">
            <option value="hoctap">Học tập</option>
          </optgroup>
          <optgroup label="Giải trí">
            <option value="giaitri">Giải trí</option>

          </optgroup>
          <optgroup label="Khác">
            <option value="timdo">Tìm đồ thất lạc</option>

          </optgroup>
          </select>
                      </div>
			<div class="form-group">
<br>
    <label for="exampleFormControlTextarea1">Nội dung bài viết</label>

<textarea name="content" id="text2" onkeyup="myFunction()"></textarea>

<script>
$('textarea').trumbowyg()
function myFunction(){
	document.getElementById("submitbutton").style.display = "none";
document.getElementById("confirm").style.display = "block";
}
</script>

  </div>

			<button type="button" id="confirm" class="btn btn-warning" onclick="return validate_text();"><i class="fas fa-check-circle"></i> Xác nhận đăng</button>
			<input type="submit" id="submitbutton" name="submit" style="display: none;" value="Đăng bài viết">

<!--Thuật toán chặn các từ ngữ tục tĩu-->
<script>
	// Các từ sẽ bị chặn ở dòng dưới
var swear_words_arr=new Array("địt","lồn","cặc","buồi","cứt","chó","vãi","địt mẹ","chim","bướm","dái","vcl","đcm","đkm","đm","dkm","dcm","clgt");

var swear_alert_arr=new Array;
var swear_alert_count=0;
function reset_alert_count()
{
 swear_alert_count=0;
}
function validate_text()
{
 reset_alert_count();
 var compare_text=document.getElementById("text").value;
  var compare_text2=document.getElementById("text2").value;
 for(var i=0; i<swear_words_arr.length; i++)
 {
  for(var j=0; j<(compare_text.length); j++)
  {
   if(swear_words_arr[i]==compare_text.substring(j,(j+swear_words_arr[i].length)).toLowerCase())
   {
    swear_alert_arr[swear_alert_count]=compare_text.substring(j,(j+swear_words_arr[i].length));
    swear_alert_count++;
   }
  }
  for(var j=0; j<(compare_text2.length); j++)
  {
   if(swear_words_arr[i]==compare_text2.substring(j,(j+swear_words_arr[i].length)).toLowerCase())
   {
    swear_alert_arr[swear_alert_count]=compare_text2.substring(j,(j+swear_words_arr[i].length));
    swear_alert_count++;
   }
  }
 }
 var alert_text="";
 for(var k=1; k<=swear_alert_count; k++)
 {
  alert_text+="\n" + "(" + k + ")  " + swear_alert_arr[k-1];
 }
 
 if(swear_alert_count>0)
 {
  alert("Bài viết sẽ không được gửi đi!!!\nLý do chặn: Tìm thấy từ ngữ không cho phép sau đây:\n_______________________________\n" + alert_text + "\n_______________________________\nTrang web sẽ được tải lại sau khi ấn OK");
  location.reload();
  document.form1.text.select();
 }
 else
 {
document.getElementById("submitbutton").style.display = "block";
document.getElementById("confirm").style.display = "none";
 }
}
function select_area()
{
 document.form1.text.select();
}
window.onload=reset_alert_count;
</script>



	</form>

</body>

</html>



<?php


$str = (isset($_POST['content']) ? $_POST['content'] : '');
$content_m = nl2br($str);
	if(isset($_POST['submit'])){

		$topic_name= mysqli_real_escape_string($db, $_POST['topic_name']);
    $cat = $_POST['chuyenmuc'];
		$content = mysqli_real_escape_string($db, $content_m);
date_default_timezone_set('Asia/Ho_Chi_Minh');
		$date=date("Y-m-d H:i:s");

		if(isset($_POST['submit'])){
			if($topic_name&&$content)

			{

				if(strlen($topic_name)>=10){

					$query = "INSERT INTO topics (topic_name, topic_content, topic_creator, date, category) 

								VALUES('$topic_name', '$content', '".$usen."', '$date', '$cat')";

					mysqli_query($db, $query);

					echo "<p style='color:red'>Đăng bài viết thành công !</p>";

				}else{

					echo "<p style='color:red'>Tiêu đề quá ngắn! (>10 kí tự)</p>";
				}

			}else{

				echo "<p style='color:red'>Bạn thiếu tiêu đề / nội dung</p>";

			}
		
			
		
		}

		

		

		

	

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