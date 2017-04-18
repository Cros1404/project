<script type="text/javascript">
	document.getElementById("livestream").setAttribute("class", "active");
</script>
<?php
if ( $_SESSION["error"] == 3 ){
		echo '<p class="alert alert-warning"><strong>Error! </strong>Invalid Youtube URL or channel ID.</p>' ;
		$_SESSION["error"] = null;
}
$stmt = $db -> prepare("SELECT URL, courseName FROM livestream WHERE courseName=:courseName");
$stmt -> bindParam(':courseName', $_GET['courseName']);
$stmt -> execute();
$x = $stmt -> fetch();
if ( $x ){
	echo '<iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/';
	if ( !filter_var( $x['URL'], FILTER_VALIDATE_URL) === false ){
		parse_str( parse_url( $x['URL'], PHP_URL_QUERY ), $my_array_of_vars );
		echo $my_array_of_vars['v'];
	} else 
		echo 'live_stream?channel='.$x['URL'];
	echo '" frameborder="0" allowfullscreen></iframe>';
	if ($_SESSION['EditMode']) {
		echo '<br><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Edit\', \'Livestream\', null, \''.$x['URL'].'\', null )"><span class="glyphicon glyphicon-edit"></span> Edit Livestream</button> ';
	}
}
else {
	echo '<i style="color:grey">No livestream available.</i>';
	if ($_SESSION['EditMode']) {
			echo '<br><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Add New\', \'Livestream\' )"><span class="glyphicon glyphicon-plus"></span> Add The Livestream</button> ';
	}
}
