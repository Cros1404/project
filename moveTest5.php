 <?php
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
          header("Location: MakeTest5.php");
         ?>
        