<?php 
// find video link
$stmt = $db -> prepare("SELECT videoURL FROM lesson WHERE ID=:id");
$stmt -> bindParam(':id', $_GET['id']);
$stmt -> execute();
$x = $stmt -> fetch();
echo '<iframe width="560" height="315" src="'.$x['videoURL'].'" frameborder="0" allowfullscreen></iframe>';
if ($_SESSION['EditMode']) {
	echo '<br><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span> Edit Lesson</button> ' ;
	echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span> Remove Lesson</button><br> ' ;
}

//find exercise link
$stmt = $db -> prepare("SELECT URL FROM exercise WHERE lessonID=:id");
$stmt -> bindParam(':id', $_GET['id']);
$stmt -> execute();
foreach ($stmt as $index => $x) {
	echo '<br><a href="'.$x['URL'].'" target="_blank">Exercises '.($index + 1).' </a>' ;
	if ($_SESSION['EditMode']) {
		echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editExercise"><span class="glyphicon glyphicon-edit"></span></button> ' ;
		echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span></button>' ;
	}
}


echo '<hr>' ;

//find material links
$stmt = $db -> prepare("SELECT URL, materialName FROM material WHERE lessonID=:id");
$stmt -> bindParam(':id', $_GET['id']);
$stmt -> execute();
foreach ( $stmt as $index => $x ) {
	if ( $index != 0 )
		echo '<br>';
	echo '<a href="'.$x['URL'].'" target="_blank">'.$x['materialName'].' </a>' ;
	if ($_SESSION['EditMode']) {
		echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span></button> ';
		echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span></button>' ;
	}
}

echo '<script type="text/javascript">
	document.getElementById("lesson'.$_GET['id'].'").setAttribute("class", "active");
</script>';
?>