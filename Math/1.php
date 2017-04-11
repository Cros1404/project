<?php include "course_menu.php";?>
<script type="text/javascript">
	document.getElementById("lesson1").setAttribute("class", "active");
</script>
<div class="col col-lg-2"><div class="container" style="line-height: 200%;">

<?php 
// find video link
$myquery = "SELECT videoURL FROM lesson WHERE courseName='".basename(__DIR__)."' AND lessonIndex=".basename(__FILE__, '.php').";";
$data = $db -> query($myquery) ;
$videoURL = $data -> fetch() ;
echo '<iframe width="560" height="315" src="'.$x['videoURL'].'" frameborder="0" allowfullscreen></iframe>';
if ($_SESSION['EditMode']) {
	echo '<br><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span> Edit Video URL</button> ' ;
	echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> Remove Lesson</button><br> ' ;
}



//find exercise link
$myquery = "SELECT URL FROM exercise WHERE courseName='".basename(__DIR__)."' AND lessonIndex=".basename(__FILE__, '.php').";";
$data = $db -> query($myquery) ;
foreach ($data as $index => $x) {
	echo '<br><a href="'.$x['URL'].'" target="_blank">Exercises '.($index + 1).' </a>' ;
	if ($_SESSION['EditMode']) {
		echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editExercise"><span class="glyphicon glyphicon-edit"></span></button> ' ;
		echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span></button>' ;
	}
}


echo '<hr>' ;

//find material links
$myquery = "SELECT URL, materialName FROM material WHERE courseName='".basename(__DIR__)."' AND lessonIndex=".basename(__FILE__, '.php').";";
$data = $db -> query($myquery) ;
foreach ( $data as $index => $x ) {
	if ( $index != 0 )
		echo '<br>';
	echo '<a href="'.$x['URL'].'" target="_blank">'.$x['materialName'].' </a>' ;
	if ($_SESSION['EditMode']) {
		echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span></button> ';
		echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span></button>' ;
	}
}


?>
<br><br>
<form action="<?php echo basename(__FILE__); ?>" method="post">
<?php
if ($_SESSION['teacher'])
	if ($_SESSION['EditMode'])
		echo '<button type="submit" class="btn btn-success" name="btnExitEditMode">Exit Edit Mode</button>';
	else
		echo '<button type="submit" class="btn btn-success" name="btnEditMode">Edit Mode</button>';
?>
</form>
</div></div></div></div>

<div id="editExercise" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Exercise URL</h4>
      </div>
      <div class="modal-body">
	    <form action="courses.php" method="post">
		      <div class="form-group">
				  <label for="course_name">New exercise URL:</label>
				  <input type="text" class="form-control" id="course_name" name="course_name" required>
			  </div>
			  <button type="submit" class="btn btn-default" name="btnCreate">Submit</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
?>
<?php include "../footer.php" ?>