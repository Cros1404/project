<?php
include "connection.php";
session_start();

if ( $_SESSION['teacher'] != true )
  header("Location: index.php");
else {
	if ( isset($_POST['btnEditLesson'] ) ) {
		if ( preg_match( "/^https:\/\/www\.youtube\.com\/watch\?.*v=.{11}.*/", $_POST['videoURL'] ) === 1 && !filter_var( $_POST['videoURL'], FILTER_VALIDATE_URL) === false ){
			$url = filter_var( $_POST['videoURL'], FILTER_SANITIZE_URL );
			$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("UPDATE lesson SET videoURL=:videoURL, lessonName=:name WHERE ID=:id");
			$stmt -> bindParam(':id', $_POST['objectID']);
			$stmt -> bindParam(':videoURL', $url );
			$stmt -> bindParam(':name', $name );
			$stmt -> execute();
		} else
			$_SESSION['error'] = 1;

	} else if ( isset( $_POST['btnEditExercises'] ) ) {
		if ( filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false )
			$_SESSION['error'] = 2 ;
		else {
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$stmt = $db -> prepare("UPDATE exercise SET URL=:URL WHERE ID=:id");
			$stmt -> bindParam(':id', $_POST['objectID']);
			$stmt -> bindParam(':URL', $url );
			$stmt -> execute();
		}
	} else if ( isset( $_POST['btnEditMaterial'] ) ) {
		if ( filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false )
			$_SESSION['error'] = 2 ;
		else {
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("UPDATE material SET URL=:URL, materialName=:name WHERE ID=:id");
			$stmt -> bindParam(':id', $_POST['objectID']);
			$stmt -> bindParam(':URL', $url );
			$stmt -> bindParam(':name', $name );
			$stmt -> execute();
		}
	} else if ( isset( $_POST['btnEditExtraMaterial'] ) ) {
		if ( filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false )
			$_SESSION['error'] = 2 ;
		else {
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("UPDATE extraMaterial SET URL=:URL, materialName=:name WHERE ID=:id");
			$stmt -> bindParam(':id', $_POST['objectID']);
			$stmt -> bindParam(':URL', $url );
			$stmt -> bindParam(':name', $name );
			$stmt -> execute();
		}
	} else if ( isset( $_POST['btnEditLivestream'] ) ){
		if (  preg_match( "/^.{23}$/", $_POST['URL'] ) ){
			$channelID = filter_var( $_POST['URL'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("UPDATE livestream SET URL=:URL WHERE courseName=:courseName");
			$stmt -> bindParam(':courseName', $_GET['courseName']);
			$stmt -> bindParam(':URL', $channelID );
			$stmt -> execute();
		} else if ( preg_match( "/^https:\/\/www\.youtube\.com\/watch\?.*v=.{11}.*/", $_POST['URL'] ) === 1 && !filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false ){
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$stmt = $db -> prepare("UPDATE livestream SET URL=:URL WHERE courseName=:courseName");
			$stmt -> bindParam(':courseName', $_GET['courseName']);
			$stmt -> bindParam(':URL', $url );
			$stmt -> execute();
		} else
			$_SESSION['error'] = 3 ;
	} else if ( isset( $_POST['btnDeleteExercises'] ) ) {
		$stmt = $db -> prepare("DELETE FROM exercise WHERE ID=:id");
		$stmt -> bindParam(':id', $_POST['objectID']);
		$stmt -> execute();

	} else if ( isset( $_POST['btnDeleteMaterial'] )){
			$stmt = $db -> prepare("DELETE FROM material WHERE ID=:id");
			$stmt -> bindParam(':id', $_POST['objectID']);
			$stmt -> execute();
	} else if ( isset( $_POST['btnDeleteExtraMaterial'] )){
			$stmt = $db -> prepare("DELETE FROM extraMaterial WHERE ID=:id");
			$stmt -> bindParam(':id', $_POST['objectID']);
			$stmt -> execute();
	} else if ( isset( $_POST['btnNewExercises'] ) ) {
		if ( filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false )
			$_SESSION['error'] = 2 ;
		else {
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$stmt = $db -> prepare("INSERT INTO exercise(lessonID, URL) VALUES(:id, :URL);");
			$stmt -> bindParam(':id', $_GET['id']);
			$stmt -> bindParam(':URL', $url);
			$stmt -> execute();
		}
	} else if ( isset( $_POST['btnNewMaterial'] ) ) {
		if ( filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false )
			$_SESSION['error'] = 2 ;
		else {
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("INSERT INTO material(lessonID, URL, materialName) VALUES(:id, :URL, :name);");
			$stmt -> bindParam(':id', $_GET['id']);
			$stmt -> bindParam(':URL', $url);
			$stmt -> bindParam(':name', $name );
			$stmt -> execute();
		}
	} else if ( isset( $_POST['btnNewExtraMaterial'] ) ) {
		if ( filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false )
			$_SESSION['error'] = 2 ;
		else {
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("INSERT INTO extraMaterial(courseName, URL, materialName) VALUES(:courseName, :URL, :name);");
			$stmt -> bindParam(':courseName', $_GET['courseName']);
			$stmt -> bindParam(':URL', $url);
			$stmt -> bindParam(':name', $name );
			$stmt -> execute();
		}
	} else if ( isset($_POST['btnNewLesson'] ) ) {
		if ( preg_match( "/^https:\/\/www\.youtube\.com\/watch\?.*v=.{11}.*/", $_POST['videoURL'] ) === 1 && !filter_var( $_POST['videoURL'], FILTER_VALIDATE_URL) === false ){
			$url = filter_var( $_POST['videoURL'], FILTER_SANITIZE_URL );
			$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("INSERT INTO lesson(courseName, lessonName, videoURL) VALUES(:courseName, :lessonName, :videoURL)");
			$stmt -> bindParam(':courseName', $_GET['courseName']);
			$stmt -> bindParam(':lessonName', $name );
			$stmt -> bindParam(':videoURL', $url );
			$stmt -> execute();
		} else
			$_SESSION['error'] = 1;
	} else if ( isset( $_POST['btnNewLivestream'] ) ){
		if (  preg_match( "/^.{23}$/", $_POST['URL'] ) ){
			$channelID = filter_var( $_POST['URL'], FILTER_SANITIZE_STRING );
			$stmt = $db -> prepare("INSERT INTO livestream(courseName, URL) VALUES(:courseName, :URL)");
			$stmt -> bindParam(':courseName', $_GET['courseName']);
			$stmt -> bindParam(':URL', $channelID );
			$stmt -> execute();
		} else if ( preg_match( "/^https:\/\/www\.youtube\.com\/watch\?.*v=.{11}.*/", $_POST['URL'] ) === 1 && !filter_var( $_POST['URL'], FILTER_VALIDATE_URL) === false ){
			$url = filter_var( $_POST['URL'], FILTER_SANITIZE_URL );
			$stmt = $db -> prepare("INSERT INTO livestream(courseName, URL) VALUES(:courseName, :URL)");
			$stmt -> bindParam(':courseName', $_GET['courseName']);
			$stmt -> bindParam(':URL', $url );
			$stmt -> execute();
		} else
			$_SESSION['error'] = 3 ;
	}

	header("Location: lesson.php?courseName=".$_GET['courseName']."&id=".$_GET['id']);

	if ( isset($_POST['btnDeleteLesson'] ) ) {
		$stmt = $db -> prepare("DELETE FROM lesson WHERE ID=:id");
		$stmt -> bindParam(':id', $_POST['objectID']);
		$stmt -> execute();
		header("Location: lesson.php?courseName=".$_GET['courseName']."&id=livestream");
	} else if ( isset( $_POST['btnEditCourse'] ) ){
		$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
		$stmt = $db -> prepare("UPDATE course SET courseName=:newCourseName WHERE courseName=:oldCourseName");
		$stmt -> bindParam(':oldCourseName', $_GET['courseName']);
		$stmt -> bindParam(':newCourseName', $name);
		$stmt -> execute();
		header("Location: lesson.php?courseName=".$name."&id=".$_GET['id']."");
	} else if ( isset( $_POST['btnDeleteCourse'] ) ){
		$stmt = $db -> prepare("DELETE FROM course WHERE courseName=:courseName");
		$stmt -> bindParam(':courseName', $_GET['courseName']);
		$stmt -> execute();
		header("Location: courses.php");
	} else if ( isset( $_POST['btnPublish'] ) ){
    $stmt = $db -> prepare("UPDATE lesson SET testPublished=true WHERE ID=:id");
		$stmt -> bindParam(':id', $_GET['id']);
		$stmt -> execute();
    header("Location: MakeTest".$_GET['id'].".php");
  } else if ( isset( $_POST['btnUnpublish'] ) ){
    $stmt = $db -> prepare("UPDATE lesson SET testPublished=false WHERE ID=:id");
		$stmt -> bindParam(':id', $_GET['id']);
		$stmt -> execute();
    header("Location: MakeTest".$_GET['id'].".php");
  }
}
