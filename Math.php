<?php 
session_start();
include "menu.php" ?>
<div class="container" style="width:auto;float:left;"><div class="well">
  <h4 style="line-height: 130%;"><strong>Physics<br>and<br>Mathematics</strong></h4>
  <hr>
  <ul class="nav nav-pills nav-stacked" role="tablist">
    <li ><a onclick="course_1_lesson_1()" href="#">Lesson 1</a></li>
    <li><a href="#">Lesson 2</a></li>
    <li><a href="#">Lesson 3</a></li>
    <li><a href="#">Lesson 4</a></li>
    <li><hr></li>
    <li><a href="#">Live Stream</a></li>
  </ul>
</div></div>

<div class="container">
  <div class="Content_of_course">
    <h2 id="Title_of_lesson">About The Course</h2>
    <p id="content_of_course1_lesson1">Over view about the course...</p>
    <p id="change_video"></p>
  </div>

</div>

<script>
function course_1_lesson_1(){
  document.getElementById("Title_of_lesson").innerHTML="Title of lesson 1";
  document.getElementById("content_of_course1_lesson1").innerHTML="<iframe width=\"700\" height=\"600\" src=\"https://www.youtube.com/embed/YAbI4w95cTE\" type=\"video/mp4\"></iframe>";

}
</script>

<?php include "footer.php" ?>
