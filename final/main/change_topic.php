<?php
	session_start();
	require('connect.php');
	//include('view.php');
	$name = "";
	$address = "";
	if ($_SESSION['username']) {
		if($_GET["idt"]){
			$query = "SELECT * FROM topics WHERE topic_id='".$_GET['idt']."'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results)){
				while($row=mysqli_fetch_assoc($results)){
					$topic_content=$row['topic_content'];
					$topic_name=$row['topic_name'];
					if($row['topic_creator']==$_SESSION['username']){
						if(@$_GET['action']=="edit"){
?>
		
		<?php include("header.php");?></br>
		<center><form method="post" action="" >
		<input type="hidden" name="id" value="<?php echo  $_GET["idt"]; ?>">
		<div class="input-group">
			<label>Tiêu đề</label>
			<br/><textarea style="resize: none;width:400px;" name="name" value="" ><?php echo $topic_name; ?></textarea><br/>
		</div>
		<div class="input-group">
			<label>Nội dung</label>
			
			<br/> <textarea style="resize: none;width:400px;height:300px;" name="address" value="" ><?php echo $topic_content; ?></textarea><br/>
		</div>
		<div class="input-group">
				<button class="btn" type="submit" name="update" style="background: #556B2F;" >Chỉnh sửa</button>
		</div>
		</form></center>
		
<?php
							if (isset($_POST['update'])) {
								$id = mysqli_real_escape_string($db, $_POST['id']);
								$name = mysqli_real_escape_string($db,$_POST['name']);
								$address = mysqli_real_escape_string($db,$_POST['address']);
								mysqli_query($db, "UPDATE topics SET topic_name='$name', topic_content='$address' WHERE topic_id='".$_GET['idt']."'");
								header('location: index.php');
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