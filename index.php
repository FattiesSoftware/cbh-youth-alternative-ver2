<!-- Project name: CBH Youth Online (Đoàn trường THPT Chuyên Biên Hoà Online)
	 Project link: https://youth.fattiesoftware.com/
 	 Created by Fatties Software 2020
 	 Team members:
 	 - Duong Tung Anh (CEO/Founder - C4K60 Bien Hoa Gifted High School) | https://fb.me/tunnaduong
	 - Hoang Phat (Co-Founder/Lead Developer - A1K60 Bien Hoa Gifted High School) | https://fb.me/hoangphathandsome
	 All rights reserved 
-->
<?php
// Chúng ta cần sử dụng phiên đăng nhập. Nên lúc nào cũng phải có bắt đầu phiên ở đầu tiên
session_start();
// GitHub API config file
require_once 'require/githubConfig.php';
// Github user class
require_once 'require/github.user.class.php';
$user = new User();
// Nếu người dùng chưa đăng nhập thì ẩn nút Profile và Đăng xuất
if (!isset($_SESSION['loggedin'])) {
	$PROP = 'none';
	$OUT = 'none';
} else {
	// Nếu đã đăng nhập thì hiện 2 nút này
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
}
// Nếu đã đăng nhập bằng Github thì hiện 2 nút này
if(isset($accessToken)){
	$none = 'none';
	$PROP = 'block';
	$IN = 'none';
	$OUT = 'block';
} 
// File head của trang
require "include/header.php";
?>
<link rel="stylesheet" href="style.css">


<script>
//<![CDATA[
(function($){
	$.fn.chocolate = function(args) {
		// Default Options
		var options = $.extend({
			interval 	: 3000,
			speed 		: 1000
		}, args);
		return this.each(function() {
			
			var original = $(this);
			// Create element
			$div = $(document.createElement('div'));
			$div.css({
				position 	: 'absolute',
				zIndex 		: 0,
				overflow 	: 'hidden',
			});
			original.prepend($div);
		    $div.css(copybackground());
		    $div.css('background-image', 'url(' + args.images[0] + ')');
			
			// This element background none
			original.css('background', 'none');
		    
		    // Clone bg element
		    $div2 = $div.clone();
		    $div.after($div2);
			
			// Set postion
			$div.css(copyPosition());
			$div2.css(copyPosition());
			// Resize window
			$(window).resize(function() {
				$div.css(copyPosition());
				$div2.css(copyPosition());
			});
			// Copy background style
			function copybackground() {
				var backgroundProperties = [
		        	'Attachment', 'Color', 'Repeat',
		        	'Position', 'Size', 'Clip', 'Origin'
		    		];
			    var prop,
			    	copyStyle 			= {},
			    	i 					= 0;
			    for (; i < backgroundProperties.length; i++) {
			    	prop = 'background' + backgroundProperties[i];
			    	copyStyle[prop] = original.css(prop);
			    }
			    return copyStyle;
			}
			// Copy position style
		    function copyPosition() {
		    	var corners 	= ['Top', 'Right', 'Bottom', 'Left'];
			    var i 			= 0,
			    	position 	= original.position(),
			    	copyStyle 	= {
			    		top 	: position.top,
			    		left 	: position.left,
			    		width 	: original.innerWidth(),
			    		height 	: original.innerHeight()
			    	};
			    for (; i < corners.length; i++) {
		    		corner = corners[i];
		    		copyStyle['margin' + corner] = original.css('margin' + corner);
		    		copyStyle['border' + corner] = original.css('border' + corner);
		    	}
		    	return copyStyle;
		    }
		    var count 	= 0,
		    	current = 0;
			// Change background function
			var slide = function() {
				if (current == args.images.length - 1) current = 0;
				else current++;
				
				if (count == 0) {
					$div2.fadeOut(options.speed);
					$div.css('background-image', 'url(' + args.images[current] + ')').fadeIn(options.speed);
					count++;
				} else {
					$div.fadeOut(options.speed);
					$div2.css('background-image', 'url(' + args.images[current] + ')').fadeIn(options.speed);
					count = 0;
				}
			}		
			setInterval(function() {slide();}, options.interval);
		});
	}
})(jQuery);
//]]>
</script>
<script>
		$(function() {
			$('body').chocolate({
				images		: ['/images/bienhoa11.jpg', '/images/bienhoa22.jpg','/images/bienhoa33.jpg'],
				interval	: 4000,
				speed		: 2000,
			});
		});
	</script>

<div>
<center>
	<div class='containerbg3' style="
    margin-bottom: 27px;
    padding-left: 0px;
    padding-bottom: 0px;
    padding-top: 0px;
    padding-right: 0px;
">
<div style="float: left;margin-top: 4px;margin-left: 5px;">
	<b>
<i class="fas fa-volume-up"></i> Thông báo |</b>

</div>
<div style="float: right;margin-top: 4px;">
		<marquee class="marq" width="100%" direction="left">
KỲ THI TỐT NGHIỆP THPT QUỐC GIA 2020 CHÍNH THỨC DIỄN RA   •   Thông báo về việc tập trung học sinh trúng tuyển vào lớp 10 năm học 2020-2021
</marquee>
</div>
	</div>
	<div class='containerbg2' style="padding-top: 5px;padding-bottom: 15px;margin-top: 25px;top: 76px;">
<img class="logo" src="/images/logo2.png"/>
</div>										  
</center>
<div class='containerbg sma'>
<big><b><i class="fas fa-question-circle"></i> Đây là gì?</b></big>
<p>Chào mừng đến với cổng thông tin điện tử Đoàn trường Chuyên Biên Hoà!<br> Đây là nơi để tra cứu các thông tin, vấn đề liên quan đến Đoàn trường THPT Chuyên Biên Hoà.</p>
<br>
<big><b><i class="fas fa-bolt"></i> Bạn có thể làm được gì với website này?</b></big>
<br>- Tra cứu xếp hạng tháng
<br>- Tra cứu thời khoá biểu
<br>- Gửi tài liệu cần in ấn trực tuyến
<br>- Biết được những sự kiện, hoạt động mới nhất của Đoàn trường THPT Chuyên Biên Hoà
<br>- Có thể đóng góp ý kiến, phản hồi của mình trực tiếp với xung kích hoặc thầy cô giáo qua tính năng diễn đàn
<br>Và còn nhiều hơn thế... Hãy tự mình khám phá nhé!
</p>
<br>
<?php
require "include/footer.php";
?>
</div>
</div>
	<?php
$home = 'active';
require "include/navbar.php";
?>

</body>
</html>