
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( $_SESSION['logged_in'] != true ){
        header("Location: index.php");
        } ?>
        <?php 
        if ( $inModal == null )
          include "menu.php"; 
        ?>
        <div class="container">
        <h3>TEST: Lesson 1 </h3>
        <form class="container" action="Test10.php" method="post" >
        <?php include "connection.php";
        $nRow="SELECT COUNT(*) FROM exam where ID =10";
        $data_Row=$db->query($nRow);
        $number_of_row=$data_Row->fetchColumn();
        echo "This test has <b>".$number_of_row." questions</b>.<br><br>";
        $i=1;
          $myquery="SELECT * FROM exam WHERE ID=10 ";
          $question_data = $db->query($myquery);
          foreach ($question_data as $row){
$the_answer=$row["right_answer"];
echo "<div class='container' style='width:700px'><div class='well well-lg'>";
echo "<div class='form-group'>";
echo "<b>Question $i :</b>".$row["question"]."<br>";
echo "<input type='radio' name='$i' value='A'>  A.  ".$row["A"]."<br>";
echo "<input type='radio' name='$i' value='B'>  B.  ".$row["B"]."<br>";
echo "<input type='radio' name='$i' value='C'>  C.  ".$row["C"]."<br>";
echo "<input type='radio' name='$i' value='D'>  D.  ".$row["D"]."<br>";
echo  "<p id='$i' ></p>";
echo  "<input type='hidden' name='answer$i' value='$the_answer'>";
echo "</div></div></div>";
$i++;
        }
?>
        <input type='submit' class="btn btn-default" name='btnSmTest10' value='Submit' style="margin-left: 500px;" >
        </form>
        </div>
        <?php
        if(isset($_POST['btnSmTest10']))
        {
          $right_answer_numbers = 0;
          $right_answer_point = 0;
          for($i=1;$i<=$number_of_row;$i++)
          {
            if($_POST["$i"]== $_POST["answer$i"]){
              echo
              "
              <script>
              document.getElementById(\"$i\").innerHTML=\"<b >Your answer: ".$_POST[$i]." <br>Congratulations!</b>\";
              </script>
              ";
              $right_answer_numbers +=1;
              $right_answer_point +=10;
            }
            else
            {
                $answer = "Your answer: $_POST[$i] <br> Try Again!";
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
        