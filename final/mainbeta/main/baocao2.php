<?php
	session_start();
	require('connect.php');
	if ($_SESSION['username']) {
		$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
		$results = mysqli_query($db, $query);
		$rows= mysqli_num_rows($results);
		while($row = mysqli_fetch_assoc($results)){
			$xungkich=$row['xungkich'];
		}
		if($xungkich==1){
			date_default_timezone_set('Asia/Ho_Chi_Minh');
	if(@$_GET['class']){
	$loi=array();
	$student=array() ;
	$tong =0;
	$list_loi= array (
		1=>"Lỗi 1",
		2=>"Lỗi 2",
		3=>"Lỗi 3",
	);
	if($_SERVER['REQUEST_METHOD']=="POST"){
	$errors = array(); 
	if(empty($_POST['student'])){
		$error['pay']= "Bạn cần chọn học sinh báo cáo <3";
	}
	if(isset($_POST['submit']))
	{
		$loi_1s=$_POST['loi_1s'];
		$loi_2s=$_POST['loi_2s'];
		$loi_3s=$_POST['loi_3s'];
	}
	if(isset($_POST['loi'])){
		foreach($_POST['loi'] as $v){
			if ($list_loi[$v]=="Lỗi 1") $tong=$tong+5*$loi_1s;
			if ($list_loi[$v]=="Lỗi 2") $tong=$tong+5*$loi_2s;
			if ($list_loi[$v]=="Lỗi 3") $tong=$tong+5*$loi_3s;
			$loi[]=$list_loi[$v];
		}
	}
	//////////////danh sách học sinh
	if($_GET['class']=="11Toan")
	{
	$list_student= array (
		1=>"Ngô Việt Anh",
		2=>"Trần Hàn Minh",
		3=>"Đỗ Hoàng Thanh Sơn",
	);
	}
	if($_GET['class']=="11Van")
	{
	$list_student= array (
		1=>"Lại Thùy Chi",
		2=>"Nguyễn Vân Kim",
		3=>"Trần Văn Hưởng",
	);
	}
	
	//////////////////
	if(isset($_POST['student'])){
		foreach($_POST['student'] as $v){
			$student[]=$list_student[$v];
		}
	$sstudent = serialize($student);
	$sloi = serialize($loi);
	echo $sstudent."<br>".$tong."<br>".$sloi;
	}
	if(empty($student)){
		$error['pay']= "Bạn cần chọn học sinh báo cáo";
	}
}

?>
<html>
    <head>
	<title>Trang chủ</title>
	<style>
	.multiselect {
		width: 200px;
	}

	.selectBox {
		position: relative;
	}

	.selectBox select {
	width: 100%;
	font-weight: bold;
	}

	.overSelect {
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
	}

	#checkboxes {
		display: none;
		border: 1px #dadada solid;
		}

	#checkboxes label {
		display: block;
	}

	#checkboxes label:hover {
		background-color: #1e90ff;
	}
</style>
	</head>
<body>

<form action="" method="POST">
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select>
        <option>Chọn học sinh</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">
      <label for="one">
        <input type="checkbox" name="student[]" value="1" id="one" />Học Sinh 1</label>
      <label for="two">
        <input type="checkbox" name="student[]" value="2" id="two" />Học Sinh 2</label>
      <label for="three">
        <input type="checkbox" name="student[]" value="3" id="three" />Học Sinh 3</label>
    </div>
  </div>
	<input type="checkbox" name="loi[]" value="1" id="loi_1">
		<label for=loi_1">Lỗi 1</label>
			<label>Số lượng</label>
			<input type="number" id="loi_1s" name="loi_1s" value="1" min="1" max="35"><br/><br/>
		<input type="checkbox" name="loi[]" value="2" id="loi_2">
		<label for=loi_2">Loi 2</label>
			<label>Số lượng</label>
			<input type="number" id="loi_2s" name="loi_2s" value="1" min="1" max="35"><br/><br/>
		<input type="checkbox" name="loi[]" value="3" id="loi_3">
		<label for=loi_3">Loi 3</label>
			<label>Số lượng</label>
			<input type="number" id="loi_3s" name="loi_3s" value="1" min="1" max="35"><br/><br/>
		<span style="color : red;"> <?php if(isset($error['pay'])) echo $error['pay']; ?> </span><br/><br/>
	<input type="submit" name="submit" value="Gửi thông tin">
</form>
</body>
</html><?php 
		}else {
	
		echo "</center></h1>";
		include("header.php");
		echo "</br>"."Bạn không có quyền báo cáo";
		}
	}
	
	else {
		echo " bạn cần đăng nhập ";
		header('location: login.php');
	}
	}
	?>