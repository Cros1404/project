<?php 

echo '<!-- Modal -->
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
		</div>';

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
?>