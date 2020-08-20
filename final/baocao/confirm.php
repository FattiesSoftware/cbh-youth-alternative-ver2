<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Include GitHub API config file
require_once 'gitConfig.php';

// Include and initialize user class
require_once 'User.class.php';
$user = new User();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'members';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if(isset($accessToken)){
	   // Get the user profile info from Github
    $gitUser = $gitClient->apiRequest($accessToken);

    if(!empty($gitUser)){
        // User profile data
        $gitUserData = array();
        $gitUserData['oauth_provider'] = 'github';
        $gitUserData['oauth_uid'] = !empty($gitUser->id)?$gitUser->id:'';
        $gitUserData['name'] = !empty($gitUser->name)?$gitUser->name:'';
        $gitUserData['username'] = !empty($gitUser->login)?$gitUser->login:'';
        $gitUserData['email'] = !empty($gitUser->email)?$gitUser->email:'';
        $gitUserData['location'] = !empty($gitUser->location)?$gitUser->location:'';
        $gitUserData['picture'] = !empty($gitUser->avatar_url)?$gitUser->avatar_url:'';
        $gitUserData['link'] = !empty($gitUser->html_url)?$gitUser->html_url:'';
        
        // Insert or update user data to the database
        $userData = $user->checkUser($gitUserData);
        
        // Put user data into the session
        $_SESSION['userData'] = $userData;
$OUT1 = 'none';

    }else{
		    $OUT1 = 'block';
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
    
	$none = 'none';
$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	}elseif(isset($_GET['code'])){
    // Verify the state matches the stored state
    if(!$_GET['state'] || $_SESSION['state'] != $_GET['state']) {
        header("Location: ".$_SERVER['PHP_SELF']);
    }
    
    // Exchange the auth code for a token
    $accessToken = $gitClient->getAccessToken($_GET['state'], $_GET['code']);
  
    $_SESSION['access_token'] = $accessToken;
  
    header('Location: ./');
}else{
// Generate a random hash and store in the session for security
    $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);
    
    // Remove access token from the session
    unset($_SESSION['access_token']);
  
    // Get the URL to authorize
    $loginURL = $gitClient->getAuthorizeURL($_SESSION['state']);
    
    // Render Github login button
    $output2 = '<a type="button" href="'.htmlspecialchars($loginURL).'" class="col-1" style="color: rgb(51, 51, 51);"><i class="fab fa-2x fa-github"></i></a>';
$PROP = 'none';
	$OUT = 'none';
}
if (isset($_GET['lop'])){
	$lop = $_GET['lop'];
} else {
	$lop = 'Không có thông tin';
}
	if (isset($_GET['vang'])){
	$vang = $_GET['vang'];
} else {
	$vang = '0';
}
	if (isset($_GET['vesinh'])){
	$vesinh = $_GET['vesinh'];
} else {
	$vesinh = 'Không có thông tin';
}
	if (isset($_GET['dongphuc'])){
	$dongphuc = $_GET['dongphuc'];
} else {
	$dongphuc = 'Không có thông tin';
}
	if (isset($_GET['soloi'])){
	$soloi = $_GET['soloi'];
} else {
	$soloi = '0';
}
	if (isset($_GET['loivipham1'])){
	$loivipham1 = $_GET['loivipham1'];
} else {
	$loivipham1 = '';
}
	if (isset($_GET['loivipham2'])){
	$loivipham2 = $_GET['loivipham2'];
} else {
	$loivipham2 = '';
}
	if (isset($_GET['loivipham3'])){
	$loivipham3 = $_GET['loivipham3'];
} else {
	$loivipham3 = '';
}
	if (isset($_GET['loivipham4'])){
	$loivipham4 = $_GET['loivipham4'];
} else {
	$loivipham4 = '';
}
	if (isset($_GET['loivipham5'])){
	$loivipham5 = $_GET['loivipham5'];
} else {
	$loivipham5 = '';
}

	$loi2 = 'block';
	$loi3 = 'block';
	$loi4 = 'block';
	$loi5 = 'block';
	$tenloi1= 'Không có lỗi';
	$tenloi2= 'Không có lỗi';
	$tenloi3= 'Không có lỗi';
	$tenloi4= 'Không có lỗi';
	$tenloi5= 'Không có lỗi';

	if ($vang == ''){
		$vang = '0';
	}
	if ($soloi == 1){
		$loi2 = 'none';
		$loi3 = 'none';
		$loi4 = 'none';
		$loi5 = 'none';
	}
	if ($soloi == 2){

		$loi3 = 'none';
		$loi4 = 'none';
		$loi5 = 'none';
	}
		if ($soloi == 3){


		$loi4 = 'none';
		$loi5 = 'none';
	}
			if ($soloi == 4){



		$loi5 = 'none';
	}

	if ($loivipham1 == ''){
		$loivipham1 = 'Không có lỗi';
		$point1 = '0';
	}
	if ($loivipham2 == ''){
		$loivipham2 = 'Không có lỗi';
		$point2 = '0';
	}
	if ($loivipham3 == ''){
		$loivipham3 = 'Không có lỗi';
		$point3 = '0';
	}
	if ($loivipham4 == ''){
		$loivipham4 = 'Không có lỗi';
		$point4 = '0';
	}
	if ($loivipham5 == ''){
		$loivipham5 = 'Không có lỗi';
		$point5 = '0';
	}
	// thuật toán tính tổng điểm trừ đối với lỗi vi phạm 1
	if ($loivipham1 == '1'){
		$point1 = '01';
		$tenloi1= 'Đi muộn';
	}
	if ($loivipham1 == '2'){
		$point1 = '10';
		$tenloi1= 'Đi muộn (bỏ chạy)';
	}
	if ($loivipham1 == '3'){
		$point1 = '15';
		$tenloi1= 'Đi muộn sau 7 giờ';
	}
	if ($loivipham1 == '4'){
		$point1 = '10';
		$tenloi1= 'Đi muộn trèo tường';
	}
	if ($loivipham1 == '5'){
		$point1 = '02';
		$tenloi1= 'Vắng mặt không lí do giờ truy bài';
	}
	if ($loivipham1 == '6'){
		$point1 = '10';
		$tenloi1= 'Ra ngoài giờ truy bài (bỏ chạy)';
	}
	if ($loivipham1 == '7'){
		$point1 = '01';
		$tenloi1= 'Không đúng trang phục: áo phù hiệu giày';
	}
	if ($loivipham1 == '8'){
		$point1 = '05';
		$tenloi1= 'Tập trung muộn';
	}
	if ($loivipham1 == '9'){
		$point1 = '01';
		$tenloi1= 'Nghỉ không phép làm việc riêng trong giờ tập trung';
	}
	if ($loivipham1 == '10'){
		$point1 = '10';
		$tenloi1= 'Tập trung muộn sau 10 phút xếp hàng chưa ngay ngắn';
	}
	if ($loivipham1 == '11'){
		$point1 = '05';
		$tenloi1= 'Mất trật tự trong buổi tập trung';
	}
	if ($loivipham1 == '12'){
		$point1 = '01';
		$tenloi1= 'Không cất ghế sau giờ tập trung';
	}
	if ($loivipham1 == '13'){
		$point1 = '02';
		$tenloi1= 'Nói bậy';
	}
	if ($loivipham1 == '14'){
		$point1 = '02';
		$tenloi1= 'Ăn quà không đúng nơi quy định';
	}
	if ($loivipham1 == '15'){
		$point1 = '05';
		$tenloi1= 'Hút thuốc lá trong trường';
	}
	if ($loivipham1 == '16'){
		$point1 = '05';
		$tenloi1= 'Không dừng xe ở cổng trường';
	}
	if ($loivipham1 == '17'){
		$point1 = '10';
		$tenloi1= 'Không dừng xe ở cổng trường khi đã nhắc nhở';
	}
	if ($loivipham1 == '18'){
		$point1 = '10';
		$tenloi1= 'Không đội mũ bảo hiểm';
	}
	if ($loivipham1 == '19'){
		$point1 = '50';
		$tenloi1= 'Vô lễ với cán bộ giáo viên';
	}
	if ($loivipham1 == '20'){
		$point1 = '02';
		$tenloi1= 'Xả đổ rác không đúng nơi quy định';
	}
	if ($loivipham1 == '21'){
		$point1 = '01';
		$tenloi1= 'Trực nhật muộn đổ rác muộn';
	}

	if ($loivipham1 == '22'){
		$point1 = '05';
		$tenloi1= 'Không lấy sổ đầu bài sáng thứ 2';
	}
	if ($loivipham1 == '23'){
		$point1 = '02';
		$tenloi1= 'Trực nhật bẩn không trực khu vực';
	}
	if ($loivipham1 == '24'){
		$point1 = '02';
		$tenloi1= 'Để xe không đúng nơi quy định';
	}
	if ($loivipham1 == '25'){
		$point1 = '05';
		$tenloi1= 'Khu vực để xe lộn xộn không ngăn nắp';
	}
	if ($loivipham1 == '26'){
		$point1 = '02';
		$tenloi1= 'Không đóng cửa tắt điện sau giờ học';
	}
	if ($loivipham1 == '27'){
		$point1 = '02';
		$tenloi1= 'Sử dụng nhà vệ sinh không đúng cách';
	}
	if ($loivipham1 == '28'){
		$point1 = '05';
		$tenloi1= 'Làm vỡ cửa kính';
	}
	if ($loivipham1 == '29'){
		$point1 = '02';
		$tenloi1= 'Đá bóng không đúng nơi quy định';
	}
	if ($loivipham1 == '30'){
		$point1 = '05';
		$tenloi1= 'Sử dụng không đúng khu vực vệ sinh cho phép';
	}
	if ($loivipham1 == '31'){
		$point1 = '50';
		$tenloi1= 'Đánh nhau';
	}
	if ($loivipham1 == '32'){
		$point1 = '80';
		$tenloi1= 'Đánh nhau không khai báo thành khẩn';
	}
		if ($loivipham1 == '33'){
		$point1 = '20';
		$tenloi1= 'Vi phạm ATGT (có báo cáo về trường)';
	}

	if ($loivipham1 == '34'){
		$point1 = '10';
		$tenloi1= 'Vi phạm quy chế thi';
	}
	if ($loivipham1 == '35'){
		$point1 = '10';
		$tenloi1= 'Giờ tự quản ồn học sinh ra ngoài ảnh hưởng đến lớp khác';
	}
	if ($loivipham1 == '36'){
		$point1 = '03';
		$tenloi1= 'Cán bộ lớp BCH chi đoàn đến họp muộn';
	}
	if ($loivipham1 == '37'){
		$point1 = '05';
		$tenloi1= 'Cán bộ lớp BCH chi đoàn vắng mặt không lí do';
	}
	if ($loivipham1 == '38'){
		$point1 = '10';
		$tenloi1= 'Cán bộ lớp BCH chi đoàn không hoàn thành nhiệm vụ';
	}
	if ($loivipham1 == '39'){
		$point1 = '01';
		$tenloi1= 'Xung kích không thực hiện nhiệm vụ';
	}
	if ($loivipham1 == '40'){
		$point1 = '02';
		$tenloi1= 'Đội văn nghệ không thực hiện nhiệm vụ';
	}
	if ($loivipham1 == '41'){
		$point1 = '10';
		$tenloi1= 'Lớp trực tuần bỏ buổi trực';
	}
	if ($loivipham1 == '42'){
		$point1 = '05';
		$tenloi1= 'Lớp trực tuần xuống trực cổng muộn';
	}
	if ($loivipham1 == '43'){
		$point1 = '10';
		$tenloi1= 'Lớp trực tuần chuẩn bị không tốt cho buổi tập trung';
	}
	if ($loivipham1 == '44'){
		$point1 = '05';
		$tenloi1= 'Đánh nhau không khai báo thành khẩn';
	}
		// thuật toán tính tổng điểm trừ đối với lỗi vi phạm 2
	if ($loivipham2 == '1'){
		$point2 = '01';
		$tenloi2= 'Đi muộn';
	}
	if ($loivipham2 == '2'){
		$point2 = '10';
		$tenloi2= 'Đi muộn (bỏ chạy)';
	}
	if ($loivipham2 == '3'){
		$point2 = '15';
		$tenloi2= 'Đi muộn sau 7 giờ';
	}
	if ($loivipham2 == '4'){
		$point2 = '10';
		$tenloi2= 'Đi muộn trèo tường';
	}
	if ($loivipham2 == '5'){
		$point2 = '02';
		$tenloi2= 'Vắng mặt không lí do giờ truy bài';
	}
	if ($loivipham2 == '6'){
		$point2 = '10';
		$tenloi2= 'Ra ngoài giờ truy bài (bỏ chạy)';
	}
	if ($loivipham2 == '7'){
		$point2 = '01';
		$tenloi2= 'Không đúng trang phục: áo phù hiệu giày';
	}
	if ($loivipham2 == '8'){
		$point2 = '05';
		$tenloi2= 'Tập trung muộn';
	}
	if ($loivipham2 == '9'){
		$point2 = '01';
		$tenloi2= 'Nghỉ không phép làm việc riêng trong giờ tập trung';
	}
	if ($loivipham2 == '10'){
		$point2 = '10';
		$tenloi2= 'Tập trung muộn sau 10 phút xếp hàng chưa ngay ngắn';
	}
	if ($loivipham2 == '11'){
		$point2 = '05';
		$tenloi2= 'Mất trật tự trong buổi tập trung';
	}
	if ($loivipham2 == '12'){
		$point2 = '01';
		$tenloi2= 'Không cất ghế sau giờ tập trung';
	}
	if ($loivipham2 == '13'){
		$point2 = '02';
		$tenloi2= 'Nói bậy';
	}
	if ($loivipham2 == '14'){
		$point2 = '02';
		$tenloi2= 'Ăn quà không đúng nơi quy định';
	}
	if ($loivipham2 == '15'){
		$point2 = '05';
		$tenloi2= 'Hút thuốc lá trong trường';
	}
	if ($loivipham2 == '16'){
		$point2 = '05';
		$tenloi2= 'Không dừng xe ở cổng trường';
	}
	if ($loivipham2 == '17'){
		$point2 = '10';
		$tenloi2= 'Không dừng xe ở cổng trường khi đã nhắc nhở';
	}
	if ($loivipham2 == '18'){
		$point2 = '10';
		$tenloi2= 'Không đội mũ bảo hiểm';
	}
	if ($loivipham2 == '19'){
		$point2 = '50';
		$tenloi2= 'Vô lễ với cán bộ giáo viên';
	}
	if ($loivipham2 == '20'){
		$point2 = '02';
		$tenloi2= 'Xả đổ rác không đúng nơi quy định';
	}
	if ($loivipham2 == '21'){
		$point2 = '01';
		$tenloi2= 'Trực nhật muộn đổ rác muộn';
	}

	if ($loivipham2 == '22'){
		$point2 = '05';
		$tenloi2= 'Không lấy sổ đầu bài sáng thứ 2';
	}
	if ($loivipham2 == '23'){
		$point2 = '02';
		$tenloi2= 'Trực nhật bẩn không trực khu vực';
	}
	if ($loivipham2 == '24'){
		$point2 = '02';
		$tenloi2= 'Để xe không đúng nơi quy định';
	}
	if ($loivipham2 == '25'){
		$point2 = '05';
		$tenloi2= 'Khu vực để xe lộn xộn không ngăn nắp';
	}
	if ($loivipham2 == '26'){
		$point2 = '02';
		$tenloi2= 'Không đóng cửa tắt điện sau giờ học';
	}
	if ($loivipham2 == '27'){
		$point2 = '02';
		$tenloi2= 'Sử dụng nhà vệ sinh không đúng cách';
	}
	if ($loivipham2 == '28'){
		$point2 = '05';
		$tenloi2= 'Làm vỡ cửa kính';
	}
	if ($loivipham2 == '29'){
		$point2 = '02';
		$tenloi2= 'Đá bóng không đúng nơi quy định';
	}
	if ($loivipham2 == '30'){
		$point2 = '05';
		$tenloi2= 'Sử dụng không đúng khu vực vệ sinh cho phép';
	}
	if ($loivipham2 == '31'){
		$point2 = '50';
		$tenloi2= 'Đánh nhau';
	}
	if ($loivipham2 == '32'){
		$point2 = '80';
		$tenloi2= 'Đánh nhau không khai báo thành khẩn';
	}
		if ($loivipham2 == '33'){
		$point2 = '20';
		$tenloi2= 'Vi phạm ATGT (có báo cáo về trường)';
	}

	if ($loivipham2 == '34'){
		$point2 = '10';
		$tenloi2= 'Vi phạm quy chế thi';
	}
	if ($loivipham2 == '35'){
		$point2 = '10';
		$tenloi2= 'Giờ tự quản ồn học sinh ra ngoài ảnh hưởng đến lớp khác';
	}
	if ($loivipham2 == '36'){
		$point2 = '03';
		$tenloi2= 'Cán bộ lớp BCH chi đoàn đến họp muộn';
	}
	if ($loivipham2 == '37'){
		$point2 = '05';
		$tenloi2= 'Cán bộ lớp BCH chi đoàn vắng mặt không lí do';
	}
	if ($loivipham2 == '38'){
		$point2 = '10';
		$tenloi2= 'Cán bộ lớp BCH chi đoàn không hoàn thành nhiệm vụ';
	}
	if ($loivipham2 == '39'){
		$point2 = '01';
		$tenloi2= 'Xung kích không thực hiện nhiệm vụ';
	}
	if ($loivipham2 == '40'){
		$point2 = '02';
		$tenloi2= 'Đội văn nghệ không thực hiện nhiệm vụ';
	}
	if ($loivipham2 == '41'){
		$point2 = '10';
		$tenloi2= 'Lớp trực tuần bỏ buổi trực';
	}
	if ($loivipham2 == '42'){
		$point2 = '05';
		$tenloi2= 'Lớp trực tuần xuống trực cổng muộn';
	}
	if ($loivipham2 == '43'){
		$point2 = '10';
		$tenloi2= 'Lớp trực tuần chuẩn bị không tốt cho buổi tập trung';
	}
	if ($loivipham2 == '44'){
		$point2 = '05';
		$tenloi2= 'Đội mũ bảo hiểm không cài quai';
	}

	// thuật toán tính tổng điểm trừ đối với lỗi vi phạm 3
	if ($loivipham3 == '1'){
		$$point3 = '01';
		$tenloi3= 'Đi muộn';
	}
	if ($loivipham3 == '2'){
		$point3 = '10';
		$tenloi3= 'Đi muộn (bỏ chạy)';
	}
	if ($loivipham3 == '3'){
		$point3 = '15';
		$tenloi3= 'Đi muộn sau 7 giờ';
	}
	if ($loivipham3 == '4'){
		$point3 = '10';
		$tenloi3= 'Đi muộn trèo tường';
	}
	if ($loivipham3 == '5'){
		$point3 = '02';
		$tenloi3= 'Vắng mặt không lí do giờ truy bài';
	}
	if ($loivipham3 == '6'){
		$point3 = '10';
		$tenloi3= 'Ra ngoài giờ truy bài (bỏ chạy)';
	}
	if ($loivipham3 == '7'){
		$$point3 = '01';
		$tenloi3= 'Không đúng trang phục: áo phù hiệu giày';
	}
	if ($loivipham3 == '8'){
		$point3 = '05';
		$tenloi3= 'Tập trung muộn';
	}
	if ($loivipham3 == '9'){
		$$point3 = '01';
		$tenloi3= 'Nghỉ không phép làm việc riêng trong giờ tập trung';
	}
	if ($loivipham3 == '10'){
		$point3 = '10';
		$tenloi3= 'Tập trung muộn sau 10 phút xếp hàng chưa ngay ngắn';
	}
	if ($loivipham3 == '11'){
		$point3 = '05';
		$tenloi3= 'Mất trật tự trong buổi tập trung';
	}
	if ($loivipham3 == '12'){
		$$point3 = '01';
		$tenloi3= 'Không cất ghế sau giờ tập trung';
	}
	if ($loivipham3 == '13'){
		$point3 = '02';
		$tenloi3= 'Nói bậy';
	}
	if ($loivipham3 == '14'){
		$point3 = '02';
		$tenloi3= 'Ăn quà không đúng nơi quy định';
	}
	if ($loivipham3 == '15'){
		$point3 = '05';
		$tenloi3= 'Hút thuốc lá trong trường';
	}
	if ($loivipham3 == '16'){
		$point3 = '05';
		$tenloi3= 'Không dừng xe ở cổng trường';
	}
	if ($loivipham3 == '17'){
		$point3 = '10';
		$tenloi3= 'Không dừng xe ở cổng trường khi đã nhắc nhở';
	}
	if ($loivipham3 == '18'){
		$point3 = '10';
		$tenloi3= 'Không đội mũ bảo hiểm';
	}
	if ($loivipham3 == '19'){
		$point3 = '50';
		$tenloi3= 'Vô lễ với cán bộ giáo viên';
	}
	if ($loivipham3 == '20'){
		$point3 = '02';
		$tenloi3= 'Xả đổ rác không đúng nơi quy định';
	}
	if ($loivipham3 == '21'){
		$$point3 = '01';
		$tenloi3= 'Trực nhật muộn đổ rác muộn';
	}

	if ($loivipham3 == '22'){
		$point3 = '05';
		$tenloi3= 'Không lấy sổ đầu bài sáng thứ 2';
	}
	if ($loivipham3 == '23'){
		$point3 = '02';
		$tenloi3= 'Trực nhật bẩn không trực khu vực';
	}
	if ($loivipham3 == '24'){
		$point3 = '02';
		$tenloi3= 'Để xe không đúng nơi quy định';
	}
	if ($loivipham3 == '25'){
		$point3 = '05';
		$tenloi3= 'Khu vực để xe lộn xộn không ngăn nắp';
	}
	if ($loivipham3 == '26'){
		$point3 = '02';
		$tenloi3= 'Không đóng cửa tắt điện sau giờ học';
	}
	if ($loivipham3 == '27'){
		$point3 = '02';
		$tenloi3= 'Sử dụng nhà vệ sinh không đúng cách';
	}
	if ($loivipham3 == '28'){
		$point3 = '05';
		$tenloi3= 'Làm vỡ cửa kính';
	}
	if ($loivipham3 == '29'){
		$point3 = '02';
		$tenloi3= 'Đá bóng không đúng nơi quy định';
	}
	if ($loivipham3 == '30'){
		$point3 = '05';
		$tenloi3= 'Sử dụng không đúng khu vực vệ sinh cho phép';
	}
	if ($loivipham3 == '31'){
		$point3 = '50';
		$tenloi3= 'Đánh nhau';
	}
	if ($loivipham3 == '32'){
		$point3 = '80';
		$tenloi3= 'Đánh nhau không khai báo thành khẩn';
	}
		if ($loivipham3 == '33'){
		$point3 = '20';
		$tenloi3= 'Vi phạm ATGT (có báo cáo về trường)';
	}

	if ($loivipham3 == '34'){
		$point3 = '10';
		$tenloi3= 'Vi phạm quy chế thi';
	}
	if ($loivipham3 == '35'){
		$point3 = '10';
		$tenloi3= 'Giờ tự quản ồn học sinh ra ngoài ảnh hưởng đến lớp khác';
	}
	if ($loivipham3 == '36'){
		$point3 = '03';
		$tenloi3= 'Cán bộ lớp BCH chi đoàn đến họp muộn';
	}
	if ($loivipham3 == '37'){
		$point3 = '05';
		$tenloi3= 'Cán bộ lớp BCH chi đoàn vắng mặt không lí do';
	}
	if ($loivipham3 == '38'){
		$point3 = '10';
		$tenloi3= 'Cán bộ lớp BCH chi đoàn không hoàn thành nhiệm vụ';
	}
	if ($loivipham3 == '39'){
		$$point3 = '01';
		$tenloi3= 'Xung kích không thực hiện nhiệm vụ';
	}
	if ($loivipham3 == '40'){
		$point3 = '02';
		$tenloi3= 'Đội văn nghệ không thực hiện nhiệm vụ';
	}
	if ($loivipham3 == '41'){
		$point3 = '10';
		$tenloi3= 'Lớp trực tuần bỏ buổi trực';
	}
	if ($loivipham3 == '42'){
		$point3 = '05';
		$tenloi3= 'Lớp trực tuần xuống trực cổng muộn';
	}
	if ($loivipham3 == '43'){
		$point3 = '10';
		$tenloi3= 'Lớp trực tuần chuẩn bị không tốt cho buổi tập trung';
	}
	if ($loivipham3 == '44'){
		$point3 = '05';
		$tenloi3= 'Đội mũ bảo hiểm không cài quai';
	}
		// thuật toán tính tổng điểm trừ đối với lỗi vi phạm 4
	if ($loivipham4 == '1'){
		$point4 = '01';
		$tenloi4= 'Đi muộn';
	}
	if ($loivipham4 == '2'){
		$point4 = '10';
		$tenloi4= 'Đi muộn (bỏ chạy)';
	}
	if ($loivipham4 == '3'){
		$point4 = '15';
		$tenloi4= 'Đi muộn sau 7 giờ';
	}
	if ($loivipham4 == '4'){
		$point4 = '10';
		$tenloi4= 'Đi muộn trèo tường';
	}
	if ($loivipham4 == '5'){
		$point4 = '02';
		$tenloi4= 'Vắng mặt không lí do giờ truy bài';
	}
	if ($loivipham4 == '6'){
		$point4 = '10';
		$tenloi4= 'Ra ngoài giờ truy bài (bỏ chạy)';
	}
	if ($loivipham4 == '7'){
		$point4 = '01';
		$tenloi4= 'Không đúng trang phục: áo phù hiệu giày';
	}
	if ($loivipham4 == '8'){
		$point4 = '05';
		$tenloi4= 'Tập trung muộn';
	}
	if ($loivipham4 == '9'){
		$point4 = '01';
		$tenloi4= 'Nghỉ không phép làm việc riêng trong giờ tập trung';
	}
	if ($loivipham4 == '10'){
		$point4 = '10';
		$tenloi4= 'Tập trung muộn sau 10 phút xếp hàng chưa ngay ngắn';
	}
	if ($loivipham4 == '11'){
		$point4 = '05';
		$tenloi4= 'Mất trật tự trong buổi tập trung';
	}
	if ($loivipham4 == '12'){
		$point4 = '01';
		$tenloi4= 'Không cất ghế sau giờ tập trung';
	}
	if ($loivipham4 == '13'){
		$point4 = '02';
		$tenloi4= 'Nói bậy';
	}
	if ($loivipham4 == '14'){
		$point4 = '02';
		$tenloi4= 'Ăn quà không đúng nơi quy định';
	}
	if ($loivipham4 == '15'){
		$point4 = '05';
		$tenloi4= 'Hút thuốc lá trong trường';
	}
	if ($loivipham4 == '16'){
		$point4 = '05';
		$tenloi4= 'Không dừng xe ở cổng trường';
	}
	if ($loivipham4 == '17'){
		$point4 = '10';
		$tenloi4= 'Không dừng xe ở cổng trường khi đã nhắc nhở';
	}
	if ($loivipham4 == '18'){
		$point4 = '10';
		$tenloi4= 'Không đội mũ bảo hiểm';
	}
	if ($loivipham4 == '19'){
		$point4 = '50';
		$tenloi4= 'Vô lễ với cán bộ giáo viên';
	}
	if ($loivipham4 == '20'){
		$point4 = '02';
		$tenloi4= 'Xả đổ rác không đúng nơi quy định';
	}
	if ($loivipham4 == '21'){
		$point4 = '01';
		$tenloi4= 'Trực nhật muộn đổ rác muộn';
	}

	if ($loivipham4 == '22'){
		$point4 = '05';
		$tenloi4= 'Không lấy sổ đầu bài sáng thứ 2';
	}
	if ($loivipham4 == '23'){
		$point4 = '02';
		$tenloi4= 'Trực nhật bẩn không trực khu vực';
	}
	if ($loivipham4 == '24'){
		$point4 = '02';
		$tenloi4= 'Để xe không đúng nơi quy định';
	}
	if ($loivipham4 == '25'){
		$point4 = '05';
		$tenloi4= 'Khu vực để xe lộn xộn không ngăn nắp';
	}
	if ($loivipham4 == '26'){
		$point4 = '02';
		$tenloi4= 'Không đóng cửa tắt điện sau giờ học';
	}
	if ($loivipham4 == '27'){
		$point4 = '02';
		$tenloi4= 'Sử dụng nhà vệ sinh không đúng cách';
	}
	if ($loivipham4 == '28'){
		$point4 = '05';
		$tenloi4= 'Làm vỡ cửa kính';
	}
	if ($loivipham4 == '29'){
		$point4 = '02';
		$tenloi4= 'Đá bóng không đúng nơi quy định';
	}
	if ($loivipham4 == '30'){
		$point4 = '05';
		$tenloi4= 'Sử dụng không đúng khu vực vệ sinh cho phép';
	}
	if ($loivipham4 == '31'){
		$point4 = '50';
		$tenloi4= 'Đánh nhau';
	}
	if ($loivipham4 == '32'){
		$point4 = '80';
		$tenloi4= 'Đánh nhau không khai báo thành khẩn';
	}
		if ($loivipham4 == '33'){
		$point4 = '20';
		$tenloi4= 'Vi phạm ATGT (có báo cáo về trường)';
	}

	if ($loivipham4 == '34'){
		$point4 = '10';
		$tenloi4= 'Vi phạm quy chế thi';
	}
	if ($loivipham4 == '35'){
		$point4 = '10';
		$tenloi4= 'Giờ tự quản ồn học sinh ra ngoài ảnh hưởng đến lớp khác';
	}
	if ($loivipham4 == '36'){
		$point4 = '03';
		$tenloi4= 'Cán bộ lớp BCH chi đoàn đến họp muộn';
	}
	if ($loivipham4 == '37'){
		$point4 = '05';
		$tenloi4= 'Cán bộ lớp BCH chi đoàn vắng mặt không lí do';
	}
	if ($loivipham4 == '38'){
		$point4 = '10';
		$tenloi4= 'Cán bộ lớp BCH chi đoàn không hoàn thành nhiệm vụ';
	}
	if ($loivipham4 == '39'){
		$point4 = '01';
		$tenloi4= 'Xung kích không thực hiện nhiệm vụ';
	}
	if ($loivipham4 == '40'){
		$point4 = '02';
		$tenloi4= 'Đội văn nghệ không thực hiện nhiệm vụ';
	}
	if ($loivipham4 == '41'){
		$point4 = '10';
		$tenloi4= 'Lớp trực tuần bỏ buổi trực';
	}
	if ($loivipham4 == '42'){
		$point4 = '05';
		$tenloi4= 'Lớp trực tuần xuống trực cổng muộn';
	}
	if ($loivipham4 == '43'){
		$point4 = '10';
		$tenloi4= 'Lớp trực tuần chuẩn bị không tốt cho buổi tập trung';
	}
	if ($loivipham4 == '44'){
		$point4 = '05';
		$tenloi4= 'Đội mũ bảo hiểm không cài quai';
	}
		// thuật toán tính tổng điểm trừ đối với lỗi vi phạm 5
	if ($loivipham5 == '1'){
		$point5 = '01';
		$tenloi5= 'Đi muộn';
	}
	if ($loivipham5 == '2'){
		$point5 = '10';
		$tenloi5= 'Đi muộn (bỏ chạy)';
	}
	if ($loivipham5 == '3'){
		$point5 = '15';
		$tenloi5= 'Đi muộn sau 7 giờ';
	}
	if ($loivipham5 == '4'){
		$point5 = '10';
		$tenloi5= 'Đi muộn trèo tường';
	}
	if ($loivipham5 == '5'){
		$point5 = '02';
		$tenloi5= 'Vắng mặt không lí do giờ truy bài';
	}
	if ($loivipham5 == '6'){
		$point5 = '10';
		$tenloi5= 'Ra ngoài giờ truy bài (bỏ chạy)';
	}
	if ($loivipham5 == '7'){
		$point5 = '01';
		$tenloi5= 'Không đúng trang phục: áo phù hiệu giày';
	}
	if ($loivipham5 == '8'){
		$point5 = '05';
		$tenloi5= 'Tập trung muộn';
	}
	if ($loivipham5 == '9'){
		$point5 = '01';
		$tenloi5= 'Nghỉ không phép làm việc riêng trong giờ tập trung';
	}
	if ($loivipham5 == '10'){
		$point5 = '10';
		$tenloi5= 'Tập trung muộn sau 10 phút xếp hàng chưa ngay ngắn';
	}
	if ($loivipham5 == '11'){
		$point5 = '05';
		$tenloi5= 'Mất trật tự trong buổi tập trung';
	}
	if ($loivipham5 == '12'){
		$point5 = '01';
		$tenloi5= 'Không cất ghế sau giờ tập trung';
	}
	if ($loivipham5 == '13'){
		$point5 = '02';
		$tenloi5= 'Nói bậy';
	}
	if ($loivipham5 == '14'){
		$point5 = '02';
		$tenloi5= 'Ăn quà không đúng nơi quy định';
	}
	if ($loivipham5 == '15'){
		$point5 = '05';
		$tenloi5= 'Hút thuốc lá trong trường';
	}
	if ($loivipham5 == '16'){
		$point5 = '05';
		$tenloi5= 'Không dừng xe ở cổng trường';
	}
	if ($loivipham5 == '17'){
		$point5 = '10';
		$tenloi5= 'Không dừng xe ở cổng trường khi đã nhắc nhở';
	}
	if ($loivipham5 == '18'){
		$point5 = '10';
		$tenloi5= 'Không đội mũ bảo hiểm';
	}
	if ($loivipham5 == '19'){
		$point5 = '50';
		$tenloi5= 'Vô lễ với cán bộ giáo viên';
	}
	if ($loivipham5 == '20'){
		$point5 = '02';
		$tenloi5= 'Xả đổ rác không đúng nơi quy định';
	}
	if ($loivipham5 == '21'){
		$point5 = '01';
		$tenloi5= 'Trực nhật muộn đổ rác muộn';
	}

	if ($loivipham5 == '22'){
		$point5 = '05';
		$tenloi5= 'Không lấy sổ đầu bài sáng thứ 2';
	}
	if ($loivipham5 == '23'){
		$point5 = '02';
		$tenloi5= 'Trực nhật bẩn không trực khu vực';
	}
	if ($loivipham5 == '24'){
		$point5 = '02';
		$tenloi5= 'Để xe không đúng nơi quy định';
	}
	if ($loivipham5 == '25'){
		$point5 = '05';
		$tenloi5= 'Khu vực để xe lộn xộn không ngăn nắp';
	}
	if ($loivipham5 == '26'){
		$point5 = '02';
		$tenloi5= 'Không đóng cửa tắt điện sau giờ học';
	}
	if ($loivipham5 == '27'){
		$point5 = '02';
		$tenloi5= 'Sử dụng nhà vệ sinh không đúng cách';
	}
	if ($loivipham5 == '28'){
		$point5 = '05';
		$tenloi5= 'Làm vỡ cửa kính';
	}
	if ($loivipham5 == '29'){
		$point5 = '02';
		$tenloi5= 'Đá bóng không đúng nơi quy định';
	}
	if ($loivipham5 == '30'){
		$point5 = '05';
		$tenloi5= 'Sử dụng không đúng khu vực vệ sinh cho phép';
	}
	if ($loivipham5 == '31'){
		$point5 = '50';
		$tenloi5= 'Đánh nhau';
	}
	if ($loivipham5 == '32'){
		$point5 = '80';
		$tenloi5= 'Đánh nhau không khai báo thành khẩn';
	}
		if ($loivipham5 == '33'){
		$point5 = '20';
		$tenloi5= 'Vi phạm ATGT (có báo cáo về trường)';
	}

	if ($loivipham5 == '34'){
		$point5 = '10';
		$tenloi5= 'Vi phạm quy chế thi';
	}
	if ($loivipham5 == '35'){
		$point5 = '10';
		$tenloi5= 'Giờ tự quản ồn học sinh ra ngoài ảnh hưởng đến lớp khác';
	}
	if ($loivipham5 == '36'){
		$point5 = '03';
		$tenloi5= 'Cán bộ lớp BCH chi đoàn đến họp muộn';
	}
	if ($loivipham5 == '37'){
		$point5 = '05';
		$tenloi5= 'Cán bộ lớp BCH chi đoàn vắng mặt không lí do';
	}
	if ($loivipham5 == '38'){
		$point5 = '10';
		$tenloi5= 'Cán bộ lớp BCH chi đoàn không hoàn thành nhiệm vụ';
	}
	if ($loivipham5 == '39'){
		$point5 = '01';
		$tenloi5= 'Xung kích không thực hiện nhiệm vụ';
	}
	if ($loivipham5 == '40'){
		$point5 = '02';
		$tenloi5= 'Đội văn nghệ không thực hiện nhiệm vụ';
	}
	if ($loivipham5 == '41'){
		$point5 = '10';
		$tenloi5= 'Lớp trực tuần bỏ buổi trực';
	}
	if ($loivipham5 == '42'){
		$point5 = '05';
		$tenloi5= 'Lớp trực tuần xuống trực cổng muộn';
	}
	if ($loivipham5 == '43'){
		$point5 = '10';
		$tenloi5= 'Lớp trực tuần chuẩn bị không tốt cho buổi tập trung';
	}
	if ($loivipham5 == '44'){
		$point5 = '05';
		$tenloi5= 'Đội mũ bảo hiểm không cài quai';
	}

	$tongdiem = $point1 + $point2 + $point3 + $point4 + $point5;
	if ($tongdiem == 1){
		$tongdiem = '01';
	}
		if ($tongdiem == 2){
		$tongdiem = '02';
	}
		if ($tongdiem == 3){
		$tongdiem = '03';
	}
		if ($tongdiem == 5){
		$tongdiem = '05';
	}
	function rebuild_date( $format, $time = 0 )
{
    if ( ! $time ) $time = time();

	$lang = array();
	$lang['sun'] = 'CN';
	$lang['mon'] = 'T2';
	$lang['tue'] = 'T3';
	$lang['wed'] = 'T4';
	$lang['thu'] = 'T5';
	$lang['fri'] = 'T6';
	$lang['sat'] = 'T7';
	$lang['sunday'] = 'Chủ nhật';
	$lang['monday'] = 'Thứ hai';
	$lang['tuesday'] = 'Thứ ba';
	$lang['wednesday'] = 'Thứ tư';
	$lang['thursday'] = 'Thứ năm';
	$lang['friday'] = 'Thứ sáu';
	$lang['saturday'] = 'Thứ bảy';
	$lang['january'] = 'Tháng Một';
	$lang['february'] = 'Tháng Hai';
	$lang['march'] = 'Tháng Ba';
	$lang['april'] = 'Tháng Tư';
	$lang['may'] = 'Tháng Năm';
	$lang['june'] = 'Tháng Sáu';
	$lang['july'] = 'Tháng Bảy';
	$lang['august'] = 'Tháng Tám';
	$lang['september'] = 'Tháng Chín';
	$lang['october'] = 'Tháng Mười';
	$lang['november'] = 'Tháng M. một';
	$lang['december'] = 'Tháng M. hai';
	$lang['jan'] = 'T01';
	$lang['feb'] = 'T02';
	$lang['mar'] = 'T03';
	$lang['apr'] = 'T04';
	$lang['may2'] = 'T05';
	$lang['jun'] = 'T06';
	$lang['jul'] = 'T07';
	$lang['aug'] = 'T08';
	$lang['sep'] = 'T09';
	$lang['oct'] = 'T10';
	$lang['nov'] = 'T11';
	$lang['dec'] = 'T12';

    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
    $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );
    $return = date( $format, $time );

    $replaces = array(
        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
        '/Monday(\W|$)/' => $lang['monday'] . "$1",
        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
        '/Friday(\W|$)/' => $lang['friday'] . "$1",
        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
        '/January(\W|$)/' => $lang['january'] . "$1",
        '/February(\W|$)/' => $lang['february'] . "$1",
        '/March(\W|$)/' => $lang['march'] . "$1",
        '/April(\W|$)/' => $lang['april'] . "$1",
        '/May(\W|$)/' => $lang['may'] . "$1",
        '/June(\W|$)/' => $lang['june'] . "$1",
        '/July(\W|$)/' => $lang['july'] . "$1",
        '/August(\W|$)/' => $lang['august'] . "$1",
        '/September(\W|$)/' => $lang['september'] . "$1",
        '/October(\W|$)/' => $lang['october'] . "$1",
        '/November(\W|$)/' => $lang['november'] . "$1",
        '/December(\W|$)/' => $lang['december'] . "$1" );

    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
	if (!isset($_SESSION['loggedin'])) {
		if(isset($accessToken)){
			$error2 = $userData['oauth_uid'];
			$usern = $userData['username'];
			$none = 'none';
			$PROP = 'block';
			$IN = 'none';
			$OUT = 'block';
			if ($error2 == 17230355) {// nếu id = 1
	// chuyển đến xung kích
	
		}else {
		die ('Bạn không có quyền truy cập vào đây!'); // chuyển đến trang login
		}
		} else {
		die ('Bạn không có quyền truy cập vào đây!'); // chuyển đến trang login
		}
	} else {
	$usern = $_SESSION['username'];
	$none = 'none';
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
	}



?>
<html>
<head>
	<title>Xác nhận gửi báo cáo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled JavaScript -->
<link href='https://www.blogger.com/static/v1/widgets/2549344219-widget_css_bundle.css' rel='stylesheet' type='text/css'/>
<meta charset='utf-8'/>
<meta content='width=device-width, initial-scale=1' name='viewport'/>
<meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
<meta content='width=device-width, initial-scale = 1.0, user-scalable = no' name='viewport'/>
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:600,700%7CDamion" rel="stylesheet" type="text/css">
<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
<meta content='blogger' name='generator'/>
<link href='https://c4k60.blogspot.com/favicon.ico' rel='icon' type='image/x-icon'/>
<link href='http://doantruongthptchuyenbienhoa.online/' rel='canonical'/>
<meta content='https://doantruongthptchuyenbienhoa.online/' property='og:url'/>
<meta content='Đoàn trường THPT Chuyên Biên Hoà' property='og:title'/>
<meta content='Cổng thông tin điện tử Đoàn trường THPT Chuyên Biên Hoà Online' property='og:description'/>
<!--[if IE]> <script> (function() { var html5 = ("abbr,article,aside,audio,canvas,datalist,details," + "figure,footer,header,hgroup,mark,menu,meter,nav,output," + "progress,section,time,video").split(','); for (var i = 0; i < html5.length; i++) { document.createElement(html5[i]); } try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {} })(); </script> <![endif]-->
<!-- Latest compiled and minified CSS -->
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'/>
<!-- jQuery library -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<!-- Latest compiled JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<link crossorigin='anonymous' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' rel='stylesheet'/>
<script src="https://global.oktacdn.com/okta-signin-widget/3.2.0/js/okta-sign-in.min.js" type="text/javascript"></script>

<link href="https://global.oktacdn.com/okta-signin-widget/3.2.0/css/okta-sign-in.min.css" type="text/css" rel="stylesheet"/>

<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<link crossorigin='anonymous' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' rel='stylesheet'/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body  style="    background-color: #f3f4f7;">
<style>
@media only screen and (max-width: 790px) {
.content {
	width: auto;
	margin: 0 auto;
    padding-left: 25px;
    padding-right: 25px;

}
}
</style>
	<style>
	.navtop {
	background-color: #2f3947;
	height: 60px;
	width: 100%;
	border: 0;
}
.navtop div {
	display: flex;
	margin: 0 auto;
	width: 1000px;
	height: 100%;
}
.navtop div h1, .navtop div a {
	display: inline-flex;
	align-items: center;
}
.navtop div h1 {
	flex: 1;
	font-size: 24px;
	padding: 0;
	margin: 0;
	color: #eaebed;
	font-weight: normal;
}
.navtop div a {
	padding: 0 20px;
	text-decoration: none;
	color: #c1c4c8;
	font-weight: bold;
}
.navtop div a i {
	padding: 2px 8px 0 0;
}
.navtop div a:hover {
	color: #eaebed;
}
body.loggedin {
	background-color: #f3f4f7;
}
.content {
	width: 1000px;
	margin: 0 auto;
}
.content h2 {
	margin: 0;
	padding: 25px 0;
	font-size: 22px;
	border-bottom: 1px solid #e0e0e3;
	color: #4a536e;
}
.content > p, .content > div {
	box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
	margin: 25px 0;
	padding: 25px;
	background-color: #fff;
}
.content > p table td, .content > div table td {
	padding: 5px;
}
.content > p table td:first-child, .content > div table td:first-child {
	font-weight: bold;
	color: #4a536e;
	padding-right: 15px;
}
.content > div p {
	padding: 5px;
	margin: 0 0 10px 0;
}
@media only screen and (max-width: 790px) {
.content {
	width: 720px;
	margin: 0 auto;
    padding-left: 25px;
    padding-right: 25px;

}
}
input[type=submit] {
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
	display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
	</style>
	<nav class='navbar navbar-inverse '>
<div class='container-fluid'>
<div class='navbar-header'>
<img src="/cbh.png" style="width: 40px;height: 40px;margin-top: 5px;margin-right: 5px;" alt="">
<button class='navbar-toggle' data-target='#myNavbar' data-toggle='collapse' type='button'>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
</button>
</div>
<div class='collapse navbar-collapse' id='myNavbar'>
<ul class='nav navbar-nav'>
<li class=''><a href='/'>Trang chủ</a></li>
<li class=''><a href='/forum'>Diễn đàn</a></li>
<li class=''><a class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href='/tracuu'>Tra cứu</a><div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item " style="
    margin-left: 10px;
" href="/loivipham">Các lỗi vi phạm</a><br>
          <a class="dropdown-item " style="
    margin-left: 10px;
" href="/thoikhoabieu">Thời khoá biểu</a><br>
          <a class="dropdown-item " style="
    margin-left: 10px;
" href="/hocsinh">Học sinh</a>
        </div></li>
<li class=''><a href='/xephang'>Xếp hạng</a></li>
<li class=''><a href='/hoatdong'>Hoạt động/Sự kiện</a></li>
<li class='active'><a href='/baocao'>Báo cáo</a></li>
<li class=''><a href='/lienhe'>Liên hệ</a></li>
</ul> 
<ul class='nav navbar-nav navbar-right flex-row justify-content-between ml-auto'>
<li id="profile" style="display:<?=$PROP?>">
<a href="profile.php"><i class="fas fa-user-circle"></i> Trang cá nhân</a></li>
<li class='' style="display:<?=$IN?>"><a href='/baocao'><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
<li class='' style="display:<?=$OUT?>"><a href='/logout.php'><i class="fas fa-sign-in-alt"></i> Đăng xuất</a></li>

</ul>

</div>
</div>
</nav>
<script>
function myFunction2() {
var str = document.getElementById("demo").innerHTML; 
str = str.replace(",", "+");
document.getElementById("demo").innerHTML = str;
}
myFunction2()


</script>
<?php

$datee = rebuild_date('Y-m-d' );
// Username doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO baocao (class, xungkich, date, diem, absent, vesinh, dongphuc, maloi1, maloi2, maloi3, maloi4, maloi5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$stmt->bind_param('ssssssssssss', $lop, $usern, $datee, $tongdiem, $vang, $vesinh, $dongphuc, $tenloi1, $tenloi2, $tenloi3, $tenloi4, $tenloi5);
	$stmt->execute();
	$message = 'Gửi báo cáo thành công!';
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	$message = 'Đã có lỗi xảy ra! Báo cáo của bạn chưa được gửi đi';
}
$con->close();	

?>
<div class="content">
	<h2><?=$message?></h2>
	<br>
	<h3>Nội dung báo cáo:</h3>
	<p>
	<b>Thời gian báo cáo:</b> <?=rebuild_date('H:i l, d/m/Y' )?><br>
	<b>Xung kích báo cáo:</b> <?=$usern?><br>
	<b>Lớp:</b> <?=$lop?><br>
	<b>Vắng:</b> <?=$vang?><br>
	<b>Vệ sinh:</b> <?=$vesinh?><br>
	<b>Đồng phục:</b> <?=$dongphuc?><br>
	<b>Số lỗi vi phạm:</b> <?=$soloi?><br>
	<b>Lỗi vi phạm 1: <?=$tenloi1?></b><br>
	<b style="display:<?=$loi2?>">Lỗi vi phạm 2: <?=$tenloi2?></b>
	<b style="display:<?=$loi3?>">Lỗi vi phạm 3: <?=$tenloi3?></b>
	<b style="display:<?=$loi4?>">Lỗi vi phạm 4: <?=$tenloi4?></b>
	<b style="display:<?=$loi5?>">Lỗi vi phạm 5: <?=$tenloi5?></b>
	<b id="demo">Tổng điểm trừ: <?=$tongdiem?></b><br>

	</p>

	<button style="float:left" type="button" class="btn btn-danger" onclick="location.href='/baocao'"><i class="fas fa-redo-alt"></i> Quay lại</button>
	</div>
	


</body>
</html>