<?php
	session_start();
	require('connect.php');
	$audio_name="";
	if ($_SESSION['username']) {
		if($_GET["idt"]){
			$query = "SELECT * FROM audios WHERE audio_id='".$_GET['idt']."'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results)){
				while($row=mysqli_fetch_assoc($results)){
					$audio_name=$row['audio_name'];
					if($row['audio_creator']==$_SESSION['username']){
						if(@$_GET['action']=="edit"){
?>
		<?php include("header.php");?></br>
		<form method="post" action="" enctype="multipart/form-data" >
		<center> 
			<input type="hidden" name="id" value="<?php echo  $_GET["idt"]; ?>">
			<label>Tiêu đề</label>
			<br/><textarea style="resize: none;width:400px;" name="name" value="" ><?php echo $audio_name; ?></textarea><br/>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >Chỉnh sửa</button>
		</center>
		</form>
		
<?php
							if (isset($_POST['update'])) {
								$id = mysqli_real_escape_string($db, $_POST['id']);
								$errors=array();
								$audio_name= mysqli_real_escape_string($db, $_POST['name']);
								if(strlen($audio_name)== 0){
									$errors[]= 'Maybe you forgot audios name';
								}
							if(empty($errors)){
									mysqli_query($db, "UPDATE audios SET audio_name='$audio_name' WHERE audio_id='".$_GET['idt']."'");
									echo 'Chỉnh sửa thành công';
								}else{
									foreach($errors as $error){
									echo '<center>';
									echo $error,'<br/>';
									echo '</center>';
									}
								}
							}
						}
						if (@$_GET['action']=="del") {
							mysqli_query($db, "DELETE FROM topics WHERE topic_id='".$_GET['idt']."'");
							header('location: index.php');
						}
					}else header('location: index.php');
				}
			}
		}
	}
	
	
?>