<?php
// find video link
$stmt = $db -> prepare("SELECT ID, videoURL, lessonName, testPublished FROM lesson WHERE ID=:id");
$stmt -> bindParam(':id', $_GET['id']);
$stmt -> execute();
$x = $stmt -> fetch();
$testPublished = $x['testPublished'];
parse_str( parse_url( $x['videoURL'], PHP_URL_QUERY ), $my_array_of_vars ); // Get video ID from URL
echo '<iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/'.$my_array_of_vars['v'].'" frameborder="0" allowfullscreen></iframe>';
if ($_SESSION['EditMode']) {
	echo '<br><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Edit\', \'Lesson\', \''.$x['lessonName'].'\', \''.$x['videoURL'].'\', '.$x['ID'].' )"><span class="glyphicon glyphicon-edit"></span> Edit Lesson</button> ' ;
	echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Delete\', \'Lesson\', null, null, '.$x['ID'].' )"><span class="glyphicon glyphicon-remove"></span> Delete Lesson</button><br> ' ;
}

//find exercise links
$stmt = $db -> prepare("SELECT ID, URL FROM exercise WHERE lessonID=:id");
$stmt -> bindParam(':id', $_GET['id']);
$stmt -> execute();
$empty = true;
foreach ($stmt as $index => $x) {
	$empty = false;
	echo '<br><a href="'.$x['URL'].'" target="_blank">Exercises '.($index + 1).' </a>' ;
	if ($_SESSION['EditMode']) {
		echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Edit\', \'Exercises\', '.($index + 1).', \''.$x['URL'].'\', '.$x['ID'].' )"><span class="glyphicon glyphicon-edit"></span></button> ' ;
		echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Delete\', \'Exercises\', '.($index + 1).', null, '.$x['ID'].' )"><span class="glyphicon glyphicon-remove"></span></button>' ;
	}
}

if ( $empty ){
	echo '<br><i style="color:grey">No exercises available.</i>';
}

if ($_SESSION['EditMode']) {
	echo '<br><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Add New\', \'Exercises\')"><span class="glyphicon glyphicon-plus"></span> Add New Exercises</button>' ;
}

echo '<hr>' ;

//find material links
$stmt = $db -> prepare("SELECT ID, URL, materialName FROM material WHERE lessonID=:id");
$stmt -> bindParam(':id', $_GET['id']);
$stmt -> execute();
$empty = true;
foreach ( $stmt as $index => $x ) {
	$empty = false;
	if ( $index != 0 )
		echo '<br>';
	echo '<a href="'.$x['URL'].'" target="_blank">'.$x['materialName'].' </a>' ;
	if ($_SESSION['EditMode']) {
		echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Edit\', \'Material\', \''.$x['materialName'].'\', \''.$x['URL'].'\', '.$x['ID'].' )"><span class="glyphicon glyphicon-edit"></span></button> ';
		echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Delete\', \'Material\', \''.$x['materialName'].'\', null, '.$x['ID'].' )"><span class="glyphicon glyphicon-remove"></span></button>' ;
	}
}

if ( $empty )
	echo '<i style="color:grey">No materials available.</i>';

if ($_SESSION['EditMode'])
	echo '<br><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Add New\', \'Material\')"><span class="glyphicon glyphicon-plus"></span> Add New Material</button>' ;

if ( $testPublished == true )
  echo '<hr><a href="Test'.htmlspecialchars($_GET['id']).'.php" class="btn btn-default"> Test</a>' ;
else
  echo '<hr><i style="color:grey">No test available.</i>';

echo '<script type="text/javascript">
	document.getElementById("lesson'.htmlspecialchars($_GET['id']).'").setAttribute("class", "active");
</script>';
?>
