<?php 
session_start();
if ( $_SESSION['logged_in'] != true ){
header("Location: index.php");
}
$_SESSION = array();
include "menu.php";?>
<h4 class="alert alert-info" style="width:350px;margin-left: 50px">Logged out.</h4>
<?php include "footer.php"; ?>