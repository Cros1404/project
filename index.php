<?php session_start(); ?>
<?php include "menu.php"; ?>

<div class="container">
	<div class="page-header"><h1>Distance Learning</h1> </div>
	<p id="content">Distance Learning is website for studying remotely.</p></div>

<script>
 document.getElementById("home").setAttribute("class", "active");
 if ( "<?php echo $_SESSION["logged_in"]; ?>" != "1" ){
 document.getElementById("content").innerHTML += " Log in to access the courses."
 }
</script>
<?php include "footer.php"; ?>