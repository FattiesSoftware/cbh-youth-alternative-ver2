<!-- Project name: CBH Youth Online (Đoàn trường THPT Chuyên Biên Hoà Online)
   Project link: https://youth.fattiesoftware.com/
   Created by Fatties Software 2020
   Team members:
   - Duong Tung Anh (CEO/Founder - C4K60 Bien Hoa Gifted High School) | https://fb.me/tunnaduong
   - Hoang Phat (Co-Founder/Lead Developer - A1K60 Bien Hoa Gifted High School) | https://fb.me/hoangphathandsome
   All rights reserved 
-->
<!--
  Chân trang của dự án
  Dạng bảng nhưng được hiển thị cùng dòng
  -->
<footer class="footer">
    <div class="column">
        <p>&copy; Đoàn trường Chuyên Biên Hoà</p>
    </div>
    <div class="column">
        <p id="demo"></p>
    </div>
     <div class="column">
        <p> Designed and developed with <i class="fas fa-heart"></i> by <a href="https://facebook.com/tunnaduong/">Fatties Software</a></p>
<style>
.column {    
    display: inline-block;
}
</style>
</div>
<!--Thuật toán lấy năm hiện tại kèm dấu chấm và hiển thị vào phần tử 'demo'-->
<script>
function myFunction() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("demo").innerHTML = n + ".";
}
myFunction()
</script>
<!--Script của Tidio Talk-->
<script src="//code.tidio.co/xk9nqvz3a3dzutblmspl6ct5spdbueji.js"> </script>
      </footer>