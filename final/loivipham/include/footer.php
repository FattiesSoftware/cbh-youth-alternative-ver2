<footer class="footer">
<hr>
    <div class="container" style="
    margin-right: 15px;
    margin-left: 15px;
">
    <div class="column">
        <p>&copy; Đoàn trường Chuyên Biên Hoà</p>
    </div>

    <div class="column">
        <p id="demo"></p>
    </div>

     <div class="column">
        <p> Designed and developed with <i class="fas fa-heart"></i> by <a href="https://facebook.com/tunnaduong/">Fatties Software</a></p>
</div>
<style>
.column {    
    display: inline-block;
}
</style>
</div>
<script>

function myFunction() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("demo").innerHTML = n + ".";
}
myFunction()
</script>
      
      </footer>