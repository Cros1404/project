<?php include "menu.php"; ?>
<div class="container">
	<form action="login.php" method="post">
	  <div class="form-group">
	    <label for="usr">Username:</label>
	    <input type="text" class="form-control" id="usr" name="usr">
	  </div>
	  <div class="form-group">
	    <label for="pwd">Password:</label>
	    <input type="password" class="form-control" id="pwd" name="pwd">
	  </div>
	  <button type="submit" class="btn btn-default" name="btnLogin">Login</button>
	</form>
</div>

<?php 
session_start();

if(isset($_POST['btnLogin'])) {
    echo 'Hello '; 
}
?>
<?php include "footer.php"; ?>