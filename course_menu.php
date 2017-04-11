<?php 
session_start();

if ( $_SESSION['logged_in'] != true )
  header("Location: index.php");

if ( isset($_POST['btnEditMode'] ) )
  $_SESSION['EditMode'] = true;

if ( isset($_POST['btnExitEditMode'] ) )
  $_SESSION['EditMode'] = false;

include "connection.php";
include "menu.php"; ?>
<div class="container"><div class="row"><div class="col-12 col-md-auto">
<div class="container" style="width:auto;float:left;"><div class="well">
  <h4 style="line-height: 130%;"><strong>
  <?php
  echo str_replace(" ", "<br>", $_GET['courseName']) ;
  ?></strong></h4>
  <hr>
  <ul class="nav nav-pills nav-stacked" role="tablist">
  <?php 
    $stmt = $db -> prepare("SELECT lessonID, videoURL, lessonName FROM lesson WHERE courseName=:courseName");
    $stmt -> bindParam( ':courseName', $_GET['courseName'] );
    $stmt -> execute();
    foreach ($stmt as $x)
    {
      echo '<li id="lesson'.$x['lessonID'].'"><a href="lesson.php?courseName='.$_GET['courseName'].'&id='.$x['lessonID'].'">'.$x['lessonName'].'</a></li>';
    } 
  ?>
   <!-- <li id="lesson1"><a href="lesson1.php"></a></li>
    <li><a href="#">Lesson 2</a></li>
    <li><a href="#">Lesson 3</a></li>
    <li><a href="#">Lesson 4</a></li> -->
    <li><hr></li>
    <li id="livestream"><a href="lesson.php?courseName=<?php echo $_GET['courseName'];?>&id=livestream">Live Stream</a></li>
    <li id="materials"><a href="lesson.php?courseName=<?php echo $_GET['courseName'];?>&id=materials">Study Materials</a></li>
  </ul>
</div></div></div>

