<nav class='navbar navbar-inverse'>
<div class='container-fluid'>
<div class='navbar-header'>
	<a href='/'>
	<img src="/cbh.png" class="logo2" style="width: 40px;height: 40px;margin-top: 5px;margin-right: 5px;margin-left: 5px;" alt="">
</a>

<button class='navbar-toggle' data-target='#myNavbar' data-toggle='collapse' type='button'>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
</button>
</div>
<div class='collapse navbar-collapse' id='myNavbar'>
<ul class='nav navbar-nav'>
<li class="<?=$home?>"><a href='/'><i class="fas fa-home"></i> Trang chủ</a></li>
<li class="<?=$diendan?>"><a href='/forum'><i class="fas fa-comments"></i> Diễn đàn</a></li>
<li class="<?=$loa?>"><a href='/loaphatthanh'><i class="fas fa-volume-up"></i> Loa lớn</a></li>
<li class="<?=$tracuu?>"><a class="nav-link dropdown-toggle" href="/tracuu" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i> Tra cứu</a>
		  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item " style="
    margin-left: 10px;
" href="/loivipham"><i class="fas fa-times"></i> Các lỗi vi phạm</a><br>
          <a class="dropdown-item " style="
    margin-left: 10px;
" href="/thoikhoabieu"><i class="fas fa-table"></i> Thời khoá biểu</a><br>
          <a class="dropdown-item " style="
    margin-left: 10px;
" href="/hocsinh"><i class="fas fa-user-graduate"></i> Học sinh</a>
        </div></li>
<li class="<?=$xephang?>"><a href='/xephang'><i class="fas fa-trophy"></i> Xếp hạng</a></li>
<li class="<?=$sukien?>"><a href='/hoatdong'><i class="far fa-newspaper"></i> Tin tức</a></li>
<li class="<?=$baocao?>"><a href='/baocao'><i class="fas fa-file-signature"></i> Báo cáo</a></li>
<li class="<?=$lienhe?>"><a href='/lienhe'><i class="far fa-address-book"></i> Liên hệ</a></li>
<li class="<?=$svhd?>"><a href='/svhd'><i class="fas fa-book-reader"></i> CLB Sách</a></li>
<li class="<?=$inan?>"><a href='/inan'><i class="fas fa-file-alt"></i> In tài liệu</a></li>
</ul> 
<ul class='nav navbar-nav navbar-right flex-row justify-content-between ml-auto'>
<li class="<?=$trangcanhan?>" id="profile" style="display:<?=$PROP?>">
<a href="profile.php"><i class="fas fa-user-circle"></i> Trang cá nhân</a></li>
<li class="<?=$dangnhap?>" style="display:<?=$IN?>"><a href='/baocao'><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
<li class="<?=$dangxuat?>" style="display:<?=$OUT?>"><a href='/logout.php'><i class="fas fa-sign-in-alt"></i> Đăng xuất</a></li>

</ul>

</div>
</div>
</nav>