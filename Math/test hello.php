<?php 
include "../connection.php";

$myquery = "select videoURL from lesson WHERE courseName='Math' AND lessonIndex=1;";
$data = $db -> query($myquery);

echo $data['videoURL'] ;
 ?>