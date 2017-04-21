<?php include "connection.php" ?>
<?php session_start();
if ( $_SESSION['logged_in'] != true ){
header("Location: index.php");
} ?>


<?php include "menu.php" ?>
<script>
 document.getElementById("createtest").setAttribute("class", "active");
</script>
<h2 style="margin-left: 65px">CREATE TESTS</h2>
<p style="margin-left: 65px">Choose a couser and then choose a lesson to create a test</p>
<div class="container list_group" style="width:500px;margin-left: 50px">

<?php

$myquery = "SELECT courseName FROM course";
$data = $db -> query($myquery);
foreach ($data as $x)
{
    echo '<a class="list-group-item" data-toggle="collapse" data-target="#demo"><h4>'.$x['courseName'].'</h4></a>';
    $course_name= $x['courseName'];
    $getLesson = "SELECT lessonName,ID,courseName, testPublished FROM lesson where courseName = '$course_name' ";
    $LessonInfo = $db -> query($getLesson);
    echo '<div id="demo" class="collapse">';
    foreach ($LessonInfo as $courseInfo)
    {
        $name_lesson = $courseInfo['lessonName'];
        $ID = $courseInfo['ID'];
        $testPublished = $courseInfo['testPublished'];

      //  $_SESSION[$name_lesson]=$name_lesson;
      $myfile = fopen("MakeTest$ID.php", "w");
        echo '<a href="MakeTest'.$ID.'.php" type="button" class="btn btn-default list-group-item"><h4>'.$courseInfo['lessonName'].'</h4></a>' ;
        //echo '<a onclick="'.$name_lesson.'()" type="button" class="btn btn-default list-group-item"><h4>'.$courseInfo['lessonName'].'</h4></a>' ;
        //echo '<a class="list-group-item "><h5>'.$courseInfo['lessonName'].'</h5></a>';
        $test="
        <?php include \"connection.php\"; ?>
        <?php session_start();
        if ( $_SESSION[teacher] != true ){
        header(\"Location: index.php\");
        } ?>
        <?php include \"menu.php\" ?>
        <?php include \"control.php\" ?>
        <div class=\"container\">
        <form action=\"moveTest$ID.php\" method=\"post\">
        <input type=\"hidden\" name=\"ID\"  value=\"$ID\" id=\"ID\">
        <h2>Lesson: $name_lesson</h2>
    <div class=\"form-group\">
      <label for=\"qust\">Question:</label>
      <input type=\"text\" name=\"qust\" class=\"form-control\" id=\"qust\" >
    </div>
    <div class=\"form-group\">
      <label for=\"A\">A.</label>
      <input type=\"text\" name=\"A\" class=\"form-control\" id=\"A\" ><br>
      <label for=\"B\">B.</label>
      <input type=\"text\" name=\"B\" class=\"form-control\" id=\"B\"><br>
      <label for=\"C\">C.</label>
      <input type=\"text\" name=\"C\" class=\"form-control\" id=\"C\"><br>
      <label for=\"D\">D.</label>
      <input type=\"text\" name=\"D\" class=\"form-control\" id=\"D\"><br>
      <label for=\"ra\">Right Option:</label>
      <input type=\"text\" name=\"ra\" class=\"form-control\" id=\"ra\" pattern=\"[A-Da-d]{1}\" title=\"type option A/B/C/D\"><br>
      <button type=\"submit\" class=\"btn btn-default\" name=\"btnTest\">Create</button>
    </div>
  </form>
  <button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\">Look Through The Test</button>
  <br><br><br><br>
  <!-- Modal -->
  <div id=\"myModal\" class=\"modal fade\" role=\"dialog\" >
    <div class=\"modal-dialog\" style=\"width:1000px\">
      <!-- Modal content-->
      <div class=\"modal-content\" style=\"width:1000px\">
        <?php include \"Test$ID.php\" ?>
        <div class=\"modal-body\">
          <p>The Test will be published when publish button is pressed.</p>
        </div>
        <div class=\"modal-footer\">

        <form action=\"buttons.php?id=$ID\" method=\"post\">
        <a href=\"EditTest$ID.php\"><button type=\"button\"  class=\"btn btn-info btn-primary btn-lg\">Edit The Test</button></a>
        <?php
        \$stmt = \$db->prepare(\"SELECT testPublished FROM lesson where ID = $ID\");
        \$stmt -> execute();
        \$x = \$stmt -> fetch();
        if ( \$x['testPublished'] != 1 )
                echo '<button type=\"submit\" class=\"btn btn-info btn-primary btn-lg\" name=\"btnPublish\">Publish</button>';
        else
                echo '<button type=\"submit\" class=\"btn btn-info btn-primary btn-lg\" name=\"btnUnpublish\">Unpublish</button>';
        ?>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php include \"footer.php\"?>
        ";
        fwrite($myfile, $test);
        fclose($myfile);

        $fileTest = fopen("moveTest$ID.php","w");
        $mkTest = ' <?php
        include "connection.php";
        $add=$db->prepare("INSERT INTO exam (question,A,B,C,D,right_answer,ID) VALUES(:qust,:A,:B,:C,:D,:ra,:ID)");

            $add->bindParam(":qust", $qust);
            $add->bindParam(":A", $A);
            $add->bindParam(":B", $B);
            $add->bindParam(":C", $C);
            $add->bindParam(":D", $D);
            $add->bindParam(":ra", $ra);
            $add->bindParam(":ID", $ID);
          $qust=$_POST["qust"];
          $A=$_POST["A"];
          $B=$_POST["B"];
          $C=$_POST["C"];
          $D=$_POST["D"];
          $ra=$_POST["ra"];
          $ID=$_POST["ID"];
          $add->execute();
          header("Location: MakeTest'.$ID.'.php");
         ?>
        ';

        fwrite($fileTest, $mkTest);
        fclose($fileTest);
        $textTest=fopen("Test$ID.php","w");
        $txTest='
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( $_SESSION[\'logged_in\'] != true ){
        header("Location: index.php");
        } ?>
        <?php include "menu.php" ?>
        <div class="container">
        <h3>CREATE TEST FOR LESSON: '.$name_lesson.' </h3>
        <form class="container" action="Test'.$ID.'.php" method="post" >
        <?php include "connection.php";
        $nRow="SELECT COUNT(*) FROM exam where ID ='.$ID.'";
        $data_Row=$db->query($nRow);
        $number_of_row=$data_Row->fetchColumn();
        echo "This test has <b>".$number_of_row." questions</b>.<br><br>";
        $i=1;
          $myquery="SELECT * FROM exam WHERE ID='.$ID.' ";
          $question_data = $db->query($myquery);
          foreach ($question_data as $row){
$the_answer=$row["right_answer"];
echo "<div class=\'container\' style=\'width:700px\'><div class=\'well well-lg\'>";
echo "<div class=\'form-group\'>";
echo "<b>Question $i :</b>".$row["question"]."<br>";
echo "<input type=\'radio\' name=\'$i\' value=\'A\'>  A.  ".$row["A"]."<br>";
echo "<input type=\'radio\' name=\'$i\' value=\'B\'>  B.  ".$row["B"]."<br>";
echo "<input type=\'radio\' name=\'$i\' value=\'C\'>  C.  ".$row["C"]."<br>";
echo "<input type=\'radio\' name=\'$i\' value=\'D\'>  D.  ".$row["D"]."<br>";
echo  "<p id=\'$i\' ></p>";
echo  "<input type=\'hidden\' name=\'answer$i\' value=\'$the_answer\'>";
echo "</div></div></div>";
$i++;
        }
?>
        <input type=\'submit\' class="btn" name=\'btnSmTest'.$ID.'\' value=\'Submit\' style="margin-left: 500px;" >
        </form>
        </div>
        <?php
        if(isset($_POST[\'btnSmTest'.$ID.'\']))
        {
          $right_answer_numbers = 0;
          $right_answer_point = 0;
          for($i=1;$i<=$number_of_row;$i++)
          {
            if($_POST["$i"]== $_POST["answer$i"]){
              echo
              "
              <script>
              document.getElementById(\"$i\").innerHTML=\"<b >Your choosen is: ".$_POST[$i]." <br>Congratulations!!!</b>\";
              </script>
              ";
              $right_answer_numbers +=1;
              $right_answer_point +=10;
            }
            else
            {
                $answer = "Your answer: $_POST[$i] <br> Try Again!!!";
                if ( $_POST[$i] == null )
                  $answer = "You did not choose an answer.";
                echo "<script>document.getElementById(\"$i\").innerHTML=\"<b>".$answer."</b>\";</script>";
            }
          }
        echo "<h4 style=\"margin-left: 360px; \"><b><br> You have $right_answer_numbers right questions. <br> You have $right_answer_point points</b></h4>";
        }
        ?>
        <br><br>
        <?php include "footer.php" ?>
        ';
        fwrite($textTest,$txTest);
        fclose($textTest);



        $EditTest=fopen("EditTest$ID.php","w");
        $EditTheTest='
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( $_SESSION["teacher"] != true ){
        header("Location: index.php");
        } ?>

        <?php include "menu.php" ?>
        <div class="container">
        <h2>DELETE QUESTIONS</h2>
        <form class="" action="DeleteTestQuestion'.$ID.'.php" method="post">
        <table class="table table-striped">
          <tr class="active">
            <th>Question</th><th>A</th><th>B</th><th>C</th><th>D</th><th>Right Answer</th><th>Delete</th>
          </tr>
          <?php
          include "connection.php";
          $myquery="SELECT question,A,B,C,D,right_answer,id_question,ID FROM exam WHERE ID='.$ID.'";
          $question_data = $db->query($myquery);

          foreach ($question_data as $row) {

            echo "<tr ><td >".$row[\'question\']."</td><td>".$row[\'A\']."</td><td>".$row[\'B\']."</td><td>".$row[\'C\']."</td><td>".$row[\'D\']."</td><td>".$row[\'right_answer\']."</td>";
            echo "<td><input type=\'Checkbox\' name=\'chosen[]\' value=\'".$row[\'id_question\']."\'></td>";

            echo "</tr>";
            }
           ?>

        </table>

        <input  type="submit" class="btn" name="deleteSelected" value="Delete">


        </form>

        </div>
        <?php include "footer.php" ?>

        ';
        fwrite($EditTest,$EditTheTest);
        fclose($EditTest);


        $DeleteQuestion=fopen("DeleteTestQuestion$ID.php","w");
        $DeleteTheTestQuestion='
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( $_SESSION["teacher"] != true ){
        header("Location: index.php");
        } ?>

<?php
include "connection.php";
$id=$_POST[\'chosen\'];
$id_list=implode(",",$id);

$sql="DELETE FROM exam WHERE id_question IN ($id_list)";
$db->query($sql);
header("Location: EditTest'.$ID.'.php");
header("Location: Test'.$ID.'.php");



?>
        ';
        fwrite($DeleteQuestion,$DeleteTheTestQuestion);
        fclose($DeleteQuestion);



    }
    echo '</div>';
}

?>
<!-- Trigger the modal with a button -->

</div>

<?php include "footer.php" ?>
