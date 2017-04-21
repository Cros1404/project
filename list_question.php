<?php include "menu.php" ?>
<div class="container">
<h2>LIST QUESTION</h2>

<table border="1" class="table table-bordered">
  <tr class="active">
    <th>ID Lesson</th><th>Question</th><th>A</th><th>B</th><th>C</th><th>D</th><th>Right Answer</th><th>Edit</th><th>Delete</th>
  </tr>
  <?php
  include "connection.php";
  $myquery="SELECT question,A,B,C,D,right_answer,id_question,ID FROM exam";
  $question_data = $db->query($myquery);

  foreach ($question_data as $row) {

    echo '<tr><td class="active">'.$row['ID'].'</td><td>'.$row['question'].'</td><td> '.$row['A'].'</td><td> '.$row['B'].'</td><td> '.$row['C'].'</td><td> '.$row['D'].'</td><td> '.$row['right_answer'].'</td>';
    echo '<td><a href="update_question.php?id='.$row['id_question'].'"><button>Update</button></a></td>';
    echo '<td><a href="delete_question.php?id='.$row['id_question'].'"><button>Delete</button></a></td>';
    echo '</tr>';
    }
   ?>

</table>
</div>
<?php include "footer.php" ?>
