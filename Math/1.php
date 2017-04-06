<?php include "course_menu.php"; ?>
<script type="text/javascript">
	document.getElementById("lesson1").setAttribute("class", "active");
</script>
<div class="container" style="width:auto;float:right;margin-right:450px">

<?php 
$myquery = "SELECT videoURL FROM lesson WHERE courseName='".basename(__DIR__)."' AND lessonIndex=".basename(__FILE__, '.php').";";
foreach ($data as $x)
{
    echo '<iframe width="560" height="315" src="'.$x['videoURL'].'" frameborder="0" allowfullscreen></iframe>';
} 	 ?> 

<iframe width="560" height="315" src="https://www.youtube.com/embed/vN2jAio0djg" frameborder="0" allowfullscreen></iframe>
<br><br><a href="#">Exercises 1</a><br>
<a href="#">Exercises 1</a><br>
<a href="#">Exercises 1</a>

<hr><a href="#">Materials</a><br>
<a href="#">Materials</a><br>
<a href="#">Materials</a>
</div>
<?php include "../footer.php" ?>