<?php include "connection.php"; ?>
<?php
if(isset($_POST['btnLogin'])) {

	$username = $_POST['usr'] ;
	$password = $_POST['pwd'] ;
	$myquery = "SELECT username, password, teacher FROM user";
	$login_data = $db -> query($myquery);

	foreach ($login_data as $x)	{
		if ( $x['username'] == $username and $x['password'] == $password ) {
			session_start();
			$_SESSION["logged_in"] = true;
			if ( $x['teacher'] == 1 ){
				$_SESSION["teacher"] = true;
			} 
		}
	}
}
?>
<?php include "menu.php"; ?>
<div class="container">
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
<p>
<?php 
if(isset($_POST['btnLogin'])) {
	if ( $_SESSION["logged_in"] != true ){
		echo '<p class="bg-warning">Username or password incorrect.</p>' ;
	}
	else {
		echo '<p class="bg-success">Succesfully logged in.</p>' ;
	}
}
?>
</p></div>

<?php include "footer.php"; ?>