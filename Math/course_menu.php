<?php 
session_start();
if ( $_SESSION['logged_in'] != true ){
header("Location: ../index.php");}
include "../menu.php"; ?>

<div class="container" style="width:auto;float:left;"><div class="well">
  <h4 style="line-height: 130%;"><strong>Physics<br>and<br>Mathematics</strong></h4>
  <hr>
  <ul class="nav nav-pills nav-stacked" role="tablist">
    <li id="lesson1"><a href="lesson1.php">Lesson 1</a></li>
    <li><a href="#">Lesson 2</a></li>
    <li><a href="#">Lesson 3</a></li>
    <li><a href="#">Lesson 4</a></li>
    <li><hr></li>
    <li><a href="#">Live Stream</a></li>
    <li><a href="#">Study Materials</a></li>
  </ul>
</div></div>

