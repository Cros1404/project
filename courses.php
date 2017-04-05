<?php include "connection.php"; ?>
<?php session_start();
if ( $_SESSION['logged_in'] != true ){
header("Location: index.php");
} ?>
<?php include "menu.php"; ?>

<div class="container list_group" style="width:500px;margin-left: 50px">

<?php
$coursename_exists = false;
if(isset($_POST['btnCreate']) and $_SESSION['teacher'] == true) {
	$given_coursename = filter_var( $_POST['course_name'], FILTER_SANITIZE_STRING ) ;
	$myquery = "SELECT courseName, url FROM course";
	$data = $db -> query($myquery);
	foreach ($data as $x)	{
		if ( strtolower( $x['courseName'] ) == strtolower( $given_coursename ) ) {
			$coursename_exists = true;
			break;
		}
	}
   
	if ( $coursename_exists == false ){
		$given_url = str_replace( " ", "_", $given_coursename );
		$add = $db -> prepare("INSERT INTO course (courseName, url) VALUES (:courseName, :url)");
	    $add -> bindParam(':courseName', $given_coursename);
	    $add -> bindParam(':url', $given_url);
	    $add -> execute();
	    mkdir( $given_url );
	}
}
$myquery = "SELECT courseName, url FROM course";
$data = $db -> query($myquery);
foreach ($data as $x)
{
    echo '<a href="'.$x['url'].'/index.php" class="list-group-item"><h4>'.$x['courseName'].'</h4></a>';
} ?>
<!-- Trigger the modal with a button -->
<?php if ( $_SESSION['teacher'] == true ){
echo '<button type="button" class="btn btn-default list-group-item" data-toggle="modal" data-target="#myModal"><h4>Create a new course</h4></button>' ;
} ?>
<!-- <a href="#" class="list-group-item"><h4>Mathematics</h4></a>
  <a href="#" class="list-group-item"><h4>Physics</h4></a>
  <a href="#" class="list-group-item"><h4>English</h4></a> -->
</div>
<?php
/*$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "Mickey Mouse\n";
fwrite($myfile, $txt);
$txt = "Minnie Mouse\n";
fwrite($myfile, $txt);
fclose($myfile);*/
?>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Course</h4>
      </div>
      <div class="modal-body">
	    <form action="courses.php" method="post">
		      <div class="form-group">
				  <label for="course_name">Course Name:</label>
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

<script>
 document.getElementById("courses").setAttribute("class", "active");
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>

<?php 
if ( $coursename_exists == true ){
		echo '<br><p class="alert alert-warning" style="width:250px;margin-left: 65px"><strong>Error!</strong> The given course name already exists.</p> </div></div>' ;
}
?>

<?php include "footer.php"; ?>