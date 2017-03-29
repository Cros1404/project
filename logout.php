<?php 
session_start();
if ( $_SESSION['logged_in'] != true ){
header("Location: index.php");
}
$_SESSION = array();
include "menu.php";?>
<h4 class="container alert alert-info">Logged out.</h4>
<?php include "footer.php"; ?>