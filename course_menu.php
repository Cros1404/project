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
<div class="container"><div class="row"><div class="col-12 col-auto"><div class="well" style="width:auto;float:left">
  <h4 style="line-height: 130%;"><strong><i>
  <?php
  echo str_replace(" ", "<br>", $_GET['courseName']) ;
  ?></i></strong></h4>
  <hr>
  <ul class="nav nav-pills nav-stacked" role="tablist">
  <?php 
    $stmt = $db -> prepare("SELECT ID, videoURL, lessonName FROM lesson WHERE courseName=:courseName");
    $stmt -> bindParam( ':courseName', $_GET['courseName'] );
    $stmt -> execute();
    $empty = true;
    foreach ($stmt as $x){
      $empty = false;
      echo '<li id="lesson'.$x['ID'].'"><a href="lesson.php?courseName='.$_GET['courseName'].'&id='.$x['ID'].'" id="lessonlink'.$x['ID'].'">'.$x['lessonName'].'</a></li>';
    }
    if ($empty)
      echo '<li><i style="color:grey">No lessons available.</i></li>';

    if ( $_SESSION['EditMode'] ){
      echo '<li><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="width:170px;" onclick="btnPress(\'Add New\', \'Lesson\')"><span class="glyphicon glyphicon-plus"></span> Add New Lesson</button></li>' ;
    }


  ?>  
    <li><hr></li>
    <li id="livestream"><a href="lesson.php?courseName=<?php echo $_GET['courseName'];?>&id=livestream">Live Stream</a></li>
    <li id="materials"><a href="lesson.php?courseName=<?php echo $_GET['courseName'];?>&id=materials">Study Materials</a></li>
<?php 
if ( $_SESSION['EditMode'] ){
      echo '<li><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" style="width:170px;" onclick="btnPress(\'Edit\', \'Course Name\', \''.$_GET['courseName'].'\')"><span class="glyphicon glyphicon-edit"></span> Edit Course Name</button></li>' ;
      echo '<li><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="width:170px;" onclick="btnPress(\'Delete\', \'This Course\', \''.$_GET['courseName'].'\')"><span class="glyphicon glyphicon-remove"></span> Delete This Course</button></li>' ;
    }
?>
  </ul>
</div></div>
