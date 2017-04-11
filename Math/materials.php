<?php include "course_menu.php"; ?>
<script type="text/javascript">
	document.getElementById("materials").setAttribute("class", "active");
</script>
<?php
if ($_SESSION['teacher'])
	if ($_SESSION['EditMode'])
		echo '<button type="submit" class="btn btn-success" name="btnExitEditMode">Exit Edit Mode</button>';
	else
		echo '<button type="submit" class="btn btn-success" name="btnEditMode">Edit Mode</button>';
?>
<?php include "../footer.php" ?>