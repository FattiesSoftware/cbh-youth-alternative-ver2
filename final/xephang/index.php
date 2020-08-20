<?php

	session_start();
	// Include GitHub API config file
require_once 'gitConfig.php';

// Include and initialize user class
require_once 'user.class.php';
$user = new User();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	$PROP = 'none';
	$OUT = 'none';
} else {
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
}
if(isset($accessToken)){
		$none = 'none';
$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
}
require "include/header.php";

?>
<html>
<head>
	<title>Trang chủ</title>
	<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
</head>
<body>
	<center><h1> Diễn đàn </h1></center>
	<?php include("header.php"); 
	$i=1;
	$baocao=array();
// tạo connection
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$con = new mysqli($servername, $username, $password, $dbname);

	?>
</body>
</html>
<?php



$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
			die("Kết nối thất bại " . $conn->connect_error);
		} 
	$sql = "SELECT SUM(diem) AS TotalPoint11Nga FROM baocao  WHERE class='11 Nga'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {    
			$muoimotnga = $row["TotalPoint11Nga"];
    }
} else {
		echo "Không có dữ liệu!";
	}
$sql2 = "SELECT SUM(diem) AS TotalPoint12Toan FROM baocao  WHERE class='12 Toán'";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
		while($row2 = $result2->fetch_assoc()) {   
			$muoihaitoan = $row2["TotalPoint12Toan"]; 
    }
}

$sql23 = "SELECT SUM(diem) AS TotalPoint9A1 FROM baocao  WHERE class='9A1'";
	$result23 = $conn->query($sql23);

	if ($result23->num_rows > 0) {
		while($row23 = $result23->fetch_assoc()) {   
			$chinamot = $row23["TotalPoint9A1"]; 
			if ($chinamot == 1){
		$chinamot = '01';
	} elseif ($chinamot == 2){
		$chinamot = '02';
	} elseif ($chinamot == 3){
		$chinamot = '03';
	} elseif ($chinamot == 4){
		$chinamot = '04';
	} elseif ($chinamot == 5){
		$chinamot = '05';
	} elseif ($chinamot == 6){
		$chinamot = '06';
	} elseif ($chinamot == 7){
		$chinamot = '07';
	} elseif ($chinamot == 8){
		$chinamot = '08';
	} elseif ($chinamot == 9){
		$chinamot = '09';
	}
    }
}

$sql234 = "SELECT SUM(diem) AS TotalPoint12Anh FROM baocao  WHERE class='12 Anh'";
	$result234 = $conn->query($sql234);

	if ($result234->num_rows > 0) {
		while($row234 = $result234->fetch_assoc()) {   
			$muoihaianh = $row234["TotalPoint12Anh"]; 
    }
}

$sql2345 = "SELECT SUM(diem) AS TotalPoint12SuDia FROM baocao  WHERE class='12 Sử - Địa'";
	$result2345 = $conn->query($sql2345);

	if ($result2345->num_rows > 0) {
		while($row2345 = $result2345->fetch_assoc()) {   
			$muoihaisudia = $row2345["TotalPoint12SuDia"]; 
    }
}



// Add xep hang
if (isset($_GET['lop'])){
	if ($_GET['lop'] == '11 Nga'){
		$diem = $muoimotnga;
	} elseif ($_GET['lop'] == '12 Toán'){
		$diem = $muoihaitoan;
	} elseif ($_GET['lop'] == '9A1'){
		$diem = $chinamot;
	} elseif ($_GET['lop'] == '12 Anh'){
		$diem = $muoihaianh;
	} elseif ($_GET['lop'] == '12 Sử - Địa'){
		$diem = $muoihaisudia;
	} elseif ($_GET['lop'] == 'lop'){
		$diem = $lopp;
	}

	if ($diem == 1){
		$diem = '01';
	} 
	if ($diem == 2){
		$diem = '02';
	} 
	if ($diem == 3){
		$diem = '03';
	} 
	if ($diem == 4){
		$diem = '04';
	} 
	if ($diem == 5){
		$diem = '05';
	} 
	if ($diem == 6){
		$diem = '06';
	} 
	if ($diem == 7){
		$diem = '07';
	} 
	if ($diem == 8){
		$diem = '08';
	} 
	if ($diem == 9){
		$diem = '09';
	}
	if ($diem >=100){
		$maxchar = '3';
	} else {
		$maxchar = '2';
	}
if ($stmt = $conn->prepare('SELECT id,  diem FROM xephang WHERE  lop = ? ')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_GET['lop']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		if ($diem == 1){
		$diem = '01';
	} elseif ($diem == 2){
		$diem = '02';
	} elseif ($diem == 3){
		$diem = '03';
	} elseif ($diem == 4){
		$diem = '04';
	} elseif ($diem == 5){
		$diem = '05';
	} elseif ($diem == 6){
		$diem = '06';
	} elseif ($diem == 7){
		$diem = '07';
	} elseif ($diem == 8){
		$diem = '08';
	} elseif ($diem == 9){
		$diem = '09';
	}
		echo 'Xếp hạng dành cho lớp '.$_GET['lop'].' đã tồn tại. Đang cập nhật xếp hạng mới với số điểm mới là '.$diem.'<br>';
		if ($stmt = $conn->prepare('UPDATE xephang SET  diem=LPAD('.$diem.', '.$maxchar.', 0) WHERE lop=?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_GET['lop']);
	$stmt->execute();
	$stmt->store_result();
	} 
} else {

$lop = $_GET['lop'];
if ($stmt = $conn->prepare('INSERT INTO xephang (lop, diem) VALUES (?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$stmt->bind_param('ss', $lop, $diem);
	$stmt->execute();
	echo 'Đã thêm xếp hạng cho lớp '.$lop.'<br>';
}
}
}
}
echo "<table id='myTable' class='sortable'>";
				$sql = "SELECT * FROM xephang";
	$result = $conn->query($sql);
	
		while($row = $result->fetch_assoc()) {  
			$lopgido = $row['lop'];
			
					if($lopgido=='11 Nga'){
				$sql_u = "SELECT id, lop, diem, FIND_IN_SET( diem, ( SELECT GROUP_CONCAT( diem ORDER BY diem ASC ) FROM xephang ) ) AS rank FROM xephang WHERE lop='11 Nga'";
	$result_u = $conn->query($sql_u) or die($conn->error);
		while($row_u = $result_u->fetch_assoc()) {    
			$xephang = "<tr><td>".$row['diem']."</td><td>Lớp 11 Nga xếp thứ ".$row_u['rank']." với ".$row['diem']." điểm trừ.<br></td></tr>";
			echo $xephang;
			
			}
		}

			
			if($lopgido=='12 Toán'){
				$sql_u2 = "SELECT id, lop, diem, FIND_IN_SET( diem, ( SELECT GROUP_CONCAT( diem ORDER BY diem ASC ) FROM xephang ) ) AS rank FROM xephang WHERE lop='12 Toán'";
	$result_u2 = $conn->query($sql_u2) or die($conn->error);
		while($row_u2 = $result_u2->fetch_assoc()) {    
			$xephang = "<tr><td name='TD'>".$row['diem']."</td><td>Lớp 12 Toán xếp thứ ".$row_u2['rank']." với ".$row['diem']." điểm trừ.<br></td></tr>";
			echo $xephang;
			}
		}



if($lopgido=='9A1'){
				$sql_u233 = "SELECT id, lop, diem, FIND_IN_SET( diem, ( SELECT GROUP_CONCAT( diem ORDER BY diem ASC ) FROM xephang ) ) AS rank FROM xephang WHERE lop='9A1'";
	$result_u233 = $conn->query($sql_u233) or die($conn->error);
		while($row_u233 = $result_u233->fetch_assoc()) {    
			$xephang = "<tr><td name='TD'>".$row['diem']."</td><td>Lớp 9A1 xếp thứ ".$row_u233['rank']." với ".$row['diem']." điểm trừ.<br></td></tr>";
			echo $xephang;
			}
		}

if($lopgido=='12 Anh'){
				$sql_u2334 = "SELECT id, lop, diem, FIND_IN_SET( diem, ( SELECT GROUP_CONCAT( diem ORDER BY diem ASC ) FROM xephang ) ) AS rank FROM xephang WHERE lop='12 Anh'";
	$result_u2334 = $conn->query($sql_u2334) or die($conn->error);
		while($row_u2334 = $result_u2334->fetch_assoc()) {    
			$xephang = "<tr><td name='TD'>".$row['diem']."</td><td>Lớp 12 Anh xếp thứ ".$row_u2334['rank']." với ".$row['diem']." điểm trừ.<br></td></tr>";
			echo $xephang;
			}
		}


if($lopgido=='12 Sử - Địa'){
				$sql_u23345 = "SELECT id, lop, diem, FIND_IN_SET( diem, ( SELECT GROUP_CONCAT( diem ORDER BY diem ASC ) FROM xephang ) ) AS rank FROM xephang WHERE lop='12 Sử - Địa'";
	$result_u23345 = $conn->query($sql_u23345) or die($conn->error);
		while($row_u23345 = $result_u23345->fetch_assoc()) {    
			$xephang = "<tr><td name='TD'>".$row['diem']."</td><td>Lớp 12 Sử - Địa xếp thứ ".$row_u23345['rank']." với ".$row['diem']." điểm trừ.<br></td></tr>";
			echo $xephang;
			}
		}
if($lopgido=='lop'){
				$sql_u233456 = "SELECT id, lop, diem, FIND_IN_SET( diem, ( SELECT GROUP_CONCAT( diem ORDER BY diem ASC ) FROM xephang ) ) AS rank FROM xephang WHERE lop='lop'";
	$result_u233456 = $conn->query($sql_u233456) or die($conn->error);
		while($row_u233456 = $result_u233456->fetch_assoc()) {    
			$xephang = "<tr><td name='TD'>".$row['diem']."</td><td>Xếp hạng</td></tr>";
			echo $xephang;
			}
		}



    }

echo '</table>';
?>
<button onclick="myfunction2()">Sort</button>
<script type="text/javascript">
	function myfunction2(){
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
      if (Number(x.innerHTML) > Number(y.innerHTML)) {
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

</script>
