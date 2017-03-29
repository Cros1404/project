<?php session_start();
if ( $_SESSION['logged_in'] != true ){
header("Location: index.php");
} ?>
<?php include "menu.php"; ?>

<div class="container list_group">
  <a href="#" class="list-group-item"><h4>Mathematics</h4></a>
  <a href="#" class="list-group-item"><h4>Physics</h4></a>
  <a href="#" class="list-group-item"><h4>English</h4></a>
</div>

<script>
 document.getElementById("courses").setAttribute("class", "active");
 document.getElementByClassName("list-group-item").style.color = "blue" ;
</script>
<?php include "footer.php"; ?>