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
	$errors = array(); 
	if(empty($_POST['pay'])){
		$error['pay']= "Bạn cần chọn lớp báo cáo";
	}
	$tong=0;
	$pay="";
	$list_cat= array (
		1=>"Loi 1",
		2=>"Loi 2",
		3=>"Loi 3",
	);
	//$date=date("d-m-Y H:i:s");
	$date=date("Y-m-d");
	if(isset($_POST['pay'])){
		$pay=$_POST['pay'];
	}
	$date_c=getdate();
	
	$loi=array() ;
	if(isset($_POST['cat'])){
		foreach($_POST['cat'] as $v){
			if ($list_cat[$v]=="Loi 1") $tong=$tong+5;
			if ($list_cat[$v]=="Loi 2") $tong=$tong+5;
			if ($list_cat[$v]=="Loi 3") $tong=$tong+5;
			$loi[]=$list_cat[$v];
		}	
	}
	$sloi = serialize($loi);
	if (empty($error['pay'])) {
			$query = "INSERT INTO baocao (classname,tong,userbaocao,date,loi) 
				  VALUES('$pay','$tong','".$_SESSION['username']."','$date','$sloi')";
			//mysqli_query($db, $query);
	///////////////////////////////////////////	

	
	$query_i = "SELECT * FROM class WHERE classname='$pay'";
	$results = mysqli_query($db, $query_i);
	if (mysqli_num_rows($results) !=0){
		if($date_c['weekday']=="Tuesday"){
			$query = "UPDATE class SET Tuesday='$sloi',tong3='$tong'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Monday"){
			$query = "UPDATE class SET Monday='$sloi',tong2='$tong'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Wednesday"){
			$query = "UPDATE class SET Wednesday='$sloi',tong4='$tong'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Thursday"){
			$query = "UPDATE class SET Thursday='$sloi',tong5='$tong'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Friday"){
			$query = "UPDATE class SET Friday='$sloi',tong6='$tong'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Saturday"){
			$query = "UPDATE class SET Saturday='$sloi',tong7='$tong'";
			$check = mysqli_query($db, $query);
		}
				//$loi1=$row['password'];
		$query_t = "UPDATE class SET tong=tong2+tong3+tong4+tong5+tong6+tong7";
		$results = mysqli_query($db, $query_t);
		
	}else
	{
		if($date_c['weekday']=="Tuesday"){
			$query = "INSERT INTO class (classname,tong3,Tuesday,userbaocao)
				  VALUES('$pay','$tong','$sloi','".$_SESSION['username']."')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Monday"){
			$query = "INSERT INTO class (classname,tong2,Tuesday,userbaocao)
				  VALUES('$pay','$tong','$sloi','".$_SESSION['username']."')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Wednesday"){
			$query = "INSERT INTO class (classname,tong4,Wednesday,userbaocao)
				  VALUES('$pay','$tong','$sloi','".$_SESSION['username']."')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Thursday"){
			$query = "INSERT INTO class (classname,tong5,Thursday,userbaocao)
				  VALUES('$pay','$tong','$sloi','".$_SESSION['username']."')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Friday"){
			$query = "INSERT INTO class (classname,tong6,Friday,userbaocao)
				  VALUES('$pay','$tong','$sloi','".$_SESSION['username']."')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Saturday"){
			$query = "INSERT INTO class (classname,tong7,Saturday,userbaocao)
				  VALUES('$pay','$tong','$sloi','".$_SESSION['username']."')";
			mysqli_query($db, $query);
		}
		$query_t = "UPDATE class SET tong=tong2+tong3+tong4+tong5+tong6+tong7";
		$results = mysqli_query($db, $query_t);
	}
	
			
			echo "Báo cáo thành công !<br/>";
			//header('location: index.php');
	}
		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Báo cáo</title>

</head>
<body>
	<?php include("header.php"); ?>
	<br/><br/><br/><form action="" method="POST">
		<select name="pay">  
			<option value="">--Chọn tên lớp--</option>
			<option <?php if(isset($pay)&& $pay=='9A1') echo "selected=\"selected\""; ?> value="9A1">Lớp 9A1 </option>
			<option <?php if(isset($pay)&& $pay=='9A2') echo "selected=\"selected\""; ?> value="9A2">Lớp 9A2 </option>
		</select><br/><br/>
		<!--<label>Tên lớp</label>
		<input type="text" name="classname" value="<?php //echo $classname; ?>"><br/><br/>-->
		<input type="checkbox" name="cat[]" value="1" id="cat_1">
		<label for=cat_1">Lỗi 1</label><br/><br/>
		<input type="checkbox" name="cat[]" value="2" id="cat_2">
		<label for=cat_2">Lỗi 2</label><br/><br/>
		<input type="checkbox" name="cat[]" value="3" id="cat_3">
		<label for=cat_3">Lỗi 3</label><br/><br/>
		<span style="color : red;"> <?php if(isset($error['pay'])) echo $error['pay']; ?> </span><br/><br/>
		<input type="submit" name="add_post" value="Gửi thông tin">
	</form>
</body>
</html>
<?php

	if(@$_GET['action']=="logout")
	{
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
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
?>