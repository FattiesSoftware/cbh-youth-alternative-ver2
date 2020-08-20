<?php
	$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) !=0) {
			while($row = mysqli_fetch_assoc($result)){
				$user_id=$row['id'];
		}}
		$insert = "INSERT INTO views (audio_name,user_id,view) 
					VALUES('".$_GET['name']."','$user_id','1')";
		mysqli_query($db, $insert);
			
		$query = "SELECT * FROM views  WHERE audio_name = '".$_GET['name']."'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) !=0) {
			while($row = mysqli_fetch_assoc($results)){
				$array[]=$row['user_id'];
				$view=count(array_unique($array, 0));
			}
		}
		$upd = "UPDATE audios SET view='$view' WHERE filename='".$_GET['name']."'";
		$check = mysqli_query($db, $upd);
		echo " Số lượt nghe là :" .$view;
?>