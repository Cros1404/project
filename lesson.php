<?php include "course_menu.php";?>
<div class="col col-lg-2"><div class="container" style="line-height: 200%;">

<?php 
if ( $_GET['id'] == "livestream" ){
	echo '<script type="text/javascript">
	document.getElementById("livestream").setAttribute("class", "active");
</script>';
} else if ( $_GET['id'] == "materials" ){
	echo '<script type="text/javascript">
	document.getElementById("materials").setAttribute("class", "active");
</script>';
} else
	include "lesson_page.php";?>

<br><br>
<form action="lesson.php?courseName=<?php echo $_GET['courseName'];?>&id=<?php echo $_GET['id'];?>" method="post">
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
<?php include "../footer.php" ?>