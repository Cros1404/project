
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( $_SESSION["teacher"] != true ){
        header("Location: index.php");
        } ?>

<?php
include "connection.php";
$id=$_POST['chosen'];
$id_list=implode(",",$id);

$sql="DELETE FROM exam WHERE id_question IN ($id_list)";
$db->query($sql);
header("Location: EditTest4.php");
header("Location: Test4.php");



?>
        