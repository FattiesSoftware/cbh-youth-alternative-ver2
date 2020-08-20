<!-- Project name: CBH Youth Online (Đoàn trường THPT Chuyên Biên Hoà Online)
	 Project link: https://youth.fattiesoftware.com/
 	 Created by Fatties Software 2020
 	 Team members:
 	 - Duong Tung Anh (CEO/Founder - C4K60 Bien Hoa Gifted High School) | https://fb.me/tunnaduong
	 - Hoang Phat (Co-Founder/Lead Developer - A1K60 Bien Hoa Gifted High School) | https://fb.me/hoangphathandsome
	 All rights reserved 
-->
<?php
// Include GitHub API config file
require_once 'require/githubConfig.php';
// Include and initialize user class
require_once 'require/github.user.class.php';
require_once 'require/logincheck.php';
$diendan = 'active';
require('require/serverconnect.php');
require('include/header.php');
require('include/navbar.php');
require('include/style.php');
?>
<style type="text/css">
	textarea{ 
  width: 100%; 
  min-width:100%; 
  max-width:100%; 

  height:80px; 
  min-height:80px;  
  max-height:80px;
}
.tunnaduong {
	width: 55%;
    padding: 10px;
    position: relative;
    margin: 0 auto;
}
#comment {

}
#content {
	margin-top: 30px;margin-left: 100px;margin-right: 100px
}
.reply {
	width: 50%;
	position: relative;
    margin: 0 auto;
    right: -25px;
}
@media only screen and (max-width: 890px) {
#content {
	margin-left: 20px;
	margin-right: 20px;
}
	textarea{ 
  width: 100%; 
  min-width:100%; 
  max-width:100%; 

  height:60px; 
  min-height:60px;  
  max-height:60px;
}
.tunnaduong {
	width: 100%;
    padding: 10px;
    position: relative;
}
.reply {
	width: 89%;
	position: relative;
    right: -25px;
}
}
.swal2-popup {
  font-size: 1.6rem !important;
}
#comment{
    margin-top:5px;  padding: 10px;border-radius: 7px;border:1px solid #d7d8fc;background-color: #fdfdfd;
}
#avatar{
    margin-bottom: 0px;float: left;   border-radius: 50%; margin-right: 15px
}
#tunganh{
    color:#07f;font-size:11px;display:none
}
#tunna{
    color: #e8e20a;display:none
}
#dot{
    display: inline;color: #6e7abe;font-size: 12px
}
#concac{
    float: right;color: gray;
}
#texxt{
    height:60px; min-height:60px;  max-height:60px;
}
</style>
<div id="content">
<form id="myform" method="POST">
<div class="form-group tunnaduong" style="overflow: hidden">
    <label for="exampleFormControlTextarea1">Bình luận</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" placeholder="Bạn nghĩ gì về bài viết này?" rows="3"></textarea>
    <button type="submit" name="submit" id="sendcomment" class="btn btn-primary" style="margin-top: 10px;float: right;">
    <i class="fas fa-paper-plane"></i> Gửi bình luận
	</button>







	<?php
		$str = (isset($_POST['comment']) ? $_POST['comment'] : '');
		$content_m = nl2br($str);
		$comment = mysqli_real_escape_string($db, $content_m);
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$date=date("Y-m-d H:i:s");
if(isset($_POST['submit'])){
			if($comment)

			{

				if(strlen($comment)>=10){

					$query = "INSERT INTO forum_comments (content, topic_id, author, date) 

								VALUES('$comment', '69', '$usen', '$date')";

					mysqli_query($db, $query);

					echo "<p style='color:green;margin-top: 5px;' id='result'>Đăng bình luận thành công!</p>";

				}else{

					echo "<p style='color:red;margin-top: 5px;' id='result'>Bình luận quá ngắn! (>10 kí tự)</p>";
				}

			}else{

				echo "<p style='color:red;margin-top: 5px;' id='result'>Bạn thiếu nội dung bình luận</p>";

			}
		}

		if(isset($_GET['action'])){
			if (isset($_SESSION['loggedin'])) {
			$comment_like_id = $_GET['id'];
			$action = $_GET['action'];
			$user_liked = $_SESSION['id'];
			switch ($action) {
				case 'like':
				$query_like = "INSERT INTO rating_info (comment_id, user_id, rating_action) VALUES ($comment_like_id, $user_liked, 'like') ON DUPLICATE KEY UPDATE rating_action='like'";
				break;
				case 'unlike':
				$query_like = "DELETE FROM rating_info WHERE comment_id = $comment_like_id AND user_id = $user_liked";
				break;
			}
			mysqli_query($db, $query_like);
			} else {
				$login = '/login';
	echo "<script>Swal.fire({
  icon: 'error',
  title: 'Không thể thực hiện tác vụ',
  text: 'Bạn chưa đăng nhập. Hãy đăng nhập để bày tỏ cảm xúc đối với bình luận này',
  footer: '<a href=$login>Đăng nhập</a>'
})</script>";
}
		}


$str2 = (isset($_POST['reply_comment']) ? $_POST['reply_comment'] : '');
		$content_m = nl2br($str2);
		$reply_comment = mysqli_real_escape_string($db, $content_m);
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$date=date("Y-m-d H:i:s");
if(isset($_POST['submit2'])){
	$reply_to_comment_id = $_POST['replying-to-comment-id'];
			if($reply_comment)
			{

				if(strlen($reply_comment)>=10){

					$query = "INSERT INTO forum_comments (content, topic_id, author, parent_comment_id, date) 

								VALUES('$reply_comment', '69', '$usen', '$reply_to_comment_id', '$date')";

					mysqli_query($db, $query);

					$error_reply = "<p style='color:green;margin-top: 15px;float:right' id='result'>Đăng trả lời thành công!</p>";

				}else{

					$error_reply = "<p style='color:red;margin-top: 15px;float:right' id='result'>Trả lời quá ngắn! (>10 kí tự)</p>";
				}

			}else{

				$error_reply = "<p style='color:red;margin-top: 15px;float:right' id='result'>Bạn thiếu nội dung trả lời</p>";

			}
		} else {
			$error_reply = "";
		}



// Get total number of likes for a particular post
function getLikes($id)
{
  global $db;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE comment_id = $id AND rating_action='like'";
  $rs = mysqli_query($db, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}
?>
  </div>
</form>
<div class="outer">
<?php

			// Check if user already likes post or not
function userLiked($comment_id)
{
	global $db;
	if (isset($_SESSION['loggedin'])) {
	$user_id2 = $_SESSION['id'];

  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id2 
  		  AND comment_id=$comment_id AND rating_action='like'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}else{
	return false;
}
}
if(isset($_POST['submit2'])){
$commentid2 = $_POST['replying-to-comment-id'];
} else {
	$commentid2 = '0';
}

function listComment(){
	global $db;
	global $error_reply;
	global $commentid2;
$query = "SELECT * FROM forum_comments WHERE topic_id='69' AND parent_comment_id=0";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results)){
			while($row=mysqli_fetch_assoc($results)){
				$comment_content=$row['content'];
				$comment_date = $row['date'];
				$comment_id = $row['id'];
				
				$query_u = "SELECT * FROM accounts WHERE username=''";
				$results_u = mysqli_query($db, $query_u);
				if (mysqli_num_rows($results_u)) {
				while($row_u=mysqli_fetch_assoc($results_u)){

					$name = $row_u['name'];
					$profile_pic = $row_u['profile_pic'];
					$user_id = $row_u['id'];
					$veri = $row_u['verified'];
					$is_admin = $row_u['permission'];	
				} 
			}else {
					$name = 'Ẩn danh';
					$profile_pic = 'images/ano.png';
					$user_id = 'unknown';
					$veri = 'no';
					$is_admin = 'guest';	
			}
				echo "
				<div class='tunnaduong id' id='comment' style='margin-top:5px;  padding: 10px;border-radius: 7px;border:1px solid #d7d8fc;background-color: #fdfdfd;' data-commentid=''>
	<a href='/profile.php?id='><img src='/' width='30' height='30' style='margin-bottom: 0px;float: left;   border-radius: 50%; margin-right: 15px'></a>
<a href='/profile.php?id='><b>$name</b></a> <i id='tunganh'  data-toggle='tooltip' title='Tài khoản đã xác minh' style='color:#07f;font-size:11px;display:none' class='fas fa-check-circle'></i> <p data-toggle='tooltip' id='tunna'style='color: #e8e20a;display:none' title='Quản trị viên đã xác minh'><i class='fas fa-crown'></i> Quản trị viên</p>
<p>$comment_content</p>
<a ";
if (userLiked($comment_id)==1){
      		echo "href='?action=unlike&id=' style='font-weight: bold;'";
      		 }else{
      		 	echo "href='?action=like&id='";
      	}
 echo " data-id='' id='likebutton' ><!-- if user likes topic, style button differently -->
      	<i ";
      	if (userLiked($comment_id)==1){
      		echo "class='fas fa-heart'";
      		 }else{
      		 	echo "class='far fa-heart'";
      	}
      	echo " id='like-btn' class='like-btn'></i> Thích (<span class='likes'>getLikes($comment_id)</span>)</a> <p style='display: inline;color: #6e7abe;font-size: 12px'> 󠀠 •󠀠  </p> 󠀠 <a role='button' onclick='replycommentfunc()' id='replytocomment'><i class='far fa-comment-dots'></i> Trả lời</a><a role='button' onclick='hidereplycommentfunc()' id='replytocomment2' style='display:none;'><i class='far fa-comment-dots'></i> Trả lời</a>
<p id='concac' style='float: right;color: gray;'>$comment_date</p>
<p style='display: inline;color: #6e7abe;font-size: 12px'> 󠀠 • 󠀠 </p>
<a href='#'><i class='far fa-flag'></i> Báo xấu</a>

<div id='replycomment' style='display:none'>
<form method='POST'>
    <textarea style=' height:60px; min-height:60px;  max-height:60px;' class='form-control' id='exampleFormControlTextarea1' name='reply_comment' placeholder='Đang trả lời bình luận' rows='2'></textarea>
    <input type='text' name='replying-to-comment-id' value='' style='display:none'></input>
    <button type='submit' name='submit2' id='sendcomment' class='btn btn-primary' style='margin-top: 10px;'>
    <i class='fas fa-paper-plane'></i> Gửi bình luận
	</button>
	$error_reply
	</form>
	</div>
	<div id='replyto'></div>
</div>

<script>
var veri = '$veri';
			if (veri == 'yes') {
				document.getElementById('tunganh').style.display = 'inline';
			} 
			var admin = '$is_admin';
			if (admin == 'admin') {
				document.getElementById('tunna').style.display = 'inline';
			} 
			moment.locale('vi');
			document.getElementById('concac').innerHTML =moment('$comment_date', 'YYYY-MM-DD h:m:s').fromNow();
function replycommentfunc(){
	document.getElementById('replycomment').style.display = 'block';
	document.getElementById('replytocomment').style.display = 'none';
	document.getElementById('replytocomment2').style.display = 'inline';
	
}
function hidereplycommentfunc(){
	document.getElementById('replycomment').style.display = 'none';
	document.getElementById('replytocomment2').style.display = 'none';
	document.getElementById('replytocomment').style.display = 'inline';
}
replycommentfunc$commentid2();
</script>

";
listReplies($comment_id);
}
$parent_cmt_id = $row['parent_comment_id'];
		} else {
			echo "<center><p style='color: gray;margin-top: 10px'><i class='far fa-flag'></i><br>Hãy trở thành người đầu tiên bình luận cho bài viết này!</p></center>";
		}
}

listComment();

function listReplies($commentIDdauBuoi){
		global $db;
		global $parent_cmt_id;
$query2 = "SELECT * FROM forum_comments WHERE topic_id='69' and parent_comment_id<>0";
		$results2 = mysqli_query($db, $query2);
		if (mysqli_num_rows($results2)){
			while($row2=mysqli_fetch_assoc($results2)){
				$comment_content2=$row2['content'];
				$comment_date2 = $row2['date'];
				$comment_id2 = $row2['id'];
				$author1 = $row2['author'];
				$query_u2 = "SELECT * FROM accounts WHERE username='$author1'";
				$results_u2 = mysqli_query($db, $query_u2);
				if (mysqli_num_rows($results_u2)) {
				while($row_u2=mysqli_fetch_assoc($results_u2)){

					$name2 = $row_u2['name'];
					$profile_pic2 = $row_u2['profile_pic'];
					$user_id2 = $row_u2['id'];
					$veri2 = $row_u2['verified'];
					$is_admin2 = $row_u2['permission'];	
				} 
			}else {
					$name2 = 'Ẩn danh';
					$profile_pic2 = 'images/ano.png';
					$user_id2 = 'unknown';
					$veri2 = 'no';
					$is_admin2 = 'guest';	
			}
}

echo "<div class='tunnaduong id' id='comment$comment_id2' style='margin-top:5px;  padding: 10px;border-radius: 7px;border:1px solid #d7d8fc;background-color: #fdfdfd;' data-commentid='$comment_id2'>
	<a href='/profile.php?id=$user_id2'><img src='/$profile_pic2' width='30' height='30' style='margin-bottom: 0px;float: left;   border-radius: 50%; margin-right: 15px'></a>
<a href='/profile.php?id=$user_id2'><b>$name2</b></a> <i id='tunganh$comment_id2'  data-toggle='tooltip' title='Tài khoản đã xác minh' style='color:#07f;font-size:11px;display:none' class='fas fa-check-circle'></i> <p data-toggle='tooltip' id='tunna$comment_id2'style='color: #e8e20a;display:none' title='Quản trị viên đã xác minh'><i class='fas fa-crown'></i> Quản trị viên</p>
<p>$comment_content2</p>
<a ";
if (userLiked($comment_id2)==1){
      		echo "href='?action=unlike&id=$comment_id2' style='font-weight: bold;'";
      		 }else{
      		 	echo "href='?action=like&id=$comment_id2'";
      	}
 echo " data-id='$comment_id2' id='likebutton$comment_id2' ><!-- if user likes topic, style button differently -->
      	<i ";
      	if (userLiked($comment_id2)==1){
      		echo "class='fas fa-heart'";
      		 }else{
      		 	echo "class='far fa-heart'";
      	}
      	echo " id='like-btn$comment_id2' class='like-btn'></i> Thích (<span class='likes'>getLikes($comment_id2)</span>)</a> <p style='display: inline;color: #6e7abe;font-size: 12px'> 󠀠 •󠀠  </p> 󠀠 <a role='button' onclick='replycommentfunc$comment_id2()' id='replytocomment$comment_id2'><i class='far fa-comment-dots'></i> Trả lời</a><a role='button' onclick='hidereplycommentfunc$comment_id2()' id='replytocomment$comment_id22' style='display:none;'><i class='far fa-comment-dots'></i> Trả lời</a>
<p id='concac2$comment_id2' style='float: right;color: gray;'>$comment_date2</p>
<p style='display: inline;color: #6e7abe;font-size: 12px'> 󠀠 • 󠀠 </p>
<a href='#'><i class='far fa-flag'></i> Báo xấu</a>
</div>
<script>
var veri$comment_id2 = '$veri2';
			if (veri$comment_id2 == 'yes') {
				document.getElementById('tunganh$comment_id2').style.display = 'inline';
			} 
			var admin$comment_id2 = '$is_admin2';
			if (admin$comment_id2 == 'admin') {
				document.getElementById('tunna$comment_id2').style.display = 'inline';
			} 
			moment.locale('vi');
			document.getElementById('concac2$comment_id2').innerHTML =moment('$comment_date2', 'YYYY-MM-DD h:m:s').fromNow();
</script>
";


}


}




?>

<style type="text/css">
	ul {
	list-style-type: none;
}
</style>
<ul>
	<li>
		Comment1
		<ul>Reply CMT1
			<ul>Reply CMT11</ul>
		</ul>
	</li>
	<li>
		Comment2
	</li>
</ul>
<div id="output"></div>






<div class='tunnaduong id' id='comment' data-commentid=''>
	<div id="upperpart">
<a href='/profile.php?id='><img src='/' width='30' height='30' id="avatar"></a>
<a href='/profile.php?id='><b>Duong Tung Anh</b></a> <i id='tunganh'  data-toggle='tooltip' title='Tài khoản đã xác minh' class='fas fa-check-circle'></i> <p data-toggle='tooltip' id='tunna' title='Quản trị viên đã xác minh'><i class='fas fa-crown'></i> Quản trị viên</p>
</div>
<div id="comment_noidung">
<p>Comment Content...</p>
</div>
<div id="bottompart">
<a href='?action=like&id=' data-id='' id='likebutton' >
<i class='far fa-heart' id='like-btn' class='like-btn'></i> Thích (<span class='likes'>1</span>)</a> <p id="dot"> 󠀠 •󠀠  </p> 󠀠 <a role='button' onclick='replycommentfunc()' id='replytocomment'><i class='far fa-comment-dots'></i> Trả lời</a><a role='button' onclick='hidereplycommentfunc()' id='replytocomment2' style='display:none;'><i class='far fa-comment-dots'></i> Trả lời</a>
<p id='concac'>2020</p>
<p id="dot"> 󠀠 • 󠀠 </p>
<a href='#'><i class='far fa-flag'></i> Báo xấu</a>
</div>
<div id='replycommentpart' style='display:none'>
<form method='POST'>
 <textarea class='form-control' id='texxt' name='reply_comment' placeholder='Đang trả lời bình luận' rows='2'></textarea>
    <input type='text' name='replying-to-comment-id' value='' style='display:none'></input>
    <button type='submit' name='submit2' id='sendcomment' class='btn btn-primary' style='margin-top: 10px;'>
    <i class='fas fa-paper-plane'></i> Gửi bình luận
	</button>
</form>
</div>
</div>

<script>
var veri = '$veri';
			if (veri == 'yes') {
				document.getElementById('tunganh').style.display = 'inline';
			} 
			var admin = '$is_admin';
			if (admin == 'admin') {
				document.getElementById('tunna').style.display = 'inline';
			} 
			moment.locale('vi');
			document.getElementById('concac').innerHTML =moment('$comment_date', 'YYYY-MM-DD h:m:s').fromNow();
function replycommentfunc(){
	document.getElementById('replycommentpart').style.display = 'block';
	document.getElementById('replytocomment').style.display = 'none';
	document.getElementById('replytocomment2').style.display = 'inline';
	
}
function hidereplycommentfunc(){
	document.getElementById('replycommentpart').style.display = 'none';
	document.getElementById('replytocomment2').style.display = 'none';
	document.getElementById('replytocomment').style.display = 'inline';
}
replycommentfunc$commentid2();
</script>







</div>
<hr>
<?php require('include/footer.php');?> 


</div>
<!--Thuật toán sắp xếp danh sách bài viết theo thứ tự giảm dần qua id bài viết-->
<script>
	 $(document).ready(function(){
            // Main function 

           function GFG_Fun()  
            { 
                var $wrap = $('.outer'); 
                $wrap.find('.id').sort(function(a, b)  
                    { 
                        return +b.dataset.commentid - 
                            +a.dataset.commentid; 
                    }) 
                    .appendTo($wrap); 
            } 
            GFG_Fun()
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>




