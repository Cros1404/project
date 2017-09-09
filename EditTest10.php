
        <?php include "connection.php"; ?>
        <?php session_start();
        if ( $_SESSION["teacher"] != true ){
        header("Location: index.php");
        } ?>

        <?php include "menu.php" ?>
        <div class="container">
        <h2>DELETE QUESTIONS</h2>
        <form class="" action="DeleteTestQuestion10.php" method="post">
        <table class="table table-striped">
          <tr class="active">
            <th>Question</th><th>A</th><th>B</th><th>C</th><th>D</th><th>Right Answer</th><th>Delete</th>
          </tr>
          <?php
          include "connection.php";
          $myquery="SELECT question,A,B,C,D,right_answer,id_question,ID FROM exam WHERE ID=10";
          $question_data = $db->query($myquery);

          foreach ($question_data as $row) {

            echo "<tr ><td >".$row['question']."</td><td>".$row['A']."</td><td>".$row['B']."</td><td>".$row['C']."</td><td>".$row['D']."</td><td>".$row['right_answer']."</td>";
            echo "<td><input type='Checkbox' name='chosen[]' value='".$row['id_question']."'></td>";

            echo "</tr>";
            }
           ?>

        </table>

        <input  type="submit" class="btn btn-default" name="deleteSelected" value="Delete">


        </form>

        </div>
        <?php include "footer.php" ?>

        