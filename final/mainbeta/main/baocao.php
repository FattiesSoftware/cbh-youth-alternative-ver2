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
				$error['pay']= "Bạn cần chọn học sinh báo cáo <3";
			}else{
				$pay=$_POST['pay'];
				$pay1=$_POST['pay1'];
			}
		$tong=0;
		$list_cat= array (
			1=>"Loi 1",
			2=>"Loi 2",
			3=>"Loi 3",
		);
		
		if(empty($pay)&&empty($pay1)){
			$error['pay']= "Bạn cần chọn học sinh báo cáo";
			$error['pay']="Bạn cần chọn lớp báo cáo";
		}
		if(empty($error)){
			echo $pay."<br>";
			echo $pay1."<br>";
		}
		$date_c=getdate();
	
		$loi=array() ;
		$date=date("Y-m-d");
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
			/*$query = "INSERT INTO baocao (classname,studentname,tong,userbaocao,date,loi) 
				  VALUES('$pay1','$pay','$tong','".$_SESSION['username']."','$date','$sloi')";
			mysqli_query($db, $query);*/


	
	$query_i = "SELECT * FROM class WHERE classname='$pay1'";
	$results = mysqli_query($db, $query_i);
	if (mysqli_num_rows($results) !=0){
		if($date_c['weekday']=="Tuesday"){
			$query = "UPDATE class SET Tuesday='$sloi',tong3='$tong',studentname='$pay'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Monday"){
			$query = "UPDATE class SET Monday='$sloi',tong2='$tong',studentname='$pay'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Wednesday"){
			$query = "UPDATE class SET Wednesday='$sloi',tong4='$tong',studentname='$pay'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Thursday"){
			$query = "UPDATE class SET Thursday='$sloi',tong5='$tong',studentname='$pay'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Friday"){
			$query = "UPDATE class SET Friday='$sloi',tong6='$tong',studentname='$pay'";
			$check = mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Saturday"){
			$query = "UPDATE class SET Saturday='$sloi',tong7='$tong',studentname='$pay'";
			$check = mysqli_query($db, $query);
		}
				//$loi1=$row['password'];
		$query_t = "UPDATE class SET tong=tong2+tong3+tong4+tong5+tong6+tong7";
		$results = mysqli_query($db, $query_t);
		
	}else
	{
		if($date_c['weekday']=="Tuesday"){
			$query = "INSERT INTO class (classname,tong3,Tuesday,userbaocao,studentname)
				  VALUES('$pay1','$tong','$sloi','".$_SESSION['username']."','$pay')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Monday"){
			$query = "INSERT INTO class (classname,tong2,Monday,userbaocao,studentname)
				  VALUES('$pay1','$tong','$sloi','".$_SESSION['username']."','$pay')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Wednesday"){
			$query = "INSERT INTO class (classname,tong4,Wednesday,userbaocao,studentname)
				  VALUES('$pay1','$tong','$sloi','".$_SESSION['username']."','$pay')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Thursday"){
			$query = "INSERT INTO class (classname,tong5,Thursday,userbaocao,studentname)
				  VALUES('$pay1','$tong','$sloi','".$_SESSION['username']."','$pay')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Friday"){
			$query = "INSERT INTO class (classname,tong6,Friday,userbaocao,studentname)
				  VALUES('$pay1','$tong','$sloi','".$_SESSION['username']."','$pay')";
			mysqli_query($db, $query);
		}
		if($date_c['weekday']=="Saturday"){
			$query = "INSERT INTO class (classname,tong7,Saturday,userbaocao,studentname)
				  VALUES('$pay1','$tong','$sloi','".$_SESSION['username']."','$pay')";
			mysqli_query($db, $query);
		}
		$query_t = "UPDATE class SET tong=tong2+tong3+tong4+tong5+tong6+tong7";
		$results = mysqli_query($db, $query_t);
	}
			
		?>
		<script> alert("Báo cáo thành công!!");
		//setTimeout(<?php header('location: index.php')?>, 3000);
		</script><?php
	}
		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Báo cáo</title>

</head>
<body>
	<?php include("header.php"); ?>
	 <script>
            function random_function()
            {
                var a=document.getElementById("input").value;
                if(a==="11 Toán")
                {
                    var arr=["A","B","C","D"];
					var	string=string+"<option <?php if(isset($pay)&& $pay=='A') echo 'selected=\'selected\''; ?>value='A'>A</option>";
					var	string=string+"<option <?php if(isset($pay)&& $pay=='B') echo 'selected=\'selected\''; ?>value='B'>B</option>";
					var	string=string+"<option <?php if(isset($pay)&& $pay=='C') echo 'selected=\'selected\''; ?>value='C'>C</option>";
					var	string=string+"<option <?php if(isset($pay)&& $pay=='D') echo 'selected=\'selected\''; ?>value='D'>D</option>";
                }
                else if(a==="11 Văn")
                {
                    var arr=["E","F","G","H"];
					var	string=string+"<option <?php if(isset($pay)&& $pay=='E') echo 'selected=\'selected\''; ?>value='E'>E</option>";
					var	string=string+"<option <?php if(isset($pay)&& $pay=='F') echo 'selected=\'selected\''; ?>value='F'>F</option>";
					var	string=string+"<option <?php if(isset($pay)&& $pay=='G') echo 'selected=\'selected\''; ?>value='G'>G</option>";
					var	string=string+"<option <?php if(isset($pay)&& $pay=='H') echo 'selected=\'selected\''; ?>value='H'>H</option>";
                }
				var	string='';
				
             
                for(i=0;i<arr.length;i++)
                {
					string=string+"<option value="+arr[i]+">"+arr[i]+"</option>";
                }
                document.getElementById("output").innerHTML=string;
            }
        </script>
	<form action="" method="POST">
        <select name="pay1" id="input" onchange="random_function()">
            <option>Lớp</option>
			 <optgroup label="Tự Nhiên">
				<option <?php if(isset($pay1)&& $pay1=='11 Toán') echo 'selected=\'selected\''; ?> value='11 Toán'>11 Toán</option>
			</optgroup>
			 <optgroup label="Xã Hội">
				<option <?php if(isset($pay1)&& $pay1=='11 Văn') echo 'selected=\'selected\''; ?> value='11 Văn'>11 Văn</option>
			</optgroup>
		</select>
        <div>
           <select name="pay" id="output" onchange="random_function1()">
		 </div>
		<br><input type="checkbox" name="cat[]" value="1" id="cat_1" style="height:25px; width:25px; vertical-align: middle;">
		<label for=cat_1">Lỗi 1</label><br/><br/>
		<input type="checkbox" name="cat[]" value="2" id="cat_2" style="height:25px; width:25px; vertical-align: middle;">
		<label for=cat_2">Lỗi 2</label><br/><br/>
		<input type="checkbox" name="cat[]" value="3" id="cat_3" style="height:25px; width:25px; vertical-align: middle;">
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