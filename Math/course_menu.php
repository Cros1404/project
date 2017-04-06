<?php 
session_start();
if ( $_SESSION['logged_in'] != true ){
header("Location: ../index.php");}

include "../connection.php";
include "../menu.php"; ?>

<div class="container" style="width:auto;float:left;"><div class="well">
  <h4 style="line-height: 130%;"><strong>Physics<br>and<br>Mathematics</strong></h4>
  <hr>
  <ul class="nav nav-pills nav-stacked" role="tablist">
  <?php 
    $myquery = "SELECT lessonIndex, videoURL, lessonName FROM lesson WHERE courseName='".basename(__DIR__)."';";
    $data = $db -> query($myquery);
    foreach ($data as $x)
    {
      if ($x['lessonIndex'] != 0)
        echo '<li id="lesson'.$x['lessonIndex'].'"><a href="'.$x['lessonIndex'].'.php">'.$x['lessonName'].'</a></li>';
    } 
  ?>
 <!--   <li id="lesson1"><a href="lesson1.php">Lesson 1</a></li>
    <li><a href="#">Lesson 2</a></li>
    <li><a href="#">Lesson 3</a></li>
    <li><a href="#">Lesson 4</a></li> -->
    <li><hr></li>
    <li id="livestream"><a href="livestream.php">Live Stream</a></li>
    <li><a href="#">Study Materials</a></li>
  </ul>
</div></div>

