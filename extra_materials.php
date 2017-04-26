<script type="text/javascript">
	document.getElementById("materials").setAttribute("class", "active");
</script>
<h2>Study Materials</h2>
<hr>
<?php
$stmt = $db -> prepare("SELECT ID, URL, materialName FROM extraMaterial WHERE courseName=:courseName");
$stmt -> bindParam(':courseName', $_GET['courseName']);
$stmt -> execute();
$empty = true;
foreach ( $stmt as $index => $x ) {
	$empty = false;
	if ( $index != 0 )
		echo '<br>';
	echo '<a href="'.$x['URL'].'" target="_blank">'.$x['materialName'].' </a>' ;
	if ($_SESSION['EditMode']) {
		echo '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Edit\', \'Extra Material\', \''.$x['materialName'].'\', \''.$x['URL'].'\', '.$x['ID'].' )"><span class="glyphicon glyphicon-edit"></span></button> ';
		echo '<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Delete\', \'Extra Material\', \''.$x['materialName'].'\', null, '.$x['ID'].' )"><span class="glyphicon glyphicon-remove"></span></button>' ;
	}
}

if ( $empty )
	echo '<br><i style="color:grey">No extra materials available.</i>';

if ($_SESSION['EditMode']) 
	echo '<br><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="btnPress( \'Add New\', \'Extra Material\')"><span class="glyphicon glyphicon-plus"></span> Add New Material</button>' ;