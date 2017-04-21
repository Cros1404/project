<?php include "connection.php" ?>

<?php session_start();
if ( $_SESSION['teacher'] != true ){
header("Location: index.php");
} ?>
