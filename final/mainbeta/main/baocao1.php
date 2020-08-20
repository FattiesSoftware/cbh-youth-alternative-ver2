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
			
		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Báo cáo</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}
</style>

</head>
<body>
	<?php include("header.php"); ?>
	<div class="container">
  <h2>Danh Sách</h2>         
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Khối Lớp
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
	  <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">THCS<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-submenu">
            <a class="test" href="#">Khối 6<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">6A1</a></li>
              <li><a href="#">6A2</a></li>
            </ul>
          </li>
		  <li class="dropdown-submenu">
            <a class="test" href="#">Khối 7<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">7A1</a></li>
              <li><a href="#">7A2</a></li>
            </ul>
          </li>
		  <li class="dropdown-submenu">
            <a class="test" href="#">Khối 8<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">8A1</a></li>
              <li><a href="#">8A2</a></li>
            </ul>
          </li>
		  <li class="dropdown-submenu">
            <a class="test" href="#">Khối 9<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">9A1</a></li>
              <li><a href="#">9A2</a></li>
            </ul>
          </li>
        </ul>
      </li>
	  
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">THPT<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-submenu">
            <a class="test" href="#">Khối 10<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">10 Toán</a></li>
              <li><a href="#">10 Lí</a></li>
			  <li><a href="#">10 Hóa</a></li>
              <li><a href="#">10 Sinh</a></li>
			  <li><a href="#">10 Tin</a></li>
              <li><a href="#">10 Văn</a></li>
			  <li><a href="#">10 Sử-Địa</a></li>
              <li><a href="#">10 Anh</a></li>
			  <li><a href="#">10 Nga</a></li>
            </ul>
          </li>
		  <li class="dropdown-submenu">
            <a class="test" href="#">Khối 11<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href='baocao2.php?class=11Toan'>11 Toán</a></li>
              <li><a href="#">11 Lí</a></li>
			  <li><a href="#">11 Hóa</a></li>
              <li><a href="#">11 Sinh</a></li>
			  <li><a href="#">11 Tin</a></li>
              <li><a href="#">11 Văn</a></li>
			  <li><a href="#">11 Sử-Địa</a></li>
              <li><a href="#">11 Anh</a></li>
			  <li><a href="#">11 Nga</a></li>
            </ul>
          </li>
		  <li class="dropdown-submenu">
            <a class="test" href="#">Khối 12<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">12 Toán</a></li>
              <li><a href="#">12 Lí</a></li>
			  <li><a href="#">12 Hóa</a></li>
              <li><a href="#">12 Sinh</a></li>
			  <li><a href="#">12 Tin</a></li>
              <li><a href="#">12 Văn</a></li>
			  <li><a href="#">12 Sử-Địa</a></li>
              <li><a href="#">12 Anh</a></li>
			  <li><a href="#">12 Nga</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
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