<?php

	session_start();
	require('connect.php');
	if ($_SESSION['username']) {
?>
<html>
<head>
	<title>Trang chủ</title>
</head>
<body>
	<br/><br/><br/>
	<?php include("header.php"); 
	echo "</br>";
	$i=1;
	$baocao=array();
	
	$quer = "SELECT * FROM baocao";
	$results = mysqli_query($db, $quer);
	if (mysqli_num_rows($results) !=0) {
		while($row = mysqli_fetch_assoc($results)){
			$userbaocao=$row["userbaocao"];
				$query_u = "SELECT * FROM users WHERE username='$userbaocao'";
				$results_u = mysqli_query($db, $query_u);
					if (mysqli_num_rows($results_u) !=0) {
					while($row_u = mysqli_fetch_assoc($results_u)){
							$user_id=$row_u['id'];
						}
				}
			$new_baocao = array
			(
			'STT' => $row["id"],
			'classname' => $row["classname"],
			'tong' => $row["tong"],
			'userbaocao'=> $row["userbaocao"],
			'user_id'=>$user_id,
			'loi'=>$row["loi"]
			);
			$baocao[] = $new_baocao;
	}
}	
 else {
    echo "0 results";
}
	

	function storey_sort($classname_a, $classname_b) {
    return $classname_a["tong"] - $classname_b["tong"];
}
	usort($baocao, "storey_sort");
	foreach($baocao as $top_tong) {
    list($STT, $classname, $tong,$userbaocao,$user_id,$loi) = array_values($top_tong);
	$uloi= unserialize($loi);
	foreach( $uloi as $value )
    {
        echo "lỗi là $value";
		echo "</br>";
    } 
    echo "Lớp xếp thứ ".$i. " Số thứ tự : " .$STT." thuộc lớp :  ".$classname." co tong so diem la : ".$tong. ". Xung kích liên quan <a href='profile.php?id=$user_id'>". $userbaocao." </a><br/><br/>";$i=$i+1;
}


	?>
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
		echo " bạn cần đăng nhập ";
		header('location: login.php');
	}
?>
