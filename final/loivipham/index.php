<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Include GitHub API config file
require_once 'gitConfig.php';

// Include and initialize user class
require_once 'User.class.php';
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
$tracuu = 'active';
require "include/header.php";
require "include/navbar.php";
?>
  


<div class="container" style="margin-right: 15px;margin-left: 15px;">
        <h1><b>Tra cứu lỗi vi phạm</b></h1>
<p>1. Đi muộn (Trừ 1 điểm)<br />
2. Đi muộn (bỏ chạy) (-10 điểm)<br />
3. Đi muộn sau 7 giờ (-15 điểm)<br />
4. Đi muộn trèo tường (-10 điểm)<br />
5. Vắng mặt không lí do giờ truy bài (-2 điểm)<br />
6. Ra ngoài giờ truy bài (bỏ chạy) (-10 điểm)<br />
7. Không đúng trang phục: áo,phù hiệu,giày (-1 điểm)<br />
8. Tập trung muộn (-5 điểm)<br />
9. Nghỉ không phép, làm việc riêng trong giờ tập trung (-1 điểm)<br />
10. Tập trung muộn, sau 10 phút xếp hàng chưa ngay ngắn (-10 điểm)<br />
11. Mất trật tự trong buổi tập trung (-5 điểm)<br />
12. Không cất ghế sau giờ tập trung (-1 điểm)<br />
13. Nói bậy (-2 điểm)<br />
14. Ăn quà không đúng nơi quy định (-2 điểm)<br />
15. Hút thuốc lá trong trường (-5 điểm)<br />
16. Không dừng xe ở cổng trường (-5 điểm)<br />
17. Không dừng xe ở cổng trường khi đã nhắc nhở (-10 điểm)<br />
18. Không đội mũ bảo hiểm (-10 điểm)<br />
19. Vô lễ với cán bộ giáo viên (-50 điểm)<br />
20. Xả, đổ rác không đúng nơi quy định (-2 điểm)<br />
21. Trực nhật muộn, đổ rác muộn (-1 điểm)<br />
22. Không lấy sổ đầu bài sáng thứ 2 (-5 điểm)<br />
23. Trực nhật bẩn, không trực khu vực (-2 điểm)<br />
24. Để xe không đúng nơi quy định (-2 điểm)<br />
25. Khu vực để xe lộn xộn, không ngăn nắp (-5 điểm)<br />
26. Không đóng cửa tắt điện sau giờ học (-2 điểm)<br />
27. Sử dụng nhà vệ sinh không đúng cách (-2 điểm)<br />
28. Làm vỡ cửa kính (-5 điểm)<br />
29. Đá bóng không đúng nơi quy định (-2 điểm)<br />
30. Sử dụng không đúng khu vực vệ sinh cho phép (-5 điểm)<br />
31. Đánh nhau (-50 điểm)<br />
32. Đánh nhau không khai báo thành khẩn (-80 điểm)<br />
33. Vi phạm ATGT (có báo cáo về trường) (-20 điểm)<br />
34. Vi phạm quy chế thi (-10 điểm)<br />
35. Giờ tự quản ồn, học sinh ra ngoài, ảnh hưởng đến lớp khác (-10 điểm)<br />
36. Cán bộ lớp, BCH chi đoàn đến họp muộn (-3 điểm)<br />
37. Cán bộ lớp, BCH chi đoàn vắng mặt không lí do (-5 điểm)<br />
38. Cán bộ lớp, BCH chi đoàn không hoàn thành nhiệm vụ (-10 điểm)<br />
39. Xung kích không thực hiện nhiệm vụ (-1 điểm)<br />
40. Đội văn nghệ không thực hiện nhiệm vụ (-2 điểm)<br />
41. Lớp trực tuần bỏ buổi trực (-10 điểm)<br />
42. Lớp trực tuần xuống trực cổng muộn (-5 điểm)<br />
43. Lớp trực tuần chuẩn bị không tốt cho buổi tập trung (-10 điểm)<br />
44. Đội mũ bảo hiểm không cài quai (-5 điểm)<br />
</p>

</div>
<?php
      require "include/footer.php";
?>
      <!-- Bootstrap nhân JavaScript
    ================================================== -->
    <!-- Đặt ở cuối mã trang web để trang tải nhanh hơn -->
    <!-- IE10 viewport hack cho Surface/bug máy tính bàn Windows 8 -->
    <script src="https://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="//code.tidio.co/xk9nqvz3a3dzutblmspl6ct5spdbueji.js"> </script>
  </body>
</html>
