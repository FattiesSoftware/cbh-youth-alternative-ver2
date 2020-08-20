<?php
if (!isset($_SESSION['loggedin'])) {
$username = 'guest';
} else {
$username = $_SESSION['username'];
}
	$query = "SELECT * FROM accounts WHERE username='".$username."'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) !=0) {
			while($row = mysqli_fetch_assoc($result)){
				$user_id=$row['id'];
		}}
		$insert = "INSERT INTO view (topic_id,user_id,view) 
					VALUES('".$_GET['id']."','$user_id','1')";
		mysqli_query($db, $insert);
			
		$query = "SELECT * FROM view  WHERE topic_id = '".$_GET['id']."'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) !=0) {
			while($row = mysqli_fetch_assoc($results)){
				$array[]=$row['user_id'];
				$view=count(array_unique($array, 0));
			}
		}
		$upd = "UPDATE topics SET view='$view' WHERE topic_id='".$_GET['id']."'";
		$check = mysqli_query($db, $upd);
		
?>