<?php include "course_menu.php";?>

<div class="col col-lg-7" style="line-height: 200%;margin-left: 10px">

<?php 
if ( $_SESSION["error"] == 1 ){
		echo '<p class="alert alert-warning"><strong>Error! </strong>Invalid Youtube URL. Make sure to enter the exact URL you see when you open the Youtube page of the video.</p>' ;
		$_SESSION["error"] = null;
} else if ( $_SESSION["error"] == 2 ){
		echo '<p class="alert alert-warning"><strong>Error! </strong>Invalid URL.</p>' ;
		$_SESSION["error"] = null;
}
if ( $_GET['id'] == "livestream" ){
	include "livestream.php";
} else if ( $_GET['id'] == "materials" ){
	include "extra_materials.php";
} else
	include "lesson_page.php";?>

<br>
<form action="lesson.php?courseName=<?php echo htmlspecialchars($_GET['courseName']);?>&id=<?php echo htmlspecialchars($_GET['id']);?>" method="post">
<?php
if ($_SESSION['teacher']){
	echo '<hr>';
	if ($_SESSION['EditMode'])
		echo '<button type="submit" class="btn btn-success" name="btnExitEditMode">Exit Edit Mode</button>';
	else
		echo '<button type="submit" class="btn btn-success" name="btnEditMode">Edit Mode</button>';
}

?>
</form>
<br>
</div></div></div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="title">Edit Exercise URL</h4>
      </div>
      <div class="modal-body">
	    <form action="buttons.php?courseName=<?php echo htmlspecialchars($_GET['courseName']);?>&id=<?php echo htmlspecialchars($_GET['id']);?>" method="post">
		      <div id="form">
			  </div>
			  <input type="hidden" class="form-control" name="objectID" id="objectIDtoSend">
			  <input type="hidden" class="form-control" name="returnURI">
		</form>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>

  </div>
</div>
<?php include "../footer.php" ?>
<script type="text/javascript">
		// script for EDIT and DELETE buttons
		function btnPress( action, object, name, URL, objectID ){
			document.getElementById("title").innerHTML = action + " " + object;
			if ( action == "Edit" ){
				if ( object == "Lesson" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>Edit Lesson Name:</strong><input type="text" class="form-control" name="name" value="' + name + '" required></div><div class="form-group"><strong>Edit Lesson Video URL:</strong><input type="text" class="form-control" name="videoURL" value="' + URL + '" required></div><button type="submit" class="btn btn-default" name="btnEditLesson">Submit Changes</button>';
				} else if ( object == "Exercises" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>Edit URL of Exercises ' + name + ':</strong><input type="text" class="form-control" name="URL" value="' + URL + '" required></div><button type="submit" class="btn btn-default" name="btnEditExercises">Submit Changes</button>';
				} else if ( object == "Material" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>Edit Material Name:</strong><input type="text" class="form-control" name="name" value="' + name + '" required></div><div class="form-group"><strong>Edit Material URL:</strong><input type="text" class="form-control" name="URL" value="' + URL + '" required></div><button type="submit" class="btn btn-default" name="btnEditMaterial">Submit Changes</button>';			
				} else if ( object == "Livestream" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>Enter youtube livestream URL or your channel ID, which can be found <a href="https://www.youtube.com/account_advanced" target="_blank">here</a>:</strong><input type="text" class="form-control" name="URL" value="' + URL + '" required></div><button type="submit" class="btn btn-default" name="btnEditLivestream">Submit Changes</button><br><br><p class="text-info">Your youtube livestream URL changes each time you start the livestream. Entering your channel ID instead of the URL will make it so that this page shows your livestream permanently. </p>';	
				} else if ( object == "Extra Material"){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>Edit Material Name:</strong><input type="text" class="form-control" name="name" value="' + name + '" required></div><div class="form-group"><strong>Edit Material URL:</strong><input type="text" class="form-control" name="URL" value="' + URL + '" required></div><button type="submit" class="btn btn-default" name="btnEditExtraMaterial">Submit Changes</button>';
				} else if ( object == "Course Name" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>Edit Course Name:</strong><input type="text" class="form-control" name="name" value="' + name + '" required></div><button type="submit" class="btn btn-default" name="btnEditCourse">Submit Changes</button>';
				}

				document.getElementById("objectIDtoSend").setAttribute("value", objectID );
			} else if ( action == "Delete" ){
				if ( object == "Lesson" ){
					document.getElementById("form").innerHTML = '<strong>Are you sure you want to delete this lesson?</strong><br><br><button type="submit" class="btn btn-default" name="btnDeleteLesson">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>';
				} else if ( object == "Exercises" ){
					document.getElementById("form").innerHTML = '<strong>Are you sure you want to delete link "Exercises ' + name + '"?</strong><br><br><button type="submit" class="btn btn-default" name="btnDeleteExercises">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>';
				} else if ( object == "Material" ){
					document.getElementById("form").innerHTML = '<strong>Are you sure you want to delete the material link "' + name + '"?</strong><br><br><button type="submit" class="btn btn-default" name="btnDeleteMaterial">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>';
				} else if ( object == "Extra Material"){
					document.getElementById("form").innerHTML = '<strong>Are you sure you want to delete the material link "' + name + '"?</strong><br><br><button type="submit" class="btn btn-default" name="btnDeleteExtraMaterial">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>'
				} else if ( object == "This Course"){
					document.getElementById("form").innerHTML = '<strong>Are you sure you want to delete this course?</strong><br><br><button type="submit" class="btn btn-default" name="btnDeleteCourse">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>'
				}

				document.getElementById("objectIDtoSend").setAttribute("value", objectID );
			} else if ( action == "Add New" ) {
				if ( object == "Lesson" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>New Lesson Name:</strong><input type="text" class="form-control" name="name" required></div><div class="form-group"><strong>New Lesson Video URL:</strong><input type="text" class="form-control" name="videoURL" required></div><button type="submit" class="btn btn-default" name="btnNewLesson">Submit Changes</button>';
				} else if ( object == "Exercises" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>URL of new Exercises link:</strong><input type="text" class="form-control" name="URL" required></div><button type="submit" class="btn btn-default" name="btnNewExercises">Submit Changes</button>';
				} else if ( object == "Material" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>New Material Name:</strong><input type="text" class="form-control" name="name" required></div><div class="form-group"><strong>New Material URL:</strong><input type="text" class="form-control" name="URL" required></div><button type="submit" class="btn btn-default" name="btnNewMaterial">Submit Changes</button>';		
				} else if ( object == "Extra Material" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>New Material Name:</strong><input type="text" class="form-control" name="name" required></div><div class="form-group"><strong>New Material URL:</strong><input type="text" class="form-control" name="URL" required></div><button type="submit" class="btn btn-default" name="btnNewExtraMaterial">Submit Changes</button>';		
				} else if ( object == "Livestream" ){
					document.getElementById("form").innerHTML = '<div class="form-group"><strong>Enter youtube livestream URL or your channel ID, which can be found <a href="https://www.youtube.com/account_advanced" target="_blank">here</a>:</strong><input type="text" class="form-control" name="URL" required></div><button type="submit" class="btn btn-default" name="btnNewLivestream">Submit Changes</button><br><br><p class="text-info">Your youtube livestream URL changes each time you start the livestream. Entering your channel ID instead of the URL will make it so that this page shows your livestream permanently. </p>';	
				}
			} 
		}
</script>


