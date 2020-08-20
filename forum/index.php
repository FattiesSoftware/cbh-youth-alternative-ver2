<!-- Project name: CBH Youth Online (Đoàn trường THPT Chuyên Biên Hoà Online)
	 Project link: https://youth.fattiesoftware.com/
 	 Created by Fatties Software 2020
 	 Team members:
 	 - Duong Tung Anh (CEO/Founder - C4K60 Bien Hoa Gifted High School) | https://fb.me/tunnaduong
	 - Hoang Phat (Co-Founder/Lead Developer - A1K60 Bien Hoa Gifted High School) | https://fb.me/hoangphathandsome
	 All rights reserved 
-->
<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Include GitHub API config file
require_once 'require/githubConfig.php';

// Include and initialize user class
require_once 'require/github.user.class.php';
$user = new User();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	$WELCOME = 'Bạn chưa đăng nhập! Hãy đăng nhập để tham gia thảo luận.';
	$PROP = 'none';
	$OUT = 'none';
} else {
	$WELCOME = '';
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';

// Create connection
require('require/serverconnect.php');
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
?>


	<body class="loggedin">
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
.content > p, .content > div {
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

<?php
$diendan = 'active';
require "include/navbar.php";
require "include/style.php";



?>

<?php ini_set('default_charset', 'utf-8'); ?>
		<div class="content">
			<h2>Diễn đàn</h2>
			<p style="display:<?=$IN?>"><?=$WELCOME?></p>
			<p style="display:<?=$OUT?>">Chào mừng, <?=$nam?>!
			<br>
				<button style="float:right" type="button" class="btn btn-danger" onClick="window.location.reload();"><i class="fas fa-redo-alt"></i> Tải lại</button>
			<?php
			
function rebuild_date( $format, $time = 0 )
{
    if ( ! $time ) $time = time();

	$lang = array();
	$lang['sun'] = 'CN';
	$lang['mon'] = 'T2';
	$lang['tue'] = 'T3';
	$lang['wed'] = 'T4';
	$lang['thu'] = 'T5';
	$lang['fri'] = 'T6';
	$lang['sat'] = 'T7';
	$lang['sunday'] = 'Chủ nhật';
	$lang['monday'] = 'Thứ hai';
	$lang['tuesday'] = 'Thứ ba';
	$lang['wednesday'] = 'Thứ tư';
	$lang['thursday'] = 'Thứ năm';
	$lang['friday'] = 'Thứ sáu';
	$lang['saturday'] = 'Thứ bảy';
	$lang['january'] = 'Tháng Một';
	$lang['february'] = 'Tháng Hai';
	$lang['march'] = 'Tháng Ba';
	$lang['april'] = 'Tháng Tư';
	$lang['may'] = 'Tháng Năm';
	$lang['june'] = 'Tháng Sáu';
	$lang['july'] = 'Tháng Bảy';
	$lang['august'] = 'Tháng Tám';
	$lang['september'] = 'Tháng Chín';
	$lang['october'] = 'Tháng Mười';
	$lang['november'] = 'Tháng M. một';
	$lang['december'] = 'Tháng M. hai';
	$lang['jan'] = 'T01';
	$lang['feb'] = 'T02';
	$lang['mar'] = 'T03';
	$lang['apr'] = 'T04';
	$lang['may2'] = 'T05';
	$lang['jun'] = 'T06';
	$lang['jul'] = 'T07';
	$lang['aug'] = 'T08';
	$lang['sep'] = 'T09';
	$lang['oct'] = 'T10';
	$lang['nov'] = 'T11';
	$lang['dec'] = 'T12';

    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
    $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );
    $return = date( $format, $time );

    $replaces = array(
        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
        '/Monday(\W|$)/' => $lang['monday'] . "$1",
        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
        '/Friday(\W|$)/' => $lang['friday'] . "$1",
        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
        '/January(\W|$)/' => $lang['january'] . "$1",
        '/February(\W|$)/' => $lang['february'] . "$1",
        '/March(\W|$)/' => $lang['march'] . "$1",
        '/April(\W|$)/' => $lang['april'] . "$1",
        '/May(\W|$)/' => $lang['may'] . "$1",
        '/June(\W|$)/' => $lang['june'] . "$1",
        '/July(\W|$)/' => $lang['july'] . "$1",
        '/August(\W|$)/' => $lang['august'] . "$1",
        '/September(\W|$)/' => $lang['september'] . "$1",
        '/October(\W|$)/' => $lang['october'] . "$1",
        '/November(\W|$)/' => $lang['november'] . "$1",
        '/December(\W|$)/' => $lang['december'] . "$1" );

    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
$contents = 'Bây giờ là: ' . rebuild_date('H:i l, d/m/Y' ) . '<br />';
 echo $contents;



?>
<style>
	#moinhat {
  padding: 10px;
  border-radius: 7px;
border:1px solid #d7edfc;
  background-color: #f0f7fc;
}
@media only screen and (max-width: 590px) {
.moinhat {
	display: none;
}
}
</style>
	<style type="text/css">
		/* Style the list */
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}

/* Display list items side by side */
ul.breadcrumb li {
  display: inline;
  font-size: 14px;
}

/* Add a slash symbol (/) before/behind each list item */
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}

/* Add a color to all links inside the list */
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}

/* Add a color on mouse-over */
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}

	</style>
<center><a href="post.php" style="float: right;"><button type="button" class="btn btn-success"><i class="fas fa-edit"></i> Đăng bài viết mới</button></a><br/><br/></center>
		<ul class="breadcrumb" style="margin-bottom: 0px;">
  <li><a href="/">Trang chủ</a></li>
  <li>Diễn đàn</li>
</ul>
	<center>
		<?php
require('require/serverconnect.php');
  if ($conn->connect_error) {
      die("kết nối thất bại " . $conn->connect_error);
    } 
  $sql = "SELECT * FROM topics WHERE category='hoctap'";
  $result = $conn->query($sql);
 $rows = mysqli_num_rows($result);
  $sql2 = "SELECT * FROM topics WHERE category='giaitri'";
  $result2 = $conn->query($sql2);
 $rows2 = mysqli_num_rows($result2);
 $sql3 = "SELECT * FROM topics WHERE category='timdo'";
  $result3 = $conn->query($sql3);
 $rows3 = mysqli_num_rows($result3);
  $totalhoctap = $rows;
$totalgiaitri = $rows2;
$totaltimdo = $rows3;
//HỌC TẬP
 $sql4 = "SELECT * FROM topics WHERE category='hoctap' ORDER BY topic_id DESC LIMIT 1;";
  $result4 = $conn->query($sql4) or die($conn->error);
    while($rowa = $result4->fetch_assoc()) {
      $latest_name = $rowa['topic_name'];
      $latest_date = $rowa['date'];
      $post_id = $rowa['topic_id'];
      $post_author = $rowa['topic_creator'];
    }
   $sql5 = "SELECT * FROM accounts WHERE username='$post_author';";
    $result5 = $conn->query($sql5) or die($conn->error);
    while($rowa1 = $result5->fetch_assoc()) {
       $author_id = $rowa1['id'];
       $veri = $rowa1['verified'];  
    }
//GIẢI TRÍ
     $sql6 = "SELECT * FROM topics WHERE category='giaitri' ORDER BY topic_id DESC LIMIT 1;";
  $result6 = $conn->query($sql6) or die($conn->error);
    while($rowa2 = $result6->fetch_assoc()) {
      $latest_name2 = $rowa2['topic_name'];
      $latest_date2 = $rowa2['date'];
      $post_id2 = $rowa2['topic_id'];
      $post_author2 = $rowa2['topic_creator'];
    
   $sql7 = "SELECT * FROM accounts WHERE username='$post_author2';";
    $result7 = $conn->query($sql7) or die($conn->error);
    while($rowa3 = $result7->fetch_assoc()) {
       $author_id2 = $rowa3['id'];
       $veri1 = $rowa3['verified'];  
    }
    }
//TÌM ĐỒ
    $sql8 = "SELECT * FROM topics WHERE category='timdo' ORDER BY topic_id DESC LIMIT 1;";
  $result8 = $conn->query($sql8) or die($conn->error);
    while($rowa3 = $result8->fetch_assoc()) {
      $latest_name3 = $rowa3['topic_name'];
      $latest_date3 = $rowa3['date'];
      $post_id3 = $rowa3['topic_id'];
      $post_author3 = $rowa3['topic_creator'];
    }
   $sql9 = "SELECT * FROM accounts WHERE username='$post_author3';";
    $result9 = $conn->query($sql9) or die($conn->error);
    while($rowa4 = $result9->fetch_assoc()) {
       $author_id3 = $rowa4['id'];
       $veri2 = $rowa4['verified'];  
    }
    //Tắt thông báo lỗi php
error_reporting(0);
@ini_set('display_errors', 0);
    ?>
		<table class="table table-hover" style="background-color: white;">
  <tbody>
    <tr>
      <td width="20" style="padding-top: 13px;"><i class="fas fa-comments" style="font-size: 24px;margin-top: 8px;color: #337ab7;"></i></td>
      <td style="padding-top: 13px;"><b><a href="hoctap">Học tập</a></b><br><p style="color: gray;display: inline;">Bài viết:</p> <?php echo $totalhoctap ?> <p style="color: gray;display: inline;">Bình luận:</p> 0</td>
      <td class="moinhat" width="300"><div id="moinhat" style="height: 55px;padding-top: 7px;">
  <p style="margin-bottom: 0px; font-size: 12px;display: inline;">Mới nhất: <a id="isValid12" href="hoctap/topic.php?id=<?php echo $post_id?>"></a><br><a href="/profile.php?id=<?php echo $author_id?>"><?php echo $post_author?> <i id='tunganh'  data-toggle='tooltip' title='Tài khoản đã xác minh' style='color:#07f;font-size:11px;display:none' class='fas fa-check-circle'></i></a>, <p id="isValid1" style="color: gray;display: inline; font-size: 12px">

<script>
  yourString = '<?php echo $latest_name?>'
  var result = yourString.substring(0, 33) + '...';
  document.getElementById("isValid12").innerHTML = result;
	moment.locale('vi');
	document.getElementById("isValid1").innerHTML = moment("<?php echo $latest_date?>", "YYYY-MM-DD h:m:s").fromNow();
  var veri = '<?php echo $veri ?>';
            if (veri == 'yes'){
              document.getElementById('tunganh').style.display = 'inline';
            }else {
              document.getElementById("tunganh").style.display = "none";
            }
</script></p></p></div></td>
    </tr>
    <tr>
      <td style="padding-top: 13px;"><i class="fas fa-comments" style="font-size: 24px;margin-top: 8px;color: #337ab7;"></i></td>
      <td style="padding-top: 13px;"><b><a href="giaitri">Giải trí</a></b><br><p style="color: gray;display: inline;">Bài viết:</p> <?php echo $totalgiaitri ?> <p style="color: gray;display: inline;">Bình luận:</p> 0</td>
      <td class="moinhat"><div id="moinhat" style="height: 55px;padding-top: 7px;">
  <p style="margin-bottom: 0px; font-size: 12px;display: inline;">Mới nhất: <a id="isValid21" href="hoctap/topic.php?id=<?php echo $post_id2?>"></a><br><a href="/profile.php?id=<?php echo $author_id2?>"><?php echo $post_author2?> <i id='tunganh2'  data-toggle='tooltip' title='Tài khoản đã xác minh' style='color:#07f;font-size:11px;display:none;display:inline' class='fas fa-check-circle'></i></a></a>, <p id="isValid2" style="color: gray;display: inline; font-size: 12px">
<script>
  yourString2 = '<?php echo $latest_name2?>'
  var result2 = yourString2.substring(0, 33) + '...';
  document.getElementById("isValid21").innerHTML = result2;
  moment.locale('vi');
  document.getElementById("isValid2").innerHTML = moment("<?php echo $latest_date2?>", "YYYY-MM-DD h:m:s").fromNow();
  if (document.getElementById("isValid2").innerHTML == 'Invalid date') {
    document.getElementById("isValid2").innerHTML = 'Không có bài viết nào'
  }
   var veri2 = '<?php echo $veri1 ?>';
            if (veri2 == 'yes'){
              document.getElementById('tunganh2').style.display = 'inline';
            }else {
              document.getElementById("tunganh2").style.display = "none";
            }
</script></p></p>



</div>

</td>
    </tr>
    <tr>

 <td style="padding-top: 13px;"><i class="fas fa-comments" style="font-size: 24px;margin-top: 8px;color: #337ab7;"></i></td>
      <td style="padding-top: 13px;"><b><a href="timdo">Tìm đồ thất lạc</a></b><br><p style="color: gray;display: inline;">Bài viết:</p> <?php echo $totaltimdo ?> <p style="color: gray;display: inline;">Bình luận:</p> 0</td>

      <td class="moinhat"><div id="moinhat" style="height: 55px;padding-top: 7px;">
  <p style="margin-bottom: 0px; font-size: 12px;display: inline;">Mới nhất: <a id="isValid31" href="hoctap/topic.php?id=<?php echo $post_id3?>"></a><br><a href="http://localhost/profile.php?id=<?php echo $author_id3?>"><?php echo $post_author3?> <i id='tunganh3'  data-toggle='tooltip' title='Tài khoản đã xác minh' style='color:#07f;font-size:11px;display:none;display:inline' class='fas fa-check-circle'></i></a>, <p id="isValid3" style="color: gray;display: inline; font-size: 12px">
<?php echo $latest_name3 ?>
<script>
	yourString3 = '<?php echo $latest_name3 ?>'
  var result3 = yourString3.substring(0, 33) + '...';
  document.getElementById("isValid31").innerHTML = result3;
  moment.locale('vi');
  document.getElementById("isValid3").innerHTML = moment("<?php echo $latest_date3?>", "YYYY-MM-DD h:m:s").fromNow();
  if (document.getElementById("isValid3").innerHTML == 'Invalid date') {
    document.getElementById("isValid3").innerHTML = 'Không có bài viết nào'
  }
   var veri3 = '<?php echo $veri2 ?>';
            if (veri3 == 'yes'){
              document.getElementById('tunganh3').style.display = 'inline';
            }else {
              document.getElementById("tunganh3").style.display = "none";
            }
</script></p></p></div></td>
    </tr>
  </tbody>
</table>
	</center>
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
<!--Thuật toán sắp xếp danh sách bài viết theo thứ tự giảm dần qua id bài viết-->
<script>
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (Number(y.innerHTML) > Number(x.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
sortTable()
</script>

</center>
<?php
	require "include/footer.php";
	?>
</div>
</body>
</html>
