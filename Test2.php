
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( $_SESSION['logged_in'] != true ){
        header("Location: index.php");
        } ?>
        <?php include "menu.php" ?>
        <div class="container">
        <h3>CREATE TEST FOR LESSON: Lesson 2 </h3>
        <form class="container" action="Test2.php" method="post" >
        <?php include "connection.php";
        $nRow="SELECT COUNT(*) FROM exam where ID =2";
        $data_Row=$db->query($nRow);
        $number_of_row=$data_Row->fetchColumn();
        echo "This test has <b>".$number_of_row." questions</b>.<br><br>";
        $i=1;
          $myquery="SELECT * FROM exam WHERE ID=2 ";
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
echo  "<input type='hidden' name='answer$i' value='$the_answer'><br>";
echo "</div></div></div>";
$i++;
        }
?>
        <div class='container' style="margin-left: 500px;">
        <input type='submit' class="btn" name='btnSmTest2' value='Submit' >
        </div>
        </form>
        </div>
        <?php
        if(isset($_POST['btnSmTest2']))
        {
          for($i=1;$i<=$number_of_row;$i++)
          {
            if($_POST["$i"]== $_POST["answer$i"]){
              echo
              "
              <script>
              document.getElementById(\"$i\").innerHTML=\"<b >Your choosen is: ".$_POST[$i].". Congratulation!!!</b>\";
              </script>
              ";
              $right_answer_numbers +=1;
              $right_answer_point +=10;
            }
            else
            {
                echo "<script>document.getElementById(\"$i\").innerHTML=\"<b>Your choosen is:".$_POST[$i].". Try Again!!!</b>\";</script>";
            }
          }
        echo "<br> You have $right_answer_numbers right questions. <br> You have $right_answer_point points";
        }
        ?>
        <?php include "footer.php" ?>
        