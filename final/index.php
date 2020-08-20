<?php
// We need to use sessions, so you should always start sessions using the below code.
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
				images		: ['/bienhoa11.jpg', '/bienhoa22.jpg','/bienhoa33.jpg'],
				interval	: 4000,
				speed		: 2000,
			});
		});
	</script>
	<style id='page-skin-1' type='text/css'><!--
/*
-----------------------------------------------
Template Name  : Ego Cafe
Author         : NewBloggerThemes.com
Author URL     : http://newbloggerthemes.com/
Theme URL      : http://newbloggerthemes.com/ego-cafe-blogger-template/
Created Date   : Saturday, August 23, 2014
License        : This template is free for both personal and commercial use, But to satisfy the 'attribution' clause of the license, you are required to keep the footer links intact which provides due credit to its authors.For more information about this license, please use this link :http://creativecommons.org/licenses/by/3.0/
----------------------------------------------- */
wrappernbt{
position: relative;
width: 200px;
height: 200px;
}
contentabove{
color: #FFFFFF;
font-size: 26px;
font-weight: bold;
text-shadow: -1px -1px 1px #000, 1px 1px 1px #000;
position: relative;
z-index: 100;
}
mycarousel{
color: #999999;
position: absolute;
top: 0;
left: 0;
z-index: -100;
}
.btn-group button { margin: 0 7px; }
.modal-backdrop {
/* bug fix - no overlay */
display: none;
}
/* Variable definitions
====================
*/
/* Use this with templates/template-twocol.html */
.section, .widget {margin:0;padding:0;}
/* Reset */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,dfn,var{font-style:normal;font-weight:normal;}li{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}
html,body{height:100%;
font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
}
html, body {
margin: 0;
padding: 0;
width: 100%;
height: 100%;
}
body{
margin:0;
padding:0;
text-align:left;
background-position: center center;
background-attachment: fixed;
background-repeat: repeat;
background-size: cover;
box-shadow:inset 0 0 100px rgba(0,0,0,0.5);
position:relative
}
.containerbg {
width: 800px;
padding: 27px;
background-color: rgba(0,0,0,.6);
border-radius: 10px;
position: absolute;
top: 70px;
left: 48%;
margin-left: -384px;
color: #fff;
padding-top: 24px;
margin-top: 125px;
    top: 150px;
}
.containerbg2 {
width: 800px;
padding: 27px;
background-color: rgba(0,0,0,.6);
border-radius: 10px;
position: absolute;
top: 70px;
left: 48%;
margin-left: -384px;
color: #fff;
padding-top: 24px;
margin-top: 0px;
}
.logo{
	width: 550px;
}

#wrappernbt{position:relative;width:100%;margin:auto}
#headernbt{width:100%;padding:40px 0;margin:auto}
h1{font-family:'Damion',cursive;font-size:103px;text-align:center;color:#fff;}
h2{font-family:'Josefin Sans',sans-serif;font-size:30px;letter-spacing:4px;text-align:center;color:#fff;}
h2 strong.sep-onenbt{width:60px;height:1px;background:#fff;position:absolute;margin-left:-80px;margin-top:15px}
h2 strong.sep-twonbt{width:60px;height:1px;background:#fff;position:absolute;margin-left:15px;margin-top:15px}
#middlenbt{width:100%;padding:0px 0;margin:0px 0;text-align:center}
#middlenbt p{font-size:24px;color:#000;line-height:34px;padding:0 30%;text-align:center}
#middlenbt p span{color:#e63b4dtext-align:center}
#footernbt{width:100%;padding:130px 0;margin:130px 0;
margin-top: 25px;
margin-right: 0px;
margin-bottom: 25px;
margin-left: 0px;
padding-top: 245px;
padding-right: 0px;
padding-bottom: 20px;
padding-left: 0px;
}
@media screen and (max-width: 768px){
.containerbg {
text-align:left;
width: 400px;
padding: 15px;
top: 70px;
left: 96%;
margin-left: -384px;
margin-top: 0px;
    top: 120px;
}
.containerbg2 {
text-align:center;
width: 400px;
padding: 15px;
top: 70px;
left: 96%;
margin-left: -384px;
margin-top: 0px;
}
.logo{
	width:336px;
}
.logo2{
	margin-left: 10px;
}
.container {

    margin-right: 3px;
    margin-left: 3px;

}
.sma {
padding-top: 7px;
    margin-top: 80px;
    top: 120px;
}
#headernbt{width:100%;padding:5px 0;margin:auto}
h1{font-size:53px;color:#fff;}
h2{font-size:15px;letter-spacing:2px;color:#fff;}
h2 strong.sep-onenbt{width:30px;margin-left:-40px;margin-top:7px}
h2 strong.sep-twonbt{width:30px;margin-left:10px;margin-top:7px}
#middlenbt{margin:50px 0 20px;width:100%;padding:5%;text-align:center}
#middlenbt p{font-size:10px;color:#000;line-height:24px;padding:0;text-align:center;}
#middlenbt p span{color:#e63b4d}
}
h2.date-header{margin:10px 0;display:none}
.main .widget{margin:0;padding:0}
#comments{padding:10px;margin-bottom:20px}
#comments h4{font-size:22px;margin-bottom:10px}
.deleted-comment{font-style:italic;color:gray}
#blog-pager-newer-link{float:left}
#blog-pager-older-link{float:right}
#blog-pager{text-align:center;padding:5px}
.feed-links{clear:both}
#navbar-iframe{height:0;visibility:hidden;display:none}
.separator a[style="margin-left: 1em; margin-right: 1em;"] {margin-left: auto!important;margin-right: auto!important;}
.themewidgetsec {display:none;}
.themewidgetsec .widget {display:none;}
.copyrightnbt {margin-top:10px;margin-bottom:10px;color:#fff;font-size:14px;text-align:center;}
.copyrightnbt a {color:#fff;text-decoration:none;}
.copyrightnbt a:hover {color:#eee;text-decoration:none;}
/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.h69, h69 {
font-size: 20px;
color: #333;
text-align: left;
font-weight: bold;
}
.h70, h70 {
font-size: 15px;
color: #333;
text-align: left;
.th, th, .td, td {
color: #333;
}
.h1, h1 {
color:#fff;
}
h3 {
    font-size: 140%;
    font-weight: normal;
}
--></style>
<center><div class='containerbg2' style="
    padding-top: 5px;
    padding-bottom: 15px;
">

<img class="logo" src="/logo2.png" style=""/>


</div>
						
					  
</center>
<div class='containerbg sma' >


<big><b><i class="fas fa-question-circle"></i> Đây là gì?</b></big>
<p>Chào mừng đến với cổng thông tin điện tử Đoàn trường Chuyên Biên Hoà!<br> Đây là nơi để tra cứu các thông tin, vấn đề liên quan đến Đoàn trường THPT Chuyên Biên Hoà.</p>
<br>
<big><b><i class="fas fa-bolt"></i> Bạn có thể làm được gì với website này?</b></big>
<p>- Tra cứu các lỗi vi phạm trong tuần của lớp
<br>- Tra cứu xếp hạng tháng
<br>- Tra cứu thời khoá biểu
<br>- Tra cứu danh sách học sinh của trường
<br>- Gửi tài liệu cần in ấn trực tuyến
<br>- Biết được những sự kiện, hoạt động mới nhất của Đoàn trường THPT Chuyên Biên Hoà
<br>- Có thể đóng góp ý kiến, phản hồi của mình trực tiếp với xung kích hoặc thầy cô giáo qua tính năng diễn đàn
<br>Và còn nhiều hơn thế... Hãy tự mình khám phá nhé!
</p>
<br>
<?php
require "include/footer.php";
?>
<style>
.column {    
    display: inline-block;
}
</style>
</div>

<?php
$home = 'active';
require "include/navbar.php";

?>


<script src="//code.tidio.co/xk9nqvz3a3dzutblmspl6ct5spdbueji.js"> </script>
</body>
</html>
<footer class="footer">

		<hr>
        
        
      </footer>
      <!-- Bootstrap nhân JavaScript
    ================================================== -->
    <!-- Đặt ở cuối mã trang web để trang tải nhanh hơn -->
    <!-- IE10 viewport hack cho Surface/bug máy tính bàn Windows 8 -->
    <script src="https://v4-alpha.getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>