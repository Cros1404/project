<?php include "connection.php"; ?>
<?php
session_start();
if ( $_SESSION['logged_in'] == true ){
	header("Location: index.php");
}
if ( isset($_POST['btnLogin'] ) ) {
	$given_username = filter_var( $_POST['usr'], FILTER_SANITIZE_STRING ) ;
	$given_password = filter_var( $_POST['pwd'], FILTER_SANITIZE_STRING ) ;
	$myquery = "SELECT username, password, teacher FROM user";
	$login_data = $db -> query($myquery);

	foreach ($login_data as $x)	{
		if ( $x['username'] == $given_username and $x['password'] == $given_password ) {
			$_SESSION["logged_in"] = true;
			if ( $x['teacher'] == 1 ){
				$_SESSION["teacher"] = true;
			}
			break; 
		}
	}
}
?>
<?php include "menu.php"; ?>
<script>
 document.getElementById("login").setAttribute("class", "active");
</script>
<div class="container" id="content" style="width:350px;"><div class="well well-lg">
	<form action="login.php" method="post">
	  <div class="form-group">
	    <label for="usr">Username:</label>
	    <input type="text" class="form-control" id="usr" name="usr" required>
	  </div>
	  <div class="form-group">
	    <label for="pwd">Password:</label>
	    <input type="password" class="form-control" id="pwd" name="pwd" required>
	  </div>
	  <button type="submit" class="btn btn-default" name="btnLogin">Login</button>
	</form>
<?php 
if(isset($_POST['btnLogin'])) {
	if ( $_SESSION["logged_in"] != true ){
		echo '<br><p class="alert alert-warning">Incorrect username or password!</p> </div></div>' ;
	}
	else {
		echo '	</div>
				<script>
					document.getElementById("content").innerHTML = \'<h4 class="alert alert-success">Logged in.</h4>\' ;
					document.getElementById("login").setAttribute("class", "");
				</script> ';
	}
} else {
	echo ' </div></div>' ;
}
?>

<?php include "footer.php"; ?>